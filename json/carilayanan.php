<?php
require 'connect.php';
//$carinama=$_GET["carinama"];
date_default_timezone_set('Asia/Jakarta');
$day=date("w");

$lay=$_GET['lay'];
$lay = explode(",", $lay);
$c = "";
for($i=0;$i<count($lay);$i++){
	if($i == count($lay)-1){
		$c .= "'".$lay[$i]."'";
	}else{
		$c .= "'".$lay[$i]."',";
	}
}

$querysearch="select bengkel_region.gid,nama_bengkel,alamat,telpon,(select jam_buka from jam_kerja where jam_kerja.gid=bengkel_region.gid and hari_id=$day),(select jam_tutup from jam_kerja where jam_kerja.gid=bengkel_region.gid and hari_id=$day),ST_X(ST_Centroid(geom)) AS lng, ST_Y(ST_CENTROID(geom)) As lat from bengkel_region left join jam_kerja on jam_kerja.gid=bengkel_region.gid join layanan_bengkel on bengkel_region.gid=layanan_bengkel.gid where layanan_id in ($c) and hari_id=$day group by bengkel_region.gid having count(layanan_id)=$i";
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