<!DOCTYPE html>
<?php
$kode_perusahaan = $_GET['id'];

$error_kodeperusahaan = '';
$error_namaperusahaan = '';
$error_email = '';
$error_cpperusahaan = '';
$error_alamat = '';
$error_kabupaten = '';
$error_provinsi = '';

//connect database
require_once('config.php');
$db = new mysqli($db_host, $db_username, $db_password, $db_database);
if ($db->connect_errno){
	die ("Could not connect to the database: <br />". $db->connect_error);
}

if (!isset($_POST["submit"])){
	$query = " SELECT * FROM perusahaan WHERE kode_perusahaan ='".$kode_perusahaan."'";
	// Execute the query
	$result = $db->query( $query );
	if (!$result){
		die ("Could not query the database: <br />". $db->connect_error);
	}else{
		while ($row = $result->fetch_object()){
			$kode_perusahaan = $row->kode_perusahaan;
			$nama_perusahaan = $row->nama_perusahaan;
			$email = $row->email;
			$cp_perusahaan = $row->cp_perusahaan;
			$alamat = $row->alamat;
			$kabupaten = $row->kabupaten;
			$provinsi = $row->provinsi;
		}
	}
	}else{
	$nama_perusahaan = test_input($_POST['nama_perusahaan']);
	if ($nama_perusahaan == ''){
		$error_namaperusahaan = "Nama Perusahaan is required";
		$valid_namaperusahaan = FALSE;
	}else{
		$valid_namaperusahaan = TRUE;
	}
	$kode_perusahaan = $_POST['kode_perusahaan'];
	if ($kode_perusahaan == '' || $kode_perusahaan == 'none'){
		$error_kodeperusahaan = "kode is required";
		$valid_kodeperusahaan = FALSE;
	}else{
		$valid_kodeperusahaan = TRUE;
	}
	$email = test_input($_POST['email']);
	if ($email == ''){
		$error_email = "Email is required";
		$valid_email = FALSE;
	}else{
		$valid_email = TRUE;
	}
	$cp_perusahaan = test_input($_POST['cp_perusahaan']);
	if ($cp_perusahaan == ''){
		$error_cpperusahaan = "CP is required";
		$valid_cpperusahaan = FALSE;
	}else{
		$valid_cpperusahaan = TRUE;
	}
	$alamat = test_input($_POST['alamat']);
	if ($alamat == ''){
		$error_alamat = "Alamat is required";
			$valid_alamat = FALSE;
	}else{
		$valid_alamat = TRUE;
	}
	$kabupaten = test_input($_POST['kabupaten']);
	if ($kabupaten == ''){
		$error_kabupaten = "Kabupaten is required";
			$valid_kabupaten = FALSE;
	}else{
		$valid_kabupaten = TRUE;
	}
	$provinsi = test_input($_POST['provinsi']);
	if ($provinsi == ''){
		$error_provinsi = "Provinsi is required";
		$valid_provinsi = FALSE;
	}else{
		$valid_provinsi = TRUE;
	}

	
	//update data into database
	if ( $valid_namaperusahaan && $valid_kodeperusahaan && $valid_email && $valid_cpperusahaan && $valid_alamat && $valid_kabupaten && $valid_provinsi){
		//escape inputs data
		
		$nama_perusahaan = $db->real_escape_string($nama_perusahaan);
		$kode_perusahaan = $db->real_escape_string($kode_perusahaan);
		$email = $db->real_escape_string($email);
		$cp_perusahaan = $db->real_escape_string($cp_perusahaan);
		$alamat = $db->real_escape_string($alamat);
		$kabupaten = $db->real_escape_string($kabupaten);
		$provinsi = $db->real_escape_string($provinsi);
		
		//Asign a query
		$query = " UPDATE perusahaan SET  nama_perusahaan='".$nama_perusahaan."', kode_perusahaan='".$kode_perusahaan."', email='".$email."', cp_perusahaan='".$cp_perusahaan."', alamat='".$alamat."', kabupaten='".$kabupaten."', provinsi='".$provinsi."' WHERE kode_perusahaan='".$kode_perusahaan."'";
		// Execute the query
		$result = $db->query( $query );
		if (!$result){
		   die ("Could not query the database: <br />". $db->error);
		}else{
			echo "<script>alert('Data has been updated!<br>')</script>";
			echo "<script>window.open('tab_perusahaan.php','_self')</script>";
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
	
    <title>Edit Perusahaan</title>

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
					<h3 class="page-header"><i class="fa fa-files-o"></i> Form Bahan Baku</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="icon_document_alt"></i>Edit</li>
						<li><i class="fa fa-files-o"></i>Perusahaan</li>
					</ol>
				</div>
			</div>
              <!-- Form validations -->              
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Perusahaan
                          </header>
                          <div class="panel-body">
                              <div class="form">
								<form method='POST' autocomplete='on' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Nama </label>
                                      <div class="col-sm-10">
                                          <input name='nama_perusahaan' type="text" class="form-control" value='<?php echo $nama_perusahaan?>' required/>
										  <span class="error">* <?php echo $error_namaperusahaan;?></span>
                                      </div>
									</div>
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Kode </label>
                                      <div class="col-sm-10">
                                          <input name='kode_perusahaan' type="text" class="form-control" value='<?php echo $kode_perusahaan?>' required/>
										  <span class="error">* <?php echo $error_kodeperusahaan;?></span>
                                      </div>
									</div>
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Contak Person</label>
                                      <div class="col-sm-10">
                                          <input name='cp_perusahaan' type="text" class="form-control" value='<?php echo $cp_perusahaan?>' required/>
										  <span class="error">* <?php echo $error_cpperusahaan;?></span>
                                      </div>
									</div>
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Email</label>
                                      <div class="col-sm-10">
                                          <input name='email' type="text" class="form-control"value='<?php echo $email?>' required />
										  <span class="error">* <?php echo $error_email;?></span>
                                      </div>
									</div>
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Alamat</label>
                                      <div class="col-sm-10">
                                          <input name='alamat' type="text" class="form-control" value='<?php echo $alamat?>' required />
										  <span class="error">* <?php echo $error_alamat;?></span>
                                      </div>
									</div>
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Kabupaten</label>
                                      <div class="col-sm-10">
                                          <input name='kabupaten' type="text" class="form-control" value='<?php echo $kabupaten?>' required />
										  <span class="error">* <?php echo $error_kabupaten;?></span>
                                      </div>
									</div>
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Provinsi</label>
                                      <div class="col-sm-10">
                                          <input name='provinsi' type="text" class="form-control" value='<?php echo $provinsi?>' required />
										  <span class="error">* <?php echo $error_provinsi;?></span>
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
