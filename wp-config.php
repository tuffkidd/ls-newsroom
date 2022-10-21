<?php

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'news_lscns');

/** Database username */
define('DB_USER', 'news_lscns');

/** Database password */
define('DB_PASSWORD', 'ls4696');

/** Database hostname */
define('DB_HOST', 'wildworks.kr');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

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
define('AUTH_KEY',          '=KTbSAn2 VTJ+8hx4nyIc}X-VTV#vz^:E`59^p!/r~V|w P!/y[m`4E-*<Dqt__O');
define('SECURE_AUTH_KEY',   '$v?pAG$I[!rQU{+spYp_VMxTeo7R,IzBDW}dxEs=>V=e[v@zF3j!idvW-@pj [Rk');
define('LOGGED_IN_KEY',     'zQJxI$`MVBwyaCDM0^fU@p|*s9_9#yA0-WC7j+F`GQ3BevGS;EFl$uVgzy</KWm4');
define('NONCE_KEY',         '-)~>@yMT@8utmkgjP*&}`m3u%ynI~MgX:CZT@n>MV-E}hPr0k%+A;tx(EvUHUJ6|');
define('AUTH_SALT',         '>rQo 8dnUEddPB}ik5|w&FZi_=)L1LX9ND(hlNK;4+aV(tFj.D3LD?]`s-_h-bL;');
define('SECURE_AUTH_SALT',  '/Np,iD7[ Id[s~_c#-]s{3o|N!@8C^_2,?:QpBP-PwnXCLpAU:q,|^K|(_n9(mtu');
define('LOGGED_IN_SALT',    'cAj]+:O{TfM^r%Z,:tim,eegE]c0DL|H)iV:xc?Y3aY@rCe3`$7:z}x{3V;HD{R3');
define('NONCE_SALT',        'b=t5{~ 1)tm~%!0T_XJq8jzV[`Ok9R+Nv%P LEkb|htL@P/L{7yn2`cdjBG6htqA');
define('WP_CACHE_KEY_SALT', ' o~%cK%b/8oBa9[PULoguI0{W*EX)n-E5wXFGh$%k1s=Le@C9*RsEC{#wjF}!6Pe');


/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', true);


/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';