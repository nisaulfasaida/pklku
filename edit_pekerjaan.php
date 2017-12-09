<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['masuk']))
{
   header('Location:./login.php');
}

$kode_kerja = $_GET['id'];

$error_kodekerja = '';
$error_namakerja = '';


//connect database
require_once('config.php');
$db = new mysqli($db_host, $db_username, $db_password, $db_database);
if ($db->connect_errno){
	die ("Could not connect to the database: <br />". $db->connect_error);
}

if (!isset($_POST["submit"])){
	$query = " SELECT * FROM pekerjaan WHERE kode_kerja='".$kode_kerja."'";
	// Execute the query
	$result = $db->query( $query );
	if (!$result){
		die ("Could not query the database: <br />". $db->connect_error);
	}else{
		while ($row = $result->fetch_object()){
			$kode_kerja = $row->kode_kerja;
			$nama_kerja = $row->nama_kerja;
		}
	}
	}else{
	$nama_kerja = test_input($_POST['nama_kerja']);
	if ($nama_kerja == ''){
		$error_namakerja = "Nama kerja is required";
		$valid_namakerja = FALSE;
	}else{
		$valid_namakerja = TRUE;
	}
	$kode_kerja = $_POST['kode_kerja'];
	if ($kode_kerja == '' || $kode_kerja == 'none'){
		$error_kodekerja = "kode is required";
		$valid_kodekerja = FALSE;
	}else{
		$valid_kodekerja = TRUE;
	}

	
	//update data into database
	if ( $valid_namakerja && $valid_kodekerja){
		//escape inputs data
		
		$nama_kerja = $db->real_escape_string($nama_kerja);
		$kode_kerja = $db->real_escape_string($kode_kerja);
	
		//Asign a query
		$query = " UPDATE pekerjaan SET  nama_kerja='".$nama_kerja."', kode_kerja='".$kode_kerja."'";
		// Execute the query
		$result = $db->query( $query );
		if (!$result){
		   die ("Could not query the database: <br />". $db->error);
		}else{
			echo "<script>alert('Data has been updated!<br>')</script>";
			echo "<script>window.open('tab_pekerjaan.php','_self')</script>";
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
	
    <title>Add Bahan Baku</title>

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
                <li><i class="icon_documents_alt"></i><a href="tab_pekerjaan.php">Jenis Pekerjaan</a></li>
                <li><i class="fa fa-pencil"></i>Edit Tenaga Kerja</a></li>
          </ol>
				</div>
			</div>
              <!-- Form validations -->              
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Form Bahan Baku
                          </header>
                          <div class="panel-body">
                              <div class="form">
								<form method='POST' autocomplete='on' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Nama Bahan Baku</label>
                                      <div class="col-sm-10">
                                          <input name='nama_kerja' type="text" class="form-control" value='<?php echo $nama_kerja?>' required/>
										  <span class="error">* <?php echo $error_namakerja;?></span>
                                      </div>
									</div>
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Kode Bahan Baku</label>
                                      <div class="col-sm-10">
                                          <input name='kode_kerja' type="text" class="form-control" value='<?php echo $kode_kerja?>' required/>
										  <span class="error">* <?php echo $error_kodekerja;?></span>
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
