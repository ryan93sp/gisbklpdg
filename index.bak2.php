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
    <link rel="stylesheet" href="css/jquery.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
	<link rel="stylesheet" href="mylib/mystyle.css" type="text/css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDM2fDXHmGzCDmDBk3bdPIEjs6zwnI1kGQ&signed_in=true"></script>
	
<script type="text/javascript">
var server= 'http://localhost/bengkel/json/';
$(function(){
	$.ajax({ 
	url: server+'listkecamatan.php', data: "", dataType: 'json', success: function(rows){
		for (var i in rows){
			var row = rows[i];
			var gid=row.gid;
			var kecamatan=row.kecamatan;
			$('#selectkec').append('<option value="'+gid+'">'+kecamatan+'</option>');
		}
	}
	});
});
$(function(){
	$.ajax({ 
	url: server+'kendaraan.php', data: "", dataType: 'json', success: function(rows){
		for (var i in rows){
			var row = rows[i];
			var id=row.id;
			var kendaraan=row.kendaraan;
			$('#selectken').append('<option value="'+id+'">'+kendaraan+'</option>');
		}
	}
	});
});
function kategori(){
	$('#selectbeng option').remove();
	var v=selectken.value;
	$.ajax({ 
	url: server+'kategori.php?id='+v, data: "", dataType: 'json', success: function(rows){
		for (var i in rows){
			var row = rows[i];
			var id=row.id;
			var kategori=row.kategori;
			$('#selectbeng').append('<option value="'+id+'">'+kategori+'</option>');
		}
	}
	});
}
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
                                        <center>Posisi Anda</center>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse ">
                                <div class="panel-body">
									<center>
									<button type="button" onclick="geolocation()" class="btn btn-primary">Posisi Sekarang <i class="fa fa-crosshairs"></i></button>
									<br><button type="button" onclick="manuallocation()" class="btn btn-primary">Posisi Manual <i class="fa fa-map-marker"></i></button>
									</center>
                                </div>
                            </div>
                        </div>
						<div class="panel">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                        <center>Nama Bengkel</center>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse ">
                                <div class="panel-body">
                                    <div class="input-group">
                                        <label class="sr-only" for="">cari</label>
                                        <input class="form-control" style="border-radius:.25rem;" id="inputcarinama" name="inputcarinama" placeholder="Nama.." type="text">
                                        <span class="input-group-btn">
                                            <button type="submit" id="" class="btn btn-primary" onclick="btncarinama()">Cari <i class="fa fa-search"></i></button>
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
									<input id="inputradius" data-slider-id='ex1Slider' type="text" data-slider-min="0.5" data-slider-max="3" data-slider-step="0.5" data-slider-value="0.5"/>
									<button type="submit" id="" class="btn btn-primary" style="margin-top:10px" onclick="btnradius()">Cari <i class="fa fa-search"></i></button>
									</center>
                                </div>
                            </div>
                        </div>
						<div class="panel">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                                        <center>Kategori Bengkel</center>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse6" class="panel-collapse collapse">
                                <div class="panel-body">
									<select required name="selectken" id="selectken" style="margin-bottom:5px;" class="form-control" placeholder="" onchange="kategori()">
										<option selected disabled>--Pilih Kendaraan--</option>
									</select>
									<select required name="selectbeng" id="selectbeng" class="form-control" placeholder="">
										<option selected disabled>--Pilih Bengkel--</option>
									</select>
									<button type="submit" id="buttonkat" class="btn btn-primary" onclick="btncarikat()"> Cari <i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
						<div class="panel">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                                        <center>Layanan Bengkel</center>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse5" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="checkbox">
										<label><input type="checkbox" name="layanan" value="1">Service Mesin</label>
									</div>
									<div class="checkbox">
										<label><input type="checkbox" name="layanan" value="2">Ganti Suku Cadang</label>
									</div>
									<div class="checkbox">
										<label><input type="checkbox" name="layanan" value="3">Tune Up</label>
									</div>
									<div class="checkbox">
										<label><input type="checkbox" name="layanan" value="4">Ganti Oli</label>
									</div>
									<div class="checkbox">
										<label><input type="checkbox" name="layanan" value="5">Bongkar Mesin</label>
									</div>
									<div class="checkbox">
										<label><input type="checkbox" name="layanan" value="6">Tambal Ban</label>
									</div>
									<div class="checkbox">
										<label><input type="checkbox" name="layanan" value="7">Penjualan Aksesoris</label>
									</div>
									<div class="checkbox">
										<label><input type="checkbox" name="layanan" value="7">Pasang & Services AC</label>
									</div>
									<button type="submit" id="buttonlayanan" class="btn btn-primary" onclick=""> Cari <i class="fa fa-search"></i></button>
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
                                    <select required name="selecttipe" id="selectkec" class="form-control" placeholder="">
										<option selected disabled>--Pilih Kecamatan--</option>
									</select>
									<button type="submit" id="buttoncarikec" class="btn btn-primary" onclick="alert('a')"> Cari <i class="fa fa-search"></i></button>
                                        
                                </div>
                            </div>
                        </div>
						
                    </div>
                </div>
				<div class="items-list" style="width:25%;" id="hasil">
                    <div class="inner" id="innerbtn">
                        <header id="header">
                            <h3>Hasil Pencarian</h3>
                        </header>
						<div id="list-a" style="display:block;"></div>
						<div id="det-a" style="display:none;">
							<div id="isi"></div>
						</div>
						<div id="det-r" style="display:none;">
							<div id="isi-r"></div>
							<div id="back-a"></div>
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


<script type="text/javascript" src="js/before.js"></script>
<script type="text/javascript" src="js/jquery-custom.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/smoothscroll.js"></script>
<script type="text/javascript" src="js/bootstrap-select.js"></script>
<script type="text/javascript" src="js/bootstrap-slider.js"></script>
<script type="text/javascript" src="mylib/myjs.js"></script>

<script type="text/javascript" src="mylib/map.js"></script>

<script type="text/javascript">
$('#inputradius').slider({
	formatter: function(value) {
		return value+' km';
		}
	});
</script>
</body>
</html>