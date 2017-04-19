<?php 
session_start();
if(!isset($_SESSION['admin'])){
	echo"<script language='JavaScript'>document.location='login.php'</script>";
	  exit();
}
include("inc/connect.php");?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
	<link rel="icon" type="image/png" href="../image/icon.png">
    <title>Admin GIS Bengkel Kota Padang</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../lib/font/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
	<link href="dist/css/style.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/skins/skin-black.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDM2fDXHmGzCDmDBk3bdPIEjs6zwnI1kGQ&libraries=drawing"></script>
  </head>
  <body class="skin-black fixed">
    <div class="wrapper">
      <!-- Main Header -->
      <header class="main-header">
		<?PHP include("inc/header.php"); ?>
	  </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <?PHP include("inc/sidebar.php"); ?>
        </section>
        <!-- /.sidebar -->
      </aside>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Data Bengkel Kota Padang
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">  
		  <?php
			$p=$_GET['page'];
			$page="pages/".$p.".php";
			if(file_exists($page)){
				include($page);
			}elseif($p==""){
				include('pages/home.php');
			}else{
				include('pages/404.php');
			}
		  ?>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <strong>Copyright &copy; 2015 <a href="#">Admin GIS Bengkel Kota Padang</a></strong>
      </footer>
    </div><!-- ./wrapper -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
	<script src="plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
	<script src="dist/js/app.min.js" type="text/javascript"></script>
	<script src="inc/script.js" type="text/javascript"></script>
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
        $('#example1').dataTable({
          "bPaginate": true,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false,
		  "iDisplayLength": 25,
		  "oLanguage": {
			 "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
			 "sLengthMenu": "_MENU_ data per halaman",
			 "sSearch": "Cari:"
			}
        });
        $(".timepicker").timepicker({
			showInputs: false,
			showMeridian: false,
			defaultTime: 'value'
        });
      });
    </script>
  </body>
</html>