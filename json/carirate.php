<?php
require 'connect.php';
$rate=$_GET["rate"];
date_default_timezone_set('Asia/Jakarta');
$day=date("w");
if ($rate==1){
	$querysearch="select bengkel_region.gid,nama_bengkel,alamat,telpon,(select jam_buka from jam_kerja where jam_kerja.gid=bengkel_region.gid and hari_id=$day),(select jam_tutup from jam_kerja where jam_kerja.gid=bengkel_region.gid and hari_id=$day),ST_X(ST_Centroid(geom)) AS lng, ST_Y(ST_CENTROID(geom)) As lat from rating_bengkel right join bengkel_region on rating_bengkel.gid=bengkel_region.gid group by bengkel_region.gid having avg(rating) <= 1 or avg(rating) is null";
}else{
	$querysearch="select bengkel_region.gid,nama_bengkel,alamat,telpon,(select jam_buka from jam_kerja where jam_kerja.gid=bengkel_region.gid and hari_id=$day),(select jam_tutup from jam_kerja where jam_kerja.gid=bengkel_region.gid and hari_id=$day),ST_X(ST_Centroid(geom)) AS lng, ST_Y(ST_CENTROID(geom)) As lat from rating_bengkel right join bengkel_region on rating_bengkel.gid=bengkel_region.gid group by bengkel_region.gid having avg(rating) <= $rate and avg(rating) > $rate-1";
}
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