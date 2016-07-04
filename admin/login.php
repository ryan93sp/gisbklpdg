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
    <title>GIS Bengkel Kota Padang | Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.login.css" rel="stylesheet" type="text/css" />

  </head>
 
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <b>Log in</b>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <form action="session.php" method="post">
        
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

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    
  </body>
</html>