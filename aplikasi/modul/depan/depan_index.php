<?php
if (!defined('nsi')) { exit(); }
set_web('judul', 'Depan');

load_script('highcharts');
view_layout('v_atas.php');

if(get_notif('level_ditolak')) {
	?>
	<div class="alert alert-danger alert-dismissible">
		<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		<h4><i class="icon fa fa-ban"></i> Akses ditolak!</h4>
		Anda tidak berhak.
	</div>
	<?php
}

$warna_arr = array('f56954', '00a65a', 'f39c12', '00c0ef', '3c8dbc', 'd2d6de');

$sql_dept = "	SELECT COUNT(m_personal.id) AS jumlah, m_departemen.nama_departemen AS nama_departemen 
					FROM m_departemen 
					LEFT JOIN m_personal ON m_personal.id_departemen = m_departemen.id
				WHERE m_departemen.aktif='y' GROUP BY m_departemen.id ORDER BY m_departemen.nama_departemen ";
$data_dept = $db->select($sql_dept);

$donut_staff_data = array();
$bar_staff_data = array();
$no = 0;
foreach ($data_dept as $row) {
	$bar_staff_data[] = '
	{
		name: "'.$row->nama_departemen.'",
		data: ['.$row->jumlah.']
	}';

	$donut_staff_data[] = '
		[
			"'.$row->nama_departemen.'", '.$row->jumlah.'
		]';
	$no++;
}
$bar_staff_view = implode(', ', $bar_staff_data);
$donut_staff_view = implode(', ', $donut_staff_data);


?>
<div class="row">
	<div class="col-md-6">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Jumlah Staff - Donut</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div class="box-body">
				<div id="graph_jumlah_staff_donut"></div>				
			</div>
		</div>	
	</div>


	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Jumlah Staff - Bar Chart</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
			</div>
			<div class="box-body">
				<div id="graph_jumlah_staff_barchart"></div>
			</div>
		</div>
	</div>
</div>
<?php
view_layout('v_bawah1.php');
// script js
?>
<script type="text/javascript">
var jumlah_staff_barchart;
var jumlah_staff_donut;
$(document).ready(function() {
	// barchart
	jumlah_staff_barchart = new Highcharts.Chart({
		credits: false,
		chart: {
			renderTo: 'graph_jumlah_staff_barchart',
			type: 'column'
		},   
		title: {
			text: ''
		},
		xAxis: {
			categories: ['Kelompok Staff']
		},
		yAxis: {
			title: {
				text: 'Jumlah Total '
			}
		},
		series:             
		[
			<?php echo $bar_staff_view; ?>
		]
	});

	// donut
	jumlah_staff_donut = new Highcharts.Chart(
	{
		credits: false,
		chart: {
			renderTo: 'graph_jumlah_staff_donut',
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false
		},   
		title: {
			text: ''
		},
		tooltip: {
			formatter: function() {
				return '<b>'+
				this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2) +' % ';
			}
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: false
				},
				showInLegend: true
			}
		},
		series: [{
			type: 'pie',
			name: 'Jumlah Staff',
			data: [
				<?php echo $donut_staff_view; ?>
			]
		}]
	});


});
	


</script>

<?php
view_layout('v_bawah2.php');