<?php
ini_set('display_errors', '1');
session_start();
date_default_timezone_set('Asia/Kolkata');
//Database host
define('_DB_SERVER_', 'localhost');

//datbase username
define('_DB_USER_', 'root');

//database password
define('_DB_PASSWD_', 'pb58N23YTkjS');

//database name
define('_DB_NAME_', 'cricvillescore');

define('_DB_TYPE_', 'MySQL');
define('_WP_DB_SERVER_', 'localhost');
define('_WP_DB_USER_', 'root');
define('_WP_DB_PASSWD_', 'pb58N23YTkjS');
define('_WP_DB_NAME_', 'zealcity_blog');

define('FB_APP_ID', '252598391485326');
define('FB_APP_SECRET', '3817d5d3a9280fb3b0f26244c0254020');


$currentDir = dirname(__FILE__);
define('_ROOT_DIR_',             realpath($currentDir.'/..'));
define('_MODULE_DIR_', _ROOT_DIR_.'/modules/');
define('_TEMPLATE_DIR_', 'template/');
define('_COOKIE_KEY_', 'MhdfklDFDBdfdffgFGf34fgbhD5');
define('_COOKIE_IV_', 'FGFG4fgfg');
define('SMARTY_DIR', 'tools/smarty/');
define('FLAG_URL', 'http://cricville.com/test/scoreadmin/images/');
define('__BASE_URI__', '/');
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
define('PAYPAL_USERNAME', adit_api1.zealcity.com');
define('PAYPAL_PASSWORD', 'PCPJP9ALVVR6VPUH');
define('PAYPAL_SIGNATURE', 'PCPJP9ALVVR6VPUH
Anq6I4-M0NOq3q.CwFSpWVa7SGMAA3e6TpfEvDWgLYwCYjkb8Aa4ikPz');
define('PAYPAL_CURRENCY_CODE', 'USD');
define('PAYPAL_RETURN_URL', 'http://zealcity.com/return-paypal.php');
define('PAYPAL_CANCEL_URL', 'http://zealcity.com/deposit');
define('SITE_URL', 'http://zealcity.com/');

require_once(dirname(__FILE__)."/autoload.php");
require_once(dirname(__FILE__)."/../tools/smarty/Smarty.class.php");
