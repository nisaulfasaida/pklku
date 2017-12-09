<?php 
session_start();
if (!isset($_SESSION['masuk']))
{
   header('Location:./login.php');
}

  $no_analisis = $_GET['id'];
  $no_proyek = $_GET['idp'];
                  require_once('config.php');
                  $db = new mysqli($db_host, $db_username, $db_password, $db_database);
                  if ($db->connect_errno){
                    die ("Could not connect to the database: <br />". $db->connect_error);
                  }
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Detail Analisis Pekerjaan</title>

    <!-- Bootstrap CSS -->    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />    
    <!-- full calendar css-->
    <link href="assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
	<link href="assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
    <!-- easy pie chart-->
    <link href="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <!-- owl carousel -->
    <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
	<link href="css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
    <!-- Custom styles -->
	<link rel="stylesheet" href="css/fullcalendar.css">
	<link href="css/widgets.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
	<link href="css/xcharts.min.css" rel=" stylesheet">	
	<link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet">
  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">
     
      <?php
		include("header.php");
		include("sidebar.php");
	  ?>
      <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
			  <div class="row">
				<div class="col-lg-12">
					<ol class="breadcrumb">
                <li><i class="fa fa-tasks"></i><a href="tab_project.php">Proyek</a></li>
                <li><i class="fa fa-info"></i>Detail Proyek</a></li>
                <li><i class="fa fa-info"></i>Detail Analisis Pekerjaan</a></li> 				  	
					</ol>
				</div>
			</div>
		    <div class="row">
          <section class="panel">
                       <header class="panel-heading tab-bg-primary"> 
                               <ul class="nav nav-tabs"> 
                                   <li class=""> 
                                       <a href="detail_analisis.php?id=<?php echo $no_analisis ?>&idp=<?php echo $no_proyek ?>">Form Standard Analisis</a> 
                                   </li> 
                                   <li class=""> 
                                       <a href="form_analis_tenaga.php?id=<?php echo $no_analisis ?>&idp=<?php echo $no_proyek ?>">Tambah Analisis Tenaga Kerja</a>
                                   </li> 
                                   <li class=""> 
                                       <a href="form_analis_bahan.php?id=<?php echo $no_analisis ?>&idp==<?php echo $no_proyek ?>">Tambah Analisis Bahan Baku</a> 
                                   </li> 
                                   <li class=""> 
                                       <a href="form_alat_berat.php?id=<?php echo $no_analisis ?>&idp=<?php echo $no_proyek ?>">Tambah Analisis Alat Berat</a> 
                                   </li>
                                   <li>
                                       <a target='_blank' href="pdf_analisis.php?id=<?php echo $no_analisis ?>&idp=<?php echo $no_proyek ?>"><i class="fa fa-print" target="_blank"></i>Cetak Standart Analisis</a> 
                                   </li>  
                               </ul> 
                          </header> 
              </section>
            <div class="panel-body">
					  <section class="panel">
                <header class="panel-heading" align="center">
                              FORMULIR STANDAR UNTUK<br>
							  PEREKAMAN ANALISA MASING-MASING HARGA SATUAN 
                
                </header>
      						<?php                           
      						

                  //===========================keterangan proyek=================================================
      						//Asign a query
      						$query = " SELECT *
      								FROM analisis_pekerjaan left JOIN proyek ON analisis_pekerjaan.no_proyek = proyek.no_proyek left JOIN pekerjaan ON analisis_pekerjaan.kode_kerja = pekerjaan.kode_kerja WHERE analisis_pekerjaan.no_analisis='".$no_analisis."'";
      						// Execute the query
      						$result = $db->query( $query );
      						if (!$result){
      						   die ("Could not query the database: <br />". $db->error);
      						}
      						while ($row = $result->fetch_object()){
      						echo '<div class="col-md-2">PROYEK</div><div class="col-md-10">: '.$row->nama_proyek.'</div>';
      						echo '<div class="col-md-2">PROP/KAB/KODYA</div><div class="col-md-10">: '.$row->prov.'/'.$row->kab.'</div>';
      						echo '<div class="col-md-2">ITEM PEMBAYARAN NO.</div><div class="col-md-10">: '.$row->item_bayar.'</div>';
      						echo '<div class="col-md-2">JENIS PEKERJAAN</div><div class="col-md-10">: '.$row->nama_kerja.'</div>';
      						echo '<div class="col-md-2">SATUAN PEMBAYARAN</div><div class="col-md-10">: '.$row->satuan_bayar.'</div>';
      						}
                  //==================================tabel===============================
                  echo'
                <table class="table table-hover table-striped table-bordered">';
      						echo '<tbody>';		
                       echo'<tr>';
                       echo'<th rowspan="2">NO.</th>';
      								 echo'<th rowspan="2">KOMPONEN</th>';
      								 echo'<th rowspan="2">SATUAN</th>';
      								 echo'<th>PERKIRAAN</th>';
      								 echo'<th>HARGA</th>';
      								 echo'<th>JUMLAH</th>';
      								 echo'<th colspan="2">Aksi</th>';
      							  echo'</tr>';
      							  echo'<tr>';
      								echo'<th>KUALITAS</th>';
      								echo'<th>SATUAN(Rp.)</th>';
      								echo'<th>HARGA(Rp.)</th>';
      							  echo'</tr>';
                  //============tenaga kerja==========================================
                  echo'<tr>';
                  echo'<th colspan="7">A. Tenaga Kerja </th>';
                  echo'</tr>';
                  //Asign a query
                  $query2 = " SELECT
                            analisis_tenaga_kerja.no_analisis_tenaga,
                            tenaga_kerja.nama_tenaga,
                            tenaga_kerja.satuan,
                            analisis_tenaga_kerja.perkiraan,
                            tenaga_kerja.harga_satuan,
                            analisis_tenaga_kerja.no_analisis_tenaga, analisis_pekerjaan.no_analisis,
                            analisis_pekerjaan.no_proyek
                      FROM analisis_tenaga_kerja left JOIN analisis_pekerjaan ON analisis_tenaga_kerja.no_analisis = analisis_pekerjaan.no_analisis left JOIN tenaga_kerja ON analisis_tenaga_kerja.kode_tenaga = tenaga_kerja.kode_tenaga WHERE analisis_tenaga_kerja.no_analisis =$no_analisis";
                  // Execute the query
                  $result2 = $db->query( $query2 );
                  if (!$result2){
                     die ("Could not query the database: <br />". $db->error);
                  }
                  echo'<br><br>';
                  $no  = 1;
                  $jumlahtenaga = 0;
                  // Fetch and display the results
                  while ($row = $result2->fetch_object()){
                      echo '<tr>';
                      echo '<td>'.$no.'</td> ';
                      echo '<td>'.$row->nama_tenaga.'</td> ';
                      echo '<td>'.$row->satuan.'</td>';
                      echo '<td align="right">'.number_format($row->perkiraan,2,",",".").'</td>';
                      echo '<td align="right">'.number_format($row->harga_satuan,2,",",".").'</td>';
                      echo '<td align="right">'.number_format($row->harga_satuan*$row->perkiraan,2,",",".").'</td>';
                      echo '<td colspan="2">
                      <a class="btn btn-warning" href="edit_analisis_tenaga.php?id='.$row->no_analisis_tenaga.'&ids='.$row->no_analisis.'&idp='.$row->no_proyek.'" ><i class="fa fa-pencil"></i> Edit</a>
                      <a class="btn btn-danger" href="del_analisis_tenaga.php?id='.$row->no_analisis_tenaga.'&ids='.$row->no_analisis.'&idp='.$row->no_proyek.'"><i class="icon_close_alt2"></i> Hapus</a></td>';
                      echo '</tr>';
                      $jumlahtenaga = $jumlahtenaga + ($row->harga_satuan*$row->perkiraan);
                    $no++;
                  }

                  //============Bahan Baku==========================================
                  echo'<th colspan="7">B. Bahan Baku </th>';
                  //Asign a query
                  $query3 = " SELECT
                            analisis_bahan.no_analisis_bahan,
                            bahan_baku.nama_barang,
                            bahan_baku.satuan,
                            analisis_bahan.perkiraan,
                            bahan_baku.harga_k,
                            analisis_bahan.no_analisis_bahan, analisis_pekerjaan.no_analisis,
                            analisis_pekerjaan.no_proyek
                      FROM analisis_bahan left JOIN analisis_pekerjaan ON analisis_bahan.no_analisis = analisis_pekerjaan.no_analisis left JOIN bahan_baku ON analisis_bahan.kode_barang = bahan_baku.kode_barang WHERE analisis_bahan.no_analisis =$no_analisis";
                  // Execute the query
                  $result3 = $db->query( $query3 );
                  if (!$result3){
                     die ("Could not query the database: <br />". $db->error);
                  }
                  echo'<br><br>';
                  $no  = 1;
                  $jumlahbahan = 0;
                  // Fetch and display the results
                  while ($row = $result3->fetch_object()){
                      echo '<tr>';
                      echo '<td>'.$no.'</td> ';
                      echo '<td>'.$row->nama_barang.'</td> ';
                      echo '<td>'.$row->satuan.'</td>';
                      echo '<td align="right">'.number_format($row->perkiraan,2,",",".").'</td>';
                      echo '<td align="right">'.number_format($row->harga_k,2,",",".").'</td>';
                      echo '<td align="right">'.number_format($row->harga_k*$row->perkiraan,2,",",".").'</td>';
                      echo '<td colspan="3">
                      <a class="btn btn-warning" href="edit_analisis_bahan.php?id='.$row->no_analisis_bahan.'&ids='.$row->no_analisis.'&idp='.$row->no_proyek.'" ><i class="fa fa-pencil"></i> Edit</a>
                      <a class="btn btn-danger" href="del_analisis_bahan.php?id='.$row->no_analisis_bahan.'&ids='.$row->no_analisis.'&idp='.$row->no_proyek.'"><i class="icon_close_alt2"></i> Hapus</a></td>';
                      echo '</tr>';
                      $jumlahbahan = $jumlahbahan + ($row->harga_k*$row->perkiraan);
                    $no++;
                  }
                  //============Alat Berat==========================================
                   echo '<tr>';
                  echo'<th colspan="7">C. Alat Berat</th>';
                  echo "</tr>";
                  //Asign a query
                  $query4 = " SELECT
                            alat_berat.no_alat_berat, alat_berat.nama_alat_berat, alat_berat.unit, alat_berat.harga_satuan, analisis_pekerjaan.no_analisis, analisis_pekerjaan.no_proyek
                      FROM alat_berat left JOIN analisis_pekerjaan ON alat_berat.no_analisis = analisis_pekerjaan.no_analisis WHERE alat_berat.no_analisis =$no_analisis";
                  // Execute the query
                  $result4 = $db->query( $query4 );
                  if (!$result4){
                     die ("Could not query the database: <br />". $db->error);
                  }
                  echo'<br><br>';
                  $no  = 1;
                  $jumlahalat = 0;
                  // Fetch and display the results
                  while ($row = $result4->fetch_object()){
                      echo '<tr>';
                      echo '<td>'.$no.'</td> ';
                      echo '<td>'.$row->nama_alat_berat.'</td> ';
                      echo '<td>-</td>';
                      echo '<td align="right">'.number_format($row->unit,2,",",".").'</td>';
                      echo '<td align="right">'.number_format($row->harga_satuan,2,",",".").'</td>';
                      echo '<td align="right">'.number_format($row->harga_satuan*$row->unit,2,",",".").'</td>';
                      echo '<td colspan="2">
                      <a class="btn btn-warning" href="edit_alat_berat.php?id='.$row->no_alat_berat.'&ids='.$row->no_analisis.'&idp='.$row->no_proyek.'" ><i class="fa fa-pencil"></i> Edit</a>
                      <a class="btn btn-danger" href="del_alat_berat.php?id='.$row->no_alat_berat.'&ids='.$row->no_analisis.'&idp='.$row->no_proyek.'"><i class="icon_close_alt2"></i> Hapus</a></td>';
                      echo '</tr>';
                      $jumlahalat = $jumlahalat + ($row->harga_satuan*$row->unit);
                    $no++;
                  }
                  $total = $jumlahalat+$jumlahbahan+$jumlahtenaga;
                  $pajak = $total/10;
                  $hargapsar = $total-$pajak;
                  echo'<tr>';
                      echo'<td colspan="5">D. Jumlah Perekaman Analisis Harga           (A+B+C)</td>';
                      echo'<td align="right">'.number_format($total,2,",",".").'</td>';
                  echo'</tr>';
                  echo'<tr>';
                      echo'<td colspan="5">E. Pajak 10%                                 (D x 10%)</td>';
                      echo'<td align="right">'.number_format($pajak,2,",",".").'</td>';
                  echo'</tr>';
                  echo'<tr>';
                      echo'<td colspan="5">F. Harga Pemasaran                            (D-F)</td>';
                      echo'<td align="right">'.number_format($hargapsar,2,",",".").'</td>';
                  echo'</tr>';
                  $result->free();
      						$result2->free();
                  $result3->free();
                  $result4->free();
      						$db->close();							
                      ?>
						   </tbody>
				         </table>
                      </section>
                  </div>
              </div>

          </section>
      </section>
      <!--main content end-->
  </section>
  <!-- container section start -->

    <!-- javascripts -->
    <script src="js/jquery.js"></script>
	<script src="js/jquery-ui-1.10.4.min.js"></script>
    <script src="js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
    <!-- bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <!-- charts scripts -->
    <script src="assets/jquery-knob/js/jquery.knob.js"></script>
    <script src="js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="js/owl.carousel.js" ></script>
    <!-- jQuery full calendar -->
    <<script src="js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
	<script src="assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
    <!--script for this page only-->
    <script src="js/calendar-custom.js"></script>
	<script src="js/jquery.rateit.min.js"></script>
    <!-- custom select -->
    <script src="js/jquery.customSelect.min.js" ></script>
	<script src="assets/chart-master/Chart.js"></script>
   
    <!--custome script for all page-->
    <script src="js/scripts.js"></script>
    <!-- custom script for this page-->
    <script src="js/sparkline-chart.js"></script>
    <script src="js/easy-pie-chart.js"></script>
	<script src="js/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="js/jquery-jvectormap-world-mill-en.js"></script>
	<script src="js/xcharts.min.js"></script>
	<script src="js/jquery.autosize.min.js"></script>
	<script src="js/jquery.placeholder.min.js"></script>
	<script src="js/gdp-data.js"></script>	
	<script src="js/morris.min.js"></script>
	<script src="js/sparklines.js"></script>	
	<script src="js/charts.js"></script>
	<script src="js/jquery.slimscroll.min.js"></script>
  <script>

      //knob
      $(function() {
        $(".knob").knob({
          'draw' : function () { 
            $(this.i).val(this.cv + '%')
          }
        })
      });

      //carousel
      $(document).ready(function() {
          $("#owl-slider").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });
	  
	  /* ---------- Map ---------- */
	$(function(){
	  $('#map').vectorMap({
	    map: 'world_mill_en',
	    series: {
	      regions: [{
	        values: gdpData,
	        scale: ['#000', '#000'],
	        normalizeFunction: 'polynomial'
	      }]
	    },
		backgroundColor: '#eef3f7',
	    onLabelShow: function(e, el, code){
	      el.html(el.html()+' (GDP - '+gdpData[code]+')');
	    }
	  });
	});

  </script>

  </body>
</html>
