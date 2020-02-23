<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function nitropack_trailingslashit($string) {
    return rtrim( $string, '/\\' ) . '/';
}

define( 'NITROPACK_VERSION', '1.3.7' );
define( 'NITROPACK_OPTION_GROUP', 'nitropack' );
define( 'NITROPACK_DATA_DIR', nitropack_trailingslashit(WP_CONTENT_DIR) . 'nitropack' );
define( 'NITROPACK_CONFIG_FILE', nitropack_trailingslashit(NITROPACK_DATA_DIR) . 'config.json' );
