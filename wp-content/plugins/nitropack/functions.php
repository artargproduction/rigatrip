<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
require_once  'constants.php';
require_once  'nitropack-sdk/autoload.php';
$np_originalRequestCookies = $_COOKIE;
$np_customExpirationTimes = array();
$np_queriedObj = NULL;
$np_preUpdatePosts = array();
$np_preUpdateTaxonomies = array();

function nitropack_is_logged_in() {
    $loginCookies = array(defined('NITROPACK_LOGGED_IN_COOKIE') ? NITROPACK_LOGGED_IN_COOKIE : (defined('LOGGED_IN_COOKIE') ? LOGGED_IN_COOKIE : ''));
    foreach ($loginCookies as $loginCookie) {
        if (!empty($_COOKIE[$loginCookie])) {
            return true;
        }
    }

    return false;
}

function nitropack_passes_cookie_requirements() {
    $cookieStr = implode("|", array_keys($_COOKIE));
    $safeCookie = strpos($cookieStr, "comment_author") === false && strpos($cookieStr, "wp-postpass_") === false && empty($_COOKIE["woocommerce_items_in_cart"]);
    $isUserLoggedIn = nitropack_is_logged_in();

    return $safeCookie && !$isUserLoggedIn;
}

function nitropack_activate() {
    nitropack_set_wp_cache_const(true);
    $htaccessFile = nitropack_trailingslashit(NITROPACK_DATA_DIR) . ".htaccess";
    if (!file_exists($htaccessFile) && nitropack_init_data_dir()) {
        file_put_contents($htaccessFile, "deny from all");
    }
    nitropack_install_advanced_cache();

    try {
        do_action('nitropack_integration_purge_all');
    } catch (\Exception $e) {
        // Exception while signaling our 3rd party integration addons to purge their cache
    }

    if (nitropack_is_connected()) {
        nitropack_event("enable_extension");
    } else {
        setcookie("nitropack_after_activate_notice", 1, time() + 3600);
    }
}

function nitropack_deactivate() {
    nitropack_set_wp_cache_const(false);
    nitropack_uninstall_advanced_cache();

    try {
        do_action('nitropack_integration_purge_all');
    } catch (\Exception $e) {
        // Exception while signaling our 3rd party integration addons to purge their cache
    }

    if (nitropack_is_connected()) {
        nitropack_event("disable_extension");
    }
}

function nitropack_install_advanced_cache() {
    if (nitropack_is_conflicting_plugin_active()) return false;

    $templatePath = nitropack_trailingslashit(__DIR__) . "advanced-cache.php";
    if (file_exists($templatePath)) {
        $contents = file_get_contents($templatePath);
        $contents = str_replace("/*NITROPACK_FUNCTIONS_FILE*/", __FILE__, $contents);
        $contents = str_replace("/*LOGIN_COOKIES*/", defined("LOGGED_IN_COOKIE") ? LOGGED_IN_COOKIE : "", $contents);
        $contents = str_replace("/*NP_VERSION*/", NITROPACK_VERSION, $contents);

        $advancedCacheFile = nitropack_trailingslashit(WP_CONTENT_DIR) . 'advanced-cache.php';
        if (WP_DEBUG) {
            return file_put_contents($advancedCacheFile, $contents);
        } else {
            return @file_put_contents($advancedCacheFile, $contents);
        }
    }
}

function nitropack_uninstall_advanced_cache() {
    $advancedCacheFile = nitropack_trailingslashit(WP_CONTENT_DIR) . 'advanced-cache.php';
    if (file_exists($advancedCacheFile)) {
        if (WP_DEBUG) {
            return file_put_contents($advancedCacheFile, "");
        } else {
            return @file_put_contents($advancedCacheFile, "");
        }
    }
}

function nitropack_set_wp_cache_const($status) {
    if (nitropack_is_flywheel()) { // Flywheel: This is configured throught the FW control panel
        return true;
    }

    $configFilePath = nitropack_trailingslashit(ABSPATH) . "wp-config.php";
    if (!file_exists($configFilePath)) {
        $configFilePath = nitropack_trailingslashit(dirname(ABSPATH)) . "wp-config.php";
        $settingsFilePath = nitropack_trailingslashit(dirname(ABSPATH)) . "wp-settings.php"; // We need to check for this file to avoid confusion if the current installation is a nested directory of another WP installation. Refer to wp-load.php for more information.
        if (!file_exists($configFilePath) || !is_writable($configFilePath) || file_exists($settingsFilePath)) {
            return false;
        }
    }

    $newVal = sprintf("define( 'WP_CACHE', %s); // Modified by NitroPack\n", ($status ? "true" : "false") );
    $lines = file($configFilePath);
    $wpCacheFound = false;

    foreach ($lines as &$line) {
        if (preg_match("/define\s*\(\s*['\"](.*?)['\"]/", $line, $matches)) {
            if ($matches[1] == "WP_CACHE") {
                $line = $newVal;
                $wpCacheFound = true;
                break;
            }
        }
    }

    if (!$wpCacheFound) {
        if (!$status) return true; // No need to modify the file at all
        array_splice($lines, 1, 0, [$newVal]);
    }

    return WP_DEBUG ? file_put_contents($configFilePath, implode("", $lines)) : @file_put_contents($configFilePath, implode("", $lines));
}

function is_valid_nitropack_webhook() {
    return !empty($_GET["nitroWebhook"]) && !empty($_GET["token"]) && nitropack_validate_webhook_token($_GET["token"]);
}

function is_valid_nitropack_beacon() {
    if (!isset($_POST["nitroBeaconUrl"]) || !isset($_POST["nitroBeaconHash"])) return false;

    $siteConfig = nitropack_get_site_config();
    if (!$siteConfig || empty($siteConfig["siteSecret"])) return false;
    
    if (function_exists("hash_hmac") && function_exists("hash_equals")) {
        $url = base64_decode($_POST["nitroBeaconUrl"]);
        $cookiesJson = !empty($_POST["nitroBeaconCookies"]) ? base64_decode($_POST["nitroBeaconCookies"]) : ""; // We need to fall back to empty string to remain backwards compatible. Otherwise cache files invalidated before an upgrade will never get updated :(
        $localHash = hash_hmac("sha512", $url.$cookiesJson, $siteConfig["siteSecret"]);
        return hash_equals($_POST["nitroBeaconHash"], $localHash);
    } else {
        return !empty($_POST["nitroBeaconUrl"]);
    }
}

function nitropack_handle_beacon() {
    global $np_originalRequestCookies;
    $siteConfig = nitropack_get_site_config();
    if ($siteConfig && !empty($siteConfig["siteId"]) && !empty($siteConfig["siteSecret"]) && !empty($_POST["nitroBeaconUrl"])) {
        $url = base64_decode($_POST["nitroBeaconUrl"]);

        if (!empty($_POST["nitroBeaconCookies"])) {
            $np_originalRequestCookies = json_decode(base64_decode($_POST["nitroBeaconCookies"]), true);
        }

        if (null !== $nitro = get_nitropack_sdk($siteConfig["siteId"], $siteConfig["siteSecret"], $url) ) {
            try {
                if (!$nitro->hasLocalCache(false)) {
                    header("X-Nitro-Beacon: FORWARD");
                    $hasCache = $nitro->hasRemoteCache("default", false); // Download the new cache file
                    $nitro->purgeProxyCache($url);
                    do_action('nitropack_integration_purge_url', $url);
                    printf("Cache %s", $hasCache ? "fetched" : "requested");
                } else {
                    header("X-Nitro-Beacon: SKIP");
                    printf("Cache exists already");
                }
            } catch (Exception $e) {
                // not a critical error, do nothing
            }
        }
    }
    exit;
}

function nitropack_handle_webhook() {
    $siteConfig = nitropack_get_site_config();
    if ($siteConfig && $siteConfig["webhookToken"] == $_GET["token"]) {
        switch($_GET["nitroWebhook"]) {
        case "config":
            nitropack_fetch_config();
            break;
        case "cache_ready":
            if (!empty($_POST["url"])) {
                $readyUrl = NULL;
                if (!function_exists("esc_url")) {
                    $sanitizedUrl = filter_var($_POST["url"], FILTER_SANITIZE_URL);
                    if ($sanitizedUrl !== false && filter_var($sanitizedUrl, FILTER_VALIDATE_URL) !== false) {
                        $readyUrl = $sanitizedUrl;
                    }
                } else if ($validatedUrl = esc_url($_POST["url"], array("http", "https"), "notdisplay")) {
                    $readyUrl = $validatedUrl;
                }

                if ($readyUrl && null !== $nitro = get_nitropack_sdk($siteConfig["siteId"], $siteConfig["siteSecret"], $readyUrl) ) {
                    $hasCache = $nitro->hasRemoteCache("default", false); // Download the new cache file
                    $nitro->purgeProxyCache($readyUrl);
                    do_action('nitropack_integration_purge_url', $readyUrl);
                }
            }
            break;
        case "cache_clear":
            if (!empty($_POST["url"])) {
                $urls = is_array($_POST["url"]) ? $_POST["url"] : array($_POST["url"]);
                foreach ($urls as $url) {
                    if (!function_exists("esc_url")) {
                        $sanitizedUrl = filter_var($url, FILTER_SANITIZE_URL);
                        if ($sanitizedUrl !== false && filter_var($sanitizedUrl, FILTER_VALIDATE_URL) !== false) {
                            nitropack_sdk_purge_local($sanitizedUrl);
                        }
                    } else if ($validatedUrl = esc_url($url, array("http", "https"), "notdisplay")) {
                        nitropack_sdk_purge_local($validatedUrl);
                    }
                }
            } else {
                nitropack_sdk_purge_local();
            }
            break;
        }
    }
    exit;
}

