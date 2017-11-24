<?php
		$id = $_GET['id'];
		require_once('config.php');
		$db = new mysqli($db_host, $db_username, $db_password, $db_database);
		if($db->connect_errno){
			die('Could not connect to database = '.$db->connect_error);
		}
		$query = 'DELETE FROM bahan_baku WHERE kode_barang="'.$id.'"';
		$result = $db->query($query);
				if(!$result){
					die("Could not query the database: <br />". $db->error);
				}else{
					echo "<script>alert('Data Berhasil dihapus !')</script>";
		 			echo "<script>window.open('tab_bahan.php','_self')</script>";
					$db->close();
					exit;
				}
	
	?>