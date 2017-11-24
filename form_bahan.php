<!DOCTYPE html>
<?php
	require_once('config.php');
	$db = new mysqli($db_host, $db_username, $db_password, $db_database);
	if($db->connect_errno){
		die("Tidak dapat terkoneksi dengan database: </br>". $db->connect_errno);
	}
	
	if(isset($_POST['submit'])){
		$kode_barang = $_POST['kode_barang'];
		$nama_barang = $_POST['nama_barang'];
		$satuan = $_POST['satuan'];
		$harga_k = $_POST['harga_k'];
		$harga_ahs = $_POST['harga_ahs'];
		
		$query = "INSERT INTO bahan_baku (kode_barang, nama_barang, satuan, harga_k, harga_ahs) VALUES('$kode_barang', '$nama_barang', '$satuan', '$harga_k', '$harga_ahs')";
		$result = $db->query($query);
		
		$query2 = "SELECT kode_barang FROM bahan_baku WHERE kode_barang='$kode_barang'";
		$result2 = $db->query($query2);
		$row = $result2->fetch_object();
		$kode_barang2 = $row->kode_barang;
		
		if(!$result){
			if(!isset($kode_barang2)){
				echo 'Query error!';
			}else{
				echo "<script>alert('Kode '.$kode_barang2.' telah digunakan!<br>')</script>";
			}
		}else{
			echo "<script>alert('Data has been inserted!<br>')</script>";
			echo "<script>window.open('tab_bahan.php','_self')</script>";
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
					<h3 class="page-header"><i class="fa fa-files-o"></i> Form Bahan Baku</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="icon_document_alt"></i>Forms</li>
						<li><i class="fa fa-files-o"></i>Form Bahan Baku</li>
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
                                          <input name='nama_barang' type="text" class="form-control" required/>
                                      </div>
									</div>
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Kode Bahan Baku</label>
                                      <div class="col-sm-10">
                                          <input name='kode_barang' type="text" class="form-control" required/>
                                      </div>
									</div>
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Satuan</label>
                                      <div class="col-sm-10">
                                          <input name='satuan' type="text" class="form-control" required/>
                                      </div>
									</div>
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Harga K</label>
                                      <div class="col-sm-10">
                                          <input name='harga_k' type="price" class="form-control"/>
                                      </div>
									</div>
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Harga AHS</label>
                                      <div class="col-sm-10">
                                          <input name='harga_ahs' type="price" class="form-control"  />
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
