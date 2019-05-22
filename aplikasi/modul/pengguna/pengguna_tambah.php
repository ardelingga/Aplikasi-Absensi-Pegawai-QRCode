<?php
if (!defined('nsi')) { exit(); }

$form_error = array();
if(isset($_POST['submit'])) {
	if(trim($_POST['nama']) == '') {
		$form_error[] = 'Nama harus diisi';
	}
	if(trim($_POST['uname']) == '') {
		$form_error[] = 'Username harus diisi';
	}
	if(trim($_POST['upass']) == '') {
		$form_error[] = 'Password harus diisi';
	}

	if(empty($form_error)) {
		// insert db
		$data = array(
				'nama' 		=> $_POST['nama'],
				'uname' 		=> $_POST['uname'],
				'upass' 		=> md5($_POST['upass']),
				'level' 		=> $_POST['level'],
				'aktif' 		=> $_POST['aktif']
			);
		$format = array('%s', '%s', '%s', '%s', '%s');
		$insert = $db->insert('data_pengguna', $data, $format);
		if($insert > 0) {
			set_notif('simpan_ok', 1);
			redirect('?m=pengguna');
		} else {
			$form_error[] = 'Tidak dapat disimpan dalam database';
		}
	}
}

set_web('judul', 'Tambah Data Pengguna');
load_script('select2');
view_layout('v_atas.php');

?>

<div class="row">
	<div class="col-md-12">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Tambah Data Pengguna</h3>
				<div class="box-tools pull-right">
					<button data-widget ="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
				</div><!-- /.box-tools -->
			</div><!-- /.box-header -->

			<form method="POST">
				<div class="box-body">
					<?php if($form_error) { ?>
						<div id="alert-simpan" class="alert alert-danger alert-dismissable fade in">
							<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
							<h4><i class="fa fa-warning"></i> Error, Data tidak dapat disimpan.</h4>
							<?php 
								foreach ($form_error as $val) {
									echo '<p>'.$val.'</p>';
								} 
							?>
						</div>					
					<?php } ?>


					<div class="form-group">
						<label for="nama">Nama</label>
						<input type="text" placeholder="Masukkan Nama" id="nama" name="nama" class="form-control">
					</div>

					<div class="form-group">
						<label for="uname">Username</label>
						<input type="text" placeholder="Masukkan Username" id="uname" name="uname" class="form-control">
					</div>

					<div class="form-group">
						<label for="upass">Password</label>
						<input type="password" placeholder="" id="upass" name="upass" class="form-control">
					</div>

					<div class="form-group">
						<label>Level</label>
						<br />
						<select id="level" name="level" class="form-control select2" style="width: 100px;">
							<option value="operator">Operator</option>
							<option value="admin">Admin</option>
						</select>
					</div>

					<div class="form-group">
						<label>Aktif</label>
						<br />
						<select id="aktif" name="aktif" class="form-control select2" style="width: 70px;">
							<option value="Y">Ya</option>
							<option value="T">Tidak</option>
						</select>
					</div>


				</div><!-- /.box-body -->
				<div class="box-footer">
					<input type="submit" name="submit" class="btn btn-primary" value="Tambah" />
					<a href="<?php echo site_url('?m=pengguna');?>" class="btn btn-default pull-right">Batal</a>
				</div>
			</form>

		</div><!-- /.box -->
	</div>
</div>



<?php view_layout('v_bawah1.php'); ?>

<script type="text/javascript">
	$(function() {
		$('#nama').focus();
		$('.select2').select2();
	});
</script>
<?php
view_layout('v_bawah2.php');