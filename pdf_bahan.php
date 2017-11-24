<?php
//koneksi ke database
$db_host='localhost';
$db_database='pklbbm';
$db_username='root';
$db_password='';

$db = new mysqli($db_host, $db_username, $db_password, $db_database);
 if ($db->connect_errno){
  die ("Could not connect to the database: <br />". $db->connect_error);
 } 
 
require('fpdf17/fpdf.php');
$query = "SELECT * FROM bahan_baku ORDER BY nama_barang ASC";
$result = $db->query( $query );
if (!$result){
 die ("Could not query the database: <br />". $db->error);
}

$column_namabarang = "";
$column_kodebarang = "";
$column_satuan = "";
$column_hargak = "";
$column_hargaahs = "";

while($row = mysqli_fetch_array($result))
{
	$nama_barang = $row["nama_barang"];
	$kode_barang = $row["kode_barang"];
	$satuan = $row["satuan"];
	$harga_ahs = $row["harga_ahs"];
    $harga_k = $row["harga_k"];
    
 $column_namabarang = $column_namabarang.$nama_barang."\n";
 $column_kodebarang = $column_kodebarang.$kode_barang."\n";
 $column_satuan = $column_satuan.$satuan."\n";
 $column_hargak = $column_hargak.$harga_k."\n";
 $column_hargaahs = $column_hargaahs.$harga_ahs."\n";

//Create a new PDF file
$pdf = new FPDF('P','mm',array(210,297)); //L For Landscape / P For Portrait
$pdf->AddPage();

//Menambahkan Gambar
$pdf->SetFont('Arial','B',13);
$pdf->Cell(80);
$pdf->Cell(30,10,'DAFTAR',0,0,'C');
$pdf->Ln();
$pdf->Cell(80);
$pdf->Cell(30,10,'HARGA DASAR BAHAN BAKU',0,0,'C');
$pdf->Ln();
$pdf->Ln();
}
//Fields Name position
$Y_Fields_Name_position = 30;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(255,255,255);
//Bold Font for Field Name
$pdf->SetFont('Arial','',10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(15);
$pdf->Cell(40,8,'Nama Bahan Baku',1,0,'C',1);
$pdf->SetX(55);
$pdf->Cell(40,8,'Kode Bahan Baku',1,0,'C',1);
$pdf->SetX(95);
$pdf->Cell(30,8,'Satuan',1,0,'C',1);
$pdf->SetX(125);
$pdf->Cell(30,8,'Harga Untuk AHS',1,0,'C',1);
$pdf->SetX(155);
$pdf->Cell(30,8,'Harga untuk K',1,0,'C',1);
$pdf->Ln();

//Table position, under Fields Name
$Y_Table_Position = 38;

//Now show the columns
$pdf->SetFont('Arial','',10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(15);
$pdf->MultiCell(40,6,$column_namabarang,1,'L');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(55);
$pdf->MultiCell(40,6,$column_kodebarang,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(95);
$pdf->MultiCell(30,6,$column_satuan,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(125);
$pdf->MultiCell(30,6,$column_hargaahs,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(155);
$pdf->MultiCell(30,6,$column_hargak,1,'C');

$pdf->Cell(0,30,'Halaman '.$pdf->PageNo().'',0,0,'R');
$pdf->Output();
?>