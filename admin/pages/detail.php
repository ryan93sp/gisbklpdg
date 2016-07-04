<?php
require 'inc/connect.php';
$gid=$_GET["gid"];
date_default_timezone_set('Asia/Jakarta');
$day=date("w");
$query="SELECT bengkel_region.gid,nama_bengkel,alamat,telpon,jam_buka,jam_tutup,hari,foto,kendaraan,kat_nama,deskripsi,ST_X(ST_Centroid(geom)) AS lng, ST_Y(ST_CENTROID(geom)) As lat,kategori.kendaraan_id FROM bengkel_region join jam_kerja on jam_kerja.gid=bengkel_region.gid join kategori on kategori.kat_id=bengkel_region.kat_id join jenis_kendaraan on jenis_kendaraan.kendaraan_id=kategori.kendaraan_id join hari on  hari.hari_id=jam_kerja.hari_id where bengkel_region.gid=$gid and jam_kerja.hari_id=$day";
$hasil=pg_query($query);
while($row = pg_fetch_array($hasil)){
	$gid=$row['gid'];
	$nama=$row['nama_bengkel'];
	$alamat=$row['alamat'];
	$telpon=$row['telpon'];
	$hari=$row['hari'];
	$foto=$row['foto'];
	$kendaraan=$row['kendaraan'];
	$kendaraanid=$row['kendaraan_id'];
	$kategori=$row['kat_nama'];
	$deskripsi=$row['deskripsi'];
	$jam_buka=$row['jam_buka'];
	$jam_tutup=$row['jam_tutup'];

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
}
?>
<!-- Default box -->
<div class="box">
<div class="box-header with-border">
  <h2 class="box-title" style="text-transform:capitalize;"><?php echo $nama ?></h2>
</div>
<div class="box-body">
	<table>
		<tbody  style='vertical-align:top;'>
			<tr><td><b>Alamat</b></td><td> :&nbsp; </td><td style='text-transform:capitalize;'><?php echo $alamat ?></td></tr>
			<tr><td><b>Telepon</b></td><td>:</td><td><?php echo $telpon ?></td></tr>
			<tr><td><b>Kendaraan</b></td> <td> :</td><td><?php echo $kendaraan ?></td></tr>
			<tr><td><b>Bengkel<b> </td><td>: </td><td><?php echo $kategori ?></td></tr>
			<tr><td><b>Jadwal Operasional</b>&nbsp;</td><td> :</td><td><span style='color:<?php echo $warna ?>;'><?php echo $stat ?></span><?php echo ' '.$hari.' '.$jam_buka.'-'.$jam_tutup ?><br><a href="index.php?page=formj&gid=<?php echo $gid ?>" class="btn btn-info btn-sm btn-flat"><i class="fa fa-edit"></i> Jadwal Operasional</a></td></tr>
			<tr><td><b>Layanan<b> </td><td>: </td><td><ul style="padding-left:20px;"><?php 
				$queryl = "select * from layanan_bengkel join layanan on layanan_bengkel.layanan_id=layanan.layanan_id where gid=$gid and kendaraan_id=$kendaraanid";
				$hasill=pg_query($queryl);
				while($rowl = pg_fetch_array($hasill)){
					echo '<li>'.$rowl['jenis_layanan'].'</li>';
				}
			?></ul><a href="index.php?page=forml&gid=<?php echo $gid ?>" class="btn btn-info btn-sm btn-flat"><i class="fa fa-edit"></i> Layanan</a></td></tr>
			<tr><td><b>Deskripsi<b> </td><td>: </td><td><?php echo $deskripsi ?></td></tr>
		</tbody>
	</table>
</div><!-- /.box-body -->
<div class="box-footer">
	<div class="btn-group">
		<a href="index.php?page=form&gid=<?php echo $gid ?>" class="btn btn-default">Ubah data atribut <i class="fa fa-pencil"></i></a>
		<a href="index.php?page=updates&gid=<?php echo $gid ?>" class="btn btn-default">Ubah data spasial <i class="fa fa-pencil"></i></a>
	</div>
</div><!-- /.box-footer-->
</div><!-- /.box -->