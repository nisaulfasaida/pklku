<?php
session_start();
if (isset($_SESSION['masuk']))
{
	 header('Location:./index.php');
}

require_once 'config.php';
// if(isset($_POST['nip']) && isset($_POST['passowrd'])){
  $nip = $_POST['username'];
  $password = $_POST['password'];

// }
// query untuk mendapatkan record dari username
$db=mysqli_connect($db_host,$db_username,$db_password,$db_database) or
die("Maaf Anda gagal koneksi.!");
$query = "SELECT * FROM admin WHERE username = '$nip'";
$result = mysqli_query($db,$query);
$data = mysqli_fetch_array($result);
// cek kesesuaian password
if (md5($password) == $data['password'])
{
echo "";
    // menyimpan email dan kke dalam session
    $_SESSION['masuk'] = $data['no_admin'];
    $_SESSION['nama'] = $data['nama'];
    header('Location:./index.php');
}
else
?>
<html>
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LOGIN.php</title>

    <!-- Bootstrap Core CSS -->
    <link href="Template/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="Template/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS Admin -->
    <link href="Template/dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom CSS Table-->
    <link href="Template/dist/css/3-col-portfolio.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="Template/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>

  <div class="container">
      <div class="row">
          <div class="col-md-4 col-md-offset-4">
              <div class="login-panel panel panel-default">
                  <div class="panel-heading">
                      <h2 align="center" class="panel-title">Gagal Login</h2>
                  </div>
                  <div class="panel-body">
                          <fieldset>
                              <div class="form-group">
                              <h3 align="center" >Kombinasi Username dan Password tidak sesuai</h3>
                              <br/>
                              <a href="login.php" class="btn btn-lg btn-danger btn-block">Coba Lagi</a>
                          </fieldset>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- jQuery -->
  <script src="Template/vendor/jquery/jquery.min.js"></script>
  <!-- Bootstrap Core JavaScript -->
  <script src="Template/vendor/bootstrap/js/bootstrap.min.js"></script>
  <!-- Metis Menu Plugin JavaScript -->
  <script src="Template/vendor/metisMenu/metisMenu.min.js"></script>
  <!-- Custom Theme JavaScript -->
  <script src="Template/dist/js/sb-admin-2.js"></script>

  </body>
</html>
