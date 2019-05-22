<?php
if (!defined('nsi')) { exit(); }

if(isset($_GET['ajax'])) {
	$offset = isset($_POST['offset']) ? $_POST['offset'] : 0;
	$limit = isset($_POST['limit']) ? $_POST['limit'] : 10;
	$search = isset($_POST['search']) ? $_POST['search'] : '';
	
	$where = '';
	$order_by = '';

	if(!empty($search)) {
		$where = " AND (nama_priode LIKE '%".$search."%' OR tgl_mulai LIKE '%".$search."%' OR tgl_akhir LIKE '%".$search."%')";
	}
	$sql_limit = " LIMIT ".$offset.",".$limit." ";
	if ( isset($_POST['sort']) && isset($_POST['order']) ) {
		$order_by = " ORDER BY ".$_POST['sort']." ".$_POST['order']." ";
	}
	$sql_tampil = "SELECT id, nama_priode, tgl_mulai, tgl_akhir, aktif FROM m_set_priode WHERE 1=1 ".$where." ".$order_by." ".$sql_limit."";
	$data_list = $db->select($sql_tampil);
	$sql_total = "SELECT id FROM m_set_priode WHERE 1=1 ".$where." ";
	$query_total = $db->query($sql_total);
	$total = $query_total->num_rows();

	$data_list_i = array();
	foreach ($data_list as $key => $val) {

		$data_list_i[$key] = $val;
	}

	$out = array('rows' => $data_list_i, 'total' => $total);
	header('Content-Type: application/json');
	echo json_encode($out);
	exit();
}

if(isset($_GET['hapus'])) {
	$id = $_POST['id'];
	$hapus = $db->delete('m_set_priode', $id);
	if($hapus) {
		echo 'OK';
	}
	exit();
}

set_web('judul', 'Data Periode');
load_script('table');
load_script('modal');

view_layout('v_atas.php');
?>

<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Data Periode</h3>
				<div class="box-tools pull-right">
					<button data-widget ="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
				</div><!-- /.box-tools -->
			</div><!-- /.box-header -->
			<div class="box-body">
				<?php if(get_notif('simpan_ok')) { ?>
					<div class="alert alert-success alert-dismissable fade in">
						<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
						<h4><i class="fa fa-check-circle"></i> OK</h4>
						<p>
							 Sip, data telah ditambahkan.
						</p>
					</div>
				<?php } ?>
				<?php if(get_notif('ubah_ok')) { ?>
					<div class="alert alert-success alert-dismissable fade in">
						<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
						<h4><i class="fa fa-check-circle"></i> OK</h4>
						<p>
							 Sip, data telah diubah.
						</p>
					</div>
				<?php } ?>				
				<?php if(get_notif('data_tidak_ada')) { ?>
					<div class="alert alert-warning alert-dismissable fade in">
						<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
						<h4><i class="fa fa-warning"></i> Error!</h4>
						<p>
							 Data tidak ada.
						</p>
					</div>
				<?php } ?>



				<div id="toolbar" class="">
					<a href="<?php echo site_url('?m=periode&c=tambah'); ?>" class="btn btn-flat btn-success">
						<i class="glyphicon glyphicon-plus"></i> Tambah Data
					</a>
				</div>

				<table 
					id="tablegrid"
					data-toggle="table" 
					data-id-field="id"
					data-url="<?php echo site_url('?m=periode&ajax=1'); ?>" 
					data-sort-name="nama_priode"
					data-sort-order="asc"
					data-pagination="true"
					data-toolbar="#toolbar"
					data-side-pagination="server"
					data-page-list="[5, 10, 15, 20, 25, 50, 100]"
					data-page-size="10"
					data-smart-display="false"
					data-select-item-name="tbl_terpilih"
					data-striped="true"
					data-search="true"
					data-show-refresh="true"
					data-show-columns="true"
					data-show-toggle="true"
					data-method="post"
					data-content-type="application/x-www-form-urlencoded"
					data-cache="false" >
					<thead>
						<tr>
							<th data-field="id" data-switchable="false" data-visible="false">ID</th>
							<th data-field="nama_priode" data-sortable="true" data-valign="middle">Nama Periode</th>
							<th data-field="tgl_mulai" data-sortable="true" data-valign="middle">Tanggal Mulai</th>
							<th data-field="tgl_akhir" data-sortable="true" data-valign="middle">Tanggal Akhir</th>
							<th data-field="aktif" data-sortable="true" data-align="center" data-halign="center" data-valign="middle">Aktif</th>
							<th data-field="aksi" data-formatter="aksi_ft" data-sortable="false" data-align="center" data-halign="center" data-valign="middle">Aksi</th>
						</tr>
					</thead>
				</table>

			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>
</div>


<!-- Modal -->
<div id="modal_hapus" class="modal fade" data-backdrop="static" role="dialog" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Konfirmasi Hapus Data</h4>
	</div>
	<div class="modal-body">
		<p class="modal_hasil">
			Apakah Yakin Ingin Hapus Data?
		</p>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" id="link_konfirmasi_batal" data-dismiss="modal">Batal</button>
		<a href="javascript:void(0)" class="btn btn-danger" id="link_konfirmasi_hapus">HAPUS</a>
	</div>
</div>

<?php view_layout('v_bawah1.php'); ?>

<script type="text/javascript">

	var $table = $('#tablegrid');

	$(function() {

		$table.on('click', '.hapus_trigger', function(event) {
			$('#link_konfirmasi_hapus').show();
			$('#link_konfirmasi_batal').text('Batal');
			$('.modal_hasil').text('Apakah Yakin Ingin Hapus Data?');
			//alert('a');
			$('#modal_hapus').modal('show');
			var id_hapus = $(this).data('data_id');
			//alert('ID = ' + url_hapus);
			$('#link_konfirmasi_hapus').data('data_id', id_hapus);
			//alert('a');
			/* Act on the event */
		});


		$('#link_konfirmasi_hapus').click(function(event) {
			var id_hapus = $(this).data('data_id');
			//var id_hapus = 0;
			$.ajax({
				url: '<?php echo site_url('?m=periode&hapus=1'); ?>',
				type: 'POST',
				dataType: 'html',
				data: {id: id_hapus},
			})
			.done(function(data) {
				if(data == 'OK') {
					$('.modal_hasil').html('ID: ' + id_hapus + ' Terhapus');
					$('#link_konfirmasi_hapus').hide('slow');
					$('#link_konfirmasi_batal').text('Tutup');
					//$("#grid-basic").bootgrid("reload");
					$table.bootstrapTable('refresh');
				} else {
					$('.modal_hasil').html('Gagal, silahkan ulangi kembali.<br>Kemungkinan masih ada data terkait.');
				}
				//$('#modal_hapus').modal('hide');
				//console.log("success");
			})
			.fail(function() {
				alert('Error, Silahkan ulangi');
				//console.log("error");
			});
		});

		$(window).resize(function () {
			$('#tablegrid').bootstrapTable('resetView');
		});
	});


	function aksi_ft(value, row, index) {
		var nsi_out = '<a class="btn btn-flat btn-sm btn-primary" href="<?php echo site_url('?m=periode&c=ubah&id'); ?>=' + row.id + '" title="Ubah"><i class="fa fa-pencil"></i></a>';
		if(row.id >= 1) {
			nsi_out += ' <a class="hapus_trigger btn btn-flat btn-sm btn-danger" href="javascript:void(0)" data-data_id="'+row.id+'" title="Hapus" data-toggle="modal"><i class="fa fa-times"></i></a>';
		}
		return  nsi_out;
	}


</script>
<?php
view_layout('v_bawah2.php');