function nitropack_passes_page_requirements() {
    return !(
        is_404() ||
        is_preview() ||
        is_feed() ||
        is_comment_feed() ||
        is_trackback() ||
        is_user_logged_in() ||
        is_search() ||
        nitropack_is_ajax() ||
        nitropack_is_post() ||
        nitropack_is_xmlrpc() ||
        nitropack_is_robots() ||
        !nitropack_is_allowed_request() ||
        ( defined('DOING_CRON') && DOING_CRON ) || // CRON request
        ( defined('WC_PLUGIN_FILE') && (is_page( 'cart' ) || is_cart()) ) || // WooCommerce
        ( defined('WC_PLUGIN_FILE') && (is_page( 'checkout' ) || is_checkout()) ) || // WooCommerce
        ( defined('WC_PLUGIN_FILE') && is_account_page() ) // WooCommerce
    );
}

function nitropack_is_home() {
    return is_front_page() || is_home();
}

function nitropack_is_archive() {
    return is_author() || is_archive();
}

function nitropack_is_allowed_request() {
    global $np_queriedObj;
    $cacheableObjectTypes = nitropack_get_cacheable_object_types();
    if (!empty($cacheableObjectTypes)) {
        if (nitropack_is_home()) {
            if (!in_array('home', $cacheableObjectTypes)) {
                return false;
            }
        } else {
            if (is_tax() || is_category() || is_tag()) {
                $np_queriedObj = get_queried_object();
                if (!in_array($np_queriedObj->taxonomy, $cacheableObjectTypes)) {
                    return false;
                }
            } else {
                if (nitropack_is_archive()) {
                    if (!in_array('archive', $cacheableObjectTypes)) {
                        return false;
                    }
                } else {
                    $postType = get_post_type();
                    if (!in_array($postType, $cacheableObjectTypes)) {
                        return false;
                    }
                }
            }
        }
    }

    if (null !== $nitro = get_nitropack_sdk() ) {
        return $nitro->isAllowedUrl($nitro->getUrl()) && $nitro->isAllowedRequest(true);
    }

    return false;
}

function nitropack_is_ajax() {
    return (function_exists("wp_doing_ajax") && wp_doing_ajax()) || (defined('DOING_AJAX') && DOING_AJAX) || (!empty($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] == "XMLHttpRequest");
}

function nitropack_is_rest() {
    // Source: https://wordpress.stackexchange.com/a/317041
    $prefix = rest_get_url_prefix( );
    if (defined('REST_REQUEST') && REST_REQUEST // (#1)
        || isset($_GET['rest_route']) // (#2)
        && strpos( trim( $_GET['rest_route'], '\\/' ), $prefix , 0 ) === 0)
        return true;
    // (#3)
    global $wp_rewrite;
    if ($wp_rewrite === null) $wp_rewrite = new WP_Rewrite();

    // (#4)
    $rest_url = wp_parse_url( trailingslashit( rest_url( ) ) );
    $current_url = wp_parse_url( add_query_arg( array( ) ) );
    return strpos( $current_url['path'], $rest_url['path'], 0 ) === 0;
}

function nitropack_is_post() {
    return (!empty($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') || (empty($_SERVER['REQUEST_METHOD']) && !empty($_POST));
}

function nitropack_is_xmlrpc() {
    return defined('XMLRPC_REQUEST') && XMLRPC_REQUEST;
}

function nitropack_is_robots() {
    return is_robots() || (!empty($_SERVER["REQUEST_URI"]) && basename(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH)) === "robots.txt");
}

// IMPORTANT: This function should only be trusted if NitroPack is connected. Otherwise we may not have information about the admin URL in the config file and it may return an incorrect result
function nitropack_is_admin() {
    if ((nitropack_is_ajax() || nitropack_is_rest()) && !empty($_SERVER["HTTP_REFERER"])) {
        $adminUrl = NULL;
        $siteConfig = nitropack_get_site_config();
        if ($siteConfig && !empty($siteConfig["admin_url"])) {
            $adminUrl = $siteConfig["admin_url"];
        } else if (function_exists("admin_url")) {
            $adminUrl = admin_url();
        } else {
            return is_admin();
        }

        return strpos($_SERVER["HTTP_REFERER"], $adminUrl) === 0;
    } else {
        return is_admin();
    }
}

function nitropack_is_warmup_request() {
    return !empty($_SERVER["HTTP_X_NITRO_WARMUP"]);
}

function nitropack_is_lighthouse_request() {
    return !empty($_SERVER["HTTP_USER_AGENT"]) && stripos($_SERVER["HTTP_USER_AGENT"], "lighthouse") !== false;
}

function nitropack_is_gtmetrix_request() {
    return !empty($_SERVER["HTTP_USER_AGENT"]) && stripos($_SERVER["HTTP_USER_AGENT"], "gtmetrix") !== false;
}

function nitropack_is_pingdom_request() {
    return !empty($_SERVER["HTTP_USER_AGENT"]) && stripos($_SERVER["HTTP_USER_AGENT"], "pingdom") !== false;
}

function nitropack_is_optimizer_request() {
    return isset($_SERVER["HTTP_X_NITROPACK_REQUEST"]);
}

function nitropack_init() {
    global $np_queriedObj;
    header('Cache-Control: no-cache');
    header('X-Nitro-Cache: MISS');
    $GLOBALS["NitroPack.tags"] = array();

    if (is_valid_nitropack_webhook()) {
        nitropack_handle_webhook();
    } else {
        if (is_valid_nitropack_beacon()) {
            nitropack_handle_beacon();
        } else {
            if (!isset($_GET["wpf_action"]) && nitropack_passes_cookie_requirements() && nitropack_passes_page_requirements()) {
                add_action('wp_footer', 'nitropack_print_beacon_script');

                $active_plugins = apply_filters('active_plugins', get_option('active_plugins'));
                if (in_array('woocommerce-multilingual/wpml-woocommerce.php', $active_plugins, true) && (!isset($_COOKIE["np_wc_currency"]) || !isset($_COOKIE["np_wc_currency_language"]))) {
                    $final_action_before_output = 'wp_footer';
                    add_action($final_action_before_output, 'set_wc_cookies');
                }

                if (nitropack_is_optimizer_request()) { // Only care about tags for requests coming from our service. There is no need to do an API request when handling a standard client request.
                    if (defined('FUSION_BUILDER_VERSION')) {
                        add_filter('do_shortcode_tag', 'nitropack_handle_fusion_builder_conatainer_expiration', 10, 3);
                    }

                    $layout = nitropack_get_layout();

                    /* The following if statement should stay as it is written.
                     * is_archive() can return true if visiting a tax, category or tag page, so is_acrchive must be checked last
                     */
                    if (is_tax() || is_category() || is_tag()) {
                        $np_queriedObj = get_queried_object();
                        $GLOBALS["NitroPack.tags"]["pageType:" . $np_queriedObj->taxonomy] = 1;
                        $GLOBALS["NitroPack.tags"]["tax:" . $np_queriedObj->term_taxonomy_id] = 1;
                    } else {
                        $GLOBALS["NitroPack.tags"]["pageType:" . $layout] = 1;
                        if (is_single() || is_page() || is_attachment()) {
                            $singlePost = get_post();
                            if ($singlePost) {
                                $GLOBALS["NitroPack.tags"]["single:" . $singlePost->ID] = 1;
                            }
                        }
                    }

                    add_action('the_post', 'nitropack_handle_the_post');
                    add_action('wp_footer', 'nitropack_set_custom_expiration');
                    add_action('wp_footer', 'nitropack_log_tags');
                }
            } else {
                header("X-Nitro-Disabled: 1");
            }
        }
    }
}

function nitropack_handle_fusion_builder_conatainer_expiration($output, $tag, $attr) {
    global $np_customExpirationTimes;
    if ($tag == "fusion_builder_container") {
        if (!empty($attr["publish_date"]) && !empty($attr["status"]) && in_array($attr["status"], array("published_until", "publish_after"))) {
            $time = strtotime($attr["publish_date"]);
            if ($time > time()) { // We only need to look at future dates
                $np_customExpirationTimes[] = $time;
            }
        }
    }
    return $output;
}

function nitropack_set_custom_expiration() {
    global $np_customExpirationTimes, $wpdb;

    $nextPostTime = NULL;
    /*$scheduledPostsQuery = new WP_Query(array( 
        'post_status' => 'future',
        'date_query' => array(
            array(
                'column' => 'post_date',
                'after' => 'now'
            )
        ),
        'posts_per_page' => 1,
        'orderby' => 'date',
        'order' => 'ASC'
    ));*/

    // WP_Query results can be modified by other plugins, which causes issues. This is why we need to run a raw query.
    // The query below should be equivalent to the query generated by WP_Query above.
    $unmodifiedPosts = $wpdb->get_results( "SELECT ID, post_date FROM {$wpdb->prefix}posts WHERE 
    {$wpdb->prefix}posts.post_date > '" . date("Y-m-d H:i:s") . "'
    AND {$wpdb->prefix}posts.post_type = 'post' AND (({$wpdb->prefix}posts.post_status = 'future')) ORDER BY {$wpdb->prefix}posts.post_date ASC LIMIT 0, 1" ); 

    if (!empty($unmodifiedPosts)) {
        $np_customExpirationTimes[] = strtotime($unmodifiedPosts[0]->post_date);
    }

    // The Events Calendar compatibility
    if (defined('TRIBE_EVENTS_FILE') && function_exists('tribe_get_events')) {
        $events = tribe_get_events(array(
            "posts_per_page" => 1,
            "start_date" => time()
        ));

        if (count($events)) {
            $np_customExpirationTimes[] = strtotime($events[0]->event_date);
        }
    }

    if (!empty($np_customExpirationTimes)) {
        sort($np_customExpirationTimes, SORT_NUMERIC);
        header("X-Nitro-Expires: " . $np_customExpirationTimes[0]);
    }
}

function nitropack_print_beacon_script() {
    echo nitropack_get_beacon_script();
}

function nitropack_get_beacon_script() {
    $siteConfig = nitropack_get_site_config();
    if ($siteConfig && !empty($siteConfig["siteId"]) && !empty($siteConfig["siteSecret"])) {
        if (null !== $nitro = get_nitropack_sdk($siteConfig["siteId"], $siteConfig["siteSecret"]) ) {
            $url = $nitro->getUrl();
            $cookiesJson = json_encode($nitro->supportedCookiesFilter(NitroPack\SDK\NitroPack::getCookies()));

            if (function_exists("hash_hmac") && function_exists("hash_equals")) {
                $hash = hash_hmac("sha512", $url.$cookiesJson, $siteConfig["siteSecret"]);
            } else {
                $hash = "";
            }
            $url = base64_encode($url); // We want only ASCII
            $cookiesb64 = base64_encode($cookiesJson);

            echo "<script nitro-exclude>if (document.cookie.indexOf('nitroCache=HIT') == -1) {var nitroData = new FormData(); nitroData.append('nitroBeaconUrl', '$url'); nitroData.append('nitroBeaconCookies', '$cookiesb64'); nitroData.append('nitroBeaconHash', '$hash'); navigator.sendBeacon(location.href, nitroData);} document.cookie = 'nitroCache=HIT; expires=Thu, 01 Jan 1970 00:00:01 GMT;';</script>";
        }
    }
}

function nitropack_has_advanced_cache() {
    return defined( 'NITROPACK_ADVANCED_CACHE' );
}

function set_wc_cookies() {
    $wcCurrency = WC()->session->get("client_currency");
    $wcCurrencyLanguage = WC()->session->get("client_currency_language");
    if (!$wcCurrency) $wcCurrency = 0;
    if (!$wcCurrencyLanguage) $wcCurrencyLanguage = 0;
    setcookie('np_wc_currency', $wcCurrency, time() + (86400 * 7), "/");
    setcookie('np_wc_currency_language', $wcCurrencyLanguage, time() + (86400 * 7), "/");
}

function nitropack_validate_site_id($siteId) {
    if (!preg_match("/^([a-zA-Z]{32})$/", trim($siteId), $matches)) {
        return false;
    }
    return $matches[1];
}

function nitropack_validate_site_secret($siteSecret) {
    if (!preg_match("/^([a-zA-Z0-9]{64})$/", trim($siteSecret), $matches)) {
        return false;
    }
    return $matches[1];
}

function nitropack_validate_webhook_token($token) {
    return preg_match("/^([abcdef0-9]{32})$/", strtolower($token));
}

function nitropack_validate_wc_currency($cookieValue) {
    return preg_match("/^([a-z]{3})$/", strtolower($cookieValue));
}

function nitropack_validate_wc_currency_language($cookieValue) {
    return preg_match("/^([a-z_\\-]{2,})$/", strtolower($cookieValue));
}

function nitropack_get_default_cacheable_object_types() {
    $result = array("home", "archive");
    $postTypes = get_post_types(array('public' => true), 'names');
    $result = array_merge($result, $postTypes);
    foreach ($postTypes as $postType) {
        $result = array_merge($result, get_taxonomies(array('object_type' => array($postType), 'public' => true), 'names'));
    }
    return $result;
}

function nitropack_get_object_types() {
    $objectTypes = get_post_types(array('public' => true), 'objects');
    $taxonomies = get_taxonomies(array('public' => true), 'objects');

    foreach ($objectTypes as &$objectType) {
        $objectType->taxonomies = [];
        foreach ($taxonomies as $tax) {
            if (in_array($objectType->name, $tax->object_type)) {
                $objectType->taxonomies[] = $tax;
            }
        }
    }

    return $objectTypes;
}

function nitropack_get_cacheable_object_types() {
    return get_option("nitropack-cacheableObjectTypes", nitropack_get_default_cacheable_object_types());
}

/** Step 3. */
function nitropack_options() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }

    wp_enqueue_style('nitropack_bootstrap_css', plugin_dir_url(__FILE__) . 'view/stylesheet/bootstrap.min.css?np_v=' . NITROPACK_VERSION);
    wp_enqueue_style('nitropack_css', plugin_dir_url(__FILE__) . 'view/stylesheet/nitropack.css?np_v=' . NITROPACK_VERSION);
    wp_enqueue_style('nitropack_font-awesome_css', plugin_dir_url(__FILE__) . 'view/stylesheet/fontawesome/font-awesome.min.css?np_v=' . NITROPACK_VERSION, true);
    wp_enqueue_script('nitropack_bootstrap_js', plugin_dir_url(__FILE__) . 'view/javascript/bootstrap.min.js?np_v=' . NITROPACK_VERSION, true);
    wp_enqueue_script('nitropack_notices_js', plugin_dir_url(__FILE__) . 'view/javascript/np_notices.js?np_v=' . NITROPACK_VERSION, true);
    wp_enqueue_script('nitropack_overlay_js', plugin_dir_url(__FILE__) . 'view/javascript/overlay.js?np_v=' . NITROPACK_VERSION, true);
    wp_enqueue_script('nitropack_embed_js', 'https://nitropack.io/asset/js/embed.js?np_v=' . NITROPACK_VERSION, true);
    wp_enqueue_script( 'jquery-form' );

    // Manually add home and archive page object
    $homeCustomObject = new stdClass();
    $homeCustomObject->name = 'home';
    $homeCustomObject->label = 'Home';
    $homeCustomObject->taxonomies = array();

    $archiveCustomObject = new stdClass();
    $archiveCustomObject->name = 'archive';
    $archiveCustomObject->label = 'Archive';
    $archiveCustomObject->taxonomies = array();
    $objectTypes = array_merge(array('home' => $homeCustomObject, 'archive' => $archiveCustomObject), nitropack_get_object_types());

    $siteId = esc_attr( get_option('nitropack-siteId') );
    $siteSecret = esc_attr( get_option('nitropack-siteSecret') );
    $enableCompression = get_option('nitropack-enableCompression');
    $autoCachePurge = get_option('nitropack-autoCachePurge', 1);
    $checkedCompression = get_option('nitropack-checkedCompression');
    $cacheableObjectTypes = nitropack_get_cacheable_object_types();

    if (empty($siteId) || empty($siteSecret)) {
        include plugin_dir_path(__FILE__) . nitropack_trailingslashit('view') . 'connect.php';
    } else {
        $planDetailsUrl = get_nitropack_integration_url("plan_details_json");
        $optimizationDetailsUrl = get_nitropack_integration_url("optimization_details_json");
        $quickSetupUrl = get_nitropack_integration_url("quicksetup_json");
        $quickSetupSaveUrl = get_nitropack_integration_url("quicksetup");
        
        include plugin_dir_path(__FILE__) . nitropack_trailingslashit('view') . 'admin.php';
    }
}

