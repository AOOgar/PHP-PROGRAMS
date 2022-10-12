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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'sms' );

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
define( 'AUTH_KEY',         'X@Pf1Z:DmXcsiy,(@u[PGN]Q,RWGY5W<LA-=X*A&(?oNZNB7jSc;ue?MtHplb&`m' );
define( 'SECURE_AUTH_KEY',  'LX- O6U#-c<1g<AZM/2sGYNTV#3BLsKax@hRe1FF/tOAQ`ls|xQa@OiV{y%([d!+' );
define( 'LOGGED_IN_KEY',    ']&N:d ]EaK%`)j /?=G?IHSUb7L@1rh1a<S$Sxr6LpE&aK^[ceK+<+FOZOIl~_5L' );
define( 'NONCE_KEY',        'Nwmg(6WH<tW(:yoz6U-FxbO6PeI$[r<gA}.a?c c|.5;/;%hrwDGfM<`rDV.0Noj' );
define( 'AUTH_SALT',        '<Z!nJ;v;$y2`lHf6oW+S),pjA,AC7s>f~=9^m,6lU*j|rw_)4lKp)#xbDd%j9drR' );
define( 'SECURE_AUTH_SALT', 'Tp!?Y/N(%[|G0NzhNZK*vX{n0U8o*&vSmh=hd1TWcIDY,.?1j^)TvZ Q8b^>q8|W' );
define( 'LOGGED_IN_SALT',   'Q:QNF;51oSy_x!us-_RZJ`j8cJvR`_X_F+?PAE~5BToupmHz]-$ek/OjYhB|qKPS' );
define( 'NONCE_SALT',       ',Z{Y%DfcCtn>(F,_#Qp+_;F[Pohqp_XBvf|Jm{q.qe4~A1OAenx;ddc_i5]b1Yn>' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';


@ini_set( 'upload_max_filesize' , '128M' );
@ini_set( 'post_max_size', '128M');
@ini_set( 'memory_limit', '256M' );
@ini_set( 'max_execution_time', '300' );
@ini_set( 'max_input_time', '300' );