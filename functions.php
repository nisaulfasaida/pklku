<?php
  ob_start();
  error_reporting(0);
  
	require_once('config.php');
	
	$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
	if(mysqli_connect_errno()){
		die('Could not connect to database : <br/>'.$mysqli_connect_error());
	}

	$site_name="LOGIN";

	date_default_timezone_set("Asia/Jakarta");
					
	session_start();
	
	if(isset($_SESSION['masuk'])){
		if($_SESSION['status']=='admin'){
			$query = "SELECT * FROM admin WHERE no_admin=".$_SESSION['masuk']."";
			$admin=mysqli_query($con,$query); 
			$admin=$admin->fetch_object();
			$status=$_SESSION['status'];
		}else{
			echo "Harap ulangi login";
		}
	}

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	
?>