function nitropack_is_connected() {
    $siteId = esc_attr( get_option('nitropack-siteId') );
    $siteSecret = esc_attr( get_option('nitropack-siteSecret') );
    return !empty($siteId) && !empty($siteSecret);
}

function nitropack_print_notice($type, $message) {
    echo '<div class="notice notice-' . $type . ' is-dismissible">';
    echo '<p><strong>NitroPack:</strong> ' . $message . '</p>';
    echo '</div>';
}

function nitropack_get_conflicting_plugins() {
    $clashingPlugins = array();

    if (defined('BREEZE_PLUGIN_DIR')) { // Breeze cache plugin
        $clashingPlugins[] = "Breeze";
    }

    if (defined('WP_ROCKET_VERSION')) { // WP-Rocket
        $clashingPlugins[] = "WP-Rocket";
    }

    if (defined('W3TC')) { // W3 Total Cache
        $clashingPlugins[] = "W3 Total Cache";
    }

    if (defined('WPFC_MAIN_PATH')) { // WP Fastest Cache
        $clashingPlugins[] = "WP Fastest Cache";
    }

    if (defined('PHASTPRESS_VERSION')) { // PhastPress
        $clashingPlugins[] = "PhastPress";
    }

    if (defined('WPCACHEHOME')) { // WP Super Cache
        $clashingPlugins[] = "WP Super Cache";
    }

    if (defined('LSCACHE_ADV_CACHE') || defined('LSCWP_DIR')) { // LiteSpeed Cache
        $clashingPlugins[] = "LiteSpeed Cache";
    }

    if (class_exists('Swift_Performance') || class_exists('Swift_Performance_Lite')) { // Swift Performance
        $clashingPlugins[] = "Swift Performance";
    }

    if (class_exists('PagespeedNinja')) { // PageSpeed Ninja
        $clashingPlugins[] = "PageSpeed Ninja";
    }

    if (defined('AUTOPTIMIZE_PLUGIN_VERSION')) { // Autoptimize
        $clashingPlugins[] = "Autoptimize";
    }

    if (defined('WP_SMUSH_VERSION')) { // Smush by WPMU DEV
        if (class_exists('Smush\\Core\\Settings') && defined('WP_SMUSH_PREFIX')) {
            $smushLazy = Smush\Core\Settings::get_instance()->get( 'lazy_load' );
            if ($smushLazy) {
                $clashingPlugins[] = "Smush Lazy Load";
            }
        } else {
            $clashingPlugins[] = "Smush";
        }
    }

    if (defined('COMET_CACHE_PLUGIN_FILE')) { // Comet Cache by WP Sharks
        $clashingPlugins[] = "Comet Cache";
    }

    if (defined('WPO_VERSION') && class_exists('WPO_Cache_Config')) { // WP Optimize
        $wpo_cache_config = WPO_Cache_Config::instance();
        if ($wpo_cache_config->get_option('enable_page_caching', false)) {
            $clashingPlugins[] = "WP Optimize page caching";
        }
    }

    return $clashingPlugins;
}

function nitropack_is_conflicting_plugin_active() {
    $conflictingPlugins = nitropack_get_conflicting_plugins();
    return !empty($conflictingPlugins);
}

