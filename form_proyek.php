<!DOCTYPE html>
<?php
	require_once('config.php');
	$db = new mysqli($db_host, $db_username, $db_password, $db_database);
	if($db->connect_errno){
		die("Tidak dapat terkoneksi dengan database: </br>". $db->connect_errno);
	}
	
	if(isset($_POST['submit'])){
    $nama_proyek = $_POST['nama_proyek'];
		$perusahaan = $_POST['perusahaan'];
		$lokasi = $_POST['lokasi'];
		$sumberdana = $_POST['sumberdana'];
    $kab = $_POST['kab'];
    $prov = $_POST['prov'];
    $tanggal = $_POST['tanggal'];
		
		$query = "INSERT INTO proyek (nama_proyek, kode_perusahaan, lokasi, sumberdana, kab, prov, tanggal) VALUES('$nama_proyek', '$perusahaan', '$lokasi', '$sumberdana', '$kab', '$prov', '$tanggal')";
		$result = $db->query($query);
    
    if(!$result){
        echo "<script>alert('tidak berhasil dimasukkan')</script>";
    }else{
      echo "<script>alert('Data has been inserted!')</script>";
      echo "<script>window.open('tab_project.php','_self')</script>";
      $db->close();
    }	
	
	$db->close();
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
	
    <title>Tambah Proyek</title>

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
						<li><i class="fa fa-plus"></i>Tambah Proyek</a></li>
					</ol>
				</div>
			</div>
              <!-- Form validations -->              
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Form Proyek
                          </header>
                          <div class="panel-body">
                              <div class="form">
								<form method='POST' autocomplete='on' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Nama Proyek</label>
                                      <div class="col-sm-10">
                                          <input name='nama_proyek' type="text" class="form-control" required/>
                                      </div>
									</div>
									<div class="form-group">
                                      <label class="col-sm-2 control-label">Perusahaan</label>
                                      <div class="col-sm-10">
                                          <select class="form-control m-bot15" id="perusahaan" name="perusahaan" required>
                            <option value="none">--Pilih Perusahaan--</option>
                            <?php
                                $querykat = "select * from perusahaan";
                                $resultkat = $db->query($querykat);
                                if(!$resultkat){
                                    die("Could not connect to the database : <br/>". $db->connect_error);
                                }
                                while ($row = $resultkat->fetch_object()){
                                    $kid = $row->kode_perusahaan;
                                    $kname = $row->nama_perusahaan;
                                    echo "<option value=".$kid.' ';
                                    if(isset($perusahaan) && $perusahaan==$kid)
                                    echo "selected='true'";
                                    echo ">".$kname."</option>";
                                }
                            ?></select>
                                </div>
									</div>
                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Tanggal</label>
                                      <div class="col-sm-10">
                                          <input name='tanggal' type="date" class="form-control" required/>
                                      </div>
                  </div>
                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Sumber Dana</label>
                                      <div class="col-sm-10">
                                          <input name='sumberdana' type="text" class="form-control" required/>
                                      </div>
                  </div>
                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Lokasi Proyek</label>
                                      <div class="col-sm-10">
                                          <input name='lokasi' type="text" class="form-control" required/>
                                      </div>
                  </div>
                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Kabupaten</label>
                                      <div class="col-sm-10">
                                          <input name='kab' type="text" class="form-control" required/>
                                      </div>
                  </div>
                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Provinsi</label>
                                      <div class="col-sm-10">
                                          <input name='prov' type="text" class="form-control" required/>
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
