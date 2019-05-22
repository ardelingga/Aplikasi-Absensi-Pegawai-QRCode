<?php
if (!defined('nsi')) { exit(); } 

$form_error = array();
if(isset($_POST['submit'])) {
	if(trim($_POST['nama_set_abs']) == '') {
		$form_error[] = 'Nama Set Absen harus diisi';
	}
	if(trim($_POST['id_departemen']) == '') {
		$form_error[] = 'Departemen harus diisi';
	}
	if(trim($_POST['id_waktu']) == '') {
		$form_error[] = 'Waktu harus diisi';
	}
	if(trim($_POST['id_priode']) == '') {
		$form_error[] = 'Periode harus diisi';
	}

	if(empty($form_error)) {
		// insert db
		$data = array(
				'nama_set_abs' 					=> $_POST['nama_set_abs'],
				'id_departemen' 				=> $_POST['id_departemen'],
				'id_waktu' 						=> $_POST['id_waktu'],
				'id_priode' 					=> $_POST['id_priode']
				
			);
		$insert = $db->tambah('tabel_set_abs', $data);
		if($insert > 0) {
			set_notif('simpan_ok', 1);
			redirect('?m=absen');
		} else {
			$form_error[] = 'Tidak dapat disimpan dalam database';
		}
	}
}

set_web('judul', 'Tambah Data Absen');
load_script('select2');
view_layout('v_atas.php');

$sql_departemen = "SELECT id, nama_departemen FROM m_departemen WHERE aktif='y' ORDER BY nama_departemen ";
$data_departemen = $db->select($sql_departemen);
$sql_waktu = "SELECT id, nama_seting FROM m_set_waktu ORDER BY nama_seting ";
$data_waktu = $db->select($sql_waktu);
$sql_priode = "SELECT id, nama_priode FROM m_set_priode WHERE aktif='y' ORDER BY nama_priode ";
$data_priode = $db->select($sql_priode);

?>

<div class="row">
	<div class="col-md-12">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Tambah Data Absen</h3>
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
						<label for="nama">Nama Set Absen</label>
						<input type="text" placeholder="Masukkan Nama" id="nama_set_abs" name="nama_set_abs" class="form-control">
					</div>
					<div class="form-group">
						<label for="id_departemen">Departemen</label>
						<br>
						<select name="id_departemen" class="form-control select2" style="width: 200px;">
							<option value="">Silahkan Pilih</option>
							<?php 
								foreach ($data_departemen as $row_departemen) {
									echo '<option value="'.$row_departemen->id.'">'.$row_departemen->nama_departemen.'</option>';
								}
							?>
						</select>
					</div>
							<div class="form-group">
						<label for="id_waktu">Waktu</label>
						<br>
						<select name="id_waktu" class="form-control select2" style="width: 200px;">
							<option value="">Silahkan Pilih</option>
							<?php 
								foreach ($data_waktu as $row_waktu) {
									echo '<option value="'.$row_waktu->id.'">'.$row_waktu->nama_seting.'</option>';
								}
							?>
						</select>
					</div>
							<div class="form-group">
						<label for="id_priode">Periode</label>
						<br>
						<select name="id_priode" class="form-control select2" style="width: 200px;">
							<option value="">Silahkan Pilih</option>
							<?php 
								foreach ($data_priode as $row_priode) {
									echo '<option value="'.$row_priode->id.'">'.$row_priode->nama_priode.'</option>';
								}
							?>
						</select>
					</div>
				
				<div class="box-footer">
					<input type="submit" name="submit" class="btn btn-primary" value="Tambah" />
					<a href="<?php echo site_url('?m=absen');?>" class="btn btn-default pull-right">Batal</a>
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