function nitropack_admin_notices() {
    if (!empty($_COOKIE["nitropack_after_activate_notice"])) {
        setcookie("nitropack_after_activate_notice", 1, time() - 15);
        nitropack_print_notice("info", "<script>document.cookie = 'nitropack_after_activate_notice=1; expires=Thu, 01 Jan 1970 00:00:01 GMT;';</script>NitroPack has been successfully activated, but it is not connected yet. Please go to <a href='" . admin_url( 'options-general.php?page=nitropack' ) . "'>its settings</a> page to connect it in order to start opitmizing your site!");
    }

    $conflictingPlugins = nitropack_get_conflicting_plugins();
    foreach ($conflictingPlugins as $clashingPlugin) {
        nitropack_print_notice("warning", sprintf("It seems like %s is active. NitroPack and %s have overlapping functionality and can interfere with each other. Please deactivate %s for best results in NitroPack.", $clashingPlugin, $clashingPlugin, $clashingPlugin));
    }

    nitropack_print_hosting_notice();

    if (nitropack_is_connected()) {
        if (!nitropack_has_advanced_cache()) {
            $advancedCacheFile = nitropack_trailingslashit(WP_CONTENT_DIR) . 'advanced-cache.php';
            if (!file_exists($advancedCacheFile) || strpos(file_get_contents($advancedCacheFile), "NITROPACK_ADVANCED_CACHE") === false) { // For some reason we get the notice right after connecting (even though the advanced-cache file is already in place). This check works around this issue :(
                if (nitropack_install_advanced_cache()) {
                    nitropack_print_notice("info", "The file /wp-content/advanced-cache.php was either missing or not the one generated by NitroPack. NitroPack re-installed its version of the file, so it can function properly. Possibly there is another active page caching plugin in your system. For correct operation, please deactivate any other page caching plugins.");
                } else {
                    if (nitropack_is_conflicting_plugin_active()) {
                        nitropack_print_notice("error", "The file /wp-content/advanced-cache.php cannot be created because a conflicting plugin is active. Please make sure to disable all conflicting plugins.");
                    } else {
                        nitropack_print_notice("error", "The file /wp-content/advanced-cache.php cannot be created. Please make sure that the /wp-content/ directory is writable and refresh this page.");
                    }
                }
            }
        } else {
            if (!defined("NITROPACK_ADVANCED_CACHE_VERSION") || NITROPACK_VERSION != NITROPACK_ADVANCED_CACHE_VERSION) {
                if (!nitropack_install_advanced_cache()) {
                    if (nitropack_is_conflicting_plugin_active()) {
                        nitropack_print_notice("error", "The file /wp-content/advanced-cache.php cannot be created because a conflicting plugin is active. Please make sure to disable all conflicting plugins.");
                    } else {
                        nitropack_print_notice("error", "The file /wp-content/advanced-cache.php cannot be created. Please make sure that the /wp-content/ directory is writable and refresh this page.");
                    }
                }
            }
        }

        if ( (!defined("WP_CACHE") || !WP_CACHE) ) {
            if (nitropack_is_flywheel()) { // Flywheel: This is configured throught the FW control panel
                nitropack_print_notice("warning", "The WP_CACHE setting is not enabled. Please go to your FlyWheel control panel and enable this setting. You can find more information <a href='https://getflywheel.com/wordpress-support/how-to-enable-wp_cache/' target='_blank'>in this document</a>.");
            } else if (!nitropack_set_wp_cache_const(true)) {
                nitropack_print_notice("error", "The WP_CACHE constant cannot be set in the wp-config.php file. This can lead to slower cache delivery. Please make sure that the /wp-config.php file is writable and refresh this page.");
            }
        }

        if ( !nitropack_data_dir_exists() && !nitropack_init_data_dir()) {
            nitropack_print_notice("error", "The NitroPack data directory cannot be created. Please make sure that the /wp-content/ directory is writable and refresh this page.");
            return;
        }

        $siteId = esc_attr( get_option('nitropack-siteId') );
        $siteSecret = esc_attr( get_option('nitropack-siteSecret') );
        $webhookToken = esc_attr( get_option('nitropack-webhookToken') );
        $blogId = get_current_blog_id();
        $isConfigOutdated = !nitropack_is_config_up_to_date();
        $siteConfig = nitropack_get_site_config();

        if ( !nitropack_config_exists() && !nitropack_update_current_blog_config($siteId, $siteSecret, $blogId)) {
            nitropack_print_notice("error", "The NitroPack static config file cannot be created. Please make sure that the /wp-content/nitropack/ directory is writable and refresh this page.");
        } else if ( $isConfigOutdated ) {
            if (!nitropack_update_current_blog_config($siteId, $siteSecret, $blogId)) {
                nitropack_print_notice("error", "The NitroPack static config file cannot be updated. Please make sure that the /wp-content/nitropack/ directory is writable and refresh this page.");
            } else {
                if (!$siteConfig) {
                    nitropack_event("update");
                } else {
                    $prevVersion = !empty($siteConfig["pluginVersion"]) ? $siteConfig["pluginVersion"] : "1.1.4 or older";
                    nitropack_event("update", null, array("previous_version" => $prevVersion));

                    if (empty($siteConfig["pluginVersion"]) || version_compare($siteConfig["pluginVersion"], "1.3", "<")) {
                        if (!headers_sent()) {
                            setcookie("nitropack_upgrade_to_1_3_notice", 1, time() + 3600);
                        }
                        $_COOKIE["nitropack_upgrade_to_1_3_notice"] = 1;
                    }
                }
            }

            if (!nitropack_setup_webhooks(get_nitropack_sdk(), $webhookToken)) {
                nitropack_print_notice("warning", "Unable to configure webhooks. This can impact the stability of the plugin. Please disconnect and connect again in order to retry configuring the webhooks.");
            }
        }

        if (!empty($_COOKIE["nitropack_upgrade_to_1_3_notice"])) {
            nitropack_print_notice("warning", "Your new version of NitroPack has a new better way of recaching updated content. However it is incompatible with the page relationships built by your previous version. Please invalidate your cache manually one-time so that content updates start working with the updated logic. <a href='javascript:void(0);' onclick='document.cookie = \"nitropack_upgrade_to_1_3_notice=0; expires=Thu, 01 Jan 1970 00:00:01 GMT;\";jQuery(this).closest(\".is-dismissible\").hide();'>Dismiss</a>");
        }
    }
}

function nitropack_get_hosting_notice_file() {
    return nitropack_trailingslashit(NITROPACK_DATA_DIR) . "hosting_notice";
}

function nitropack_print_hosting_notice() {
    $hostingNoticeFile = nitropack_get_hosting_notice_file();
    if (!nitropack_is_connected() || file_exists($hostingNoticeFile)) return;

    $documentedHostingSetups = array(
        "flywheel" => array(
            "name" => "Flywheel",
            "helpUrl" => "https://help.nitropack.io/en/articles/3326013-flywheel-hosting-configuration-for-nitropack"
        ),
        "wpengine" => array(
            "name" => "WP Engine",
            "helpUrl" => "https://help.nitropack.io/en/articles/3639145-wp-engine-hosting-configuration-for-nitropack"
        ),
        "cloudways" => array(
            "name" => "Cloudways",
            "helpUrl" => "https://help.nitropack.io/en/articles/3582879-cloudways-hosting-configuration-for-nitropack"
        )
    );

    $siteConfig = nitropack_get_site_config();
    if ($siteConfig && !empty($siteConfig["hosting"]) && array_key_exists($siteConfig["hosting"], $documentedHostingSetups)) {
        $hostingInfo = $documentedHostingSetups[$siteConfig["hosting"]];
        
        nitropack_print_notice("info", sprintf("It looks like you are hosted on %s. Please follow <a href='%s' target='_blank'>these instructions</a> in order to make sure that everything works correctly. <a href='javascript:void(0);' onclick='jQuery.post(ajaxurl, {action: \"nitropack_dismiss_hosting_notice\"});jQuery(this).closest(\".is-dismissible\").hide();'>Dismiss</a>", $hostingInfo["name"], $hostingInfo["helpUrl"]));
    }
}

function nitropack_dismiss_hosting_notice() {
    $hostingNoticeFile = nitropack_get_hosting_notice_file();
    if (WP_DEBUG) {
        touch($hostingNoticeFile);
    } else {
        @touch($hostingNoticeFile);
    }
}

function nitropack_is_config_up_to_date() {
    $siteConfig = nitropack_get_site_config();
    return !empty($siteConfig) && !empty($siteConfig["pluginVersion"]) && $siteConfig["pluginVersion"] == NITROPACK_VERSION;
}

function nitropack_filter_non_original_cookies(&$cookies) {
    global $np_originalRequestCookies;
    $ogNames = is_array($np_originalRequestCookies) ? array_keys($np_originalRequestCookies) : array();
    foreach ($cookies as $name=>$val) {
        if (!in_array($name, $ogNames)) {
            unset($cookies[$name]);
        }
    }
}

function nitropack_add_meta_box() {
    if ( current_user_can( 'manage_options' ) )  {
        foreach (nitropack_get_cacheable_object_types() as $objectType) {
            add_meta_box( 'nitropack_manage_cache_box', 'NitroPack', 'nitropack_print_meta_box', $objectType, 'side' );
        }
    }
}

// This is only used for post types that can have "single" pages
function nitropack_print_meta_box($post) {
    wp_enqueue_script('nitropack_metabox_js', plugin_dir_url(__FILE__) . 'view/javascript/metabox.js?np_v=' . NITROPACK_VERSION, true);
    $html = '';
    $html .= '<p><a class="button nitropack-invalidate-single" data-post_id="' . $post->ID . '" style="width:100%;text-align:center;padding: 3px 0;">Invalidate cache</a></p>';
    $html .= '<p><a class="button nitropack-purge-single" data-post_id="' . $post->ID . '" style="width:100%;text-align:center;padding: 3px 0;">Purge cache</a></p>';
    $html .= '<p id="nitropack-status-msg" style="display:none;"></p>';
    echo $html;
}

