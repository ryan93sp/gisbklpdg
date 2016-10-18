<?php
require 'inc/connect.php';
$gid=$_GET["gid"];
date_default_timezone_set('Asia/Jakarta');
$day=date("w");
$query="SELECT bengkel_region.gid,nama_bengkel,alamat,telpon,jam_buka,jam_tutup,hari,foto,nama_kendaraan,nama_merk,ST_X(ST_Centroid(geom)) AS lng, ST_Y(ST_CENTROID(geom)) As lat FROM bengkel_region join jam_kerja on jam_kerja.gid=bengkel_region.gid join merk on merk.merk_id=bengkel_region.merk_id join jenis_kendaraan on jenis_kendaraan.jenis_kendaraan_id=bengkel_region.jenis_kendaraan_id join hari on  hari.hari_id=jam_kerja.hari_id where bengkel_region.gid=$gid and jam_kerja.hari_id=$day";
$hasil=pg_query($query);
while($row = pg_fetch_array($hasil)){
	$gid=$row['gid'];
	$nama=$row['nama_bengkel'];
	$alamat=$row['alamat'];
	$telpon=$row['telpon'];
	$hari=$row['hari'];
	$foto=$row['foto'];
	$kendaraan=$row['nama_kendaraan'];
	$merk=$row['nama_merk'];
	$deskripsi=$row['deskripsi'];
	$lat=$row['lat'];
	$lng=$row['lng'];
	if ($lat=='' || $lat==''){
		$lat='<span style="color:red">Kosong</span>';
		$lng='<span style="color:red">Kosong</span>';
	}
	$jam_buka=$row['jam_buka'];
	$b=substr($jam_buka,0,-3);
	$jam_tutup=$row['jam_tutup'];
	$t=substr($jam_tutup,0,-3);
	$buka = strtotime($jam_buka);
	$newbuka = date('H:i:s',$buka);
	$tutup = strtotime($jam_tutup);
	$newtutup = date('H:i:s',$tutup);
	$now = date('H:i:s');

	if($now >= $newbuka && $now <= $newtutup){
	$stat='Buka';
	$warna='blue';
	}else{
	$stat='Tutup';
	$warna='red';
	}
	if ($foto=='null' || $foto=='' || $foto==null){
		$foto='foto.jpg';
	}
}
?>
<!-- Default box -->
<div class="row">
	<div class="col-lg-7 col-xs-7 col-r-0">
		<div class="box">
			<div class="box-header with-border">
			  <h2 class="box-title" style="text-transform:capitalize;"><b>Bengkel <?php echo $nama ?></b></h2>
			</div>
			<div class="box-body">
				<table>
					<tbody  style='vertical-align:top;'>
						<tr><td><b>Alamat</b></td><td> :&nbsp; </td><td style='text-transform:capitalize;'><?php echo $alamat ?></td></tr>
						<tr><td><b>Telepon</b></td><td>:</td><td><?php echo $telpon ?></td></tr>
						<tr><td><b>Kendaraan</b></td> <td> :</td><td><?php echo $kendaraan ?></td></tr>
						<tr><td><b>Jenis Bengkel<b> </td><td>: </td><td>Bengkel <?php echo $merk ?></td></tr>
						<tr onclick='togglejad()' style="cursor:pointer;"><td><b>Jadwal Operasional</b>&nbsp;</td><td>:</td><td>
							<span id="jadwal1"><?php echo '<b>'.$hari.'</b> '.$b.' - '.$t.' ' ?><span style='color:<?php echo $warna ?>;'>(<?php echo $stat ?>) </span><i class="fa fa-chevron-down"></i></span>
							<span id="jadwal2" style="display:none;"><?php
								$q="select * from jam_kerja join hari on hari.hari_id=jam_kerja.hari_id where gid=$gid order by hari.hari_id";
								$res=pg_query($q);
								echo '<ul style="padding-left:20px;">';
								while($rowj = pg_fetch_array($res)){
									$hrid = $rowj['hari_id'];
									$hr = $rowj['hari'];
									$jb = substr($rowj['jam_buka'],0,-3);
									$jt = substr($rowj['jam_tutup'],0,-3);
									if ($day==$hrid){
										echo '<li><span style="display:inline-block;width:55px;font-weight:bold;">'.$hr.'</span>'.$jb.' - '.$jt.' <span style="color:'.$warna.'">('.$stat.')</span></li>';
									}else{
										echo '<li><span style="display:inline-block;width:55px;font-weight:bold;">'.$hr.'</span>'.$jb.' - '.$jt.'</li>';
									}
								}
								echo '</ul>'
							?></span><div>
							<a href="?page=formj&gid=<?php echo $gid ?>" class="btn btn-success btn-sm btn-flat"><i class="fa fa-edit"></i> Set Jadwal</a></div></td></tr>
						<tr><td><b>Layanan<b> </td><td>: </td><td><ul style="padding-left:20px;"><?php 
							$queryl = "select * from layanan_bengkel join layanan on layanan_bengkel.layanan_id=layanan.layanan_id where gid=$gid order by layanan_bengkel.layanan_id";
							$hasill=pg_query($queryl);
							while($rowl = pg_fetch_array($hasill)){
								echo '<li>'.$rowl['jenis_layanan'].'</li>';
							}
						?></ul><a href="?page=forml&gid=<?php echo $gid ?>" class="btn btn-success btn-sm btn-flat"><i class="fa fa-edit"></i> Set Layanan</a></td></tr>
						<tr><td><b>Deskripsi<b> </td><td>: </td><td><?php echo $deskripsi ?></td></tr>
						<tr><td><b>Data Spasial<b> </td><td>: </td><td><b>Latitude</b> : <?php echo $lat ?> <b>Longitude</b> : <?php echo $lng ?></td></tr>
					</tbody>
				</table>
			</div><!-- /.box-body -->
			<div class="box-footer">
				<div class="btn-group">
					<a href="?page=formupd&gid=<?php echo $gid ?>" class="btn btn-default"><i class="fa fa-edit"></i> Data atribut</a>
					<a href="?page=updates&gid=<?php echo $gid ?>" class="btn btn-default"><i class="fa fa-edit"></i> Data spasial</a>
				</div>
			</div><!-- /.box-footer-->
		</div><!-- /.box -->
	</div>
	<div class="col-lg-5 col-xs-5">
		<div class="box">
			<div class="box-header with-border">
			  <h2 class="box-title">Foto</h2>
			</div>
			<div class="box-body">
				<img src="../image/foto/<?php echo "$foto"; ?>" style="width:100%;;">
			</div>
			<div class="box-footer">
				<div class="btn-group">
					<a href="?page=formupl&gid=<?php echo $gid ?>" class="btn btn-default"><i class="fa fa-picture-o"></i> Ganti Foto</a>
				</div>
			</div><!-- /.box-footer-->
		</div>
	</div>
</div>
<script>
	function togglejad(){
		if($('#jadwal2').css('display') == 'none'){
			$('#jadwal1').css('display','none');
			$("#jadwal2").fadeIn();
		}else{
			$("#jadwal2").css('display','none');
			$("#jadwal1").fadeIn();
		}
	}
</script>