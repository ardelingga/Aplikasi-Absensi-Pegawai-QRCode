<?php
if (!defined('nsi')) { exit(); }

if(isset($_POST['submit'])) {
	if($_POST['pass_lama'] == '') {
		$form_error[] = 'Password lama harus diisi';
	}
	if($_POST['pass_baru'] == '') {
		$form_error[] = 'Password baru harus diisi';
	}
	if($_POST['pass_baru2'] == '') {
		$form_error[] = 'Password baru (ulangi) harus diisi';
	}
	if($_POST['pass_baru'] != $_POST['pass_baru2']) {
		$form_error[] = 'Password baru tidak sama';
	}

	$query = "SELECT * FROM `data_pengguna` WHERE `uname` = '".$_SESSION['uname']."' ";
	$row = $db->select_one($query);
	if(!$row) {
		redirect('?m=login');
	}
	if(md5($_POST['pass_lama']) != $row->upass) {
		$form_error[] = 'Password lama salah';
	}

	if(empty($form_error)) {
		// update db
		$data = array(
				'upass' 		=> md5($_POST['pass_baru'])
			);
		$format = array('%s');
		$where = array('uname' => $_SESSION['uname']);
		$where_format = array('%s');
		$update = $db->update('data_pengguna', $data, $format, $where, $where_format);
		if($update) {
			set_notif('ubah_pass_ok', 1);
			redirect('?m=profile&c=ubah-pass');
		} else {
			$form_error[] = 'Tidak dapat disimpan dalam database';
		}
	}
}
set_web('judul', 'Ubah Password ' . $_SESSION['uname']);
view_layout('v_atas.php');

if(!empty($form_error)) {
	echo '
			<div class="alert alert-danger alert-dismissible">
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				<h4><i class="icon fa fa-ban"></i> Error!</h4>
		';
	foreach ($form_error as $val) {
		echo '<p>'.$val.'</p>';
	}
	echo '</div>';
}
$ubah_pass_ok = get_notif('ubah_pass_ok');
if($ubah_pass_ok) {
	echo '
			<div class="alert alert-success alert-dismissible">
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				<h4><i class="icon fa fa-thumbs-o-up"></i> Berhasil!</h4>
		';
	echo 'Password sudah diubah.';
	echo '</div>';
}
?>

<div class="box box-widget widget-user-2">
	<!-- Add the bg color to the header using any of the bg-* classes -->
	<div class="widget-user-header bg-blue">
		<div class="widget-user-image">
			<img alt="User Avatar" src="<?php echo get_img_avatar();?>" class="img-circle">
		</div>
		<!-- /.widget-user-image -->
		<h3 class="widget-user-username"><?php echo $_SESSION['uname'];?></h3>
		<h5 class="widget-user-desc"><?php echo $_SESSION['level'];?></h5>
	</div>
	<div class="box-footer">
		<form method="POST">
			<div class="form-group">
				<label for="pass_lama">Password Lama:</label>
				<input type="password" id="pass_lama" name="pass_lama" class="form-control">
			</div>
			<div class="form-group">
				<label for="pass_baru">Password Baru:</label>
				<input type="password" id="pass_baru" name="pass_baru" class="form-control">
			</div>
			<div class="form-group">
				<label for="pass_baru2">Password Baru (ulangi):</label>
				<input type="password" id="pass_baru2" name="pass_baru2" class="form-control">
			</div>
			<input type="submit" name="submit" value="Ubah Password" class="btn btn-primary"></input>
		</form>
	</div>
</div>


<?php
view_layout('v_bawah1.php');
?>
<script type="text/javascript">
	$(function() {
		$('#pass_lama').focus();
	});
</script>
<?php
view_layout('v_bawah2.php');