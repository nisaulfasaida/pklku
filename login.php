<?php
session_start();
if (isset($_SESSION['masuk']))
{
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
      <form class="login-form" action="functions.php" accept-charset="UTF-8" role="form" method="POST">     
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
