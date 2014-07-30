<?php
ini_set('display_errors', '1');
ini_set('session.gc_maxlifetime', 30*60);
session_start();
date_default_timezone_set('Asia/Kolkata');
//Database host
define('_DB_SERVER_', 'localhost');

//datbase username
define('_DB_USER_', 'root');

//database password
define('_DB_PASSWD_', '');

//database name
define('_DB_NAME_', 'cricvillescore4');

define('_DB_TYPE_', 'MySQL');
define('_WP_DB_SERVER_', 'localhost');
define('_WP_DB_USER_', 'root');
define('_WP_DB_PASSWD_', '');
define('_WP_DB_NAME_', 'zealcity_blog');

define('FB_APP_ID', '651571088249117');
define('FB_APP_SECRET', '88d0dffa021a7383c5c994adba290f13');


$currentDir = dirname(__FILE__);
define('_ROOT_DIR_',             realpath($currentDir.'/..'));
define('_MODULE_DIR_', _ROOT_DIR_.'/modules/');
define('_TEMPLATE_DIR_', 'template/');
define('_COOKIE_KEY_', 'MhdfklDFDBdfdffgFGf34fgbhD5');
define('_COOKIE_IV_', 'FGFG4fgfg');
define('SMARTY_DIR', 'tools/smarty/');
define('FLAG_URL', 'http://cricville.com/test/scoreadmin/images/');
//define('FLAG_URL', 'http://10.199.50.79/test/scoreadmin/images/');
define('__BASE_URI__', '/zealcityori/');
define('PITCH_REPORT', 2);
define('WEATHER_REPORT', 3);
define('PAANDIT_SAYS', 5);
define('PROS_CORNER', 6);
define('INJURY_CAUSES', 4);
define('STAR_PLAYERS', 7);
define('PREDICTION', 8);
define('NEWS', 9);
define('DISCUSSIONS', 10);
define('BLOG', 11);

//Paypal Items
define('PAYPAL_MODE', '');
define('PAYPAL_USERNAME', 'adit_api1.zealcity.com');
define('PAYPAL_PASSWORD', 'PCPJP9ALVVR6VPUH');
define('PAYPAL_SIGNATURE', 'Anq6I4-M0NOq3q.CwFSpWVa7SGMAA3e6TpfEvDWgLYwCYjkb8Aa4ikPz');
define('PAYPAL_CURRENCY_CODE', 'USD');
define('PAYPAL_RETURN_URL', 'http://www.zealcity.com/return-paypal.php');
define('PAYPAL_CANCEL_URL', 'http://www.zealcity.com/deposit');
define('SITE_URL', 'http://10.199.50.88/zealcityori/');

require_once(dirname(__FILE__)."/autoload.php");
require_once(dirname(__FILE__)."/../tools/smarty/Smarty.class.php");
