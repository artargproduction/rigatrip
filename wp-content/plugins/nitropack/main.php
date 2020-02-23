<?php
/*
Plugin Name:  NitroPack
Plugin URI:   https://nitropack.io/download/plugin/nitropack-for-wordpress
Description:  A site performance optimization plugin
Version:      1.3.7
Author:       NitroPack LLC
Author URI:   https://nitropack.io/
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
require_once 'functions.php';

if (nitropack_is_wpe()) {
    // Various actions in the WP Engine environment can delete the advanced-cache.php file
    // For WP Engine we are not going to rely on the advanced-cache.php file
    nitropack_handle_request();
}

add_action( 'pre_post_update', 'nitropack_log_post_pre_update', 10, 3);
add_action( 'transition_post_status', 'nitropack_handle_post_transition', 10, 3);
add_action( 'transition_comment_status', 'nitropack_handle_comment_transition', 10, 3);
add_action( 'comment_post', 'nitropack_handle_comment_post', 10, 2);
add_action( 'switch_theme', 'nitropack_switch_theme' );

add_action('wcml_set_client_currency', function($currency) {
    setcookie('np_wc_currency', $currency, time() + (86400 * 7), "/");
});

if (nitropack_has_advanced_cache()) {
    // Handle automated updates
    if (!defined("NITROPACK_ADVANCED_CACHE_VERSION") || NITROPACK_VERSION != NITROPACK_ADVANCED_CACHE_VERSION) {
        add_action( 'plugins_loaded', 'nitropack_install_advanced_cache' );
    }
}

if ( is_admin() ) {
    add_action( 'admin_menu', 'nitropack_menu' );
    add_action( 'admin_init', 'register_nitropack_settings' );
    add_action( 'admin_notices', 'nitropack_admin_notices' );
    add_action( 'network_admin_notices', 'nitropack_admin_notices' );
    add_action( 'wp_ajax_nitropack_purge_cache', 'nitropack_purge_cache' );
    add_action( 'wp_ajax_nitropack_invalidate_cache', 'nitropack_invalidate_cache' );
    add_action( 'wp_ajax_nitropack_verify_connect', 'nitropack_verify_connect' );
    add_action( 'wp_ajax_nitropack_disconnect', 'nitropack_disconnect' );
    add_action( 'wp_ajax_nitropack_test_compression_ajax', 'nitropack_test_compression_ajax' );
    add_action( 'wp_ajax_nitropack_set_compression_ajax', 'nitropack_set_compression_ajax' );
    add_action( 'wp_ajax_nitropack_set_auto_cache_purge_ajax', 'nitropack_set_auto_cache_purge_ajax' );
    add_action( 'wp_ajax_nitropack_set_cacheable_post_types', 'nitropack_set_cacheable_post_types' );
    add_action( 'wp_ajax_nitropack_enable_warmup', 'nitropack_enable_warmup' );
    add_action( 'wp_ajax_nitropack_disable_warmup', 'nitropack_disable_warmup' );
    add_action( 'wp_ajax_nitropack_warmup_stats', 'nitropack_warmup_stats' );
    add_action( 'wp_ajax_nitropack_estimate_warmup', 'nitropack_estimate_warmup' );
    add_action( 'wp_ajax_nitropack_run_warmup', 'nitropack_run_warmup' );
    add_action( 'wp_ajax_nitropack_purge_single_cache', 'nitropack_purge_single_cache' );
    add_action( 'wp_ajax_nitropack_invalidate_single_cache', 'nitropack_invalidate_single_cache' );
    add_action( 'wp_ajax_nitropack_dismiss_hosting_notice', 'nitropack_dismiss_hosting_notice' );
    add_action( 'update_option_nitropack-enableCompression', 'nitropack_handle_compression_toggle' );
    add_action( 'add_meta_boxes', 'nitropack_add_meta_box' );

    register_activation_hook( __FILE__, 'nitropack_activate' );
    register_deactivation_hook( __FILE__, 'nitropack_deactivate' );
} else {
    if (null !== $nitro = get_nitropack_sdk()) {
        $GLOBALS["NitroPack.instance"] = $nitro;
        if (get_option('nitropack-enableCompression') == 1) {
            $nitro->enableCompression();
        }
        add_action( 'wp', 'nitropack_init' );
    }
}

function nitropack_menu() {
    add_options_page( 'NitroPack Options', 'NitroPack', 'manage_options', 'nitropack', 'nitropack_options' );
    add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'nitropack_action_links' );
}

function nitropack_action_links ( $links ) {
    $nitroLinks = array(
        '<a href="' . admin_url( 'options-general.php?page=nitropack' ) . '">Settings</a>',
    );
    return array_merge( $nitroLinks, $links );
}
