<?php
    require_once('functions.php');
    if(!isset($_SESSION['masuk'])){
        if(isset($_POST['login'])){
          if((!empty($_POST['email']))&&(!empty($_POST['password']))){
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $password = mysqli_real_escape_string($con, $_POST['password']);
            $password = md5("pas".$password."sap");

            $cekLoginAdmin = mysqli_query($con, "SELECT nama FROM admin WHERE username = '$username' AND password = '$password'");


            if(mysqli_num_rows($cekLoginAdmin)!=0){
              $fetch_user_id = mysqli_fetch_assoc($cekLoginAdmin);
              $_SESSION['masuk'] = $fetch_user_id['no_admin'];
              $_SESSION['status'] = "admin";
              header('Location:./index.php');
            }else{
              $gagal = "Tidak dapat login. Silahkan cek username dan password anda kembali";
            }
          }else{
            $gagal = "username dan password harus di isi!";
            if(!empty($_POST['username'])){
                $email = mysqli_real_escape_string($con, $_POST['username']);
            }
          }
        }
    }else{
        exit;
        header('Location:./index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php $site_name ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <!-- Bootstrap CSS -->    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
</head>

  <body class="login-img3-body">

    <div class="container">
      <form class="login-form" action="index.php" accept-charset="UTF-8" role="form" method="POST">     
        <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i> </br> <font size = "4"> Aplikasi Perhitungan Rencana Biaya PT Beton Budi Mulya</p>
            <?php if(isset($gagal)) echo '<div class="form-group"><span class="label label-warning">'.$gagal.'</span></div>' ?>
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input type="text" class="form-control" placeholder="Username" name="username" value="<?php if(isset($email)) echo $email; ?>" autofocus/>
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" class="form-control" placeholder="Password" name="password" />
				</div>
            <button class="btn btn-primary btn-lg btn-block" type="submit"  name="login" value="Login">Login</button>
      </form>
  
  </body>
</html>
