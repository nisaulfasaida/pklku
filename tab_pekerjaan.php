<!DOCTYPE html>
<?php session_start();
if (!isset($_SESSION['masuk']))
{ 
   header('Location:./login.php');
} ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Tabel Jenis Pekerjaan</title>

    <!-- Bootstrap CSS -->    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />    
    <!-- Custom styles -->
    <link rel="stylesheet" href="css/fullcalendar.css">
    <link href="css/widgets.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
    <link href="css/xcharts.min.css" rel=" stylesheet"> 
    <link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet">
  </head>

  <body>
<section id="container" class="">
      <?php
        include("header.php");
        include("sidebar.php");
      ?>
      <!--main content start-->
      <section id="main-content">
        <section class="wrapper">
          <!--overview start-->
          <div class="row">
            <div class="col-lg-12">
              <ol class="breadcrumb">
                <li><i class="icon_documents_alt"></i>Data</li>
                <li><i class="icon_documents_alt"></i><a href="tab_bahan.php">Jenis Pekerjaan</a></li>
              </ol>
            </div>
          </div>
        <div class="row">
            <div class="col-lg-12">
              <a class="btn btn-info" href="form_pekerjaan.php" title="Bootstrap 3 themes generator"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Jenis Pekerjaan</a>
              <br><br>
              <div class="panel panel-default">                          
                <div class="panel-heading">
                Table Tenaga Kerja
                </div>
                <div class="panel-body">
                  <table class="table table-hover table-striped table-bordered" id="dataTable">
                     <thead>
                      <tr>
                        <th>No</th>
                        <th>Deskripsi</th>
                        <th>Kode</th>
                        <th>Aksi</th>
                      </tr>
                     </thead>
                      <?php
                        require_once('config.php');
                        $db = new mysqli($db_host, $db_username, $db_password, $db_database);
                        if ($db->connect_errno){
                          die ("Could not connect to the database: <br />". $db->connect_error);
                        }
                        //Asign a query
                        $query = " SELECT * FROM pekerjaan ";
                        // Execute the query
                        $result = $db->query( $query );
                        if (!$result){
                           die ("Could not query the database: <br />". $db->error);
                        }
                        $no  = 1;
                        // Fetch and display the results
                        echo "<tbody>";
                        while ($row = $result->fetch_object()){
                            echo "<tr>";
                            echo "<td>".$no."</td>";
                            echo '<td>'.$row->nama_kerja.'</td> ';
                            echo '<td>'.$row->kode_kerja.'</td> ';
                            echo '<td colspan="2">
                                  <a class="btn btn-warning" href="edit_pekerjaan.php?id='.$row->kode_kerja.'" ><i class="fa fa-pencil"></i> Edit</a>
                                  <a class="btn btn-danger" href="del_pekerjaan.php?id='.$row->kode_kerja.'"><i class="icon_close_alt2"></i> Hapus</a></td>';
                            echo "</tr>";
                          $no++;
                        }
                        echo "</tbody>";
                        // echo "<br>";
                        // echo 'Total Rows = '.$result->num_rows; //num_rows= untuk menghitung baris pada tabel, fungsi bawaan
                        $result->free();
                        $db->close();             
                      ?>
                   </table>
                </div>             
              </div>
            </div>
          </div>
        </section>
      </section>
  </section>
  <!-- container section start -->
  <script src="assets/js/jquery.js"></script>
  <script src="assets/js/jquery-ui-1.10.4.min.js"></script>
  <script src="assets/js/jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
  <!-- bootstrap -->
  <script src="assets/js/bootstrap.min.js"></script>
  <!-- nice scroll -->
  <script src="assets/js/jquery.scrollTo.min.js"></script>
  <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="assets/js/scripts.js"></script>
  <!-- DATA TABLE SCRIPTS -->
  <script src="assets/dataTables/jquery.dataTables.js"></script>
  <script src="assets/dataTables/dataTables.bootstrap.js"></script>
  <script>
      $(document).ready(function () {
          $('#dataTable').dataTable();
      });
  </script>
  </body>
</html>
