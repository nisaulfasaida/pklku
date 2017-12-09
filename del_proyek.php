<?php

		$id = $_GET['id'];
		require_once('config.php');
		$db = new mysqli($db_host, $db_username, $db_password, $db_database);
		if($db->connect_errno){
			die('Could not connect to database = '.$db->connect_error);
		}
		$query = 'DELETE FROM proyek WHERE no_proyek="'.$id.'"';
		$query1 = 'DELETE FROM analisis_pekerjaan WHERE no_proyek="'.$id.'"';
		// get no analisis
		$query2 = " SELECT no_analisis FROM analisis_pekerjaan WHERE no_proyek='".$id."'";
		$array = array();	
		// $result2 = $db->query( $query2 );
		while($row2 = mysqli_fetch_array($query2)){
		  // add each row returned into an array
		  $array[] = $row2;
		}

		// $row2 = $result2->fetch_object();
		// $no_analisis = $row2->no_analisis;

		$query3 = 'DELETE FROM analisis_tenaga_kerja WHERE no_analisis="'.$no_analisis.'"';
		$query4 = 'DELETE FROM alat_berat WHERE no_analisis="'.$no_analisis.'"';
		$query5 = 'DELETE FROM analisis_bahan WHERE no_analisis="'.$no_analisis.'"';


		$result = $db->query($query);
		$result1 = $db->query($query1);
		$result3 = $db->query($query3);
		$result4 = $db->query($query4);
		$result5 = $db->query($query5);
				if(!($result && $result1 && $result3 && $result4 && $result5 )){
					die("Could not query the database: <br />". $db->error);
				}else{
		 			echo "<script>window.open('tab_project.php','_self')</script>";
					$db->close();
					exit;
				}
	
	?>
