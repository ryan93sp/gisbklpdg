<!DOCTYPE html>
<html lang="en-US">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="icon" type="image/png" href="image/icon.png">
    <link href="font/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="css/css.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap-select.css" type="text/css">
	<link rel="stylesheet" href="css/bootstrap-slider.css" type="text/css">
    <!--<link rel="stylesheet" href="css/owl.css" type="text/css">-->
    <link rel="stylesheet" href="css/jquery.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
	<link rel="stylesheet" href="mylib/mystyle.css" type="text/css">
	<script src="js/jquery.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
	<script type="text/javascript">
var server= 'http://localhost/bengkel/json/';
	$(function(){
	  $.ajax({ 
	  url: server+'listkecamatan.php', data: "", dataType: 'json', success: function(rows)
			{ 
				for (var i in rows) 
					{ 	
						var row = rows[i];
						var gid=row.gid;
						var kecamatan=row.kecamatan;
						$('#selectkec').append('<option value="'+gid+'">'+kecamatan+'</option>');
		 			}
			}
		 });
  });
	</script>
    <title>Sistem Informasi Geografis Kota Padang</title>
</head>

<body onunload="" class="map-fullscreen page-homepage navigation-off-canvas page-fade-in" id="page-top">

<!-- Outer Wrapper-->
<div id="outer-wrapper">
    <!-- Inner Wrapper -->
    <div id="inner-wrapper">
        <!-- Navigation-->
        <div class="header">
            <div class="wrapper">
                <div class="brand">
                    <a href="./"><img src="image/logo.png" alt="logo"></a>
                </div>
                <nav class="navigation-items">
                    <div class="wrapper">
                        <ul class="main-navigation navigation-top-header"></ul>
                        <ul class="user-area">
                            <li><a href="#"><b>Galeri</b></a></li>
                        </ul>
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
		<div id="page-canvas">
            <!--Off Canvas Navigation-->
            <nav class="off-canvas-navigation">
                <header style="line-height: 70px;">Navigation</header>
				<div class="main-navigation navigation-off-canvas">

					<ul>
						<li><a href="#/about-us.html">About Us</a></li>
						<li><a href="#sub-level-1" class="has-child" data-toggle="collapse" aria-expanded="false" aria-controls="sub-level-1">Pages</a>
							<div class="collapse" id="sub-level-1">
								<ul>
									<li><a href="#/404.html">404</a></li>
									<li><a href="#sub-level-2" class="has-child" data-toggle="collapse" aria-expanded="false" aria-controls="sub-level-2">Blog</a>
										<div class="collapse" id="sub-level-2">
											<ul>
												<li><a href="#/blog-listing.html">Blog Listing</a></li>
												<li><a href="#/blog-detail.html">Blog Detail</a></li>
											</ul>
										</div>
									</li>
										
								</ul>
							</div>
						</li>
						<li><a href="#/contact.html">Contact</a></li>
					</ul>


				</div>
            </nav>
            <!--end Off Canvas Navigation-->
            <!--Page Content-->
            <div id="page-content">
            <!-- Map Canvas-->
            <div style="" class="map-canvas list-width-20 results-collapsed" id="sidebar">
                <!-- Map -->
				<div class="map" style="width:50%;">
					<div style="" class="toggle-navigation">
						<div class="icon">
							<div class="line"></div>
							<div class="line"></div>
							<div class="line"></div>
						</div>
					</div>
                    <div style="" id="map" class="has-parallax"></div>
                </div>
                <!-- end Map -->
                <!--Items List-->
                <div class="items-list" style="width:25%;">
                    <div class="inner panel-group margin-btm40" id="accordion">
                        <header>
                            <h3>Pencarian</h3>
                        </header>
						<div class="panel">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                        <center>Posisi</center>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse ">
                                <div class="panel-body">
									<center>
									<button type="button" onclick="geolocation()" class="btn btn-primary" style="width:100%;">Posisi Anda <i class="fa fa-location-arrow"></i></button>
									<br><button type="button" onclick="tambahlokasi()" class="btn btn-primary" style="width:100%;">Tambah Posisi <i class="fa fa-map-marker"></i></button>
									</center>
                                </div>
                            </div>
                        </div>
						<div class="panel">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                        <center>Berdasarkan Nama</center>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse ">
                                <div class="panel-body">
                                    <div class="input-group">
                                        <label class="sr-only" for="subscribe-email">Nama</label>
                                        <input class="form-control" style="border-radius:.25rem;" id="inputcaritext" name="inputcari" placeholder="Nama.." type="text">
                                        <span class="input-group-btn">
                                            <button type="submit" id="buttoncaritext" class="btn btn-primary">Cari <i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="panel">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                        <center>Terdekat</center>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse ">
                                <div class="panel-body">
									<center>
									<input id="ex1" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="2" data-slider-step="1" data-slider-value="0"/>
									<button type="submit" id="buttoncaritext" class="btn btn-primary" style="margin-top:10px;">Cari <i class="fa fa-search"></i></button>
									</center>
                                </div>
                            </div>
                        </div>
						<div class="panel">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                        <center>Kecamatan</center>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse4" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <select required name="selecttipe" id="selectkec" class="form-control" placeholder="Pilih Jurusan">
											<option value="">--Pilih Kecamatan--</option>
										</select><br>
										<span class="input-group-btn">
                                            <button type="submit" id="buttoncarikec" style="" class="btn btn-primary" onclick="clearmarker(),cleardata()"> Cari <i class="fa fa-search"></i></button>
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="items-list" style="width:25%;" id="hasil">
                    <div class="inner">
                        <header>
                            <h3>Hasil</h3>
                        </header>
						<div>
							Isi tampilan informasi disini
						</div>
                    </div>
                </div>
                <!--end Items List-->
            </div>
            <!-- end Map Canvas-->
			<!-- you can add new page here-->
            </div>
            <!-- end Page Content-->
        </div>
    </div>
    <!-- end Inner Wrapper -->
</div>
<!-- end Outer Wrapper-->

<script type="text/javascript" src="js/jquery-2.js"></script>
<script type="text/javascript" src="js/before.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/smoothscroll.js"></script>
<script type="text/javascript" src="js/bootstrap-select.js"></script>
<script type="text/javascript" src="js/bootstrap-slider.js"></script>
<!-- <script type="text/javascript" src="js/jquery_002.js"></script>
<script type="text/javascript" src="js/jquery_003.js"></script> -->
<script type="text/javascript" src="js/jquery-custom.js"></script>
<!--<script type="text/javascript" src="js/js"></script>-->
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="mylib/myjs.js"></script>
<script type="text/javascript" src="mylib/map.js"></script>


</body>
</html>