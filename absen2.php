<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> Absen QR Code </title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="assets/nsi/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="assets/nsi/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="assets/plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="assets/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style type="text/css">
  	.login{
  		padding: auto;
  		margin-top: 100px;
  		font-size: 25px;
  		font-family: Agency FB;
  	}
  </style>
</head>
<body>
	<div class="col-md-12">
		<div class="login">
				<p align="center"><b>
					<?php
					error_reporting(-1);
					date_default_timezone_set('Asia/Jakarta');
					define('nsi', true);
					if(isset($_GET['hasil'])) {
						if($_GET['hasil'] == 'ok') {
							echo $_GET['nama'].', Berhasil Absensi <strong>'.$_GET['tipe'].'</strong>.';
							if($_GET['telat'] > 0) {
								echo '<br>Anda Telat <strong>'.$_GET['telat'].'</strong> Menit.';
							}
							echo '<br>Terimakasih.';
							exit();
						}
						if($_GET['hasil'] == 'no_db') {
							echo $_GET['nama'].', Gagal Absensi <strong>'.$_GET['tipe'].'</strong>.<br>Kesalahan Tehnis, Silahkan Ulangi atau hubungi Admin.';
							exit();
						}
						if($_GET['hasil'] == 'no_waktu') {
							echo $_GET['nama'].', Gagal Absensi.<br>Waktu Anda tidak berlaku, silahkan hubungi Admin.';
							exit();
						}
						if($_GET['hasil'] == 'no_absen') {
							echo $_GET['nama'].', Gagal Absensi.<br>'.$_GET['alasan'].', silahkan hubungi Admin.';
							exit();
						}
						if($_GET['hasil'] == 'no_qrc') {
							echo 'KESALAHAN (KODE QR SALAH), SILAHKAN ULANGI...';
							exit();
						}

					}


					define('ROOT_DIR', dirname (__FILE__));
					define('LIB_DIR', ROOT_DIR . '/libs');
					define('BASE_URL', "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?'));

					require_once (LIB_DIR . '/conf.php');
					require_once (LIB_DIR . '/mysqli.php');
					require_once (LIB_DIR . '/function.php');

					// DB AKSES
					$db = new nsiDB ($config['user'], $config['pass'], $config['db'], $config['host']);

					// ambil code dr db
					$query = "SELECT opsi_val FROM `opsi_umum` WHERE `opsi_key` = 'qrcode_kode' ";
					$row = $db->select_one($query);
					$kode_db = $row->opsi_val;

					$qrc_user = isset($_GET['qrc']) ? $_GET['qrc'] : '';
					$imei_user = isset($_GET['imei']) ? $_GET['imei'] : '';
					//echo $imei_user;
					//if($kode_db == $qrc_user) {
					if("ABC" == $qrc_user) {
					// OK KODE BENAR
					// cek data
						$sql_a = "	SELECT m_set_waktu.*, m_personal.id AS personal_id, m_personal.nama AS nama 
						FROM m_personal 
						LEFT JOIN m_departemen ON m_departemen.id = m_personal.id_departemen
						LEFT JOIN tabel_set_abs ON tabel_set_abs.id_departemen = m_personal.id_departemen
						LEFT JOIN m_set_priode ON m_set_priode.id = tabel_set_abs.id_priode
						LEFT JOIN m_set_waktu ON m_set_waktu.id = tabel_set_abs.id_waktu
						WHERE m_set_priode.aktif = 'y' AND m_personal.imei = '".$imei_user."'
						";
						$data_a = $db->select_one($sql_a);
						if(!$data_a) {
							echo 'KESALAHAN, Nomor IMEI Anda Belum Terdaftar, Silahkan Hubungi Admin.';
							exit();
						}
						$personal_id = $data_a->personal_id;
						$nama = $data_a->nama;

						//var_dump($data_a);
						//var_dump($_POST['waktu']);
						//$waktu = date("Y-m-d H:i");
						$waktu = '2017-11-24 07:01';

						//$wkt_input = (int) date("Hi");
						$wkt_input = (int) str_replace(':', '', substr($waktu, 11, 5));
						//echo $wkt_input; exit();
						$tgl = substr($waktu, 0, 10);
						//echo $tgl; exit();

						$tipe = 'error';
						$telat = 0;
						$row_jam_mulai_abs = (int) str_replace(':', '', substr($data_a->jam_mulai_abs, 0, 5));
						$row_jam_masuk = (int) str_replace(':', '', substr($data_a->jam_masuk, 0, 5));
						$row_jam_pulang = (int) str_replace(':', '', substr($data_a->jam_pulang, 0, 5));
						$row_jam_batas_pulang = (int) str_replace(':', '', substr($data_a->jam_batas_pulang, 0, 5));
						$row_jam_batas_masuk = (int) str_replace(':', '', substr($data_a->jam_batas_masuk, 0, 5));
						// Absen Masuk
						//	$telat = $wkt_input - $row_jam_masuk;

						if($wkt_input >= $row_jam_mulai_abs && $wkt_input <= $row_jam_batas_masuk) {
							$tipe = 'masuk';
							if($wkt_input > $row_jam_masuk) {
								$telat = $wkt_input - $row_jam_masuk;
							}
						}

						// Absen Pulang
						if($wkt_input >= $row_jam_pulang && $wkt_input <= $row_jam_batas_pulang) {
							$tipe = 'pulang';
						}
						if($tipe != 'error') {
						// cek apakah sudah ada data di db
							$cek_absensi = cek_absensi($personal_id, $tgl, $tipe);
							if($cek_absensi == "OK") {
							// insert db
								$data = array(
									'waktu' 			=> $waktu,
									'id_personal' 		=> $personal_id,
									'ket' 				=> 'AutoQRC',
									'tipe'				=> $tipe,
									'telat_menit'	    => $telat
									);
								$insert = $db->tambah('data_kehadiran', $data);
								if($insert > 0) {
								//set_notif('simpan_ok', 1);
									redirect('absen.php?hasil=ok&nama=' . $nama.'&tipe=' . $tipe . '&telat=' . $telat);
								} else {
									redirect('absen.php?hasil=no_db&nama=' . $nama.'&tipe=' . $tipe);
								}
							} else {
								redirect('absen.php?hasil=no_absen&nama=' . $nama.'&alasan='.$cek_absensi);
							}
						} else {
							redirect('absen.php?hasil=no_waktu&nama=' . $nama);
						}

					} else {
					// KODE SALAH
						redirect('absen.php?hasil=no_qrc');
					}

					function cek_absensi($personal_id, $tgl, $tipe) {
						global $db;
						$sql = "SELECT * FROM data_kehadiran WHERE id_personal='".$personal_id."' AND DATE(waktu) = '".$tgl."' ";
						$query = $db->query($sql);
						$total = $query->num_rows();
						if($total == 0 && $tipe == 'masuk') {
							return "OK";
						}
						if($total == 1 && $tipe == 'pulang') {
							return "OK";
						}

	// kesalahan2
						if($total == 1 && $tipe == 'masuk') {
							return "Anda Sudah Absensi Masuk Hari ini.";
						}

						if($total == 0 && $tipe == 'pulang') {
							return "Anda Belum Absensi Masuk Hari ini.";
						}

						if($total == 2) {
							return "Anda Sudah Absensi Hari ini.";
						}

						return false;
					}
					?>

				</p>
			</div>
		</div>
	</div>
	<

	<script src="assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="assets/plugins/jQueryUI/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button);
	</script>
	<!-- Bootstrap 3.3.6 -->
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- Morris.js charts -->
	<script src="assets/nsi/raphael-min.js"></script>
	<script src="assets/plugins/morris/morris.min.js"></script>
	<!-- Sparkline -->
	<script src="assets/plugins/sparkline/jquery.sparkline.min.js"></script>
	<!-- jvectormap -->
	<script src="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<!-- jQuery Knob Chart -->
	<script src="assets/plugins/knob/jquery.knob.js"></script>
	<!-- daterangepicker -->
	<script src="assets/nsi/moment.min.js"></script>
	<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
	<!-- datepicker -->
	<script src="assets/plugins/datepicker/bootstrap-datepicker.js"></script>
	<!-- Bootstrap WYSIHTML5 -->
	<script src="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
	<!-- Slimscroll -->
	<script src="assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="assets/plugins/fastclick/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="assets/dist/js/app.min.js"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="assets/dist/js/pages/dashboard.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="assets/dist/js/demo.js"></script>
</body>
</html>

