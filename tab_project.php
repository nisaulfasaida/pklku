<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Proyek</title>

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
    					</ol>
    				</div>
    			</div>
  		    <div class="row">
                    <div class="col-sm-12">
                    	<div class="col-lg-6">
                        <a class="btn btn-info" href="form_proyek.php" title="Bootstrap 3 themes generator"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Proyek</a>
                    	</div>
                    	<div class="col-lg-6">
                        <form>
						    <input type="text" id="myInput" onkeyup="myFunction()" size="30" align="right" placeholder="Search by title here..."/>
						    <input class="button" type="button" value="Search">		
						</form>
                    	</div>
  					  <br></br>
  					    <section class="panel">
                            <header class="panel-heading">
                                Table Proyek
                            </header>
                            <table class="table table-condensed table-hover" id="myTable">
                             <tbody>
                                <tr>
                                   <th>No</th>
  								 <th>Nama Proyek</th>
  								 <th>Nama Perusahaan</th>
  								 <th>Tanggal</th>
  								 <th>Sumber Dana</th>
  								 <th>Lokasi Proyek</th>
  								 <th>Kabupaten</th>
  								 <th>Provinsi</th>
  								 <th colspan="3">Aksi</th>
                                </tr>
  							  
  						<?php

  						require_once('config.php');
  						$db = new mysqli($db_host, $db_username, $db_password, $db_database);
  						if ($db->connect_errno){
  							die ("Could not connect to the database: <br />". $db->connect_error);
  						}
  						//Asign a query
  						$query = " SELECT proyek.no_proyek,
                            proyek.nama_proyek,
                            perusahaan.nama_perusahaan,
                            proyek.lokasi,
                            proyek.sumberdana,
                            proyek.kab,
                            proyek.prov,
                            proyek.tanggal
                            from proyek left JOIN perusahaan on proyek.kode_perusahaan = perusahaan.kode_perusahaan";
  						// Execute the query
  						$result = $db->query( $query );
  						if (!$result){
  						   die ("Could not query the database: <br />". $db->error);
  						}
  						$no  = 1;
  						// Fetch and display the results
  						while ($row = $result->fetch_object()){
  								echo "<tr><td>".$no."</td>";
  								echo '<td>'.$row->nama_proyek.'</td> ';
  								echo '<td>'.$row->nama_perusahaan.'</td> ';
                  echo '<td>'.$row->tanggal.'</td>';
                  echo '<td>'.$row->sumberdana.'</td>';
  								echo '<td>'.$row->lokasi.'</td>';
  								echo '<td>'.$row->kab.'</td>';
  								echo '<td>'.$row->prov.'</td>';
  								echo '<td colspan="3">
  									<a class="btn btn-primary" href="detail_proyek.php?id='.$row->no_proyek.'"><i class="fa fa-info"></i> Detail</a>
  									<a class="btn btn-warning" href="edit_proyek.php?id='.$row->no_proyek.'" ><i class="fa fa-pencil"></i> Edit</a>
  									<a class="btn btn-danger" onclick="javascript:confirmationDelete($(this));return false;" href="del_proyek.php?id='.$row->no_proyek.'"><i class="icon_close_alt2"></i> Hapus</a></td>';

  								echo '</tr>';
  							$no++;
  						}
  						echo 'Total Proyek = '.$result->num_rows; //num_rows= untuk menghitung baris pada tabel, fungsi bawaan
  						echo "<br>";
  						echo "<br>";
  						$result->free();
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

		function confirmationDelete(anchor)
		{
		   var conf = confirm('Anda yakin akan menghapus data ini?');
		   if(conf)
		      window.location=anchor.attr("href");
		}


		function myFunction() {
		  // Declare variables 
		  var input, filter, table, tr, td, i, j, s;
		  input = document.getElementById("myInput");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("myTable");
		  tr = table.getElementsByTagName("tr");

		  	for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[3];
			if (td) {
			  if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
				tr[i].style.display = "";
			  } else {
				tr[i].style.display = "none";
			  }
			} 
		  }
		}

  </script>

  </body>
</html>
