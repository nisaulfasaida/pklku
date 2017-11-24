<!DOCTYPE html>
<?php
$kode_barang = $_GET['id'];

$error_kodebarang = '';
$error_namabarang = '';
$error_satuan = '';
$error_hargak = '';
$error_hargaahs = '';

//connect database
require_once('config.php');
$db = new mysqli($db_host, $db_username, $db_password, $db_database);
if ($db->connect_errno){
	die ("Could not connect to the database: <br />". $db->connect_error);
}

if (!isset($_POST["submit"])){
	$query = " SELECT * FROM bahan_baku WHERE kode_barang='".$kode_barang."'";
	// Execute the query
	$result = $db->query( $query );
	if (!$result){
		die ("Could not query the database: <br />". $db->connect_error);
	}else{
		while ($row = $result->fetch_object()){
			$kode_barang = $row->kode_barang;
			$nama_barang = $row->nama_barang;
			$satuan = $row->satuan;
			$harga_k = $row->harga_k;
			$harga_ahs = $row->harga_ahs;
		}
	}
	}else{
	$nama_barang = test_input($_POST['nama_barang']);
	if ($nama_barang == ''){
		$error_namabarang = "Nama Barang is required";
		$valid_namabarang = FALSE;
	}else{
		$valid_namabarang = TRUE;
	}
	$kode_barang = $_POST['kode_barang'];
	if ($kode_barang == '' || $kode_barang == 'none'){
		$error_kodebarang = "kode is required";
		$valid_kodebarang = FALSE;
	}else{
		$valid_kodebarang = TRUE;
	}
	$satuan = test_input($_POST['satuan']);
	if ($satuan == ''){
		$error_satuan = "satuan is required";
		$valid_satuan = FALSE;
	}else{
		$valid_satuan = TRUE;
	}
	$harga_k = test_input($_POST['harga_k']);
	if ($harga_k == ''){
		$error_hargak = "Harga is required";
		$valid_hargak = FALSE;
	}else{
		$valid_hargak = TRUE;
	}
	$harga_ahs = test_input($_POST['harga_ahs']);
	if ($harga_ahs == ''){
		$error_hargaahs = "harga is required";
			$valid_hargaahs = FALSE;
	}else{
		$valid_hargaahs = TRUE;
	}

	
	//update data into database
	if ( $valid_namabarang && $valid_kodebarang && $valid_satuan && $valid_hargak && $valid_hargaahs){
		//escape inputs data
		
		$nama_barang = $db->real_escape_string($nama_barang);
		$kode_barang = $db->real_escape_string($kode_barang);
		$satuan = $db->real_escape_string($satuan);
		$harga_k = $db->real_escape_string($harga_k);
		$harga_ahs = $db->real_escape_string($harga_ahs);
		
		//Asign a query
		$query = " UPDATE bahan_baku SET  nama_barang='".$nama_barang."', kode_barang='".$kode_barang."', satuan='".$satuan."', harga_k='".$harga_k."', harga_ahs='".$harga_ahs."' WHERE kode_barang='".$kode_barang."'";
		// Execute the query
		$result = $db->query( $query );
		if (!$result){
		   die ("Could not query the database: <br />". $db->error);
		}else{
			echo "<script>alert('Data has been updated!<br>')</script>";
			echo "<script>window.open('tab_bahan.php','_self')</script>";
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
	                <li><i class="icon_documents_alt"></i><a href="tab_bahan.php">Bahan Baku</a></li>
	                <li><i class="fa fa-pencil"></i>Edit Bahan Baku</a></li>

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
								<form method='POST' autocomplete='on' action="">
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Nama Bahan Baku</label>
                                      <div class="col-sm-10">
                                          <input name='nama_barang' type="text" class="form-control" value='<?php echo $nama_barang?>' required/>
										  <span class="error">* <?php echo $error_namabarang;?></span>
                                      </div>
									</div>
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Kode Bahan Baku</label>
                                      <div class="col-sm-10">
                                          <input name='kode_barang' type="text" class="form-control" value='<?php echo $kode_barang?>' required/>
										  <span class="error">* <?php echo $error_kodebarang;?></span>
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
                                      <label class="col-sm-2 control-label">Harga K</label>
                                      <div class="col-sm-10">
                                          <input name='harga_k' type="text" pattern="(\d{2})([\.])(\d{2})" class="form-control"value='<?php echo $harga_k?>' required />
										  <span class="error">* <?php echo $error_hargak;?></span>
                                      </div>
									</div>
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Harga AHS</label>
                                      <div class="col-sm-10">
                                          <input name='harga_ahs' type="text" class="form-control" pattern="(\d{2})([\.])(\d{2})" value='<?php echo $harga_ahs?>' required />
										  <span class="error">* <?php echo $error_hargaahs;?></span>
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
