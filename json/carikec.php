<?php
require 'connect.php';

date_default_timezone_set('Asia/Jakarta');
$day=date("w");

$kec=$_GET['kec'];
$kec = explode(",", $kec);
$c = "";
for($i=0;$i<count($kec);$i++){
	if($i == count($kec)-1){
		$c .= "'".$kec[$i]."'";
	}else{
		$c .= "'".$kec[$i]."',";
	}
}
$querysearch = pg_query("SELECT bengkel_region.gid,nama_bengkel,alamat,telpon,jam_buka,jam_tutup,st_x(st_centroid(bengkel_region.geom)) as longitude,st_y(st_centroid(bengkel_region.geom)) as latitude from bengkel_region, kecamatan_region as k, jam_kerja WHERE st_contains(k.geom, bengkel_region.geom) and k.gid in ($c) and bengkel_region.gid=jam_kerja.gid and hari_id=$day");

while ($row=pg_fetch_assoc($querysearch))
$data[]=$row;
echo json_encode($data);

?>