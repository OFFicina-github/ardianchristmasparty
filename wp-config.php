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
define( 'DB_NAME', 'local' );

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
define( 'AUTH_KEY',          'I/Q{sS/SFX>K>AYU!1t?Z=^?gCQ/W`dGcoIfWUVjHPH;n5**(&FztXj-OIa2m$:d' );
define( 'SECURE_AUTH_KEY',   'dM=h~t!*`7rc98VtCW]x73g)G8t-^4t4N,,?2OAW*hC*W&Q^~AzU9Tf3[C)etR*)' );
define( 'LOGGED_IN_KEY',     'Mz(9Y}NR9cgk8tnN2qa.~5VN?Ojz?4#$dIck0K/9_>g4P$9sQO kVkZw6U;FGQnb' );
define( 'NONCE_KEY',         '|(UmQwh$)xZA!~C[vC,<y(dzn#Hfjgs4a_b8c/;gi(PEiU Jd(5AnOaLo80G@- &' );
define( 'AUTH_SALT',         'r+tmTQGr9C,Y>D>p/96T=I=[8f<HNRS#L%DJUca~xgSabO;eRo[guk3pKD2]}))a' );
define( 'SECURE_AUTH_SALT',  '0ZRV?z}Ze`wUJhO|I>,9^TDC3o~ J.XgZ}+X##qDaTF7a)7ubp)[d^bJ.xwf6}Lp' );
define( 'LOGGED_IN_SALT',    '&ZMko?SC/3[HO$Qt851/W(l7(IlH0*XbVdk}C9W5l&jcf>$C}BQlvfBVnEh=VOhF' );
define( 'NONCE_SALT',        ')bd~8n;@|GV=C>s1XZ2==n&6MX0]FC:Ze#Z:od{u~A<kR<I[ul#8;M<}CA$qAH}M' );
define( 'WP_CACHE_KEY_SALT', '8g}8Fuec4~v@ka3J,SP<aG;nZdVHX&HdWyi>e79LNJS$01-dX$c<Cv)D^yO;-!0.' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
