<?php if ( ! defined('CMS')) exit('Akses Ditolak, Silahkan Gunakan Aplikasi dengan Bijak...');
//error_reporting(0);
?> 

<script src="<?php echo BASE_URL; ?>/template/nsi/highcharts/highcharts.js"></script>

<script>
    var chart1; 
    $(document).ready(function() {
        chart1 = new Highcharts.Chart({
          credits: false,
         chart: {
          renderTo: 'mygraph_jk',
          type: 'column'
         },   
         title: {
          text: 'Pendaftar'
         },
         xAxis: {
          categories: ['Jenis Kelamin']
         },
         yAxis: {
          title: {
             text: 'Jumlah Total '
          }
         },
            series:             
          [
            <?php 
            //include "connection.php";
            $sql   = "SELECT jns_kelamin  FROM m_jns_kelamin ORDER BY id ";
            $query = mysqli_query( $konek, $sql )  or die(mysqli_error());
            while( $temp = mysqli_fetch_array( $query ) )
            {
              $trendbrowser = $temp['jns_kelamin'];
         
              $total   = mysqli_num_rows(mysqli_query($konek, "SELECT  jns_kelamin, tapel_ppdb  from ppdb_data_siswa WHERE jns_kelamin = '".$trendbrowser."' AND tapel_ppdb = '".$tahun_aktif."' ")); 
            ?>
              {
                name: '<?php echo $trendbrowser; ?>',
                data: [<?php echo $total; ?>]
              },
              <?php 
            }   ?>
            ]
        });
       });  
  </script>
<div class="row">
  <div class="col-md-4 col-sm-12">
    <div class="panel panel-success">
        <div class="panel-body">
          <div id ="mygraph_jk"></div>
        </div>
    </div>
  </div>
  <!--- akhir jenis kelamin -->

  <script>
    var chart1; 
    $(document).ready(function() {
        chart1 = new Highcharts.Chart({
         chart: {
          renderTo: 'mygraph_st_skol',
          type: 'column'
         },   
         title: {
          text: 'Status Sekolah'
         },
         xAxis: {
          categories: ['Status Sekolah']
         },
         yAxis: {
          title: {
             text: 'Jumlah Total '
          }
         },
            series:             
          [
            <?php 
            $sql   = "SELECT asal_sekolah  FROM m_asal_sekolah ORDER BY id ";
            $query = mysqli_query( $konek, $sql )  or die(mysqli_error());
            while( $temp = mysqli_fetch_array( $query ) )
            {
              $trendbrowser = $temp['asal_sekolah'];
         
              $total   = mysqli_num_rows(mysqli_query($konek, "SELECT  status_sekolah, tapel_ppdb  from ppdb_data_siswa WHERE status_sekolah = '".$trendbrowser."' AND tapel_ppdb = '".$tahun_aktif."' ")); 
            ?>
              {
                name: '<?php echo $trendbrowser; ?>',
                data: [<?php echo $total; ?>]
              },
              <?php 
            }   ?>
            ]
        });
       });  
  </script>

  <div class="col-md-4 col-sm-12">
    <div class="panel panel-danger">
        <div class="panel-body">
          <div id ="mygraph_st_skol"></div>
        </div>
    </div>
  </div>
  <!--- akhir status sekolah -->

   <script>
    var chart1; 
    $(document).ready(function() {
        chart1 = new Highcharts.Chart({
         chart: {
          renderTo: 'mygraph_jns_skol',
          type: 'column'
         },   
         title: {
          text: 'Jenis Sekolah'
         },
         xAxis: {
          categories: ['Jenis Sekolah']
         },
         yAxis: {
          title: {
             text: 'Jumlah Total '
          }
         },
            series:             
          [
            <?php 
            $sql   = "SELECT jns_sekolah  FROM m_jns_sekolah ORDER BY id ";
            $query = mysqli_query( $konek, $sql )  or die(mysqli_error());
            while( $temp = mysqli_fetch_array( $query ) )
            {
              $trendbrowser = $temp['jns_sekolah'];
         
              $total   = mysqli_num_rows(mysqli_query($konek, "SELECT  jns_sekolah, tapel_ppdb  from ppdb_data_siswa WHERE jns_sekolah = '".$trendbrowser."' AND tapel_ppdb = '".$tahun_aktif."' ")); 
            ?>
              {
                name: '<?php echo $trendbrowser; ?>',
                data: [<?php echo $total; ?>]
              },
              <?php 
            }   ?>
            ]
        });
       });  
  </script>

  <div class="col-md-4 col-sm-12">
    <div class="panel panel-primary">
        <div class="panel-body">
          <div id ="mygraph_jns_skol"></div>
        </div>
    </div>
  </div>
  <!--- akhir status sekolah -->
</div>


  <script>
    var chart; 
    $(document).ready(function() {
        chart = new Highcharts.Chart(
        {
          
         chart: {
          renderTo: 'mygraph_ortu',
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false
         },   
         title: {
          text: 'Pekerjaan Orang Tua '
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
          name: 'Pekerjaan Orang Tua',
          data: [
          <?php
            $query = mysqli_query($konek,"SELECT nm_kerja from m_kerja ORDER BY id");
           
            while ($row = mysqli_fetch_array($query)) {
              $browsername = $row['nm_kerja'];

               $jumlah   = mysqli_num_rows(mysqli_query($konek, "SELECT  kerja_ayah, tapel_ppdb  from ppdb_data_siswa WHERE kerja_ayah = '".$browsername."' AND tapel_ppdb = '".$tahun_aktif."' "));


              ?>
              [ 
                '<?php echo $browsername ?>', <?php echo $jumlah; ?>
              ],
              <?php
            }
            ?>
       
          ]
        }]
        });
    }); 
  </script>
  <div class="row">
  <div class="col-md-12 col-sm-12">
    <div class="panel panel-primary">
        <div class="panel-body">
          <div id ="mygraph_ortu"></div>
        </div>
    </div>
  </div>
  </div>
 