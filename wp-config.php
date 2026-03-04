<?php
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
define( 'DB_NAME', 'eddy_rakotoarivony' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'z%!R*!lswErm18L2 >x81)Yi(=*_$^`;=%JQbCLpTOiaWJ|cT >Nv$m8Xn5:=RM[' );
define( 'SECURE_AUTH_KEY',  '<>AcO@yUV}jyeid@n?W_CNf9n7SL.L^[7J(-FF?zL#ywyA=$]cHL=gO<Dg<<hB4B' );
define( 'LOGGED_IN_KEY',    'HFt#DCz?in{iwwupcM5$EM2q8],V2pSN*bw1|)WXT^8i?x*^%L,k^,%`u?rHVYy4' );
define( 'NONCE_KEY',        'DA+)2K,GQJ{t!{-);H.!9v*j~9L$1jCxN/h1jU%VbE?391_4(~q|,kYTvuVpWbJJ' );
define( 'AUTH_SALT',        '|O$jl=tkH-kw[M+V#kobn~_Zyc-IDQ3zK}~twL]r-Qx0tO^OL617?rGkO~60.bfT' );
define( 'SECURE_AUTH_SALT', '+a|Rl}&(J 3UcE?UE3n@iMNjP`TLl~UlnRx29a nW1c_bj-~@ d,5b.wwz-^S`O>' );
define( 'LOGGED_IN_SALT',   'L3V6GpRO@<%$&,u5^/fznOsZQ `{g,gG-6tt;`Z3_LntB8r)P.QdAVyV{F &|i(+' );
define( 'NONCE_SALT',       'mQH =-HVVhC0lu*dsj2lF4;+Jb7<=BR<lz=BUMC2BUi_0sa2Gft&%L)E`^]47dI_' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
