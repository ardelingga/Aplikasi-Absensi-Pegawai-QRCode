<?php
error_reporting(-1);
date_default_timezone_set('Asia/Jakarta');
define('nsi', true);

define('ROOT_DIR', dirname (__FILE__));
define('LIB_DIR', ROOT_DIR . '/libs');

require_once (LIB_DIR . '/conf.php');
require_once (LIB_DIR . '/mysqli.php');
require_once (LIB_DIR . '/function.php');

// DB AKSES
$db = new nsiDB ($config['user'], $config['pass'], $config['db'], $config['host']);

$code = sha1('Nusansifor'.date('Ymd:His').'-NSI');
$url = getHostByName(getHostName());
$url .= '/aplikasi_absen/absen.php';

$data = array(
		'opsi_val' 	=> $code
	);
$where = array('opsi_key' => 'qrcode_kode');
$update = $db->ubah('opsi_umum', $data, $where);
if($update) {
	require_once('libs/phpqrcode/qrcode/qrlib.php');
	QRcode::png('http://'.$url.'?qrc='.($code));
} else {
	//
	echo 'ERROR DB UPDATE';
}

