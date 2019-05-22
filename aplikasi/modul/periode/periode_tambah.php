<?php
if (!defined('nsi')) { exit(); }

$form_error = array();
if(isset($_POST['submit'])) {
	if(trim($_POST['nama_priode']) == '') {
		$form_error[] = 'Nama priode harus diisi';
	}
		if(trim($_POST['tgl_mulai']) == '') {
		$form_error[] = 'Tanggal Mulai harus diisi';
	}
		if(trim($_POST['tgl_akhir']) == '') {
		$form_error[] = 'Tanggal Akhir harus diisi';
	}

	if(empty($form_error)) {
		// insert db
		$data = array(
				'nama_priode' 			=> $_POST['nama_priode'],
				'tgl_mulai' 			=> $_POST['tgl_mulai'],
				'tgl_akhir' 			=> $_POST['tgl_akhir'],
				'aktif' 				=> $_POST['aktif']
			);
		$insert = $db->tambah('m_set_priode', $data);
		if($insert > 0) {
			set_notif('simpan_ok', 1);
			redirect('?m=priode');
		} else {
			$form_error[] = 'Tidak dapat disimpan dalam database';
		}
	}
}

set_web('judul', 'Tambah Data Periode');
load_script('select2');
load_script('datepicker');
view_layout('v_atas.php');

?>
<div class="row">
	<div class="col-md-12">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Tambah Data Periode</h3>
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
						<label for="nama">Nama Periode</label>
						<input type="text" placeholder="Masukkan Nama priode" id="nama_priode" name="nama_priode" class="form-control">
					</div>

              <div class="form-group">
                <label>Tanggal Mulai</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" placeholder="Masukan Tanggal Mulai" id="tgl_mulai" name="tgl_mulai" class="form-control datepicker" >
                </div>

              <div class="form-group">
                <label>Tanggal Akhir</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" placeholder="Masukan Tanggal Akhir" id="tgl_akhir" name="tgl_akhir" class= "form-control datepicker">
                </div>

					<div class="form-group">
						<label>Aktif</label>
						<br />
						<select id="aktif" name="aktif" class="form-control select2" style="width: 70px;">
							<option value="Y">Ya</option>
							<option value="T">Tidak</option>
						</select>
					</div>


				<div class="box-footer">
					<input type="submit" name="submit" class="btn btn-primary" value="Tambah" />
					<a href="<?php echo site_url('?m=priode');?>" class="btn btn-default pull-right">Batal</a>
				</div>
	
<?php view_layout('v_bawah1.php'); ?>

<script type="text/javascript">
	$(function() {
		$('#nama').focus();
		$('.select2').select2();
		$('.datepicker').datepicker({
			language: 'id',
			weekStart: 1,
			autoclose: true,
			format: 'yyyy-mm-dd',
			todayHighlight: true,
			clearBtn: false,
			todayBtn: false
		});


	});
</script>
<?php
view_layout('v_bawah2.php');