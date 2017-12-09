<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['masuk']))
{
   header('Location:./login.php');
}

$no_alat_berat= $_GET['id'];
$no_analisis = $_GET['ids'];

$error_kodebarang = '';
$error_perkiraan = '';

//connect database
require_once('config.php');
$db = new mysqli($db_host, $db_username, $db_password, $db_database);
if ($db->connect_errno){
	die ("Could not connect to the database: <br />". $db->connect_error);
}

if (!isset($_POST["submit"])){
	$query = " SELECT * FROM analisis_bahan WHERE no_analisis_bahan='".$no_analisis_bahan."'";
	// Execute the query
	$result = $db->query( $query );
	if (!$result){
		die ("Could not query the database: <br />". $db->connect_error);
	}else{
		while ($row = $result->fetch_object()){
			$kode_barang = $row->kode_barang;
			$perkiraan= $row->perkiraan;
		}
	}
	}else{
$no_analisis_bahan = $_POST['id'];
$no_analisis = $_POST['ids'];

	$kode_barang= test_input($_POST['bahanbaku']);
	if ($kode_barang == ''){
		$error_kodebarang = "Bahan Baku harus diisi";
		$valid_kodebarang = FALSE;
	}else{
		$valid_kodebarang = TRUE;
	}
	$perkiraan = $_POST['perkiraan'];
	if ($perkiraan == '' || $perkiraan == 'none'){
		$error_perkiraan = "Perkiraan harus diisi";
		$valid_perkiraan = FALSE;
	}else{
		$valid_perkiraan = TRUE;
	}
	
	//update data into database
	if ( $valid_kodebarang && $valid_perkiraan){
		//escape inputs data
		
		$kode_barang = $db->real_escape_string($kode_barang);
		$perkiraan = $db->real_escape_string($perkiraan);
		//Asign a query
		$query = " UPDATE analisis_bahan SET  kode_barang='".$kode_barang."', perkiraan='".$perkiraan."' where no_analisis_bahan='".$no_analisis_bahan."'";
		// Execute the query
		$result = $db->query( $query );
		if (!$result){
		   die ("Could not query the database: <br />". $db->error);
		}else{
			echo "<script>alert('Data has been updated!')</script>";
			echo "<script>window.open('detail_analisis.php?id='".$no_analisis."','_self')</script>";
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
	
    <title>Edit Analisis Bahan Baku</title>

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
		                <li><i class="fa fa-pencil"></i>Edit Analisis Bahan Baku</a></li> 
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
                                      <label class="col-sm-2 control-label">Bahan Baku</label>
                                      <div class="col-sm-10">
                                      		<select class="form-control m-bot15" id="bahanbaku" name="bahanbaku" required>
                                              <option value="none">--Pilih Bahan Baku--</option>
                                              <?php
                                                  $querytk = "select * from bahan_baku";
                                                  $resulttk = $db->query($querytk);
                                                  if(!$resulttk){
                                                      die("Could not connect to the database : <br/>". $db->connect_error);
                                                  }
                                                  while ($row = $resulttk->fetch_object()){
                                                      $tid = $row->kode_barang;
                                                      $tname = $row->nama_barang;
                                                      echo "<option value=".$tid.' ';
                                                      if(isset($bahanbaku) && $bahanbaku==$tid)
                                                      echo "selected='true'";
                                                      echo ">".$tname."</option>";
                                                  }
                                              ?></select>
										  <span class="error">* <?php echo $error_kodebarang;?></span>
                                      </div>
									</div>
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Perkiraan</label>
                                      <div class="col-sm-10">
                                          <input name='perkiraan' type="number" class="form-control" value='<?php echo $perkiraan?>' required/>
										  <span class="error">* <?php echo $error_perkiraan;?></span>
                                      </div>
									</div>
									<input name='id' type="hidden" class="form-control" value='<?php echo $no_analisis_bahan?>'/>
									<input name='ids' type="hidden" class="form-control" value='<?php echo $no_analisis?>'/>
									
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
