<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

define('FS_METHOD', 'direct');

/**
 * The base configurations of the WordPress.
 *
 * This file is a custom version of the wp-config file to help
 * with setting it up for multiple environments. Inspired by
 * Leevi Grahams ExpressionEngine Config Bootstrap
 * (http://ee-garage.com/nsm-config-bootstrap)
 *
 * @package WordPress
 * @author Abban Dunne @abbandunne
 * @link http://abandon.ie/wordpress-configuration-for-multiple-environments
 */


// Define Environments - may be a string or array of options for an environment
$environments = array(
	'vagrant'    => '172.16.0.20',
	'iufer'      => 'localhost',
	'labs'       => 'process.labs.duarte.com',
	'production' => 'process.duarte.com'
);

// Get Server name
$server_name = $_SERVER['SERVER_NAME'];

foreach($environments AS $key => $env){

	if(is_array($env)){

		foreach ($env as $option){

			if(stristr($server_name, $option)){

				define('ENVIRONMENT', $key);
				
				break 2;
			}

		}

	} else {

		if(strstr($server_name, $env)){

			define('ENVIRONMENT', $key);

			break;

		}
		
	}

}

// If no environment is set default to production
if(!defined('ENVIRONMENT')) define('ENVIRONMENT', 'production');

// Define different DB connection details depending on environment
switch(ENVIRONMENT){

	case 'iufer':

		define('DB_NAME', 'process-dev');
		define('DB_USER', 'root');
		define('DB_PASSWORD', 'root');
		define('DB_HOST', 'localhost');
		define('WP_DEBUG', true);
		define('SAVEQUERIES', true);
		define('WP_SITEURL', 'http://localhost:8080/process/');
		define('WP_HOME', 'http://localhost:8080/process/');
		break;

	case 'vagrant':

		define('DB_NAME', 'process');
		define('DB_USER', 'process');
		define('DB_PASSWORD', 'process');
		define('DB_HOST', 'localhost');
		define('WP_DEBUG', true);
		define('SAVEQUERIES', true);
		define('WP_SITEURL', 'http://172.16.0.20/');
		define('WP_HOME', 'http://172.16.0.20/');
		break;

	case 'labs':

		define('DB_NAME', 'process');
		define('DB_USER', 'labs');
		define('DB_PASSWORD', 'evelyn');
		define('DB_HOST', '127.0.0.1');
		define('WP_DEBUG', false);
		define('WP_SITEURL', 'http://process.labs.duarte.com');
		define('WP_HOME', 'http://process.labs.duarte.com');
		break;

	case 'production':

		define('DB_NAME', 'process');
		define('DB_USER', 'www');
		define('DB_PASSWORD', 'FirstAnd10');
		define('DB_HOST', 'www-duarte.crnqsg5dvama.us-west-1.rds.amazonaws.com');
		define('WP_DEBUG', false);
		define('WP_SITEURL', 'http://process.duarte.com');
		define('WP_HOME', 'http://process.duarte.com');
		break;

}

// If batabase isn't defined then it will be defined here.
// Put the details for your production environment in here.
if(!defined('DB_NAME'))
	define('DB_NAME', 'database_name_here');

if(!defined('DB_USER'))
	define('DB_USER', 'username_here');

if(!defined('DB_PASSWORD'))
	define('DB_PASSWORD', 'password_here');

if(!defined('DB_HOST'))
	define('DB_HOST', 'localhost');

if(!defined('DB_CHARSET'))
	define('DB_CHARSET', 'utf8');

if(!defined('DB_COLLATE'))
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

if(!defined('AUTH_KEY'))
	define('AUTH_KEY', 'I2$CljA7~NW9T[ttO.h#61+?k]|f|F!rtqxmz<08&|20Yc=[aePruVt1 t,;m.<T');

if(!defined('SECURE_AUTH_KEY'))
	define('SECURE_AUTH_KEY', 'pzl=8MhR6|g(yOI/qh=h2P|=9Pn|Y.wHe*,=:iN1+CXTP65w#eteRN=eL^|vx5]g');

if(!defined('LOGGED_IN_KEY'))
	define('LOGGED_IN_KEY', 'KbQopfYQt+MeVxhPPOue&;JNVDJY`|zyjRATksNi:vEN|+TwX! :?v9H^6&<))1F');

if(!defined('NONCE_KEY'))
	define('NONCE_KEY', 'r#BRSy#/R1+8_?4yJ _-oT.?]!cZtcfwT.--x*sTk#fq~Y(|:JT(|W,L`ycZ*kxk');

if(!defined('AUTH_SALT'))
	define('AUTH_SALT', 'Kmv}zz{0Y*w;iY>oO,A|!Qn8?SILzKIx>.2<NyJ5i82rG8;-?zm*Ck*3-+~W}p}c');

if(!defined('SECURE_AUTH_SALT'))
	define('SECURE_AUTH_SALT', '^un~PR57.Sztk$LjL+M/liexg(#;v&+354gjJ$!1SqLpc_4)K]eWLax3<G7>iv**');

if(!defined('LOGGED_IN_SALT'))
	define('LOGGED_IN_SALT', 'd)v]sUf|s!,J!( vt~]uX2[F$VIY~O- *J$UOBfNAhI~rUip+uB[I`j-oI/)z<Ej');

if(!defined('NONCE_SALT'))
	define('NONCE_SALT', 'r N31tRQEy664IM,Dn|.=m)(t53sq;b-d&Q4zTc>6sY<B]Oap.fFP*By>77,+m5[');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
if(!isset($table_prefix)) $table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
if(!defined('WPLANG'))
	define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
if(!defined('WP_DEBUG'))
	define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
