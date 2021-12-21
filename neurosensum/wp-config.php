<?php
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
define('DB_NAME', 'neurosensum_website_db');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
// define('DB_PASSWORD', 'neurowebsite_admin2019');
define('DB_PASSWORD', '');


/** MySQL hostname */
define('DB_HOST', 'localhost:3306');
// define('DB_HOST', 'neurosensum-website-db.cqcjqmzceqde.ap-southeast-1.rds.amazonaws.com:3306');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '*7S&o+m)D>_5!Gcv P%YxJ8|yMW?+xt(jdwN0Tw8G<`rf@ZBjEYVsWJUv4c+.$sP');
define('SECURE_AUTH_KEY',  'X}X2iEY>a:18-kz3+!9HntKs)c_EisUpv:7hi+!G&%6--|.69Fm6)sQ9=<NTb+pu');
define('LOGGED_IN_KEY',    'hW!O<8Ugh&ea>-dQ]vvW9/!l3F`g)R:q4u3UhB1);E%8U}@!x]Miv,C=B;Eo%S5P');
define('NONCE_KEY',        '|I:#s@ls]=-)W1$Yr]ftLd#o.;KG(%d%+*s97(_&|%?k[)=Kns3Pq]ceu~ga|^DF');
define('AUTH_SALT',        'tI,JfE8{5NY57%8G9 9zlK0Jr/ ?p=L5yTcCk[*P*+Bg1>21eB~;h8q-ua4OR~}e');
define('SECURE_AUTH_SALT', 'gBvrdMzK){z{Hk?OI~{V+`(A hj{1B<iIF3RW1$,GZr!xh0p}G!Q.^%+`8km`=i#');
define('LOGGED_IN_SALT',   'D4C}5:f;1Z}HChEDV%^q+ANMa <1>2_mYAF:18/9l1-f| &Li_LBOm/Pb*HFa?Ly');
define('NONCE_SALT',       'WsLV}RVfSICJ;&/:rHdY:9Ch3!I!&`ndNpz}Q=ep]o(wfA*8n-Y_mm+;cIuxSv3T');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpa_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
define('FS_MEHTOD', 'direct');
