<?php
		require_once('config.php');
		$con = new mysqli($db_host, $db_username, $db_password, $db_database);
		if (mysqli_connect_errno()){
			die ("Could not connect to the database: <br />". mysqli_connect_error());
		}
		//Asign a query
		$query = "SELECT * FROM bahan_baku ";
		// Execute the query
		$result = mysqli_query($con,$query);
		if (!$result)
		{
			die ("Could not query the database: <br />". mysqli_error($con));
		}
		else
		{
			while ($row = mysqli_fetch_array($result))
			{
				$kode_barang = $row['kode_barang'];
				$nama_barang = $row['nama_barang'];
				$satuan = $row['satuan'];
				$harga_ahs = $row['harga_ahs'];
				$harga_k = $row['harga_k'];
			}
		}


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tabel Bahan Baku</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap CSS -->    
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet"/>
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
	<link href="css/font-awesome.css" rel="stylesheet" /> 	
    <!-- Custom styles -->
	<link href="css/fullcalendar.css" rel="stylesheet"/>
    <link href="css/style.css" rel="stylesheet"/>
    <link href="css/style-responsive.css" rel="stylesheet" />
	<link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet"/>
	<!-- TABLE STYLES-->
    <link href="assets/dataTables/dataTables.bootstrap.css" rel="stylesheet" />

</head>
<body onload="window.print();">
<section id="main-content">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header"><center><strong>PT Beton Budi Mulya</strong></center>
        </h2>
		 </center>__________________________________________________________________________________________________________________________________________________________________________________________</center>
      </div>
      <!-- /.col -->
    </div>
	<br>
	<!-- Table row -->
    <br>
    <!-- Table row -->
    <div class="row">
		<div class="col-xs-12 table-responsive">
        <table class="table table-bordered">
          <thead>
          <tr>
            <th>No</th>
			<th>Kode</th>
			<th>Nama Bahan Baku</th>
			<th>Satuan</th>
			<th>Harga K (Rp)</th>
			<th>Harga Ahs (Rp)</th>
          </tr>
          </thead>
          <tbody>
			<?php
				//Asign a query
				$query = " SELECT * FROM bahan_baku";
				// Execute the query
				$result = mysqli_query($con,$query);
				if (!$result){
					die ("Could not query the database: <br />". mysqli_error($con));
				}
				$no=1;
				echo '<tbody>';
					while ($row = mysqli_fetch_array($result)) {
						echo'<tr class="odd gradeX">';
							echo '<td>'.$no.'</td> ';
							echo '<td>'.$row['kode_barang'].'</td> ';
							echo '<td>'.$row['nama_barang'].'</td>';	
							echo '<td>'.$row['satuan'].'</td>';
							echo '<td>'.$row['harga_k'].'</td>';
							echo '<td>'.$row['harga_ahs'].'</td>';	
						echo '</tr>';
						$no++;
					}
				?>
          </tbody>
        </table>
	</div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

  </section>
  <!-- /.content -->
</section>
<!-- ./wrapper -->
 <!-- DATA TABLE SCRIPTS -->
    <script src="assets/dataTables/jquery.dataTables.js"></script>
    <script src="assets/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
		</script>
</body>
</html>
