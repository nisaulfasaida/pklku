<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['masuk']))
{
   header('Location:./login.php');
}

$no_analisis = $_GET['id'];
$no_proyek = $_GET['idp'];

$error_pekerjaan = '';
$error_proyek = '';
$error_item_bayar = '';
$error_satuan_bayar = '';

//connect database
require_once('config.php');
$db = new mysqli($db_host, $db_username, $db_password, $db_database);
if ($db->connect_errno){
	die ("Could not connect to the database: <br />". $db->connect_error);
}

if (!isset($_POST["submit"])){
	$query = " SELECT * FROM analisis_pekerjaan WHERE no_analisis='".$no_analisis."'";
	// Execute the query
	$result = $db->query( $query );
	if (!$result){
		die ("Could not query the database: <br />". $db->connect_error);
	}else{
		while ($row = $result->fetch_object()){
			$kode_kerja = $row->kode_kerja;
      $no_proyek = $row->no_proyek;
      $item_bayar = $row->item_bayar;
      $satuan_bayar = $row->satuan_bayar;
		}
	}
	}else{
	$kode_kerja =test_input($_POST['pekerjaan']);
	if ($kode_kerja == '' || $kode_kerja == 'none'){
		$error_pekerjaan = "Jenis Pekerjaan harus diisi";
		$valid_pekerjaan = FALSE;
	}else{
		$valid_pekerjaan = TRUE;
	}
  $no_proyek
   = test_input($_POST['proyek']);
  if ($no_proyek == ''){
    $error_proyek = "Proyek kerja harus diisi";
    $valid_proyek = FALSE;
  }else{
    $valid_proyek = TRUE;
  } $item_bayar = test_input($_POST['itembayar']);
  if ($item_bayar == ''){
    $error_item_bayar = "Item bayar harus diisi";
    $valid_item_bayar = FALSE;
  }else{
    $valid_item_bayar = TRUE;
  } $satuan_bayar = test_input($_POST['satuanbayar']);
  if ($satuan_bayar == ''){
    $error_satuan_bayar = "Satuan bayar harus diisi";
    $valid_satuan_bayar = FALSE;
  }else{
    $valid_satuan_bayar = TRUE;
  }

	
	//update data into database
	if ($valid_proyek && $valid_pekerjaan && $valid_item_bayar  && $valid_satuan_bayar){
		//escape inputs data
		
		$no_proyek = $db->real_escape_string($no_proyek);
    $kode_kerja = $db->real_escape_string($kode_kerja);
    $item_bayar = $db->real_escape_string($item_bayar);
    $satuan_bayar = $db->real_escape_string($satuan_bayar);
		//Asign a query
		$query = " UPDATE analisis_pekerjaan SET no_proyek='".$no_proyek."', kode_kerja='".$kode_kerja."', item_bayar='".$item_bayar."', satuan_bayar='".$satuan_bayar."' where no_analisis=$no_analisis";
    // Execute the query
		$result = $db->query( $query );
		if (!$result){
		   die ("Could not query the database: <br />". $db->error);
		}else{
			echo "<script>alert('Data has been updated!<br>')</script>";
			echo "<script>window.open('detail_proyek.php?id=".$no_proyek."','_self')</script>";
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
	
    <title>Edit Analisis</title>

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
                <li><i class="fa fa-info"></i>Detail Proyek</a></li>
                <li><i class="fa fa-info"></i>Detail Analisis Pekerjaan</a></li> 
                <li><i class="fa fa-pencil"></i>Edit Analisis Pekerjaan</a></li> 

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
                                      <label class="col-sm-2 control-label">Pekerjaan</label>
                                      <div class="col-sm-10">
                                          <select class="form-control m-bot15" id="pekerjaan" name="pekerjaan" required>
                                              <?php
                                                  $querytk = "select * from analisis_pekerjaan left join pekerjaan on pekerjaan.kode_kerja=analisis_pekerjaan.kode_kerja where no_analisis=$no_analisis";
                                                  $resulttk = $db->query($querytk);
                                                  if(!$resulttk){
                                                      die("Could not connect to the database : <br/>". $db->connect_error);
                                                  }
                                                  while ($row = $resulttk->fetch_object()){
                                                      $tid = $row->kode_kerja;
                                                      $tname = $row->nama_kerja;
                                                      echo "<option value=".$tid.' ';
                                                      if(isset($pekerjaan) && $pekerjaan==$tid)
                                                      echo "selected='true'";
                                                      echo ">".$tname."</option>";
                                                  }
                                              ?></select>
                      <span class="error">* <?php echo $error_pekerjaan;?></span>
                   </div>
                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Proyek</label>
                                      <div class="col-sm-10">
                                          <select class="form-control m-bot15" id="proyek" name="proyek" required>
                                              <?php
                                                  $querytk = "select * from analisis_pekerjaan left join proyek on proyek.no_proyek=analisis_pekerjaan.no_proyek where no_analisis=$no_analisis";
                                                  $resulttk = $db->query($querytk);
                                                  if(!$resulttk){
                                                      die("Could not connect to the database : <br/>". $db->connect_error);
                                                  }
                                                  while ($row = $resulttk->fetch_object()){
                                                      $tid = $row->no_proyek;
                                                      $tname = $row->nama_proyek;
                                                      echo "<option value=".$tid.' ';
                                                      if(isset($proyek) && $proyek==$tid)
                                                      echo "selected='true'";
                                                      echo ">".$tname."</option>";
                                                  }
                                              ?></select>
                      <span class="error">* <?php echo $error_proyek;?></span>
                   </div>
                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Item Bayar</label>
                                      <div class="col-sm-10">
                                          <input name='itembayar' type="text" class="form-control" value='<?php echo $item_bayar?>' required/>
                      <span class="error">* <?php echo $error_item_bayar;?></span>
                                      </div>
                  </div>
                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Satuan Bayar</label>
                                      <div class="col-sm-10">
                                          <input name='satuanbayar' type="text" class="form-control" value='<?php echo $satuan_bayar?>' required/>
                      <span class="error">* <?php echo $error_satuan_bayar;?></span>
                                      </div>
                  </div>
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
