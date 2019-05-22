<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $web['judul']; ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/nsi/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/nsi/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/dist/css/AdminLTE.min.css">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="hold-transition login-page">
	<div class="login-box">
		<div align="center">
			<h3><i class="fa fa-female"></i><b><i> SELAMAT DATANG DI </i></b></h3>
		</div>
		<div class="login-logo" align="center">
			<i class="fa fa-desktop"></i><b><i> <?php echo $web['judul_aplikasi']; ?></i></b>
		</div>

		<?php if(get_notif('logout')) { ?>
			<div class="alert alert-success alert-dismissible">
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				<h4><i class="icon fa fa-thumbs-o-up"></i> Logout sukses!</h4>
				Anda telah keluar dari aplikasi.
			</div>
			<?php } ?>
			<?php if(get_notif('login_error')) { ?>
			<div class="alert alert-danger alert-dismissible">
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				<h4><i class="icon fa fa-ban"></i> Error!</h4>
				User atau Password salah.
			</div>
			<?php } ?>
		<!-- /.login-logo -->
		<div class="login-box-body">
			<h4 class="login-box-msg"><i class="fa fa-info-circle"></i><b> Silahkan Login untuk memulai Aplikasi </b></h4>

			<?php if(get_notif('level_ditolak')) { ?>
			<div class="alert alert-danger alert-dismissible">
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				<h4><i class="icon fa fa-ban"></i> Error!</h4>
				User level ditolak.
			</div>
			<?php } ?>

			<form action="" method="post">
				<div class="form-group has-feedback">
					<input type="text" name="uname" id="uname" class="form-control" placeholder="Username">
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="password" name="upass" class="form-control" placeholder="Password">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<input type="submit" name="submit" class="btn btn-success btn-block btn-flat" value="Login"/>
					</div>
				</div>
			</form>
			<hr>
			<b>Copyright © 2017 Nusansifor.</b>
		</div> <!-- /.login-box-body -->
	</div> <!-- /.login-box -->

	<!-- jQuery 2.2.0 -->
	<script src="<?php echo BASE_URL; ?>/assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="<?php echo BASE_URL; ?>/assets/bootstrap/js/bootstrap.min.js"></script>
	<script>
		$(function () {
			$('#uname').focus();
		});
	</script>
</body>
</html>
