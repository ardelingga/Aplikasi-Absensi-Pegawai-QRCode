<?php
if (!defined('nsi')) { exit(); }

$id = $_GET['id'];

$query = "SELECT * FROM `tabel_set_abs` WHERE `id` = '".$id."' ";
$row = $db->select_one($query);
if(!$row) {
	set_notif('data_tidak_ada', 1);
	redirect('?m=absen');
}

$form_error = array();
if(isset($_POST['submit'])) {
	$data_arr = array();
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
		// update db
		$data = array(
				'nama_set_abs' 					=> $_POST['nama_set_abs'],
				'id_departemen' 				=> $_POST['id_departemen'],
				'id_waktu' 						=> $_POST['id_waktu'],
				'id_priode' 					=> $_POST['id_priode']
				
			);
		$format = array('%s', '%s', '%s', '%s');
		if(trim($_POST['upass']) != '') {
			$data['upass']	= md5($_POST['upass']);
			$format[] = '%s';
		}

		$where = array('id' => $id);
		$where_format = array('%d');
		$update = $db->Ubah('tabel_set_abs', $data, $where);
		if($update) {
			set_notif('ubah_ok', 1);
			redirect('?m=absen');
		} else {
			$form_error[] = 'Tidak dapat disimpan dalam database';
		}
	}
}

$web['judul'] = 'Ubah absensi';
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
				<h3 class="box-title">Ubah absensi</h3>
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
						<input type="text" placeholder="Masukkan Nama" id="nama_set_abs" name="nama_set_abs" value="<?php echo $row->nama_set_abs;?>" class="form-control">
					</div>
					<div class="form-group">
						<label for="id_departemen">Departemen</label>
						<br>
						<select name="id_departemen" value="<?php echo $row->id_departemen;?>" class="form-control select2" style="width: 200px;">
							<option value="">Silahkan Pilih</option>
							<?php 
								foreach ($data_departemen as $row_departemen) {
									$selected = '';
									if($row->id_departemen == $row_departemen->id) {
										$selected = 'selected="selected"';
									} else {
										$selected = '';
									}
									echo '<option value="'.$row_departemen->id.'" '.$selected.'>'.$row_departemen->nama_departemen.'</option>';
								}
							?>
						</select>
					</div>
							<div class="form-group">
						<label for="id_waktu">Waktu</label>
						<br>
						<select name="id_waktu" value="<?php echo $row->id_waktu;?>" class="form-control select2" style="width: 200px;">
							<option value="">Silahkan Pilih</option>
							<?php 
								foreach ($data_waktu as $row_waktu) {
									$selected = '';
									if($row->id_waktu == $row_waktu->id) {
										$selected = 'selected="selected"';
									} else {
										$selected = '';
									}
									echo '<option value="'.$row_waktu->id.'" '.$selected.'>'.$row_waktu->nama_seting.'</option>';
								}
							?>
						</select>
					</div>
							<div class="form-group">
						<label for="id_priode">Periode</label>
						<br>
						<select name="id_priode" value="<?php echo $row->id_priode;?>" class="form-control select2" style="width: 200px;">
							<option value="">Silahkan Pilih</option>
							<?php 
								foreach ($data_priode as $row_priode) {
									$selected = '';
									if($row->id_priode == $row_priode->id) {
										$selected = 'selected="selected"';
									} else {
										$selected = '';
									}
									echo '<option value="'.$row_priode->id.'" '.$selected.'>'.$row_priode->nama_priode.'</option>';
								}
							?>
						</select>
					</div>


				</div><!-- /.box-body -->
				<div class="box-footer">
					<input type="submit" name="submit" class="btn btn-primary" value="Ubah" />
					<a href="<?php echo site_url('?m=absen');?>" class="btn btn-default pull-right">Batal</a>
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