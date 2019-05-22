<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $web['judul']; ?></title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/nsi/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/nsi/ionicons.min.css">

	<?php 
	if(isset($web['style_css'])) {
		foreach ($web['style_css'] as $val) {
			echo '<link rel="stylesheet" href="'.BASE_URL.'/assets/'.$val.'">';
		}
	}
	?>

	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/dist/css/AdminLTE.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/dist/css/skins/skin-red.min.css">

	<?php 
	if(isset($web['style_css2'])) {
		foreach ($web['style_css2'] as $val) {
			echo '<link rel="stylesheet" href="'.BASE_URL.'/assets/'.$val.'">';
		}
	}
	?>	

	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/nsi/custome.css">
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-red sidebar-mini fixed">
	<div class="wrapper">

		<!-- Main Header -->
		<header class="main-header">

			<!-- Logo -->
			<a href="<?php echo BASE_URL; ?>" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini">SMK</span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b><i>Admin</i></b></span>
			</a>
			<!-- Header Navbar -->
			<nav class="navbar navbar-static-top" role="navigation">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="logo-hape">SMKYT</span>
				</a>
				<!-- Navbar Right Menu -->
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">

						<li class="dropdown user-nsi">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<img src="<?php echo get_img_avatar();?>" class="user-image" alt="User Image">
								<span class="hidden-xs"><?php echo $_SESSION['uname']; ?></span> <span class="caret"></span>
							</a>
							<ul role="menu" class="dropdown-menu">
								<li><a href="<?php echo BASE_URL; ?>?m=profile"><i class="fa fa-user"></i> Profile</a></li>
								<li><a href="<?php echo BASE_URL; ?>?m=profile&c=ubah-pass"><i class="fa fa-key"></i> Ubah Password</a></li>
								<li class="divider"></li>
								<li><a href="<?php echo BASE_URL; ?>?m=login&c=out"><i class="fa fa-lock"></i> Logout</a></li>
							</ul>
						</li>


					</ul>
				</div>
			</nav>
		</header>
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">

			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">

				<!-- Sidebar Menu -->
				<ul class="sidebar-menu">
					<?php view_layout('v_menu.php'); ?>
				</ul>
				<!-- /.sidebar-menu -->
			</section>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">

			<!-- Main content -->
			<section class="content">