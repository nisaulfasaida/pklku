<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['masuk']))
{
   header('Location:./login.php');
}

$no_proyek = $_GET['id'];

$error_nama_proyek = '';
$error_kode_perusahaan = '';
$error_lokasi = '';
$error_sumberdana = '';
$error_kab = '';
$error_prov = '';
$error_tanggal = '';

//connect database
require_once('config.php');
$db = new mysqli($db_host, $db_username, $db_password, $db_database);
if ($db->connect_errno){
	die ("Could not connect to the database: <br />". $db->connect_error);
}

if (!isset($_POST["submit"])){
	$query = " SELECT * FROM proyek WHERE no_proyek='".$no_proyek."'";
	// Execute the query
	$result = $db->query( $query );
	if (!$result){
		die ("Could not query the database: <br />". $db->connect_error);
	}else{
		while ($row = $result->fetch_object()){
			$nama_proyek = $row->nama_proyek;
      $kode_perusahaan = $row->kode_perusahaan;
      $lokasi = $row->lokasi;
      $sumberdana = $row->sumberdana;
      $kab = $row->kab;
      $prov = $row->prov;
      $tanggal = $row->tanggal;

		}
	}
	}else{
	$nama_proyek =test_input($_POST['nama_proyek']);
	if ($nama_proyek == '' || $nama_proyek == 'none'){
		$error_nama_proyek = "Nama Proyek harus diisi";
		$valid_nama_proyek = FALSE;
	}else{
		$valid_nama_proyek = TRUE;
	}
    $kode_perusahaan = test_input($_POST['kode_perusahaan']);
  if ($kode_perusahaan == ''){
    $error_kode_perusahaan = "Kode perusahaan kerja harus diisi";
    $valid_kode_perusahaan = FALSE;
  }else{
    $valid_kode_perusahaan = TRUE;
  } $lokasi = test_input($_POST['lokasi']);
  if ($lokasi == ''){
    $error_lokasi = "lokasi harus diisi";
    $valid_lokasi = FALSE;
  }else{
    $valid_lokasi = TRUE;
  } $sumberdana = test_input($_POST['sumberdana']);
  if ($sumberdana == ''){
    $error_sumberdana = "sumberdana harus diisi";
    $valid_sumberdana = FALSE;
  }else{
    $valid_sumberdana = TRUE;
  } $kab = test_input($_POST['kab']);
  if ($kab == ''){
    $error_kab = "Kabupaten harus diisi";
    $valid_kab = FALSE;
  }else{
    $valid_kab = TRUE;
  } $prov = test_input($_POST['prov']);
  if ($prov == ''){
    $error_prov = "Provinsi harus diisi";
    $valid_prov = FALSE;
  }else{
    $valid_prov = TRUE;
  } $tanggal = test_input($_POST['tanggal']);
  if ($tanggal == ''){
    $error_tanggal = "Tanggal harus diisi";
    $valid_tanggal = FALSE;
  }else{
    $valid_tanggal = TRUE;
  }

	
	//update data into database
	if ($valid_nama_proyek && $valid_kode_perusahaan && $valid_lokasi  && $valid_sumberdana  && $valid_kab  && $valid_prov  && $valid_tanggal){
		//escape inputs data
		
		$nama_proyek = $db->real_escape_string($nama_proyek);
    $kode_perusahaan = $db->real_escape_string($kode_perusahaan);
    $lokasi = $db->real_escape_string($lokasi);
    $sumberdana = $db->real_escape_string($sumberdana);
    $kab = $db->real_escape_string($kab);
    $prov = $db->real_escape_string($prov);
    $tanggal = $db->real_escape_string($tanggal);
	
		//Asign a query
		$query = " UPDATE proyek SET nama_proyek='".$nama_proyek."', kode_perusahaan='".$kode_perusahaan."', lokasi='".$lokasi."', sumberdana='".$sumberdana."', kab='".$kab."', prov='".$prov."', kab='".$kab."', tanggal='".$tanggal."' where no_proyek=$no_proyek";
		// Execute the query
		$result = $db->query( $query );
		if (!$result){
		   die ("Could not query the database: <br />". $db->error);
		}else{
			echo "<script>alert('Data has been updated!<br>')</script>";
			echo "<script>window.open('tab_project.php','_self')</script>";
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
	
    <title>Edit Proyek</title>

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
                <li><i class="fa fa-tasks"></i><a href="tab_project.php">Proyek</a></li>
                <li><i class="fa fa-pencil"></i>Edit Proyek</a></li>  
              </ol>
				</div>
			</div>
              <!-- Form validations -->              
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Form Proyeks <?php echo $no_proyek; ?>
                          </header>
                          <div class="panel-body">
                              <div class="form">
								<form method='POST' autocomplete='on' action="">
								
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Nama Proyek</label>
                                      <div class="col-sm-10">
                                          <input name='nama_proyek' type="text" class="form-control" value='<?php echo $nama_proyek?>' required/>
										  <span class="error">* <?php echo $error_nama_proyek;?></span>
                                      </div>
									</div>
                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Kode Perusahaan</label>
                                      <div class="col-sm-10">
                                          <input name='kode_perusahaan' type="text" class="form-control" value='<?php echo $kode_perusahaan?>' required/>
                      <span class="error">* <?php echo $error_kode_perusahaan;?></span>
                                      </div>
                  </div>
                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Lokasi</label>
                                      <div class="col-sm-10">
                                          <input name='lokasi' type="text" class="form-control" value='<?php echo $lokasi?>' required/>
                      <span class="error">* <?php echo $error_lokasi;?></span>
                                      </div>
                  </div>
                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Sumber Dana</label>
                                      <div class="col-sm-10">
                                          <input name='sumberdana' type="text" class="form-control" value='<?php echo $sumberdana?>' required/>
                      <span class="error">* <?php echo $error_sumberdana;?></span>
                                      </div>
                  </div>
                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Kabupaten</label>
                                      <div class="col-sm-10">
                                          <input name='kab' type="text" class="form-control" value='<?php echo $kab?>' required/>
                      <span class="error">* <?php echo $error_kab;?></span>
                                      </div>
                  </div>
                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Provinsi</label>
                                      <div class="col-sm-10">
                                          <input name='prov' type="text" class="form-control" value='<?php echo $prov?>' required/>
                      <span class="error">* <?php echo $error_prov;?></span>
                                      </div>
                  </div>
                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Tanggal</label>
                                      <div class="col-sm-10">
                                          <input name='tanggal' type="date" class="form-control" value='<?php echo $tanggal?>' required/>
                      <span class="error">* <?php echo $error_tanggal;?></span>
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
