<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
define( 'NITROPACK_ADVANCED_CACHE', true);
define( 'NITROPACK_ADVANCED_CACHE_VERSION', '/*NP_VERSION*/');
define( 'NITROPACK_LOGGED_IN_COOKIE', '/*LOGIN_COOKIES*/' );

$nitropack_functions_file = '/*NITROPACK_FUNCTIONS_FILE*/';

if (file_exists($nitropack_functions_file)) {
    require_once $nitropack_functions_file;
}

if (defined("NITROPACK_VERSION") && NITROPACK_VERSION == NITROPACK_ADVANCED_CACHE_VERSION) {
    ob_start();
    register_shutdown_function("ob_end_flush");
    nitropack_handle_request();
}
