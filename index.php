<?php
session_start();
error_reporting(-1);
date_default_timezone_set('Asia/Jakarta');
define('nsi', true);

// PATH dan BASE
define('ROOT_DIR', dirname (__FILE__));
define('BASE_URL', "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?'));
define('LIB_DIR', ROOT_DIR . '/libs');
define('APP_DIR', ROOT_DIR . '/aplikasi');
define('MOD_DIR', APP_DIR . '/modul');
define('LAY_DIR', APP_DIR . '/layout');

// CONFIG DB DAN FUNGSI
require_once (LIB_DIR . '/conf.php');
require_once (LIB_DIR . '/mysqli.php');
require_once (LIB_DIR . '/function.php');

// DB AKSES
$db = new nsiDB ($config['user'], $config['pass'], $config['db'], $config['host']);

// MODUL REQUEST
require_once (APP_DIR . '/modul.php');
