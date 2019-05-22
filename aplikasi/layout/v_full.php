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
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/dist/css/AdminLTE.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/dist/css/skins/skin-green.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/nsi/custome.css">
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-green sidebar-mini fixed">
	<div class="wrapper">

		<!-- Main Header -->
		<header class="main-header">

			<!-- Logo -->
			<a href="<?php echo BASE_URL; ?>" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini">SMK</span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b>Admin</b>SMKYT</span>
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
								<img src="<?php echo BASE_URL; ?>/assets/dist/img/avatar04.png" class="user-image" alt="User Image">
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
					<li class="header">HEADER</li>
					<!-- Optionally, you can add icons to the links -->
					<li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>
					<li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
					<li class="treeview">
						<a href="#"><i class="fa fa-link"></i> <span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li><a href="#">Link in level 2</a></li>
							<li><a href="#">Link in level 2</a></li>
						</ul>
					</li>
				</ul>
				<!-- /.sidebar-menu -->
			</section>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">

			<!-- Main content -->
			<section class="content">
				<?php 
				for ($i=1; $i < 50; $i++) { 
					echo 'Perocbaan '.$i.'<br>';
				}
				?>
				<!-- Your Page Content Here -->

			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<!-- Main Footer -->
		<footer class="main-footer">
			<!-- To the right -->
			<div class="pull-right hidden-xs">
				Nama Aplikasi Versi 1.0
			</div>
			<!-- Default to the left -->
			<strong>Copyright &copy; 2016 <a href="#">Nama Usaha</a>.</strong> All rights reserved.
		</footer>
</div>
<script src="<?php echo BASE_URL; ?>/assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/dist/js/app.min.js"></script>
</body>
</html>