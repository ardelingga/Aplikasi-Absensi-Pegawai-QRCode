<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Absensi QRCode</title>

	<link href="libs/phpqrcode/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="libs/phpqrcode/assets/countdown/css/jquery.countdown.css">

	<style type="text/css">
		.nsi_body {margin-top: 25px;}
		.col-centered {
			float: none;
			margin: 0 auto;
		}
		.is-countdown {
			border: 1px solid #ccc;
			background-color: #eee;
			font-size: 34px;
		}

	</style>
</head>
<body>
	<div class="nsi_body">
		<div class="container">
			<div class="row">
				<div class="col-md-7 col-centered">
					<h1 class="text-center"><b> Selamat Datang </b></h1>
					<h3 class="text-center"> <b><i>Silahkan Scan QR Code Dibawah Ini..! </i></b></h3>
				</div>
			</div>
			<div class="row">
				<div class="col-md-7 col-centered">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title text-center">Absensi QARCode</h3>
						</div>
						<div class="panel-body">
							<img id="img_qrcode" class="center-block" src="qrcodeimg.php" width="200px" />
							<hr />
							<p class="text-center text-success lead">
								Silahkan scan menggunakan Smartphone Andriod Anda.
							</p>
							<div class="text-center" style="display: none;"><span id="countdown"></span></div>
							<br />
							<div class="progress">
								<div id="nsi_progress_bar" class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
								aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
								10
							</div>
						</div>

						</div>
						<div class="panel-footer text-right text-muted small">
							&copy; 2017 - Aplikasi Absensi QRCode Versi 1.0
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="libs/phpqrcode/assets/jquery.min.js"></script>
	<script src="libs/phpqrcode/assets/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="libs/phpqrcode/assets/countdown/js/jquery.plugin.js"></script> 	
	<script type="text/javascript" src="libs/phpqrcode/assets/countdown/js/jquery.countdown.js"></script>
	<script type="text/javascript">
		$(function() {
			$("#countdown").countdown({
				until: +10, 
				format: 'S',
				compact: true,
				layout: '{sn}',
				onExpiry: diUlangi,
				onTick: tiapDetik, 
				tickInterval: 1				
			});
		});

		function diUlangi() {
			var d = new Date();
			var n = d.getTime();
			$('#img_qrcode').attr('src', 'qrcodeimg.php?t='+n)
				.on('load', function() {
					if (!this.complete || typeof this.naturalWidth == "undefined" || this.naturalWidth == 0) {
						//alert('broken image!');
						location.reload(); 
					} else {
						// ok
						$('#countdown').countdown('option', {until: +10});
					}
				});
		}

		function tiapDetik(periods) {
			detik = periods[6];
			var persen =  detik * 10;
			$("#nsi_progress_bar").attr('aria-valuenow', (persen));
			$("#nsi_progress_bar").attr('style', 'width:' + persen + '%');
			$("#nsi_progress_bar").text(detik);
		}
	</script>
</body>
</html>

