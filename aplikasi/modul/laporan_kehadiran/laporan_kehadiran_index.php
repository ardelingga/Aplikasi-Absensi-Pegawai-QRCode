<?php
if (!defined('nsi')) { exit(); }

set_web('judul', 'Laporan Kehadiran');
load_script('datepicker');
view_layout('v_atas.php');

echo '<style>';
echo '
	#cetakArea {
		font-size: 9pt;
	}
';
echo '</style>';


//$bulan = '11';
//$tahun = '2017';

if(isset($_GET['fil_bulan'])) {
	$fil_bulan_arr = explode('-', $_GET['fil_bulan']);
	$tahun = $fil_bulan_arr[0];
	$bulan = $fil_bulan_arr[1];
} else {
	//$bulan_txt = date("F");
	$bulan = date("m");
	$tahun = date("Y");	
}

$tgl = date_create($tahun.'-'.$bulan.'-01');
$bulan_txt = date_format($tgl, "F");

$fil_bulan = $tahun.'-'.$bulan;

$sql_member = "SELECT m_personal.nama, m_personal.id FROM m_personal WHERE 1=1 ORDER BY nama";
$hasil_member = $db->select($sql_member);
$tgl_akhir = date("t");

$sql_absen = "SELECT * FROM data_kehadiran WHERE YEAR(waktu) = '".$tahun."' AND MONTH(waktu) = '".$bulan."' ";
$hasil_absen = $db->select($sql_absen);

$hasil_arr = array();
foreach ($hasil_absen as $row) {
	$tgl = (int) substr($row->waktu, 8, 2);
	$hasil_arr[$row->id_personal][$tgl][$row->tipe] = array(
		'telat'	=> $row->telat_menit
		//'waktu'	=> $row->waktu
	);
}

//var_dump($hasil_arr);
?>
<div class="row">
	<div class="col-md-12">
		<div style="text-align: right;"> Pilih Bulan dan Tahun 
			<input type="text" placeholder="" id="fil_bulan" name="fil_bulan" class="form-control datepicker" style="width: 65px; display: inline;" value="<?php echo $fil_bulan; ?>">
		</div>
		<br>
		<div class="box box-solid" id="cetakArea">
			<div class="box-header with-border" align="center">
				<h3 class="box-title" style="padding : 10px 0px 15px 0px;"> Laporan Kehadiran Bulan <?php echo $bulan_txt." ".$tahun;  ?> </h3>
	
			<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-bordered table-condensed table-striped table-responsive">
							<thead align="center">
								<tr align="center">
									<th> No </th>
									<th> Nama </th>
								<?php 
									for ($i=1; $i <= $tgl_akhir; $i++) { 
										echo "<th>".$i."</th>";
									}
								?>
									<th <?php echo "<td nowrap align = center>"; ?> Jml Hadir </th>
									<th <?php echo "<td nowrap align = center>"; ?> Jml Tdk Hadir </th>
									<th <?php echo "<td nowrap align = center>"; ?>   Jml Telat </th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 1;
									foreach ($hasil_member as $row) {
										$jml_hadir = 0;
										$jml_telat = 0;
										$jml_telat_menit = 0;
										$ok = '<i class="fa fa-check-circle text-green"></i>';

										echo "<tr>";
										echo "	<td nowrap align = center>".$no."</td>";
										echo "	<td nowrap>".$row->nama."</td>";
										$tipe = '';
										$telat = '';

										for ($i=1; $i <= $tgl_akhir; $i++) {
											$txt = '';
											$masuk = @$hasil_arr[$row->id][$i]['masuk'];
											$pulang = @$hasil_arr[$row->id][$i]['pulang'];
											$telat_menit = @$hasil_arr[$row->id][$i]['masuk']['telat'];
											if($masuk && $pulang) {
												$jml_hadir++;
												if($telat_menit > 0) {
													$jml_telat++;
													$jml_telat_menit += $telat_menit;
													$txt = '<i class="fa fa-check-circle text-orange" title="Telat = '.$telat_menit.' Menit"></i>';
												} else {
													$txt = $ok;
												}
											}
											if($masuk && !$pulang) {
												$txt = '<i class="fa fa-close text-green" title="Telat = '.$telat_menit.' Menit"></i>';
											}
											if(!$masuk && !$pulang) {
												$txt = '<i class="fa fa-close text-red" title="Telat = '.$telat_menit.' Menit"></i>';
											}
											echo "	<td nowrap align = center>".$txt."</td>";
										}
										echo '	<td nowrap align = center>'.$jml_hadir.'</td>';
										echo '	<td nowrap align = center>'.($tgl_akhir - $jml_hadir).'</td>';
										echo "	<td nowrap align = center><span title=\"".$jml_telat." Kali\n(".$jml_telat_menit." Menit)\">".$jml_telat_menit." Menit </span></td>";

										echo "</tr>";
										$no++;
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- /.box-body -->
		</div>
		<div align="center">
			<input type="button" class="btn btn-primary" onclick="printDiv('cetakArea')" value="Cetak" />
		</div>
		<!-- /.box -->
	</div>
	<!-- /.col (left) -->
	
	<!-- /.col (right) -->
</div>
<?php
view_layout('v_bawah1.php');
?>

<script type="text/javascript">
	$(function() {
		$('#fil_bulan').datepicker({
			language: 'id',
			weekStart: 1,
			autoclose: true,
			format: 'yyyy-mm',
			todayHighlight: true,
			clearBtn: false,
			todayBtn: false,
			minViewMode: 1
		});
		$('#fil_bulan').change(function() {
			var fil_bulan = $('#fil_bulan').val();
			window.location.href = '?m=laporan_kehadiran&fil_bulan=' + fil_bulan;
		});
	});
	function printDiv(divName) {
		var printContents = document.getElementById(divName).innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;
	}
</script>

<?php
view_layout('v_bawah2.php');