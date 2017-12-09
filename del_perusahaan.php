<?php
session_start();
if (!isset($_SESSION['masuk']))
{
	 header('Location:./login.php');
}
		$id = $_GET['id'];
		require_once('config.php');
		$db = new mysqli($db_host, $db_username, $db_password, $db_database);
		if($db->connect_errno){
			die('Could not connect to database = '.$db->connect_error);
		}
		$query = 'DELETE FROM perusahaan WHERE kode_perusahaan="'.$id.'"';
		$result = $db->query($query);
				if(!$result){
					die("Could not query the database: <br />". $db->error);
				}else{
					echo "<script>alert('Data Berhasil dihapus !')</script>";
		 			echo "<script>window.open('tab_perusahaan.php','_self')</script>";
					$db->close();
					exit;
				}
	
	?>