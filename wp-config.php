<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'inspirada');

/** MySQL database username */
define('DB_USER', 'inspirada');

/** MySQL database password */
define('DB_PASSWORD', 'Ge50Ku7HQlIF');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'E[w+;aq-%<[.!93Yw$7ypxStJLmm0Uz-|<=%{QtlAzkJ(.g9?-o7%wSVb1/e~F)D');
define('SECURE_AUTH_KEY',  'rfC+%zVkEr+I(T<3kM, JEcP2E1o mzZ_$LJ7*ylBs&#|T|dTD&Z_quB`_]|_@9{');
define('LOGGED_IN_KEY',    '5Yyzo)+0Fff&^+V%X*|A}j*CEs]K_?5.)KI!0i tyL:spg$+=2Yu[0Z|.1FXf4qA');
define('NONCE_KEY',        'mHjsw}dS2`9V,YdA,;@0Vdu8aG{[hZ,.;0egrNi_2YH,`qp`|MW<XXF#y4xDc|G-');
define('AUTH_SALT',        ']d-c~0qB|DmEd1@9;HcTr!OnDzWoN!&[l8$voWMqE*Ud{:2}`%56Sp)Y#[/X>h_A');
define('SECURE_AUTH_SALT', 'iEYr&<n)(EkJH 9A%1;hQ*4K^acp=s(b/#dD1<-kC2`Xr#J#YQjv:?t$K$B{B+d]');
define('LOGGED_IN_SALT',   'rQf+Z;2vwUa_(K!H[9?K95A)}`?^;}85D&8)2+?|Xkk.{@r+9J[uX&ggp.a<`@kZ');
define('NONCE_SALT',       'Uz~0h#,6|yK:Ip3k&3_XC)-4_QY7C5ECK:HNf6ZMIq+4&ap&--VL~H&Zz/S2`]FK');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
