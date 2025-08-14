<?php
define( 'WP_MEMORY_LIMIT', '256M' );
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'rorob' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'C&dNSZ@-{ZWaes7SzNB0]CA`%D#O(mEY|fYS),N9v}#!v]FO>;53_-,AYSArX0@k' );
define( 'SECURE_AUTH_KEY',  'O02I+@`?->n]>=9t291|.qaCQ+!z(3Ic$PWgg6aA(XLahoN|9<]6^25/hJ/.Pdbt' );
define( 'LOGGED_IN_KEY',    'qCV9TBAqc_(hqqVvWuM,4yWHx%)$%a5F%W]eo5Zw+-4[vZ<s7`x^?-Fb=P3y!3/1' );
define( 'NONCE_KEY',        'WQKf}K8bnxF5IWhD-[L#42g-}xxI!Whr.+}*{Y5}`jF4}+3Q}O/0IPrpQ6^FS6&H' );
define( 'AUTH_SALT',        '3oe;</m?x}d*NRId`:UEg`rCS/(C%l<J1_(`BP)R_Tk;$DmwR8j0-S$=I0bv[.D+' );
define( 'SECURE_AUTH_SALT', 'a}I$5z.brB:Hfav,o[Uw>%T.E|d#^@m]sW<EL&SliYHJm`$du<NYxU`6zM/;I$r:' );
define( 'LOGGED_IN_SALT',   'J@vOq,M5h_ORtHGG[R<JDoZXCv6wL(rL+(7_tmo^K[SA@Uq%Cm%bmAoxjp15yZuU' );
define( 'NONCE_SALT',       '`xxiGSBS}9i,Mfc*04{zf1dNgc/?*,it&Rug#h!A5lXOgbJ(/@/S-n[?yOifmfuK' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix  = 'uyswp_';
define( 'WP_POST_REVISIONS', 10 );

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
// define( 'WP_DEBUG', false );
define('WP_DEBUG', true); 

define('WP_DEBUG_LOG', true); 

define('WP_DEBUG_DISPLAY', false); 

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';