function get_nitropack_sdk($siteId = null, $siteSecret = null, $urlOverride = NULL) {
    $siteConfig = nitropack_get_site_config();

    require_once 'nitropack-sdk/autoload.php';
    $siteId = $siteId ? $siteId : ($siteConfig ? $siteConfig['siteId'] : get_option('nitropack-siteId'));
    $siteSecret = $siteSecret ? $siteSecret : ($siteConfig ? $siteConfig['siteSecret'] : get_option('nitropack-siteSecret'));

    if ($siteId && $siteSecret) {
        try {
            NitroPack\SDK\NitroPack::addCookieFilter("nitropack_filter_non_original_cookies");
            $userAgent = NULL; // It will be automatically detected by the SDK
            $dataDir = nitropack_trailingslashit(NITROPACK_DATA_DIR) . $siteConfig["siteId"]; // dir without a trailing slash, because this is how the SDK expects it
            $nitro = new NitroPack\SDK\NitroPack($siteId, $siteSecret, $userAgent, $urlOverride, $dataDir);
        } catch (\Exception $e) {
            return NULL;
        }
        
        return $nitro;
    }

    return NULL;
}

function get_nitropack_integration_url($integration, $nitro = null) {
    if ($nitro || (null !== $nitro = get_nitropack_sdk()) ) {
        return $nitro->integrationUrl($integration);
    }

    return "#";
}

function register_nitropack_settings() {
    register_setting( NITROPACK_OPTION_GROUP, 'nitropack-siteId', array('show_in_rest' => false) );
    register_setting( NITROPACK_OPTION_GROUP, 'nitropack-siteSecret', array('show_in_rest' => false) );
    register_setting( NITROPACK_OPTION_GROUP, 'nitropack-enableCompression', array('default' => -1) );
}

function nitropack_get_layout() {
    $layout = "default";

    if (nitropack_is_home()) {
        $layout = "home";
    } else if (is_page()) {
        $layout = "page";
    } else if (is_attachment()) {
        $layout = "attachment";
    } else if (is_author()) {
        $layout = "author";
    } else if (is_search()) {
        $layout = "search";
    } else if (is_tag()) {
        $layout = "tag";
    } else if (is_tax()) {
        $layout = "taxonomy";
    } else if (is_category()) {
        $layout = "category";
    } else if (nitropack_is_archive()) {
        $layout = "archive";
    } else if (is_feed()) {
        $layout = "feed";
    } else if (is_page()) {
        $layout = "page";
    } else if (is_single()) {
        $layout = get_post_type();
    }

    return $layout;
}

