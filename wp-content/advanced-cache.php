<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
define( 'NITROPACK_ADVANCED_CACHE', true);
define( 'NITROPACK_ADVANCED_CACHE_VERSION', '1.3.7');
define( 'NITROPACK_LOGGED_IN_COOKIE', 'wordpress_logged_in_37200e3e865bb5b65174b7fd7159af57' );

$nitropack_functions_file = 'D:\wampserver\www\rigatrip\wp-content\plugins\nitropack\functions.php';

if (file_exists($nitropack_functions_file)) {
    require_once $nitropack_functions_file;
}

if (defined("NITROPACK_VERSION") && NITROPACK_VERSION == NITROPACK_ADVANCED_CACHE_VERSION) {
    ob_start();
    register_shutdown_function("ob_end_flush");
    nitropack_handle_request();
}
