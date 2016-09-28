<?php
require 'connect.php';
$gid=$_GET["gid"];
date_default_timezone_set('Asia/Jakarta');
$day=date("w");
$querysearch="SELECT bengkel_region.gid,nama_bengkel,alamat,telpon,jam_buka,jam_tutup,hari,foto,nama_kendaraan,nama_merk,ST_X(ST_Centroid(geom)) AS lng, ST_Y(ST_CENTROID(geom)) As lat FROM bengkel_region join jam_kerja on jam_kerja.gid=bengkel_region.gid join merk on merk.merk_id=bengkel_region.merk_id join jenis_kendaraan on jenis_kendaraan.jenis_kendaraan_id=bengkel_region.jenis_kendaraan_id join hari on  hari.hari_id=jam_kerja.hari_id where bengkel_region.gid=$gid and jam_kerja.hari_id=$day";
$hasil=pg_query($querysearch);
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
	$jam_buka=$row['jam_buka'];
	$jam_tutup=$row['jam_tutup'];
	$longitude=$row['lng'];
	$latitude=$row['lat'];
	$dataarray[]=array('gid'=>$gid,'nama_bengkel'=>$nama,'alamat'=>$alamat,'telpon'=>$telpon,'hari'=>$hari,'foto'=>$foto,'kendaraan'=>$kendaraan,'merk'=>$merk,'deskripsi'=>$deskripsi,'jam_buka'=>$jam_buka,'jam_tutup'=>$jam_tutup,'longitude'=>$longitude,'latitude'=>$latitude);
}
echo json_encode ($dataarray);
?>