function nitropack_sdk_invalidate($url = NULL, $tag = NULL, $reason = NULL) {
    if (null !== $nitro = get_nitropack_sdk()) {
        try {
            $siteConfig = nitropack_get_site_config();
            $homeUrl = $siteConfig && !empty($siteConfig["home_url"]) ? $siteConfig["home_url"] : get_home_url();

            if ($tag) {
                if (is_array($tag)) {
                    $tag = array_map('nitropack_filter_tag', $tag);
                } else {
                    $tag = nitropack_filter_tag($tag);
                }
            }

            $nitro->invalidateCache(NULL, "pageType:home", $reason);
            $nitro->invalidateCache(NULL, "pageType:archive", $reason);
            $nitro->invalidateCache($url, $tag, $reason);

            try {
                do_action('nitropack_integration_purge_url', $homeUrl);

                if ($tag) {
                    do_action('nitropack_integration_purge_all');
                } else if ($url) {
                    do_action('nitropack_integration_purge_url', $url);
                } else {
                    do_action('nitropack_integration_purge_all');
                }
            } catch (\Exception $e) {
                // Exception while signaling our 3rd party integration addons to purge their cache
            }
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    return false;
}

function nitropack_sdk_purge($url = NULL, $tag = NULL, $reason = NULL, $type = \NitroPack\SDK\PurgeType::COMPLETE) {
    if (null !== $nitro = get_nitropack_sdk()) {
        try {
            if ($tag) {
                if (is_array($tag)) {
                    $tag = array_map('nitropack_filter_tag', $tag);
                } else {
                    $tag = nitropack_filter_tag($tag);
                }
            }

            if ($tag != "pageType:home") {
                $nitro->invalidateCache(NULL, "pageType:home", NULL);
            }

            if ($tag != "pageType:archive") {
                $nitro->invalidateCache(NULL, "pageType:archive", $reason);
            }

            $nitro->purgeCache($url, $tag, $type, $reason);

            try {
                $siteConfig = nitropack_get_site_config();
                $homeUrl = $siteConfig && !empty($siteConfig["home_url"]) ? $siteConfig["home_url"] : get_home_url();
                do_action('nitropack_integration_purge_url', $homeUrl);

                if ($tag) {
                    do_action('nitropack_integration_purge_all');
                } else if ($url) {
                    do_action('nitropack_integration_purge_url', $url);
                } else {
                    do_action('nitropack_integration_purge_all');
                }
            } catch (\Exception $e) {
                // Exception while signaling our 3rd party integration addons to purge their cache
            }
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    return false;
}

function nitropack_sdk_purge_local($url = NULL) {
    if (null !== $nitro = get_nitropack_sdk()) {
        try {
            if ($url) {
                $nitro->purgeLocalUrlCache($url);
                do_action('nitropack_integration_purge_url', $url);
            } else {
                $nitro->purgeLocalCache();

                try {
                    do_action('nitropack_integration_purge_all');
                } catch (\Exception $e) {
                    // Exception while signaling our 3rd party integration addons to purge their cache
                }
            }
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    return false;
}

function nitropack_fetch_config() {
    if (null !== $nitro = get_nitropack_sdk()) {
        try {
            $nitro->fetchConfig();
        } catch (\Exception $e) {}
    }
}

function nitropack_switch_theme() {
    if (!get_option("nitropack-autoCachePurge", 1)) return;

    try {
        nitropack_sdk_purge(NULL, NULL, 'Theme switched'); // purge entire cache
    } catch (\Exception $e) {}
}

function nitropack_purge_cache() {
    try {
        if (nitropack_sdk_purge(NULL, NULL, 'Manual purge of all pages')) {
            nitropack_json_and_exit(array(
                "type" => "success",
                "message" => "Success! Cache has been purged successfully!"
            ));
        }
    } catch (\Exception $e) {}

    nitropack_json_and_exit(array(
        "type" => "error",
        "message" => "Error! There was an error and the cache was not purged!"
    ));
}

function nitropack_invalidate_cache() {
    try {
        if (nitropack_sdk_invalidate(NULL, NULL, 'Manual invalidation of all pages')) {
            nitropack_json_and_exit(array(
                "type" => "success",
                "message" => "Success! Cache has been invalidated successfully!"
            ));
        }
    } catch (\Exception $e) {}

    nitropack_json_and_exit(array(
        "type" => "error",
        "message" => "Error! There was an error and the cache was not invalidated!"
    ));
}

function nitropack_json_and_exit($array) {
    echo json_encode($array);
    exit;
}

function nitropack_has_post_important_change($post) {
    $prevPost = nitropack_get_post_pre_update($post);
    return $prevPost && ($prevPost->post_title != $post->post_title || $prevPost->post_name != $post->post_name || $prevPost->post_excerpt != $post->post_excerpt);
}

function nitropack_purge_single_cache() {
    if (!empty($_POST["postId"]) && is_numeric($_POST["postId"])) {
        $postId = $_POST["postId"];
        try {
            if (nitropack_sdk_purge(NULL, "single:$postId", "Manual purge via the WordPress admin panel")) {
                nitropack_json_and_exit(array(
                    "type" => "success",
                    "message" => "Success! Cache has been purged successfully!"
                ));
            }
        } catch (\Exception $e) {}
    }

    nitropack_json_and_exit(array(
        "type" => "error",
        "message" => "Error! There was an error and the cache was not purged!"
    ));
}

function nitropack_invalidate_single_cache() {
    if (!empty($_POST["postId"]) && is_numeric($_POST["postId"])) {
        $postId = $_POST["postId"];
        try {
            if (nitropack_sdk_invalidate(NULL, "single:$postId", "Manual invalidation via the WordPress admin panel")) {
                nitropack_json_and_exit(array(
                    "type" => "success",
                    "message" => "Success! Cache has been invalidated successfully!"
                ));
            }
        } catch (\Exception $e) {}
    }

    nitropack_json_and_exit(array(
        "type" => "error",
        "message" => "Error! There was an error and the cache was not invalidated!"
    ));
}

function nitropack_clean_post_cache($post, $taxonomies = NULL, $hasImportantChangeInPost = NULL, $reason = NULL) {
    try {
        $postID = $post->ID;
        $postType = isset($post->post_type) ? $post->post_type : "post";
        $nicePostTypeLabel = nitropack_get_nice_post_type_label($postType);
        $reason = $reason ? $reason : sprintf("Updated %s '%s'", $nicePostTypeLabel, $post->post_title);
        $cacheableObjectTypes = nitropack_get_cacheable_object_types();

        if (in_array($postType, $cacheableObjectTypes)) {
            nitropack_sdk_invalidate(NULL, "single:$postID", $reason);
            if ($hasImportantChangeInPost === NULL) {
                $hasImportantChangeInPost = nitropack_has_post_important_change($post);
            }
            if ($taxonomies === NULL) {
                if ($hasImportantChangeInPost) { // This change should be reflected in all taxonomy pages
                    $taxonomies = array('related' => nitropack_get_taxonomies($post));
                } else { // No important change, so only update taxonomy pages which have been added or removed from the post
                    $taxonomies = nitropack_get_taxonomies_for_update($post);
                }
            }
            if ($taxonomies) {
                if (!empty($taxonomies['added'])) { // taxonomies that the post was just added to, must purge all pages for these taxonomies
                    foreach ($taxonomies['added'] as $term_taxonomy_id) {
                        nitropack_sdk_invalidate(NULL, "tax:$term_taxonomy_id", $reason);
                    }
                }
                if (!empty($taxonomies['deleted'])) { // taxonomy pages that the post was just removed from (also accounts for paginations via the taxpost: tag instead of only tax:)
                    foreach ($taxonomies['deleted'] as $term_taxonomy_id) {
                        nitropack_sdk_invalidate(NULL, "taxpost:$term_taxonomy_id:$postID", $reason);
                    }
                }
                if (!empty($taxonomies['related'])) { // taxonomy pages that the post is linked to (also accounts for paginations via the taxpost: tag instead of only tax:)
                    foreach ($taxonomies['related'] as $term_taxonomy_id) {
                        nitropack_sdk_invalidate(NULL, "taxpost:$term_taxonomy_id:$postID", $reason);
                    }
                }
            }
        } else {
            nitropack_sdk_invalidate(NULL, "post:$postID", $reason);
            $posts = get_post_ancestors($postID);
            foreach ($posts as $parentID) {
                nitropack_sdk_invalidate(NULL, "post:$parentID", $reason); // Maybe use recursion here?
            }
        }
    } catch (\Exception $e) {}
}

function nitropack_get_nice_post_type_label($postType) {
    $postTypes = get_post_types(array(
        "name" => $postType
    ), "objects");

    return !empty($postTypes[$postType]) && !empty($postTypes[$postType]->labels) ? $postTypes[$postType]->labels->singular_name : $postType;
}

function nitropack_handle_comment_transition($new, $old, $comment) {
    if (!get_option("nitropack-autoCachePurge", 1)) return;

    try {
        $postID = $comment->comment_post_ID;
        $post = get_post($postID);
        nitropack_sdk_invalidate(NULL, "single:" . $postID, sprintf("Invalidation of '%s' due to changing related comment status", $post->post_title));
    } catch (\Exception $e) {
        // TODO: Log the error
    }
}

function nitropack_handle_comment_post($commentID, $isApproved) {
    if (!get_option("nitropack-autoCachePurge", 1) || $isApproved !== 1) return;

    try {
        $comment = get_comment($commentID);
        $postID = $comment->comment_post_ID;
        $post = get_post($postID);
        nitropack_sdk_invalidate(NULL, "single:" . $postID, sprintf("Invalidation of '%s' due to posting a new approved comment", $post->post_title));
    } catch (\Exception $e) {
        // TODO: Log the error
    }
}

function nitropack_handle_post_transition($new, $old, $post) {
    if (!get_option("nitropack-autoCachePurge", 1)) return;

    try {
        if ($new === "auto-draft" || $new === "draft" || $new === "inherit") { // Creating a new post or draft, don't do anything for now. 
            return;
        }

        $ignoredPostTypes = array("revision", "scheduled-action", "flamingo_contact");
        $nicePostTypes = array(
            "post" => "Post",
            "page" => "Page",
            "tribe_events" => "Calendar Event",
        );
        $postType = isset($post->post_type) ? $post->post_type : "post";
        $nicePostTypeLabel = nitropack_get_nice_post_type_label($postType);

        if (in_array($postType, $ignoredPostTypes)) return;

        switch ($postType) {
        case "nav_menu_item":
            nitropack_sdk_invalidate(NULL, NULL, sprintf("Invalidation of all pages due to modifying menu entries"));
            break;
        case "customize_changeset":
            nitropack_sdk_invalidate(NULL, NULL, sprintf("Invalidation of all pages due to applying appearance customization"));
            break;
        case "custom_css":
            nitropack_sdk_invalidate(NULL, NULL, sprintf("Invalidation of all pages due to modifying custom CSS"));
            break;
        default:
            if ($new == "future") {
                nitropack_clean_post_cache($post, array('added' => nitropack_get_taxonomies($post)), true, sprintf("Invalidate related pages due to scheduling %s '%s'", $nicePostTypeLabel, $post->post_title));
            } else if ($new == "publish" && $old != "publish") {
                nitropack_clean_post_cache($post, array('added' => nitropack_get_taxonomies($post)), true, sprintf("Invalidate related pages due to publishing %s '%s'", $nicePostTypeLabel, $post->post_title));
                if (null !== $nitro = get_nitropack_sdk()) {
                    try {
                        $nitro->getApi()->runWarmup(get_permalink($post));
                    } catch (\Exception $e) {}
                }
            } else if ($new == "trash" && $old == "publish") {
                nitropack_clean_post_cache($post, array('deleted' => nitropack_get_taxonomies($post)), true, sprintf("Invalidate related pages due to deleting %s '%s'", $nicePostTypeLabel, $post->post_title));
            } else if ($new == "private" && $old == "publish") {
                nitropack_clean_post_cache($post, array('deleted' => nitropack_get_taxonomies($post)), true, sprintf("Invalidate related pages due to making %s '%s' private", $nicePostTypeLabel, $post->post_title));
            } else if ($new != "trash") {
                nitropack_clean_post_cache($post);
            }
            break;
        }
    } catch (\Exception $e) {
        // TODO: Log the error
    }
}

function nitropack_handle_the_post($post) {
    global $np_customExpirationTimes, $np_queriedObj;
    if (defined('POSTEXPIRATOR_VERSION')) {
        $postExpiryDate = get_post_meta($post->ID, "_expiration-date", true);
        if (!empty($postExpiryDate) && $postExpiryDate > time()) { // We only need to look at future dates
            $np_customExpirationTimes[] = $postExpiryDate;
        }
    }

    if (function_exists("sort_portfolio")) { // Portfolio Sorting plugin
        $portfolioStartDate = get_post_meta($post->ID, "start_date", true);
        $portfolioEndDate = get_post_meta($post->ID, "end_date", true);
        if (!empty($portfolioStartDate) && strtotime($portfolioStartDate) > time()) { // We only need to look at future dates
            $np_customExpirationTimes[] = strtotime($portfolioStartDate);
        } else if (!empty($portfolioEndDate) && strtotime($portfolioEndDate) > time()) { // We only need to look at future dates
            $np_customExpirationTimes[] = strtotime($portfolioEndDate);
        }
    }

    $GLOBALS["NitroPack.tags"]["post:" . $post->ID] = 1;
    $GLOBALS["NitroPack.tags"]["author:" . $post->post_author] = 1;
    if ($np_queriedObj) {
        $GLOBALS["NitroPack.tags"]["taxpost:" . $np_queriedObj->term_taxonomy_id . ":" . $post->ID] = 1;
    }
}

function nitropack_get_taxonomies($post) {
    $term_taxonomy_ids = array();
    $taxonomies = get_object_taxonomies($post->post_type);
    foreach ($taxonomies as $taxonomy) {        
        $terms = get_the_terms( $post->ID, $taxonomy );
        if (!empty($terms)) {
            foreach ($terms as $term) {
                $term_taxonomy_ids[] = $term->term_taxonomy_id;
            }
        }
    }
    return $term_taxonomy_ids;
}

function nitropack_get_taxonomies_for_update($post) {
    $prevTaxonomies = nitropack_get_taxonomies_pre_update($post);
    $newTaxonomies = nitropack_get_taxonomies($post);
    $intersection = array_intersect($newTaxonomies, $prevTaxonomies);
    $prevTaxonomies = array_diff($prevTaxonomies, $intersection);
    $newTaxonomies = array_diff($newTaxonomies, $intersection);
    return array(
        "added" => array_diff($newTaxonomies, $prevTaxonomies),
        "deleted" => array_diff($prevTaxonomies, $newTaxonomies)
    );
}

function nitropack_get_post_pre_update($post) {
    global $np_preUpdatePosts;
    return !empty($np_preUpdatePosts[$post->ID]) ? $np_preUpdatePosts[$post->ID] : NULL;
}

function nitropack_get_taxonomies_pre_update($post) {
    global $np_preUpdateTaxonomies;
    return !empty($np_preUpdateTaxonomies[$post->ID]) ? $np_preUpdateTaxonomies[$post->ID] : array();
}

function nitropack_log_post_pre_update($postID) {
    global $np_preUpdatePosts, $np_preUpdateTaxonomies;
    $post = get_post($postID);
    $np_preUpdatePosts[$postID] = $post;
    $np_preUpdateTaxonomies[$postID] = nitropack_get_taxonomies($post);
}

function nitropack_filter_tag($tag) {
    return preg_replace("/[^a-zA-Z0-9:]/", ":", $tag);
}

function nitropack_log_tags() {
    if (!empty($GLOBALS["NitroPack.instance"]) && !empty($GLOBALS["NitroPack.tags"])) {
        $nitro = $GLOBALS["NitroPack.instance"];
        $layout = nitropack_get_layout();
        try {
            if ($layout == "home") {
                $nitro->getApi()->tagUrl($nitro->getUrl(), "pageType:home");
            } else if ($layout == "archive") {
                $nitro->getApi()->tagUrl($nitro->getUrl(), "pageType:archive");
            } else {
                $nitro->getApi()->tagUrl($nitro->getUrl(), array_map("nitropack_filter_tag", array_keys($GLOBALS["NitroPack.tags"])));
            }
        } catch (\Exception $e) {}
    }
}

function nitropack_extend_nonce_life($life) {
    // Nonce life should be extended only:
    //  - if NitroPack is connected for this site
    //  - if the current value is shorter than the life time of a cache file
    //  - if no user is logged in
    //  - for cacheable requests
    //
    // Reasons why we might need to extend the nonce life time even for requests that are not cacheable:
    //  - a request may be cachable at first, but become uncachable during changes at runtime or user actions on the page (example: log in via AJAX on a category page. Once logged in the page will not redirect, but if there is an infinite scroll it will stop working if we stop extending the nonce life time)
    //  - a request may seem cachable at first, but be determined uncachable during runtime (example: visit to a URL of a page whose post type does not match the enabled cacheable post types, or a cart, checkout page, etc.)

    if ((null !== $nitro = get_nitropack_sdk())) {
        $cacheExpiration = $nitro->getConfig()->PageCache->ExpireTime;
        return $cacheExpiration > $life ? $cacheExpiration : $life; // Extend the life of cacheable nonces up to the cache expiration time if needed
    }
    return $life;
}

function nitropack_verify_connect() {
    if (empty($_POST["siteId"]) || empty($_POST["siteSecret"]) ||
        !($siteId = nitropack_validate_site_id(esc_attr($_POST["siteId"]))) ||
        !($siteSecret = nitropack_validate_site_secret(esc_attr($_POST["siteSecret"])))) {
        nitropack_json_and_exit(array("status" => "error", "message" => "Site ID and Site Secret cannot be empty"));
    }
    try {
        $blogId = get_current_blog_id();
        if (null !== $nitro = get_nitropack_sdk($siteId, $siteSecret)) {
            if ($nitro->fetchConfig()) {
                $token = md5(uniqid());
                update_option("nitropack-webhookToken", $token);
                update_option("nitropack-enableCompression", -1);
                update_option("nitropack-autoCachePurge", get_option("nitropack-autoCachePurge", 1));
                update_option("nitropack-cacheableObjectTypes", nitropack_get_default_cacheable_object_types());

                if (!nitropack_setup_webhooks($nitro, $token)) {
                    throw new \Exception("Unable to setup webhooks");
                }

                // _icl_current_language is WPML cookie, it is added here for compatibility with this module
                $customVariationCookies = array("np_wc_currency", "np_wc_currency_language", "_icl_current_language");
                $variationCookies = $nitro->getApi()->getVariationCookies();
                foreach ($variationCookies as $cookie) {
                    $index = array_search($cookie["name"], $customVariationCookies);
                    if ($index !== false) {
                        array_splice($customVariationCookies, $index, 1);
                    }
                }

                foreach ($customVariationCookies as $cookieName) {
                    $nitro->getApi()->setVariationCookie($cookieName);
                }

                $nitro->fetchConfig(); // Reload the variation cookies

                nitropack_update_current_blog_config($siteId, $siteSecret, $blogId);
                nitropack_install_advanced_cache();

                try {
                    do_action('nitropack_integration_purge_all');
                } catch (\Exception $e) {
                    // Exception while signaling our 3rd party integration addons to purge their cache
                }

                nitropack_event("connect", $nitro);
                nitropack_event("enable_extension", $nitro);

                nitropack_json_and_exit(array("status" => "success"));
            }
        }
    } catch (\Exception $e) {
        nitropack_json_and_exit(array("status" => "error", "message" => "Incorrect API credentials. Please make sure that you copied them correctly and try again."));
    }

    nitropack_json_and_exit(array("status" => "error"));
}

function nitropack_setup_webhooks($nitro, $token = NULL) {
    if (!$nitro || !$token) return false;

    try {
        $configUrl = new \NitroPack\Url(get_home_url() . "?nitroWebhook=config&token=$token");
        $cacheClearUrl = new \NitroPack\Url(get_home_url() . "?nitroWebhook=cache_clear&token=$token");
        $cacheReadyUrl = new \NitroPack\Url(get_home_url() . "?nitroWebhook=cache_ready&token=$token");

        $nitro->getApi()->setWebhook("config", $configUrl);
        $nitro->getApi()->setWebhook("cache_clear", $cacheClearUrl);
        $nitro->getApi()->setWebhook("cache_ready", $cacheReadyUrl);
    } catch (\Exception $e) {
        return false;
    }

    return true;
}

function nitropack_disconnect() {
    nitropack_uninstall_advanced_cache();
    nitropack_event("disconnect");
    nitropack_unset_current_blog_config();
    delete_option("nitropack-siteId");
    delete_option("nitropack-siteSecret");

    $hostingNoticeFile = nitropack_get_hosting_notice_file();
    if (file_exists($hostingNoticeFile)) {
        if (WP_DEBUG) {
            unlink($hostingNoticeFile);
        } else {
            @unlink($hostingNoticeFile);
        }
    }
}

function nitropack_set_compression_ajax() {
    $compressionStatus = !empty($_POST["compressionStatus"]);
    update_option("nitropack-enableCompression", (int)$compressionStatus);
}

function nitropack_set_auto_cache_purge_ajax() {
    $autoCachePurgeStatus = !empty($_POST["autoCachePurgeStatus"]);
    update_option("nitropack-autoCachePurge", (int)$autoCachePurgeStatus);
}

function nitropack_set_cacheable_post_types() {
    $currentCacheableObjectTypes = nitropack_get_cacheable_object_types();
    $cacheableObjectTypes = !empty($_POST["cacheableObjectTypes"]) ? $_POST["cacheableObjectTypes"] : array();
    update_option("nitropack-cacheableObjectTypes", $cacheableObjectTypes);

    foreach ($currentCacheableObjectTypes as $objectType) {
        if (!in_array($objectType, $cacheableObjectTypes)) {
            nitropack_sdk_purge(NULL, "pageType:" . $objectType, "Optimizing '$objectType' pages was manually disabled");
        }
    }

    nitropack_json_and_exit(array(
        "type" => "success",
        "message" => "Success! Cacheable post types have been updated!"
    ));
}

function nitropack_test_compression_ajax() {
    $hasCompression = true;
    try {
        if (nitropack_is_flywheel()) { // Flywheel: Compression is enabled by default
            update_option("nitropack-enableCompression", 0);
        } else {
            require_once plugin_dir_path(__FILE__) . nitropack_trailingslashit('nitropack-sdk') . 'autoload.php';
            $http = new NitroPack\HttpClient(get_site_url());
            $http->setHeader("X-NitroPack-Request", 1);
            $http->timeout = 25;
            $http->fetch();
            $headers = $http->getHeaders();
            if (!empty($headers["content-encoding"]) && strtolower($headers["content-encoding"]) == "gzip") { // compression is present, so there is no need to enable it in NitroPack. We only check for GZIP, because this is the only supported compression in the HttpClient
                update_option("nitropack-enableCompression", 0);
                $hasCompression = true;
            } else { // no compression, we must enable it from NitroPack
                update_option("nitropack-enableCompression", 1);
                $hasCompression = false;
            }
        }
        update_option("nitropack-checkedCompression", 1);
    } catch (\Exception $e) {
        nitropack_json_and_exit(array("status" => "error"));
    }

    nitropack_json_and_exit(array("status" => "success", "hasCompression" => $hasCompression));
}

function nitropack_handle_compression_toggle() {
    $new_value = get_option("nitropack-enableCompression"); // Unfortunately WordPress is not feeding in the $new_value as a function argument, even though the documentation says it should be. This is why we have to do this ugly thing...
    nitropack_update_blog_compression($new_value == 1);
}

function nitropack_update_blog_compression($enableCompression = false) {
    if (nitropack_is_connected()) {
        $siteId = esc_attr( get_option('nitropack-siteId') );
        $siteSecret = esc_attr( get_option('nitropack-siteSecret') );
        $blogId = get_current_blog_id();
        nitropack_update_current_blog_config($siteId, $siteSecret, $blogId, $enableCompression);
    }
}

function nitropack_enable_warmup() {
    if (null !== $nitro = get_nitropack_sdk()) {
        try {
            $nitro->getApi()->enableWarmup();
            $nitro->getApi()->setWarmupHomepage(get_home_url());
            $nitro->getApi()->runWarmup();
        } catch (\Exception $e) {
        }

        nitropack_json_and_exit(array(
            "type" => "success",
            "message" => "Success! Cache warmup has been enabled successfully!"
        ));
    }

    nitropack_json_and_exit(array(
        "type" => "error",
        "message" => "Error! There was an error while enabling the cache warmup!"
    ));
}

function nitropack_disable_warmup() {
    if (null !== $nitro = get_nitropack_sdk()) {
        try {
            $nitro->getApi()->disableWarmup();
            $nitro->getApi()->resetWarmup();
        } catch (\Exception $e) {
        }

        nitropack_json_and_exit(array(
            "type" => "success",
            "message" => "Success! Cache warmup has been disabled successfully!"
        ));
    }

    nitropack_json_and_exit(array(
        "type" => "error",
        "message" => "Error! There was an error while disabling the cache warmup!"
    ));
}

function nitropack_run_warmup() {
    if (null !== $nitro = get_nitropack_sdk()) {
        try {
            $nitro->getApi()->runWarmup();
        } catch (\Exception $e) {
        }

        nitropack_json_and_exit(array(
            "type" => "success",
            "message" => "Success! Cache warmup has been started successfully!"
        ));
    }

    nitropack_json_and_exit(array(
        "type" => "error",
        "message" => "Error! There was an error while starting the cache warmup!"
    ));
}

function nitropack_estimate_warmup() {
    if (null !== $nitro = get_nitropack_sdk()) {
        try {
            if (!session_id()) {
                session_start();
            }
            $id = !empty($_POST["estId"]) ? preg_replace("/[^a-fA-F0-9]/", "", (string)$_POST["estId"]) : NULL;
            if ($id !== NULL && (!is_string($id) || $id != $_SESSION["nitroEstimateId"])) {
                nitropack_json_and_exit(array(
                    "type" => "error",
                    "message" => "Error! Invalid estimation ID!"
                ));
            }

            $nitro->getApi()->setWarmupHomepage(get_home_url());
            $optimizationsEstimate = $nitro->getApi()->estimateWarmup($id);

            if ($id === NULL) {
                $_SESSION["nitroEstimateId"] = $optimizationsEstimate; // When id is NULL, $optimizationsEstimate holds the ID for the newly started estimate
            }
        } catch (\Exception $e) {
        }

        nitropack_json_and_exit(array(
            "type" => "success",
            "res" => $optimizationsEstimate
        ));
    }

    nitropack_json_and_exit(array(
        "type" => "error",
        "message" => "Error! There was an error while estimating the cache warmup!"
    ));
}

function nitropack_warmup_stats() {
    if (null !== $nitro = get_nitropack_sdk()) {
        try {
            $stats = $nitro->getApi()->getWarmupStats();
        } catch (\Exception $e) {
        }

        nitropack_json_and_exit(array(
            "type" => "success",
            "stats" => $stats
        ));
    }

    nitropack_json_and_exit(array(
        "type" => "error",
        "message" => "Error! There was an error while fetching warmup stats!"
    ));
}

function nitropack_data_dir_exists() {
    return defined("NITROPACK_DATA_DIR") && is_dir(NITROPACK_DATA_DIR);
}

function nitropack_init_data_dir() {
    return nitropack_data_dir_exists() || @mkdir(NITROPACK_DATA_DIR, 0755, true);
}

function nitropack_config_exists() {
    return defined("NITROPACK_CONFIG_FILE") && file_exists(NITROPACK_CONFIG_FILE);
}

function nitropack_get_site_config() {
    $siteConfig = null;
    $npConfig = nitropack_get_config();
    $currentUrl = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $matchLength = 0;
    foreach ($npConfig as $siteUrl => $config) {
        if (strpos($currentUrl, $siteUrl) === 0 && strlen($siteUrl) > $matchLength) {
            $siteConfig = $config;
            $matchLength = strlen($siteUrl);
        }
    }

    return $siteConfig;
}

function nitropack_set_config($config) {
    if (!nitropack_data_dir_exists() && !nitropack_init_data_dir()) return false;
    $GLOBALS["nitropack.config"] = $config;
    return WP_DEBUG ? file_put_contents(NITROPACK_CONFIG_FILE, json_encode($config, JSON_PRETTY_PRINT)) : @file_put_contents(NITROPACK_CONFIG_FILE, json_encode($config, JSON_PRETTY_PRINT));
}

function nitropack_get_config() {
    if (!empty($GLOBALS["nitropack.config"])) {
        return $GLOBALS["nitropack.config"];
    }

    $config = array();

    if (nitropack_config_exists()) {
        $config = json_decode(file_get_contents(NITROPACK_CONFIG_FILE), true);
    }

    $GLOBALS["nitropack.config"] = $config;
    return $config;
}

function nitropack_update_current_blog_config($siteId, $siteSecret, $blogId, $enableCompression = null) {
    if ($enableCompression === null) {
        $enableCompression = (get_option('nitropack-enableCompression') == 1);
    }

    $webhookToken = get_option('nitropack-webhookToken');
    $hosting = nitropack_detect_hosting();

    $home_url = get_home_url();
    $admin_url = admin_url();
    $configKey = preg_replace("/^https?:\/\/(.*)/", "$1", $home_url);
    $staticConfig = nitropack_get_config();
    $staticConfig[$configKey] = array(
        "siteId" => $siteId,
        "siteSecret" => $siteSecret,
        "blogId" => $blogId,
        "compression" => $enableCompression,
        "webhookToken" => $webhookToken,
        "home_url" => $home_url,
        "admin_url" => $admin_url,
        "hosting" => $hosting,
        "pluginVersion" => NITROPACK_VERSION
    );
    return nitropack_set_config($staticConfig);
}

function nitropack_unset_current_blog_config() {
    $home_url = get_home_url();
    $configKey = preg_replace("/^https?:\/\/(.*)/", "$1", $home_url);
    $staticConfig = nitropack_get_config();
    if (!empty($staticConfig[$configKey])) {
        unset($staticConfig[$configKey]);
        return nitropack_set_config($staticConfig);
    }

    return true;
}

function nitropack_event($event, $nitro = null, $additional_meta_data = null) {
    global $wp_version;

    try {
        $eventUrl = get_nitropack_integration_url("extensionEvent", $nitro);
        $domain = !empty($_SERVER["HTTP_HOST"]) ? $_SERVER["HTTP_HOST"] : "Unknown";

        $query_data = array(
            'event' => $event,
            'platform' => 'WordPress',
            'platform_version' => $wp_version,
            'nitropack_extension_version' => NITROPACK_VERSION,
            'additional_meta_data' => $additional_meta_data ? json_encode($additional_meta_data) : "{}",
            'domain' => $domain
        );

        $client = new NitroPack\HttpClient($eventUrl . '&' . http_build_query($query_data));
        $client->doNotDownload = true;
        $client->fetch();
    } catch (\Exception $e) {}
}

function nitropack_get_wpconfig_path() {
    $configFilePath = nitropack_trailingslashit(ABSPATH) . "wp-config.php";
    if (!file_exists($configFilePath)) {
        $configFilePath = nitropack_trailingslashit(dirname(ABSPATH)) . "wp-config.php";
        $settingsFilePath = nitropack_trailingslashit(dirname(ABSPATH)) . "wp-settings.php"; // We need to check for this file to avoid confusion if the current installation is a nested directory of another WP installation. Refer to wp-load.php for more information.
        if (!file_exists($configFilePath) || file_exists($settingsFilePath)) {
            return false;
        }
    }

    return $configFilePath;
}

function nitropack_is_flywheel() {
    return defined("FLYWHEEL_PLUGIN_DIR");
}

function nitropack_is_cloudways() {
    return array_key_exists("cw_allowed_ip", $_SERVER) || preg_match("~/home/.*?cloudways.*~", __FILE__);
}

function nitropack_is_wpe() {
    return !!getenv('IS_WPE');
}

function nitropack_is_wpaas() {
    return class_exists('\WPaaS\Plugin');
}

function nitropack_is_siteground() {
    $configFilePath = nitropack_get_wpconfig_path();
    if (!$configFilePath) return false;
    return strpos(file_get_contents($configFilePath), 'Added by SiteGround WordPress management system') !== false;
}

function nitropack_is_gridpane() {
    $configFilePath = nitropack_get_wpconfig_path();
    if (!$configFilePath) return false;
    return strpos(file_get_contents($configFilePath), 'GridPane Cache Settings') !== false;
}

function nitropack_is_kinsta() {
    return defined("KINSTAMU_VERSION");
}

function nitropack_detect_hosting() {
    if (nitropack_is_flywheel()) {
        return "flywheel";
    } else if (nitropack_is_cloudways()) {
        return "cloudways";
    } else if (nitropack_is_wpe()) {
        return "wpengine";
    } else if (nitropack_is_siteground()) {
        return "siteground";
    } else if (nitropack_is_wpaas()) {
        return "godaddy_wpaas";
    } else if (nitropack_is_gridpane()) {
        return "gridpane";
    } else if (nitropack_is_kinsta()) {
        return "kinsta";
    } else {
        return "unknown";
    }
}

function nitropack_handle_request() {
    header('Cache-Control: no-cache');
    $isManageWpRequest = !empty($_GET["mwprid"]);
    if ( file_exists(NITROPACK_CONFIG_FILE) && !empty($_SERVER["HTTP_HOST"]) && !empty($_SERVER["REQUEST_URI"]) && !$isManageWpRequest ) {
        try {
            $siteConfig = nitropack_get_site_config();
            if ( $siteConfig && null !== $nitro = get_nitropack_sdk($siteConfig["siteId"], $siteConfig["siteSecret"]) ) {
                if (is_valid_nitropack_webhook()) {
                    if (did_action('muplugins_loaded')) {
                        nitropack_handle_webhook();
                    } else {
                        add_action('muplugins_loaded', 'nitropack_handle_webhook');
                    }
                } else {
                    if (is_valid_nitropack_beacon()) {
                        if (did_action('muplugins_loaded')) {
                            nitropack_handle_beacon();
                        } else {
                            add_action('muplugins_loaded', 'nitropack_handle_beacon');
                        }
                    } else {
                        $GLOBALS["NitroPack.instance"] = $nitro;
                        if (nitropack_passes_cookie_requirements()) {
                            // Check whether the current URL is cacheable
                            // If this is an AJAX request, check whether the referer is cachable - this is needed for cases when NitroPack's "Enabled URLs" option is being used to whitelist certain URLs. 
                            // If we are not checking the referer, the AJAX requests on these pages can fail.
                            $urlToCheck = nitropack_is_ajax() && !empty($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : $nitro->getUrl();
                            if ($nitro->isAllowedUrl($urlToCheck)) {
                                add_filter( 'nonce_life', 'nitropack_extend_nonce_life' );
                            }

                            if ($nitro->isCacheAllowed()) {
                                if (!empty($siteConfig["compression"])) {
                                    $nitro->enableCompression();
                                }

                                if ($nitro->hasLocalCache()) {
                                    header('X-Nitro-Cache: HIT');
                                    setcookie("nitroCache", "HIT", time() + 10);
                                    $nitro->pageCache->readfile();
                                    exit;
                                } else {
                                    // We need the following if..else block to handle bot requests which will not be firing our beacon
                                    if (nitropack_is_warmup_request()) {
                                        $nitro->hasRemoteCache("default"); // Only ping the API letting our service know that this page must be cached.
                                        exit; // No need to continue handling this request. The response is not important.
                                    } else if (nitropack_is_lighthouse_request() || nitropack_is_gtmetrix_request() || nitropack_is_pingdom_request()) {
                                        $nitro->hasRemoteCache("default"); // Ping the API letting our service know that this page must be cached.
                                    }

                                    $nitro->pageCache->useInvalidated(true);
                                    if ($nitro->hasLocalCache()) {
                                        header('X-Nitro-Cache: STALE');
                                        $nitro->pageCache->readfile();
                                        exit;
                                    } else {
                                        $nitro->pageCache->useInvalidated(false);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            // Do nothing, cache serving will be handled by nitropack_init
        }
    }
}

// Init integration action handlers
require_once 'integrations.php';
if (did_action('muplugins_loaded')) {
    nitropack_check_and_init_integrations();
} else {
    add_action('muplugins_loaded', 'nitropack_check_and_init_integrations');
}
