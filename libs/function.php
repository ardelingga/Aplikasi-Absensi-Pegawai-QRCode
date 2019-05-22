<?php
if (!defined('nsi')) { exit(); }


function cek_login() {
	if(isset($_SESSION['uname'])) {
		return true;
	} else {
		redirect('?m=login');
	}
}

function cek_level($level) {
	$akses = false;
	if(isset($_SESSION['level'])) {
		$level_arr = explode(',', $level);
		foreach ($level_arr as $level_val) {
			if($_SESSION['level'] == trim($level_val)) {
				$akses = true;
			}
		}
	}
	return $akses;
}

function set_notif($name, $text) {
	$_SESSION['notif_'.$name] = $text;	
}

function get_notif($name) {
	if(isset($_SESSION['notif_'.$name])) {
		$notif = $_SESSION['notif_'.$name];
		unset($_SESSION['notif_'.$name]);
		return $notif;
	} else {
		return false;
	}
}

function redirect($url) {
	header('Location: '. BASE_URL . '/' . $url);
	exit();
}

function site_url($url) {
	return BASE_URL . '/' . $url;
}

function view_layout($file) {
	global $web;
	require LAY_DIR . '/' . $file;
}

function set_web($item, $val = '') {
	global $web;
	if($item == 'judul') {
		$web[$item] = $val.' - '.$web['nama_aplikasi'];
	} else {
		$web[$item] = $val;
	}

}

function human2byte($val) {
	$number=substr($val,0,-2);
	switch(strtoupper(substr($val,-2))) {
		case "KB":
			return $number*1024;
		case "MB":
			return $number*pow(1024,2);
		case "GB":
			return $number*pow(1024,3);
		case "TB":
			return $number*pow(1024,4);
		case "PB":
			return $number*pow(1024,5);
		default:
			return $val;
	}
}

function byte2human($val) {
	$mod = 1024;
	$units = explode(' ','B KB MB GB TB PB');
	for ($i = 0; $val >= $mod; $i++) {
		$val /= $mod;
	}
	return round($val, 2) . ' ' . $units[$i];
}

function get_img_avatar($uname = false) {
	if($uname) {
		$filename = $uname;
	} else {
		$filename = $_SESSION['uname'];
	}
	$cek_file = ROOT_DIR . '/uploads/users/'.$filename.'.jpg';
	if(file_exists($cek_file)) {
		return BASE_URL . '/uploads/users/'.$filename.'.jpg';
	} else {
		return BASE_URL . '/assets/dist/img/avatar04.png';
	}
}

function load_script($item) {
	global $web;
	switch ($item) {
		case 'table':
			$web['style_css'][] = 'nsi/bootstrap-table-1.10.1/bootstrap-table.min.css';

			$web['script_js'][] = 'nsi/bootstrap-table-1.10.1/bootstrap-table.min.js';
			$web['script_js'][] = 'nsi/bootstrap-table-1.10.1/bootstrap-table-id-ID.js';
			break;
		case 'modal':
			$web['style_css2'][] = 'nsi/bootstrap-modal-2.2.6/css/bootstrap-modal.css';
			$web['style_css2'][] = 'nsi/bootstrap-modal-2.2.6/css/bootstrap-modal-bs3patch.css';

			$web['script_js'][] = 'nsi/bootstrap-modal-2.2.6/js/bootstrap-modalmanager.js';
			$web['script_js'][] = 'nsi/bootstrap-modal-2.2.6/js/bootstrap-modal.js';
			break;
		case 'select2':
			$web['style_css'][] = 'plugins/select2/select2.min.css';
			$web['script_js'][] = 'plugins/select2/select2.full.min.js';
			break;
		case 'timepicker':
			$web['style_css'][] = 'plugins/timepicker/bootstrap-timepicker.min.css';
			$web['script_js'][] = 'plugins/timepicker/bootstrap-timepicker.min.js';
			break;
		case 'datepicker':
			$web['style_css'][] = 'plugins/datepicker/datepicker3.css';
			$web['script_js'][] = 'plugins/datepicker/bootstrap-datepicker.js';
			$web['script_js'][] = 'plugins/datepicker/locales/bootstrap-datepicker.id.js';
			break;
		case 'chartjs':
			//$web['style_css'][] = 'plugins/select2/select2.min.css';
			$web['script_js'][] = 'plugins/chartjs/Chart.min.js';
			break;
		case 'highcharts':
			//$web['style_css'][] = 'plugins/select2/select2.min.css';
			$web['script_js'][] = 'nsi/highcharts/highcharts.js';
			break;
		case 'date_time_picker':
			$web['style_css'][] = 'nsi/bootstrap_date_time/bootstrap-datetimepicker.min.css';
			$web['script_js'][] = 'nsi/bootstrap_date_time/bootstrap-datetimepicker.min.js';
			$web['script_js'][] = 'nsi/bootstrap_date_time/bootstrap-datetimepicker.id.js';
			break;

	
		default:
			break;
	}
}