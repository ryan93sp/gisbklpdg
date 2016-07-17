<?php
require 'connect.php';
$id=$_GET["id"];
date_default_timezone_set('Asia/Jakarta');
$day=date("w");
$querysearch="SELECT bengkel_region.gid,nama_bengkel,alamat,telpon,jam_buka,jam_tutup,ST_X(ST_Centroid(geom)) AS lng, ST_Y(ST_CENTROID(geom)) As lat FROM bengkel_region join jam_kerja on jam_kerja.gid=bengkel_region.gid where jenis_id='$id' and hari_id=$day";
$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil))
	{
		$gid=$row['gid'];
		$nama_bengkel=$row['nama_bengkel'];
		$alamat=$row['alamat'];
		$telpon=$row['telpon'];
		$jam_buka=$row['jam_buka'];
		$jam_tutup=$row['jam_tutup'];
		$longitude=$row['lng'];
		$latitude=$row['lat'];

		$dataarray[]=array('gid'=>$gid,'nama_bengkel'=>$nama_bengkel,'alamat'=>$alamat,'telpon'=>$telpon,'jam_buka'=>$jam_buka,'jam_tutup'=>$jam_tutup,'longitude'=>$longitude,'latitude'=>$latitude);
	}
echo json_encode ($dataarray);
?>