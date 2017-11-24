<!DOCTYPE html>
<?php
$kode_tenaga = $_GET['id'];

$error_kodetenaga = '';
$error_namatenaga = '';
$error_satuan = '';
$error_hargasatuan = '';
$error_keterangan = '';

//connect databasegtt
require_once('config.php');
$db = new mysqli($db_host, $db_username, $db_password, $db_database);
if ($db->connect_errno){
	die ("Could not connect to the database: <br />". $db->connect_error);
}

if (!isset($_POST["submit"])){
	$query = " SELECT * FROM tenaga_kerja WHERE kode_tenaga='".$kode_tenaga."'";
	// Execute the query
	$result = $db->query( $query );
	if (!$result){
		die ("Could not query the database: <br />". $db->connect_error);
	}else{
		while ($row = $result->fetch_object()){
			$kode_tenaga = $row->kode_tenaga;
			$nama_tenaga = $row->nama_tenaga;
			$satuan = $row->satuan;
			$harga_satuan = $row->harga_satuan;
			$keterangan = $row->keterangan;
		}
	}
	}else{
	$nama_tenaga = test_input($_POST['nama_tenaga']);
	if ($nama_tenaga == ''){
		$error_namatenaga = "Description is required";
		$valid_namatenaga = FALSE;
	}else{
		$valid_namatenaga = TRUE;
	}
	$kode_tenaga = $_POST['kode_tenaga'];
	if ($kode_tenaga == '' || $kode_tenaga == 'none'){
		$error_kodetenaga = "kode is required";
		$valid_kodetenaga = FALSE;
	}else{
		$valid_kodetenaga = TRUE;
	}
	$satuan = test_input($_POST['satuan']);
	if ($satuan == ''){
		$error_satuan = "satuan is required";
		$valid_satuan = FALSE;
	}else{
		$valid_satuan = TRUE;
	}
	$harga_satuan = test_input($_POST['harga_satuan']);
	if ($harga_satuan == ''){
		$error_hargasatuan = "Harga is required";
		$valid_hargasatuan = FALSE;
	}else{
		$valid_hargasatuan = TRUE;
	}
	$keterangan = test_input($_POST['keterangan']);
	if ($keterangan == ''){
		$error_keterangan = "Keterangan is required";
			$valid_keterangan = FALSE;
	}else{
		$valid_keterangan = TRUE;
	}

	
	//update data into database
	if ( $valid_namatenaga && $valid_kodetenaga && $valid_satuan && $valid_hargasatuan && $valid_keterangan){
		//escape inputs data
		
		$nama_tenaga = $db->real_escape_string($nama_tenaga);
		$kode_tenaga = $db->real_escape_string($kode_tenaga);
		$satuan = $db->real_escape_string($satuan);
		$harga_satuan = $db->real_escape_string($harga_satuan);
		$keterangan = $db->real_escape_string($keterangan);
		
		//Asign a query
		$query = " UPDATE tenaga_kerja SET  nama_tenaga='".$nama_tenaga."', kode_tenaga='".$kode_tenaga."', satuan='".$satuan."', harga_satuan='".$harga_satuan."', keterangan='".$keterangan."' WHERE kode_tenaga='".$kode_tenaga."'";
		// Execute the query
		$result = $db->query( $query );
		if (!$result){
		   die ("Could not query the database: <br />". $db->error);
		}else{
			echo "<script>alert('Data has been updated!<br>')</script>";
			echo "<script>window.open('tab_tenaga.php','_self')</script>";
			$db->close();
			exit;
		}
		
	}
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">
	
    <title>Edit Tenaga Kerja</title>

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
    <!-- =======================================================
        Theme Name: NiceAdmin
        Theme URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
        Author: BootstrapMade
        Author URL: https://bootstrapmade.com
    ======================================================= -->
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
		  <div class="row">
				<div class="col-lg-12">
					<ol class="breadcrumb">
	                <li><i class="icon_documents_alt"></i>Data</a></li>
	                <li><i class="icon_documents_alt"></i><a href="tab_tenaga.php">Tenaga Kerja</a></li>
	                <li><i class="fa fa-pencil"></i>Edit Tenaga Kerja</a></li>

          		</ol>
				</div>
			</div>
              <!-- Form validations -->              
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Edit Tenaga Kerja
                          </header>
                          <div class="panel-body">
                              <div class="form">
								<form method='POST' autocomplete='on' action="">
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Deskripsi</label>
                                      <div class="col-sm-10">
                                          <input name='nama_tenaga' type="text" class="form-control" value='<?php echo $nama_tenaga?>' required/>
										  <span class="error">* <?php echo $error_namatenaga;?></span>
                                      </div>
									</div>
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Kode Bahan Baku</label>
                                      <div class="col-sm-10">
                                          <input name='kode_tenaga' type="text" class="form-control" value='<?php echo $kode_tenaga?>' required/>
										  <span class="error">* <?php echo $error_kodetenaga;?></span>
                                      </div>
									</div>
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Satuan</label>
                                      <div class="col-sm-10">
                                          <input name='satuan' type="text" class="form-control" value='<?php echo $satuan?>' required/>
										  <span class="error">* <?php echo $error_satuan;?></span>
                                      </div>
									</div>
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Harga Satuan</label>
                                      <div class="col-sm-10">
                                          <input name='harga_satuan' type="text" pattern="(\d{2})([\.])(\d{2})" class="form-control"value='<?php echo $harga_satuan?>' required />
										  <span class="error">* <?php echo $error_hargasatuan;?></span>
                                      </div>
									</div>
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Keterangan</label>
                                      <div class="col-sm-10">
                                          <input name='keterangan' type="text" class="form-control" value='<?php echo $keterangan?>' required />
										  <span class="error">* <?php echo $error_keterangan;?></span>
                                      </div>
									</div>
									<button type='submit' name='submit'>Submit</button><br></br>
												
								</form>
                              </div>

                          </div>
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
    <script src="js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <!-- jquery validate js -->
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>

    <!-- custom form validation script for this page-->
    <script src="js/form-validation-script.js"></script>
    <!--custome script for all page-->
    <script src="js/scripts.js"></script>    

  </body>
</html>
<?php
	$db->close();
?>
