<?php
if (!defined('nsi')) { exit(); }

if(isset($_POST['submit'])) {
	include LIB_DIR . '/upload_img/class.upload.php';
	$handle = new upload($_FILES['avatar_img'], 'id_ID');
	if ($handle->uploaded) {
		$handle->file_new_name_body	= $_SESSION['uname'];
		$handle->image_resize			= true;
		$handle->image_x 					= 200;
		$handle->image_y 					= 200;
		$handle->image_ratio 			= true;
		//$handle->image_ratio_crop 		= true;
		$handle->image_ratio_fill 		= true;
		$handle->image_default_color 	= '#000000';
		$handle->file_max_size 			= human2byte('1MB');
		$handle->allowed 					= array('image/*');
		$handle->image_convert 			= 'jpg';
		$handle->file_overwrite 		= true;
		$handle->process(ROOT_DIR . '/uploads/users/');
		if ($handle->processed) {
			set_notif('upload_ok', $handle->file_src_name.' uploaded');
			$handle->clean();
		} else {
			set_notif('upload_error', $handle->error);
		}
	} else {
		set_notif('upload_error', 'silahkan pilih gambar');
	}
	redirect('?m=profile');
}
set_web('judul', 'Profile ' . $_SESSION['uname']);
view_layout('v_atas.php');
$notif_error = get_notif('upload_error');
if($notif_error) {
	echo '
			<div class="alert alert-danger alert-dismissible">
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				<h4><i class="icon fa fa-ban"></i> Error!</h4>
		';
	echo $notif_error;
	echo '</div>';
}
$notif_ok = get_notif('upload_ok');
if($notif_ok) {
	echo '
			<div class="alert alert-success alert-dismissible">
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				<h4><i class="icon fa fa-thumbs-o-up"></i> Berhasil!</h4>
		';
	echo $notif_ok;
	echo '<br>Catatan: Refresh, jika gambar masih belum berubah.';
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
		<form enctype="multipart/form-data" method="POST">
			<div class="form-group">
			<label for="avatar_img">Avatar Image:</label>
				<input type="file" id="avatar_img" name="avatar_img">
				<p class="help-block">Max file size 1MB</p>
			</div>		
			<input type="submit" name="submit" value="Ubah Avatar" class="btn btn-primary"></input>
		</form>
	</div>
</div>


<?php
view_layout('v_bawah1.php');
view_layout('v_bawah2.php');