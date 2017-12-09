<?php
session_start();
if (!isset($_SESSION['masuk']))
{
	 header('Location:./login.php');
}
    include("header.php");
   include("sidebar.php");
    // include("functions.php");

    // $id=$_SESSION['masuk'];

  require_once('config.php');
	$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
    $db = new mysqli($db_host, $db_username, $db_password, $db_database);
    if ($db->connect_errno){
        die ("Could not connect to the database: <br />". $db->connect_error);
    }

      $pesanWelcome='"Selamat Datang "';
      $query1="SELECT count(no_admin) as counter FROM admin";
  

  $result1 = $con->query($query1);
  // $result1 = $con->query($query_pkt_lab);
  $row=$result1->fetch_object();
  $jml_admin=$row->counter;
  //
  $query="SELECT count(kode_perusahaan) as counter FROM perusahaan";
  $result = $con->query($query);
  $row=$result->fetch_object();
  $jml_perusahaan=$row->counter;
  //
  $query="SELECT count(no_proyek) as counter FROM proyek";
  $result = $con->query($query);
  $row=$result->fetch_object();
  $jml_proyek=$row->counter;
  //
  $query="SELECT count(kode_kerja) as counter FROM pekerjaan";
  $result = $con->query($query);
  $row=$result->fetch_object();
  $jml_kerja=$row->counter;
  //
  $query="SELECT count(no_analisis) as counter FROM analisis_pekerjaan";
  $result = $con->query($query);
  $row=$result->fetch_object();
  $jml_ana=$row->counter;
  //
  $query="SELECT count(kode_tenaga) as counter FROM tenaga_kerja";
  $result = $con->query($query);
  $row=$result->fetch_object();
  $jml_tenaga=$row->counter;
  //
  $query="SELECT count(kode_barang) as counter FROM bahan_baku";
  $result = $con->query($query);
  $row=$result->fetch_object();
  $jml_bahan=$row->counter;
  //
  //
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

    <title>Home</title>

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
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
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!--overview start-->
			  <div class="row">
        <div class="col-lg-12">
					<h4 class="page-header" align="center"><b>Aplikasi Perhitungan Rencana Biaya Proyek<br>PT Beton Budi Mulya</b></h4>
				</div>
			</div>

        <div class="row" align="center">
  				<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
  					<div class="info-box blue-bg">
  						<i class="fa fa-building-o"></i>
  						<div class="count"><?php echo $jml_perusahaan ?></div>
              <div class="title">Perusahaan</div>
  					</div><!--/.info-box-->
  				</div><!--/.col-->

  				<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
  					<div class="info-box brown-bg">
  						<i class="fa fa-tasks"></i>
  						<div class="count"><?php echo $jml_proyek ?></div>
              <div class="title">Proyek</div>
  					</div><!--/.info-box-->
  				</div><!--/.col-->

          <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            <div class="info-box green-bg" >
              <i class="fa fa-file-text"></i>
              <div class="count"><?php echo $jml_ana ?></div>
              <div class="title">Analisis Pekerjaan</div>            
            </div><!--/.info-box-->     
          </div><!--/.col-->

          <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            <div class="info-box yellow-bg">
              <i class="fa fa-users"></i>
              <div class="count"><?php echo $jml_tenaga ?></div>
              <div class="title">Tenaga Kerja</div>
            </div><!--/.info-box-->
          </div><!--/.col-->

          <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            <div class="info-box teal-bg">
              <i class="fa fa-cubes"></i>
              <div class="count"><?php echo $jml_bahan ?></div>
              <div class="title">Bahan Baku</div>
            </div><!--/.info-box-->
          </div><!--/.col-->

          <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            <div class="info-box linkedin-bg" >
              <i class="fa fa-cog"></i>
              <div class="count"><?php echo $jml_kerja ?></div>
              <div class="title">Pekerjaan</div>            
            </div><!--/.info-box-->     
          </div><!--/.col-->
			</div><!--/.row-->

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
