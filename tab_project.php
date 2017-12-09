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

    <title>Tabel Proyek</title>

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
                <li><i class="fa fa-tasks"><a href="tab_proyek.php"></i>Tabel Proyek</li>
              </ol>
            </div>
          </div>
        <div class="row">
            <div class="col-lg-12">
              <a class="btn btn-info" href="form_proyek.php" title="Bootstrap 3 themes generator"><i class="fa fa-plus"> Tambah Proyek</i></a>
              <br><br>
              <div class="panel panel-default">                          
                <div class="panel-heading">
                Table Proyek
                </div>
                <div class="panel-body">
                  <table class="table table-hover table-striped table-bordered" id="dataTable">
                     <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Proyek</th>
                        <th>Nama Perusahaan</th>
                        <th>Tanggal</th>
                        <th>Sumber Dana</th>
                        <th>Lokasi Proyek</th>
                        <th>Kabupaten</th>
                        <th>Provinsi</th>
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
                        $query = " SELECT proyek.no_proyek,
                              proyek.nama_proyek,
                              perusahaan.nama_perusahaan,
                              proyek.lokasi,
                              proyek.sumberdana,
                              proyek.kab,
                              proyek.prov,
                              proyek.tanggal
                              from proyek left JOIN perusahaan on proyek.kode_perusahaan = perusahaan.kode_perusahaan";;
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
                            echo '<td>'.$row->nama_proyek.'</td> ';
                            echo '<td>'.$row->nama_perusahaan.'</td> ';
                            echo '<td>'.$row->tanggal.'</td>';
                            echo '<td>'.$row->sumberdana.'</td>';
                            echo '<td>'.$row->lokasi.'</td>';
                            echo '<td>'.$row->kab.'</td>';
                            echo '<td>'.$row->prov.'</td>';
                            echo '<td colspan="3">
                                  <a class="btn btn-primary" href="detail_proyek.php?id='.$row->no_proyek.'"><i class="fa fa-info"></i> Detail</a>
                                  <a class="btn btn-warning" href="edit_proyek.php?id='.$row->no_proyek.'" ><i class="fa fa-pencil"></i> Edit</a>
                                  <a class="btn btn-danger" onclick="javascript:confirmationDelete($(this));return false;" href="del_proyek.php?id='.$row->no_proyek.'"><i class="icon_close_alt2"></i> Hapus</a></td>';
                            echo '</tr>';
                          $no++;
                        }
                        echo "</tbody>";            
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
