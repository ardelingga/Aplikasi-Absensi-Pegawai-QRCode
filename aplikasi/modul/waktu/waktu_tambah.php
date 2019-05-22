<?php
if (!defined('nsi')) { exit(); }

$form_error = array();
if(isset($_POST['submit'])) {
	if(trim($_POST['nama_seting']) == '') {
		$form_error[] = 'Nama Seting harus diisi';
	}
	if(trim($_POST['jam_mulai_abs']) == '') {
		$form_error[] = 'jam mulai harus diisi';
	}
	if(trim($_POST['jam_masuk']) == '') {
		$form_error[] = 'jam masuk harus diisi';
	}
	if(trim($_POST['jam_batas_masuk']) == '') {
		$form_error[] = 'jam batas masuk harus diisi';
	}
	if(trim($_POST['jam_pulang']) == '')  {
		$form_error[] = 'jam pulang harus diisi';
	}
	if(trim($_POST['jam_batas_pulang']) == '') {
		$form_error[] = 'jam batas pulang harus diisi';
	}
	

	if(empty($form_error)) { 
		// insert db
		$data = array(
				'nama_seting' 			=> $_POST['nama_seting'],
				'jam_mulai_abs' 		=> $_POST['jam_mulai_abs'],
				'jam_masuk' 			=> $_POST['jam_masuk'],
				'jam_batas_masuk' 		=> $_POST['jam_batas_masuk'],
				'jam_pulang' 			=> $_POST['jam_pulang'],
				'jam_batas_pulang' 		=> $_POST['jam_batas_pulang']
			);
		$insert = $db->tambah('m_set_waktu', $data);
		if($insert > 0) {
			set_notif('simpan_ok', 1);
			redirect('?m=waktu');
		} else {
			$form_error[] = 'Tidak dapat disimpan dalam database';
		}
	}
}

set_web('judul', 'Set Waktu');
load_script('select2');
load_script('timepicker');
view_layout('v_atas.php');

?>

<div class="row">
	<div class="col-md-12">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Tambah Data Waktu</h3>
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
						<label for="nama_seting">Nama Seting Waktu</label>
						<input type="text" placeholder="Masukkan Nama" id="nama_seting" name="nama_seting" value="<?php echo @$_POST['nama_seting']; ?>" class="form-control">
					</div>


					<div class="bootstrap-timepicker">
						<div class="form-group" style="width: 100px;">
							<label>Jam Mulai Absen</label>
							<div class="input-group">
								<input type="text" name="jam_mulai_abs" value="<?php echo @$_POST['jam_mulai_abs']; ?>" class="form-control timepicker">
								<div class="input-group-addon">
									<i class="fa fa-clock-o"></i>
								</div>
							</div>
						</div>
					</div>


					<div class="bootstrap-timepicker">
						<div class="form-group" style="width: 100px;">
							<label>Jam Masuk</label>
							<div class="input-group">
								<input type="text" name="jam_masuk" value="<?php echo @$_POST['jam_masuk']; ?>" class="form-control timepicker">
								<div class="input-group-addon">
									<i class="fa fa-clock-o"></i>
								</div>
							</div>
						</div>
					</div>


					<div class="bootstrap-timepicker">
						<div class="form-group" style="width: 100px;">
							<label>Jam Batas Masuk</label>
							<div class="input-group">
								<input type="text" name="jam_batas_masuk" value="<?php echo @$_POST['jam_batas_masuk']; ?>" class="form-control timepicker">
								<div class="input-group-addon">
									<i class="fa fa-clock-o"></i>
								</div>
							</div>
						</div>
					</div>


					<div class="bootstrap-timepicker">
						<div class="form-group" style="width: 100px;">
							<label>Jam Pulang</label>
							<div class="input-group">
								<input type="text" name="jam_pulang" value="<?php echo @$_POST['jam_pulang']; ?>" class="form-control timepicker">
								<div class="input-group-addon">
									<i class="fa fa-clock-o"></i>
								</div>
							</div>
						</div>
					</div>


					<div class="bootstrap-timepicker">
						<div class="form-group" style="width: 100px;">
							<label>Jam Batas Pulang</label>
							<div class="input-group">
								<input type="text" name="jam_batas_pulang" value="<?php echo @$_POST['jam_batas_pulang']; ?>" class="form-control timepicker">
								<div class="input-group-addon">
									<i class="fa fa-clock-o"></i>
								</div>
							</div>
						</div>
					</div>
				</div><!-- /.box-body -->
				<div class="box-footer">
					<input type="submit" name="submit" class="btn btn-primary" value="Tambah" />
					<a href="<?php echo site_url('?m=waktu');?>" class="btn btn-default pull-right">Batal</a>
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
		$(".timepicker").timepicker({
			defaultTime: false,
			showInputs: false,
			minuteStep: 5,
			showMeridian: false
		});

	});
</script>
<?php
view_layout('v_bawah2.php');