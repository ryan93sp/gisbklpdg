<?php date_default_timezone_set('Asia/Jakarta'); ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="icon" type="image/png" href="img/icon.png">
    <link href="font/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="css/css.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap-select.css" type="text/css">
	<link rel="stylesheet" href="css/bootstrap-slider.css" type="text/css">
    <link rel="stylesheet" href="css/jquery.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
	<link rel="stylesheet" href="mylib/mystyle.css" type="text/css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	
    <title>Sistem Informasi Geografis Bengkel Kota Padang</title>
</head>

<body onunload="" class="map-fullscreen page-homepage navigation-off-canvas page-fade-in" id="page-top">

<!-- Outer Wrapper-->
<div id="outer-wrapper">
    <!-- Inner Wrapper -->
    <div id="inner-wrapper">
        <!-- Navigation-->
        <div class="header" style="position:fixed;top:0px;">
            <div class="wrapper">
                <div class="brand">
                    <a href="./"><img src="img/logo.png" alt="logo"></a>
                </div>
                <nav class="navigation-items">
                    <div class="wrapper">
                        <!--<ul class="main-navigation navigation-top-header"></ul>
                        <ul class="user-area">
                            <li><a href="#"><b>Galeri</b></a></li>
                        </ul>-->
                        <div class="toggle-navigation">
                            <div class="icon">
                                <div class="line"></div>
                                <div class="line"></div>
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- end Navigation-->
        <!-- Page Canvas-->
		<div id="page-canvas" class="" style="margin-top:69px;">
            <!--Off Canvas Navigation-->
            <nav class="off-canvas-navigation">
                <header style="line-height: 70px;">Menu</header>
				<div class="main-navigation navigation-off-canvas">
					<ul>
						<li><a href="./">Home</a></li>
						<li><a href="galeri.php">Galeri</a></li>
					</ul>
				</div>
            </nav>
            <!--end Off Canvas Navigation-->
			<div id="page-content">
                <div id="tentang" class="block equal-height">
                    <div class="container">
                        <header><h2>TENTANG APLIKASI</h2></header>
                        <div class="row">
							<div class="col-md-12 col-sm-12">
								<span style="margin-left:20px;">Aplikasi Sistem Informasi Geografis Lokasi Bengkel bertujuan untuk memudahkan masyarakat khususnya pengendara menemukan lokasi dan mengetahui informasi bengkel di Kota Padang. Aplikasi ini diimplementasikan menggunakan <i>Google Maps API</i> karena <i>google maps</i> merupakan layanan peta yang paling lengkap saat ini.</span>
								<h3>Fitur yang tersedia</h3>
								<ul style="margin-left:20px;">
									<li>Pengguna bisa menemukan bengkel berdasarkan nama</li>
									<li>Pengguna bisa menemukan bengkel berdasarkan radius terdekat dari posisi</li>
									<li>Pengguna bisa menemukan bengkel berdasarkan jenis bengkel</li>
									<li>Pengguna bisa menemukan bengkel berdasarkan layanan</li>
									<li>Pengguna bisa menemukan bengkel berdasarkan Kecamatan</li>
									<li>Pengguna bisa menemukan bengkel berdasarkan jadwal operasional</li>
									<li>Pengguna bisa menemukan bengkel berdasarkan rating bengkel</li>
									<li>Pengguna bisa memberi rating pada bengkel</li>
									<li>Pengguna bisa mengetahui rute bengkel yang dituju dari posisi</li>
									<li>Pengguna bisa melihat informasi detail bengkel</li>
								</ul>
								<h3>Developer</h3>
								<h4 style="margin-left:20px;">Ryan Syahputera | <span style="color:rgb(68, 163, 211)">ryan93sp@gmail.com</span></h4>
							</div>
						</div>
                    </div>
                    
                </div>
			</div>
		</div>
    </div>
    <!-- end Inner Wrapper -->
</div>
<!-- end Outer Wrapper-->


<script type="text/javascript" src="js/before.js"></script>
<script type="text/javascript" src="js/jquery-custom.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/smoothscroll.js"></script>
<script type="text/javascript" src="js/bootstrap-select.js"></script>

</body>
</html>