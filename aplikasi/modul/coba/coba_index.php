<?php
if (!defined('nsi')) { exit(); }

set_web('judul', 'Coba');
view_layout('v_atas.php');
?>
<div class="row">
	<div class="col-md-6">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Progress Bars Different Sizes</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<p><code>.progress</code></p>

				<div class="progress">
					<div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-primary progress-bar-striped">
						<span class="sr-only">40% Complete (success)</span>
					</div>
				</div>
				<p>Class: <code>.sm</code></p>

				<div class="progress progress-sm active">
					<div style="width: 20%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar" class="progress-bar progress-bar-success progress-bar-striped">
						<span class="sr-only">20% Complete</span>
					</div>
				</div>
				<p>Class: <code>.xs</code></p>

				<div class="progress progress-xs">
					<div style="width: 60%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-warning progress-bar-striped">
						<span class="sr-only">60% Complete (warning)</span>
					</div>
				</div>
				<p>Class: <code>.xxs</code></p>

				<div class="progress progress-xxs">
					<div style="width: 60%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-danger progress-bar-striped">
						<span class="sr-only">60% Complete (warning)</span>
					</div>
				</div>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	<!-- /.col (left) -->
	<div class="col-md-6">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Progress bars</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="progress">
					<div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-green">
						<span class="sr-only">40% Complete (success)</span>
					</div>
				</div>
				<div class="progress">
					<div style="width: 20%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar" class="progress-bar progress-bar-aqua">
						<span class="sr-only">20% Complete</span>
					</div>
				</div>
				<div class="progress">
					<div style="width: 60%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-yellow">
						<span class="sr-only">60% Complete (warning)</span>
					</div>
				</div>
				<div class="progress">
					<div style="width: 80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar progress-bar-red">
						<span class="sr-only">80% Complete</span>
					</div>
				</div>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	<!-- /.col (right) -->
</div>
<?php
view_layout('v_bawah1.php');
view_layout('v_bawah2.php');