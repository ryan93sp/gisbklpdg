<?php 
session_start();
if(isset($_SESSION['admin'])){
	echo"<script language='JavaScript'>document.location='index.php'</script>";
    exit();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
	<link rel="icon" type="image/png" href="../image/icon.png">
    <title>GIS Bengkel Kota Padang | Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
	<link href="dist/css/skins/skin-black.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/AdminLTE.min.login.css" rel="stylesheet" type="text/css" />
  </head>
  <body class="login-page skin-black">
	<div class="wrapper">
		<header class="main-header">
			<span class="logo" style="width:100%;text-align:left;font-size:16px"><b>GIS Bengkel Kota Padang</b></span>
		</header>
	</div>
    <div class="login-box">
      <div class="login-logo">
        <b>Log in</b>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <form action="act/session.php" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Username" name="username" autofocus required/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password" required/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat" name="submit">Masuk</button>
            </div><!-- /.col -->
          </div>
        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  </body>
</html>