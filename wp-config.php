<?php
define('WP_CACHE', true); // Added by WP Rocket
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'rigatrips' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'AGzo?-{) 8x3$5vDa8U#jv^9xw]1?]a3UG(~Cb#yQ&{11Drp&eF$n$)Lok&Ob[,`' );
define( 'SECURE_AUTH_KEY',  'Htn3M;PM(KCsd=*j@b0|oF{bx6Fsdai5^]1az+~zA9/?GZm#_9agUI9sa3g}Wkq/' );
define( 'LOGGED_IN_KEY',    'D>]DFl[ESNR~F!_?c^pm rdUVfahh2l#>(@bgv4rnH!-%b&)Y1Z&?T{2)NbLD&wO' );
define( 'NONCE_KEY',        '@{3()UZ_H[[X=dKMX2w+9)Js94`jh2~&Ft~&fpX}0P>Y^ZGU$z=:i_#aB!0}|9Gw' );
define( 'AUTH_SALT',        'g|a ,j0mff4n:>gl^j1*.0Fc9JV5^+OG6qc>&9Mh$J{UW?PNjGBlLQ#Y9C=?h_bl' );
define( 'SECURE_AUTH_SALT', 'uJ[K,G2%Gx~*ApAITqUV]y4R7KY]1/|<IYlO#a/}C#pfOX]-}}.O$CqRz&_|{+ZI' );
define( 'LOGGED_IN_SALT',   ' #1:o)c=L)y1%:V_o<bhdg^wHd tT#K@TJDu Q~96Eg@!]!$fG%v#d2TGXo]?KZK' );
define( 'NONCE_SALT',       '[:!f[>:kol2qK.ARBu.i)*[4zsl-`^,&&G:TKl{AFV+EZP51KhK9/Ln/-,ZL3q<t' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
