			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<!-- Main Footer -->
		<footer class="main-footer">
			<!-- To the right -->
			<div class="pull-right hidden-xs">
				<?php echo $web['nama_aplikasi'].' Versi '.$web['versi']; ?>
			</div>
			<!-- Default to the left -->
			<strong>Copyright &copy; 2017 <a href="#">Nusansifor</a>.</strong> All rights reserved.
		</footer>
</div>
<script src="<?php echo BASE_URL; ?>/assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/dist/js/app.min.js"></script>

<?php 
if(isset($web['script_js'])) {
	foreach ($web['script_js'] as $val) {
		echo '<script src="'.BASE_URL.'/assets/'.$val.'"></script>';
	}
}