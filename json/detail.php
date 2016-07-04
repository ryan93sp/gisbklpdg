<?php
require 'connect.php';
$gid=$_GET["gid"];
date_default_timezone_set('Asia/Jakarta');
$day=date("w");
$querysearch="SELECT bengkel_region.gid,nama_bengkel,alamat,telpon,jam_buka,jam_tutup,hari,foto,kendaraan,kat_nama,ST_X(ST_Centroid(geom)) AS lng, ST_Y(ST_CENTROID(geom)) As lat FROM bengkel_region join jam_kerja on jam_kerja.gid=bengkel_region.gid join kategori on kategori.kat_id=bengkel_region.kat_id join jenis_kendaraan on jenis_kendaraan.kendaraan_id=kategori.kendaraan_id join hari on  hari.hari_id=jam_kerja.hari_id where bengkel_region.gid=$gid and jam_kerja.hari_id=$day"; 
$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil))
	{
		$gid=$row['gid'];
		$nama_bengkel=$row['nama_bengkel'];
		$alamat=$row['alamat'];
		$telpon=$row['telpon'];
		$hari=$row['hari'];
		$foto=$row['foto'];
		$kendaraan=$row['kendaraan'];
		$kategori=$row['kat_nama'];
		$deskripsi=$row['deskripsi'];
		$jam_buka=$row['jam_buka'];
		$jam_tutup=$row['jam_tutup'];
		$longitude=$row['lng'];
		$latitude=$row['lat'];

		$dataarray[]=array('gid'=>$gid,'nama_bengkel'=>$nama_bengkel,'alamat'=>$alamat,'telpon'=>$telpon,'hari'=>$hari,'foto'=>$foto,'kendaraan'=>$kendaraan,'kategori'=>$kategori,'deskripsi'=>$deskripsi,'jam_buka'=>$jam_buka,'jam_tutup'=>$jam_tutup,'longitude'=>$longitude,'latitude'=>$latitude);
	}
echo json_encode ($dataarray);
?>