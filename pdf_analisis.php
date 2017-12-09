<?php
session_start();
if (!isset($_SESSION['masuk']))
{
   header('Location:./login.php');
}

  $no_analisis = $_GET['id'];
  $no_proyek = $_GET['idp'];

		require_once('config.php');
		$con = new mysqli($db_host, $db_username, $db_password, $db_database);
		if (mysqli_connect_errno()){
			die ("Could not connect to the database: <br />". mysqli_connect_error());
		}
		//Asign a query
		$query = " SELECT * FROM analisis_pekerjaan left JOIN proyek ON analisis_pekerjaan.no_proyek = proyek.no_proyek left JOIN pekerjaan ON analisis_pekerjaan.kode_kerja = pekerjaan.kode_kerja WHERE analisis_pekerjaan.no_analisis='".$no_analisis."'";
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
				$nama_proyek = $row['nama_proyek'];
				$prov = $row['prov'];
				$kab = $row['kab'];
				$item_bayar = $row['item_bayar'];
				$nama_kerja = $row['nama_kerja'];
				$satuan_bayar = $row['satuan_bayar'];
			}
		}


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tabel Standard Analisis</title>
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
		 </center>-----------------------------------------------------------------------------------------------------------------------------------------------------</center>
      </div>
      <!-- /.col -->
    </div>
	<br>
	<!-- Table row -->
    <div class="row">
		<div class="col-xs-12">
			<table cellspacing="0" cellpadding="0">
				<tr>
					<td style="text-transform:uppercase; text-decoration:bold;">Nama Proyek</td>
					<td style="text-transform:uppercase; text-decoration:bold;">&nbsp:&nbsp</td>
					<td style="text-transform:uppercase; text-decoration:bold;"><?php echo $nama_proyek;?></td>
				</tr>
				<tr>
					<td style="text-transform:uppercase; text-decoration:bold;">Lokasi</td>
					<td style="text-transform:uppercase; text-decoration:bold;">&nbsp:&nbsp</td>
					<td style="text-transform:uppercase; text-decoration:bold;"><?php echo $prov;?></td>
					<td style="text-transform:uppercase; text-decoration:bold;">&nbsp/&nbsp</td>
					<td style="text-transform:uppercase; text-decoration:bold;"><?php echo $kab;?></td>
				</tr>
				<tr>
					<td style="text-transform:uppercase; text-decoration:bold;">Item Pembayaran No.</td>
					<td style="text-transform:uppercase; text-decoration:bold;">&nbsp:&nbsp</td>
					<td style="text-transform:uppercase; text-decoration:bold;"><?php echo $item_bayar;?></td>
				</tr>
				<tr>
					<td style="text-transform:uppercase; text-decoration:bold;">Jenis Pekerjaan</td>
					<td style="text-transform:uppercase; text-decoration:bold;">&nbsp:&nbsp</td>
					<td style="text-transform:uppercase; text-decoration:bold;"><?php echo $nama_kerja;?></td>
				</tr>
				<tr>
					<td style="text-transform:uppercase; text-decoration:bold;">Satuan Bayar</td>
					<td style="text-transform:uppercase; text-decoration:bold;">&nbsp:&nbsp</td>
					<td style="text-transform:uppercase; text-decoration:bold;"><?php echo $satuan_bayar;?></td>
				</tr>
			</table>
		</div>
	</div>
    <!-- Table row -->
    <div class="row" style="margin-top: -100px">
		<div class="col-xs-12 table-responsive">
        <table class="table table-bordered">
          <thead>
          <tr>
            <th rowspan="2">NO.</th>
      		<th rowspan="2">KOMPONEN</th>
      		<th rowspan="2">SATUAN</th>
      		<th>PERKIRAAN</th>
      		<th>HARGA</th>
      		<th>JUMLAH</th>
      		</tr>
      		<tr>
      		<th>KUALITAS</th>
      		<th>SATUAN(Rp.)</th>
      		<th>HARGA(Rp.)</th>
      		</tr>
          </thead>
          <tbody>
			<?php
				echo'<tr>';
                  echo'<th colspan="12">A. Tenaga Kerja </th>';
                  echo'</tr>';
				$query2 = " SELECT
                            analisis_tenaga_kerja.no_analisis_tenaga,
                            tenaga_kerja.nama_tenaga,
                            tenaga_kerja.satuan,
                            analisis_tenaga_kerja.perkiraan,
                            tenaga_kerja.harga_satuan,
                            analisis_tenaga_kerja.no_analisis_tenaga, analisis_pekerjaan.no_analisis,
                            analisis_pekerjaan.no_proyek
                      FROM analisis_tenaga_kerja left JOIN analisis_pekerjaan ON analisis_tenaga_kerja.no_analisis = analisis_pekerjaan.no_analisis left JOIN tenaga_kerja ON analisis_tenaga_kerja.kode_tenaga = tenaga_kerja.kode_tenaga WHERE analisis_tenaga_kerja.no_analisis =$no_analisis";
                  // Execute the query
                  $result2 = mysqli_query($con,$query2);
				if (!$result2){
					die ("Could not query the database: <br />". mysqli_error($con));
				}
                  echo'<br><br>';
                  $no  = 1;
                  $jumlahtenaga = 0;
                  // Fetch and display the results
                  while ($row = mysqli_fetch_array($result2)) {
                      echo '<tr>';
                      echo '<td>'.$no.'</td> ';
                      echo '<td>'.$row['nama_tenaga'].'</td> ';
                      echo '<td>'.$row['satuan'].'</td>';
                      echo '<td>'.$row['perkiraan'].'</td>';
                      echo '<td>'.$row['harga_satuan'].'</td>';
                      echo '<td>'.$row['harga_satuan']*$row['perkiraan'].'</td>';
                      echo '</tr>';
                      $jumlahtenaga = $jumlahtenaga + ($row['harga_satuan']*$row['perkiraan']);
                    $no++;
                  }

                  //============Bahan Baku==========================================
                  echo'<th colspan="12">B. Bahan Baku </th>';
                  //Asign a query
                  $query3 = " SELECT
                            analisis_bahan.no_analisis_bahan,
                            bahan_baku.nama_barang,
                            bahan_baku.satuan,
                            analisis_bahan.perkiraan,
                            bahan_baku.harga_k,
                            analisis_bahan.no_analisis_bahan, analisis_pekerjaan.no_analisis,
                            analisis_pekerjaan.no_proyek
                      FROM analisis_bahan left JOIN analisis_pekerjaan ON analisis_bahan.no_analisis = analisis_pekerjaan.no_analisis left JOIN bahan_baku ON analisis_bahan.kode_barang = bahan_baku.kode_barang WHERE analisis_bahan.no_analisis =$no_analisis";
                  // Execute the query
                  $result3 = mysqli_query($con,$query3);
				if (!$result3){
					die ("Could not query the database: <br />". mysqli_error($con));
				}
                  echo'<br><br>';
                  $no  = 1;
                  $jumlahbahan = 0;
                  // Fetch and display the results
                  while ($row = mysqli_fetch_array($result3)) {
                      echo '<tr>';
                      echo '<td>'.$no.'</td> ';
                      echo '<td>'.$row['nama_barang'].'</td> ';
                      echo '<td>'.$row['satuan'].'</td>';
                      echo '<td>'.$row['perkiraan'].'</td>';
                      echo '<td>'.$row['harga_k'].'</td>';
                      echo '<td>'.$row['harga_k']*$row['perkiraan'].'</td>';
                      echo '</tr>';
                      $jumlahbahan = $jumlahbahan + ($row['harga_k']*$row['perkiraan']);
                    $no++;
                  }
                  //============Alat Berat==========================================
                   echo '<tr>';
                  echo'<th colspan="12">C. Alat Berat</th>';
                  echo "</tr>";
                  //Asign a query
                  $query4 = " SELECT
                            alat_berat.no_alat_berat, alat_berat.nama_alat_berat, alat_berat.unit, alat_berat.harga_satuan, analisis_pekerjaan.no_analisis, analisis_pekerjaan.no_proyek
                      FROM alat_berat left JOIN analisis_pekerjaan ON alat_berat.no_analisis = analisis_pekerjaan.no_analisis WHERE alat_berat.no_analisis =$no_analisis";
                  // Execute the query
                  $result4 = mysqli_query($con,$query4);
				if (!$result4){
					die ("Could not query the database: <br />". mysqli_error($con));
				}
                  echo'<br><br>';
                  $no  = 1;
                  $jumlahalat = 0;
                  // Fetch and display the results
                  while ($row = mysqli_fetch_array($result4)) {
                      echo '<tr>';
                      echo '<td>'.$no.'</td> ';
                      echo '<td>'.$row['nama_alat_berat'].'</td> ';
                      echo '<td>-</td>';
                      echo '<td>'.$row['unit'].'</td>';
                      echo '<td>'.$row['harga_satuan'].'</td>';
                      echo '<td>'.$row['harga_satuan']*$row['unit'].'</td>';
                      echo '</tr>';
                      $jumlahalat = $jumlahalat + ($row['harga_satuan']*$row['unit']);
                    $no++;
                  }
                  $total = $jumlahalat+$jumlahbahan+$jumlahtenaga;
                  $pajak = $total/10;
                  $hargapsar = $total-$pajak;
                  echo'<tr>';
                      echo'<th colspan="5">D. Jumlah Perekaman Analisis Harga           (A+B+C)</tH>';
                      echo'<th>'.$total.'</th>';
                  echo'</tr>';
                  echo'<tr>';
                      echo'<th colspan="5">E. Pajak 10%                                 (D x 10%)</tH>';
                      echo'<th>'.$pajak.'</th>';
                  echo'</tr>';
                  echo'<tr>';
                      echo'<th colspan="5">F. Harga Pemasaran                            (D-F)</tH>';
                      echo'<th>'.$hargapsar.'</th>';
                  echo'</tr>';							
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
