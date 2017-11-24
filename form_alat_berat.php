<!DOCTYPE html>
<?php
  $no_analisis = $_GET['id'];
  $no_proyek = $_GET['idp'];

  require_once('config.php');
  $db = new mysqli($db_host, $db_username, $db_password, $db_database);
  if($db->connect_errno){
    die("Tidak dapat terkoneksi dengan database: </br>". $db->connect_errno);
  }
  
  if(isset($_POST['submit'])){
    $nama_alat_berat = $_POST['nama_alat_berat'];
    $no_analisis = $no_analisis;
    $no_proyek = $no_proyek;
    $unit = $_POST['unit'];
    $harga_satuan = $_POST['harga_satuan'];
    
    $query = "INSERT INTO alat_berat (nama_alat_berat, no_analisis, unit, harga_satuan, no_proyek) VALUES('$nama_alat_berat', '$no_analisis', '$unit', '$harga_satuan', '$no_proyek')";
    $result = $db->query($query);
    if(!$result){
        echo "<script>alert('Data tidak berhasil dimasukkan')</script>";
    }else{
      echo "<script>alert('Data berhasil dimasukkan!')</script>";
      echo "<script>window.open('detail_analisis.php?id=$no_analisis&idp=$no_proyek','_self')</script>";
      
    } 
  
  $db->close();}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">
  
    <title>Tambah Analisis Alat Berat</title>
  
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
      <section id="main-content">
          <section class="wrapper">
      <div class="row">
        <div class="col-lg-12">
          <ol class="breadcrumb">
            <li><i class="fa fa-tasks"></i><a href="tab_project.php">Proyek</a></li>
            <li><i class="fa fa-info"></i>Detail Proyek</a></li>
            <li><i class="fa fa-plus"></i>Tambah Analisis Bahan Baku</a></li> 
          </ol>
        </div>
      </div>
            <div class="row">
                <section class="panel">
                       <header class="panel-heading tab-bg-primary"> 
                               <ul class="nav nav-tabs"> 
                                   <li class=""> 
                                       <a href="detail_analisis.php?id=<?php echo $no_analisis ?>&idp=<?php echo $no_proyek ?>">Form Standard Analisis</a> 
                                   </li> 
                                   <li class=""> 
                                       <a href="form_analis_tenaga.php?id=<?php echo $no_analisis ?>&idp=<?php echo $no_proyek ?>">Tambah Analisis Tenaga Kerja</a>
                                   </li> 
                                   <li class=""> 
                                       <a href="form_analis_bahan.php?id=<?php echo $no_analisis ?>&idp==<?php echo $no_proyek ?>">Tambah Analisis Bahan Baku</a> 
                                   </li> 
                                   <li class=""> 
                                       <a href="form_alat_berat.php?id=<?php echo $no_analisis ?>&idp==<?php echo $no_proyek ?>">Tambah Analisis Alat Berat</a> 
                                   </li> 
                               </ul> 
                          </header> 
              </section>
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Form Pekerjaan
                              <?php echo $no_analisis; ?>
                          </header>
                          <div class="panel-body">
                              <div class="form">
                                <form method='POST' autocomplete='on' action="">
                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Nama Alat Berat</label>
                                                        <div class="col-sm-10">
                                                            <input name="nama_alat_berat" id="nama_alat_berat" type="text" class="form-control" required/>
                                                        </div>
                                    </div>
                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Unit</label>
                                                        <div class="col-sm-10">
                                                            <input name="unit" id="unit" type="number" class="form-control" required/>
                                                        </div>
                                    </div>
                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Harga Satuan</label>
                                                        <div class="col-sm-10">
                                                            <input name="harga_satuan" id="harga_satuan" type="number" class="form-control" required/>
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