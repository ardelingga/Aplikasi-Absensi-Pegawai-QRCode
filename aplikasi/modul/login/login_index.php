<?php
if (!defined('nsi')) { exit(); }

if(isset($_POST['submit'])) {
	$query = "SELECT * FROM `data_pengguna` WHERE `uname` = '".$_POST['uname']."' AND `upass` = '".md5($_POST['upass'])."' AND `aktif`='Y' ";
	$row = $db->select_one($query);
	// user password benar, simpan dalam session
	if($row) {
		$_SESSION['uname'] = $row->uname;
		$_SESSION['level'] = $row->level;
		redirect('?m=depan');
	} else {
		set_notif('login_error', 1);
		redirect('?m=login');
	}
}
if(isset($_SESSION['uname'])) {
	redirect('?m=depan');
}
set_web('judul', 'Login');
view_layout('v_login.php');