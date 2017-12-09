<?php session_start();
if (!isset($_SESSION['masuk']))
{
   header('Location:./login.php');
} ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Detail Proyek</title>

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

     <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
            <div class="row">
            <div class="col-lg-12">
              <ol class="breadcrumb">
                <li><i class="fa fa-tasks"></i><a href="tab_project.php">Proyek</a></li>
                <li><i class="fa fa-info"></i>Detail Proyek</a></li>               
              </ol>
            </div>
          </div>
          <div class="row">
                    <div class="col-lg-12">
                      <header class="panel-heading" align="center">
                                    PROYEK<br>
                      </header>
                      <section class="panel">
                            <table class="table table-hover table-striped table-bordered">
                             <tbody>
                               <?php                           
                                  $no_proyek = $_GET['id'];
                                  require_once('config.php');
                                  $db = new mysqli($db_host, $db_username, $db_password, $db_database);
                                  if ($db->connect_errno){
                                    die ("Could not connect to the database: <br />". $db->connect_error);
                                  }

                                  //===========================keterangan proyek=================================================
                                  //Asign a query
                                  $query = " SELECT proyek.no_proyek,
                                          proyek.nama_proyek,
                                          perusahaan.nama_perusahaan,
                                          proyek.lokasi,
                                          proyek.sumberdana,
                                          proyek.kab,
                                          proyek.prov,
                                          proyek.tanggal
                                          from proyek left JOIN perusahaan on proyek.kode_perusahaan = perusahaan.kode_perusahaan WHERE no_proyek='".$no_proyek."'";
                                  // Execute the query
                                  $result = $db->query( $query );
                                  if (!$result){
                                     die ("Could not query the database: <br />". $db->error);
                                  }
                                  while ($row = $result->fetch_object()){
                                  echo '<div class="col-md-2">Proyek</div><div class="col-md-10">: '.$row->nama_proyek.'</div>';
                                  echo '<div class="col-md-2">Nama Perusahaan</div><div class="col-md-10">: '.$row->nama_perusahaan.'</div>';
                                  echo '<div class="col-md-2">Tanggal</div><div class="col-md-10">: '.$row->tanggal.'</div>';
                                  echo '<div class="col-md-2">Sumber Dana</div><div class="col-md-10">: '.$row->sumberdana.'</div>';
                                  echo '<div class="col-md-2">Lokasi</div><div class="col-md-10">: '.$row->lokasi.'</div>';
                                  echo '<div class="col-md-2">Kabupaten</div><div class="col-md-10">: '.$row->kab.'</div>';
                                  echo '<div class="col-md-2">Provinsi</div><div class="col-md-10">: '.$row->prov.'</div>';
                                  }
                                  echo'<div class="col-lg-10"><br><a class="btn btn-info" href="form_analisis.php?id='.$no_proyek.'" title="Bootstrap 3 themes generator"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Analisis Pekerjaan</a></br>
                                    </div>';

                                  $result->free();
                                  //-----------------------------------tabel analisis pekerjaan-----------------------------------------
                                  echo'<br><tr>
                                           <th>No</th>
                                           <th>Nama Pekerjaan</th>
                                           <th>Proyek</th>
                                           <th>Item Bayar</th>
                                           <th>Satuan Bayar</th>
                                           <th colspan="3">Aksi</th>
                                    </tr>';

                                  $query2 = " SELECT analisis_pekerjaan.no_analisis,
                                  pekerjaan.nama_kerja,
                                  proyek.nama_proyek,
                                  analisis_pekerjaan.item_bayar,
                                  analisis_pekerjaan.satuan_bayar,
                                  proyek.no_proyek
                                  FROM analisis_pekerjaan INNER JOIN proyek ON analisis_pekerjaan.no_proyek = proyek.no_proyek INNER JOIN pekerjaan ON analisis_pekerjaan.kode_kerja = pekerjaan.kode_kerja WHERE proyek.no_proyek='".$no_proyek."'";
                                  // Execute the query
                                  $result2 = $db->query( $query2 );
                                  if (!$result2){
                                     die ("Could not query the database: <br />". $db->error);
                                  }
                                  $no  = 1;
                                  // Fetch and display the results
                                  while ($row = $result2->fetch_object()){
                                      echo '<td>'.$no.'</td> ';
                                      echo '<td>'.$row->nama_kerja.'</td> ';
                                      echo '<td>'.$row->nama_proyek.'</td>';
                                      echo '<td>'.$row->item_bayar.'</td>';
                                      echo '<td>'.$row->satuan_bayar.'</td>';
                                      echo '<td colspan="3">
                                      <a class="btn btn-primary" href="detail_analisis.php?id='.$row->no_analisis.'&idp='.$row->no_proyek.'"><i class="fa fa-info"></i> Detail</a>
                                      <a class="btn btn-warning" href="edit_analisis.php?id='.$row->no_analisis.'&idp='.$row->no_proyek.'" ><i class="fa fa-pencil"></i> Edit</a>
                                      <a class="btn btn-danger" href="del_analisis.php?id='.$row->no_analisis.'&idp='.$row->no_proyek.'"><i class="icon_close_alt2"></i> Hapus</a></td>';
                                      echo '</tr>';
                                    $no++;
                                  }
                                  
                                  echo "<br>";
                                  $result2->free();
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
