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
define( 'DB_NAME', 'artprintstudio' );

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
define( 'AUTH_KEY',         '!S,[ieRz`_I&B2n[TQQ9 [*!6$<6}< ,-F3@Ho-JCJ9q&!)2J^QGjyRFxV0_z!G2' );
define( 'SECURE_AUTH_KEY',  'NX+8PF!VkXKvuwIsIH(}~gGz>.D~mgt>!XvD~`SN!B0NPz<H:K-|^ UG^T]aboB}' );
define( 'LOGGED_IN_KEY',    '@zY{34F-N)1~XC*$&=whyz2;9QoqRsWg~v]*c1dbCch:qVO_&XY2`CSl!A,ObXjL' );
define( 'NONCE_KEY',        '+0lEM:-A0,N_`-_)j(*+p3NlAZND~7a`lmi9bO@*{)FPTK>;tLC~B;GC(FH7e:z8' );
define( 'AUTH_SALT',        'Ld#l*DR,^Cjcrg8LETEu~1:h[H!~~r/2`bPXfBNQz1M#?QmkeTx5,Bem~W/O5kdD' );
define( 'SECURE_AUTH_SALT', 'Py(!Wb#1>HNVDCegDa<<GP9XiskKU?BpYf6;C9g~mHIv}9uZ#xE$fje=WUh*c=X_' );
define( 'LOGGED_IN_SALT',   'sSn`U]H]rPsXwL<~O)n6kEkri.YU6p90tIc,_QVK~I<mVGUq(E`5rdUzEhVdJ56.' );
define( 'NONCE_SALT',       'HfG{+9dLJ2<Lg8ZHy6jdq`gH?okVHU;NsP8DydbogFNSzS&7rwOPqZT*M8?AO7GR' );

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
