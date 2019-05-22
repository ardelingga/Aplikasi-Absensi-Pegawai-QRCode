<?php
if (!defined('nsi')) { exit(); }

$form_error = array();
if(isset($_POST['submit'])) {
	if(trim($_POST['nama']) == '') {
		$form_error[] = 'Nama harus diisi';
	}
	if(trim($_POST['kode_personal']) == '') {
		$form_error[] = 'Kode Personal harus diisi'; 
	}
	if(trim($_POST['alamat']) == '') {
		$form_error[] = 'Alamat harus diisi';
	}
	if(trim($_POST['no_hp']) == '') {
		$form_error[] = 'No Telfon harus diisi';
	}
	if(trim($_POST['id_departemen']) == '') {
		$form_error[] = 'Departemen harus dipilih';
	}
	if(trim($_POST['imei']) == '') {
		$form_error[] = 'Imei harus diisi';
	}

	if(empty($form_error)) {
		// insert db
		$data = array(
				'nama' 			=> $_POST['nama'],
				'kode_personal' => $_POST['kode_personal'],
				'alamat' 		=> $_POST['alamat'],
				'no_hp' 		=> $_POST['no_hp'],
				'id_departemen' => $_POST['id_departemen'],
				'imei' 			=> $_POST['imei'],
				'aktif' 		=> $_POST['aktif']
			);
		$insert = $db->tambah('m_personal', $data);
		if($insert > 0) {
			set_notif('simpan_ok', 1);
			redirect('?m=personal');
		} else {
			$form_error[] = 'Tidak dapat disimpan dalam database';
		}
	}
}

set_web('judul', 'Tambah Data Personal');
load_script('select2');
view_layout('v_atas.php');

$sql_dept = "SELECT id, nama_departemen FROM m_departemen WHERE aktif='y' ORDER BY nama_departemen ";
$data_dept = $db->select($sql_dept);

//var_dump($data_dept);

?>

<div class="row">
	<div class="col-md-12">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Tambah Data Personal</h3>
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
						<label for="kode_personal">Kode Personal</label>
						<input type="text" placeholder="Masukkan Kode Personal" id="kode_personal" name="kode_personal" class="form-control">
					</div>

					<div class="form-group">
						<label for="alamat">Alamat</label>
						<input type="text" placeholder="Masukan Alamat" id="alamat" name="alamat" class="form-control">
					</div>
						<div class="form-group">
						<label for="no_hp">No Telfon</label>
						<input type="text" placeholder="Masukkan No Telfon" id="no_hp" name="no_hp" class="form-control">
					</div>
						<div class="form-group">
						<label for="id_departemen">Departemen</label>
						<br>
						<select name="id_departemen" class="form-control select2" style="width: 200px;">
							<option value="">Silahkan Pilih</option>
							<?php 
								foreach ($data_dept as $row_dept) {
									echo '<option value="'.$row_dept->id.'">'.$row_dept->nama_departemen.'</option>';
								}
							?>
						</select>
					</div>
						<div class="form-group">
						<label for="imei">Imei</label>
						<input type="text" placeholder="Masukkan Imei" id="imei" name="imei" class="form-control">
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
					<a href="<?php echo site_url('?m=personal');?>" class="btn btn-default pull-right">Batal</a>
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