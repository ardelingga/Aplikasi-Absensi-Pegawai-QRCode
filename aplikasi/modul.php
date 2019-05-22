<?php
if (!defined('nsi')) { exit(); }

// route dari modul dan controller/aksi
$web['modul'] = isset($_GET['m']) ? $_GET['m'] : 'depan';
$web['control'] = isset($_GET['c']) ? $_GET['c'] : 'index';

// cek login
$publik_arr 	= array('login');
if(! in_array($web['modul'], $publik_arr)) {
	cek_login();
}

// cek level operator, modul depan semua level harus ada
$level_op_arr 	= array('depan', 'data_barang');
if(in_array($web['modul'], $level_op_arr)) {
	$cek_level = cek_level('admin,operator');
	if($cek_level === false) {
		set_notif('level_ditolak', 1);
		redirect('?m=depan');
	}
}
// cek level admin
$level_adm_arr = array('m_pengguna');
if(in_array($web['modul'], $level_adm_arr)) {
	$cek_level = cek_level('admin');
	if($cek_level === false) {
		set_notif('level_ditolak', 1);
		redirect('?m=login');
	}	
}

// 
$file = MOD_DIR.'/'.$web['modul'].'/'.$web['modul'].'_'.$web['control'].'.php';
if(file_exists( $file )) {
	require_once ($file);
} else {
	echo 'Error: File tidak ada '. $file;
}