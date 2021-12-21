<?php
define('WP_CACHE', true); // Added by Cache Enabler
/** Enable W3 Total Cache */





//The entries below were created by iThemes Security to enforce SSL
define( 'FORCE_SSL_ADMIN', true );
//The entry below were created by iThemes Security to disable the file editor
define( 'DISALLOW_FILE_EDIT', true );


/** Liquid Web Managed WordPress BEGIN **/
/** Warning: Only make changes to this section if you are requested by Liquid Web Managed WordPress Support. **/
/** Changes made within the BEGIN and END blocks may be removed during future platform updates. **/

/* Turn HTTPS 'on' if HTTP_X_FORWARDED_PROTO matches 'https' */
if ( isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false) {
    $_SERVER['HTTPS'] = 'on';
}

/** Set Client IP based on HTTP_X_FORWARDED_FOR if provided. **/
if ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) && ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
	$ip_list = explode( ',', $_SERVER['HTTP_X_FORWARDED_FOR'] );
	$_SERVER['REMOTE_ADDR'] = trim( $ip_list[0] );
}

defined('JETPACK_STAGING_MODE') || define( 'JETPACK_STAGING_MODE', true );



/** Core auto updates **/
defined('WP_AUTO_UPDATE_CORE')   || define('WP_AUTO_UPDATE_CORE', 'minor');

/** Always use the direct method for file access **/
defined('FS_METHOD')             || define('FS_METHOD', 'direct');
/** Liquid Web Managed WordPress END **/
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
define('DB_NAME', 's5');

/** MySQL database username */
define('DB_USER', 's5');

/** MySQL database password */
define('DB_PASSWORD', '3ESUbrVf3kYAXkRqsSEqb61gSQ0bOc7Pna');

/** MySQL hostname */
define( 'DB_HOST', 'localhost:/var/run/mysqld/mysqld.sock' );

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'X rWFU7=c`uo5Z38=HXtx}Dk`(H!{v8AaPzHJOy9?ST-o$rzO 6qm<>F8%|A`)k<' );
define( 'SECURE_AUTH_KEY',   '~Ng>7X;%lQFRl<a:Vp0|.^.3N|-N0YgGq;yBFp)qXB2uK>2>ozS<8A&v%2Q{8Dev' );
define( 'LOGGED_IN_KEY',     'G&RH8Q4KWI8jsaJ74vT$wN@_N )Yp2Q:x/l}Equj^#M4YYsqA^]HDD^gt&@CTx8;' );
define( 'NONCE_KEY',         'fer85rF}m_[);BPjV*1}%x*J~ PU:bmy4QKW0,{+@N7~oh^R$)9BFYV|+@?I9/gu' );
define( 'AUTH_SALT',         'N4f:tB r36FIs]Y&Mg,`s:f>k_Q+)q[k{NBQb}kbkXreCp>jYjc%*8zplyS}rO_K' );
define( 'SECURE_AUTH_SALT',  'ZWi/ioVI@t bzZdH#@81l$S}hG*cx2U$qDMo)Eni`pg`&ugcHzWrS/w@i]2_mBE>' );
define( 'LOGGED_IN_SALT',    'NC`81-?**2xZ!v`J_y5Mb^GHyz&:i@PP2hE&*ow qA!69QXj,@24yoO1~r#uyJbb' );
define( 'NONCE_SALT',        'E]M-oFE(WStTGWzzI&.RiX[svy&IoVCRxlOn-RDj5Dt@I|61DXjM*h3y,+54:^8I' );
define( 'WP_CACHE_KEY_SALT', ']52wCruEh[kEPQe@p Ju9X3sG@H:-yC]oZ+{WKihhT^xE8uN.p%MnEAk/F4{ODyo' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'ss_';


define( 'WP_DEBUG', false );

define('WP_HTTP_BLOCK_EXTERNAL', false);

define('DISALLOW_FILE_MODS',false);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

define("CURRENT_ENV", "prod");

