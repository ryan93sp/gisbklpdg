<!DOCTYPE html>
<html lang="en-US">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="icon" type="image/png" href="image/icon.png">
    <link rel="stylesheet" href="lib/font/css/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="lib/css/css.css" type="text/css">
    <link rel="stylesheet" href="lib/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="admin/plugins/datatables/dataTables.bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="lib/css/jquery.css" type="text/css">
    <link rel="stylesheet" href="lib/css/style.css" type="text/css">
	<link rel="stylesheet" href="lib/mystyle.css" type="text/css">
	<script type="text/javascript" src="lib/js/jquery.min.js"></script>
	
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
                    <a href="./"><img src="image/logo.png" alt="logo"></a>
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
		<div id="page-canvas" style="margin-top:69px;">
            <!--Off Canvas Navigation-->
            <nav class="off-canvas-navigation">
                <header style="line-height: 70px;">Menu</header>
				<div class="main-navigation navigation-off-canvas">
					<ul>
						<li><a href="./">Home</a></li>
						<li><a href="tentang.php">Tentang</a></li>
					</ul>
				</div>
            </nav>
            <!--end Off Canvas Navigation-->
			<div id="page-content">
                <div id="semua" class="block equal-height">
                    <div class="container">
                        <header><h2>Data Bengkel Kota Padang</h2></header>
                        <div class="row">
							<div class="col-md-12 col-sm-12">
								<table id="example2" class="table table-hover">
									<thead>
									  <tr style="font-size:16px;">
										<th>No</th>
										<th>Foto</th>
										<th>Detail</th>
										<th></th>
										<th></th>
										
									  </tr>
									</thead>
									<tbody>
									
									<?php
									include("json/connect.php");
									$sql = pg_query("SELECT * FROM bengkel_region left join merk on bengkel_region.merk_id=merk.merk_id join jenis_kendaraan on bengkel_region.kendaraan_id=jenis_kendaraan.kendaraan_id order by gid asc");
									$no = 0;
									while($data =  pg_fetch_array($sql)){
									$gid = $data['gid'];
									$nama = $data['nama_bengkel'];
									$alamat = $data['alamat'];
									$merk = $data['merk_jenis'];
									$kendaraan = $data['kendaraan'];
									$telpon = $data['telpon'];
									$foto = $data['foto'];
									if ($foto=='null' || $foto=='' || $foto==null){
										$foto='foto.jpg';
									}
									$no++;
									?>	
									
									  <tr>
										<td><?php echo "$no"; ?></td>
										<td><img src="image/foto/<?php echo "$foto"; ?>" style="width:250px;"></td>
										<td><?php echo "<b style='font-size:16px;'>Bengkel $nama</b><br>Alamat : $alamat<br>Telepon : $telpon<br>Kendaraan : $kendaraan<br>Jenis Bengkel : Bengkel $merk"; ?></td>
										<td><b>Layanan</b><ul><?php 
											$sqll=pg_query("select * from layanan_bengkel join layanan on layanan.layanan_id=layanan_bengkel.layanan_id where gid=$gid");
											while($dtl =  pg_fetch_array($sqll)){
												echo '<li>'.$dtl['jenis_layanan'].'</li>';
											}
										?></ul></td>
										<td><b>Jadwal Operasional</b><ul><?php 
											$sqll=pg_query("select * from jam_kerja join hari on jam_kerja.hari_id=hari.hari_id where gid=$gid order by jam_kerja.hari_id");
											while($dtj =  pg_fetch_array($sqll)){
												if ($dtj['jam_buka']=='00:00:00' && $dtj['jam_tutup']=='00:00:00'){
													$dtj['jam_buka']='-';
													$dtj['jam_tutup']='-';
												}
												$b=substr($dtj['jam_buka'],0,-3); //ambil karakter pertama, abaikan 3 karakter terakhir
												$t=substr($dtj['jam_tutup'],0,-3);
												echo '<li><span style="display:inline-block;width:55px;"><b>'.$dtj['hari'].'</b></span> '.$b.' - '.$t.'</li>';
											}
										?></ul></td>
									  </tr>
									<?php } ?>
									</tbody>
								  </table>
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

<script type="text/javascript" src="lib/js/before.js"></script>
<script type="text/javascript" src="lib/js/jquery-custom.js"></script>
<script type="text/javascript" src="lib/js/bootstrap.js"></script>
<script type="text/javascript" src="lib/js/smoothscroll.js"></script>
<script src="admin/plugins/datatables/jquery.dataTables.js"></script>
<script src="admin/plugins/datatables/dataTables.bootstrap.js"></script>
<script type="text/javascript">
    $(function (){
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": false,
          "bInfo": true,
          "bAutoWidth": true,
		  "oLanguage": {
			 "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
			 "sSearch": "Cari:"
		  }
        });
    });
</script>
</body>
</html>