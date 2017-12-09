<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['masuk']))
{
   header('Location:./login.php');
}

	require_once('config.php');
	$db = new mysqli($db_host, $db_username, $db_password, $db_database);
	if($db->connect_errno){
		die("Tidak dapat terkoneksi dengan database: </br>". $db->connect_errno);
	}
	
	if(isset($_POST['submit'])){
		$kode_perusahaan = $_POST['kode_perusahaan'];
		$nama_perusahaan = $_POST['nama_perusahaan'];
		$email = $_POST['email'];
		$cp_perusahaan = $_POST['cp_perusahaan'];
		$kabupaten = $_POST['kabupaten'];
		$provinsi = $_POST['provinsi'];
		$alamat = $_POST['alamat'];
		
		$query = "INSERT INTO perusahaan (kode_perusahaan, nama_perusahaan, email, cp_perusahaan, kabupaten, provinsi, alamat) VALUES('$kode_perusahaan', '$nama_perusahaan', '$email', '$cp_perusahaan', '$kabupaten', '$provinsi', '$alamat')";
		$result = $db->query($query);
		
		$query2 = "SELECT kode_perusahaan FROM perusahaan WHERE kode_perusahaan='$kode_perusahaan'";
		$result2 = $db->query($query2);
		$row = $result2->fetch_object();
		$kode_perusahaan2 = $row->kode_perusahaan;
		
		if(!$result){
			if(!isset($kode_perusahaan2)){
				echo 'Query error!';
			}else{
				echo "<script>alert('Kode '.$kode_perusahaan2.' telah digunakan!<br>')</script>";
			}
		}else{
			echo "<script>alert('Data has been inserted!')</script>";
			echo "<script>window.open('tab_perusahaan.php','_self')</script>";
			$db->close();
		}
	}
	$db->close();
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">
	
    <title>Tambah Perusahaan Mitra</title>

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
					<h3 class="page-header"><i class="fa fa-files-o"></i> Form Perusahaan</h3>
				</div>
			</div>
              <!-- Form validations -->              
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Form Tenaga Kerja
                          </header>
                          <div class="panel-body">
                              <div class="form">
								<form method='POST' autocomplete='on' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Nama Perusahaan</label>
                                      <div class="col-sm-10">
                                          <input name='nama_perusahaan' type="text" class="form-control" required/>
                                      </div>
									</div>
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Kode Perusahaan</label>
                                      <div class="col-sm-10">
                                          <input name='kode_perusahaan' type="text" class="form-control" required/>
                                      </div>
									</div>
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Email</label>
                                      <div class="col-sm-10">
                                          <input name='email' type="email" class="form-control" required/>
                                      </div>
									</div>
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Nomor Telfon</label>
                                      <div class="col-sm-10">
                                          <input name='cp_perusahaan' type="text" class="form-control" required/>
                                      </div>
									</div>
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Alamat</label>
                                      <div class="col-sm-10">
                                          <input name='alamat' type="text" class="form-control" required/>
                                      </div>
									</div>
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Kabupaten</label>
                                      <div class="col-sm-10">
                                          <input name='kabupaten' type="text" class="form-control" required//>
                                      </div>
									</div>
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Provinsi</label>
                                      <div class="col-sm-10">
                                          <input name='provinsi' type="text" class="form-control" />
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
