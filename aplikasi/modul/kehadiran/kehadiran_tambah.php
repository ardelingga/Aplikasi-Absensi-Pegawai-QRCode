<?php
if (!defined('nsi')) { exit(); }

$form_error = array();
if(isset($_POST['submit'])) {
	if(trim($_POST['waktu']) == '') {
		$form_error[] = 'Waktu harus diisi';
	}
	if(trim($_POST['id_personal']) == '') {
		$form_error[] = 'Personal harus di Pilih'; 
	}

	if(empty($form_error)) {
		// cek data
		$sql_a = "	SELECT m_set_waktu.* FROM m_personal 
					LEFT JOIN m_departemen ON m_departemen.id = m_personal.id_departemen
					LEFT JOIN tabel_set_abs ON tabel_set_abs.id_departemen = m_personal.id_departemen
					LEFT JOIN m_set_priode ON m_set_priode.id = tabel_set_abs.id_priode
					LEFT JOIN m_set_waktu ON m_set_waktu.id = tabel_set_abs.id_waktu
					WHERE m_set_priode.aktif = 'y' AND m_personal.id = '".$_POST['id_personal']."'
					";
		$data_a = $db->select_one($sql_a);

		//var_dump($data_a);
		//var_dump($_POST['waktu']);
		$wkt_input = (int) str_replace(':', '', substr($_POST['waktu'], 11, 5));
		//echo $wkt_input;

		$tipe = 'error';
		$telat = 0;
		$row_jam_mulai_abs = (int) str_replace(':', '', substr($data_a->jam_mulai_abs, 0, 5));
		$row_jam_masuk = (int) str_replace(':', '', substr($data_a->jam_masuk, 0, 5));
		$row_jam_pulang = (int) str_replace(':', '', substr($data_a->jam_pulang, 0, 5));
		$row_jam_batas_pulang = (int) str_replace(':', '', substr($data_a->jam_batas_pulang, 0, 5));
		$row_jam_batas_masuk = (int) str_replace(':', '', substr($data_a->jam_batas_masuk, 0, 5));
		// Absen Masuk
		if($wkt_input >= $row_jam_mulai_abs && $wkt_input <= $row_jam_batas_masuk) {
			$tipe = 'masuk';
			if($wkt_input > $row_jam_masuk) {
				$telat = $wkt_input - $row_jam_masuk;
				//echo '<br>';
				//echo str_replace(':', '', $wkt_input);
				//echo '-';
				//echo str_replace(':', '', $data_a->jam_masuk);
			}
		}

		// Absen Pulang
		if($wkt_input >= $row_jam_pulang && $wkt_input <= $row_jam_batas_pulang) {
			$tipe = 'pulang';
		}
		if($tipe != 'error') {

			// insert db
			$data = array(
				'waktu' 			=> $_POST['waktu'],
				'id_personal' 		=> $_POST['id_personal'],
				'ket' 				=> $_POST['ket'],
				'tipe'				=> $tipe,
				'telat_menit'	    => $telat
				);
			$insert = $db->tambah('data_kehadiran', $data);
			if($insert > 0) {
				set_notif('simpan_ok', 1);
				redirect('?m=kehadiran');
			} else {
				$form_error[] = 'Tidak dapat disimpan dalam database';
			}
		} else {
			$form_error[] = 'Waktu tidak sesuai.';
		}
	}
}

set_web('judul', 'Tambah Data Kehadiran');
load_script('select2');
load_script('date_time_picker');
view_layout('v_atas.php');

$sql_personal = "SELECT id, nama FROM m_personal ORDER BY nama ";
$data_personal = $db->select($sql_personal);

//var_dump($data_dept);

?>

<div class="row">
	<div class="col-md-12">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Tambah Data Kehadiran</h3>
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
						<label>Waktu</label>

						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
							<input type="text" class="form-control dtpicker" id="waktu" name="waktu">
						</div>
						<!-- /.input group -->
					</div>	
					<div class="form-group">
						<label for="id_personal">Personal</label>
						<br>
						<select name="id_personal" class="form-control select2" style="width: 200px;">
							<option value="">Silahkan Pilih</option>
							<?php 
							foreach ($data_personal as $row_personal) {
								echo '<option value="'.$row_personal->id.'">'.$row_personal->nama.'</option>';
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="ket">Keterangan</label>
						<input type="text" placeholder="Masukan Keterangan" id="ket" name="ket" class="form-control">
					</div>
				</div>
				<div class="box-footer">
					<input type="submit" name="submit" class="btn btn-primary" value="Tambah" />
					<a href="<?php echo site_url('?m=kehadiran');?>" class="btn btn-default pull-right">Batal</a>
				</div>
			</form>
		</div>
	</div>
</div>

<?php view_layout('v_bawah1.php'); ?>

<script type="text/javascript">
$(function() {
	$('.select2').select2();
	$(".dtpicker").datetimepicker({
		language:  'id',
		weekStart: 1,
		autoclose: true,
		todayBtn: true,
		todayHighlight: true,
		minuteStep: 1,
		pickerPosition: 'bottom-right',
		format: "yyyy-mm-dd hh:ii"
	});
});

</script>
<?php
view_layout('v_bawah2.php');