<?php
include('connect.php');
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
$querysearch="SELECT row_to_json(fc) FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features FROM (SELECT 'Feature' As type , ST_AsGeoJSON(loc.geom)::json As geometry , row_to_json((SELECT l FROM (SELECT gid, kecamatan) As l )) As properties FROM kecamatan_region As loc where gid in ($c)) As f ) As fc"; 

$hasil=pg_query($querysearch);
while($data=pg_fetch_array($hasil)){
		$load=$data['row_to_json'];
	}	
	echo $load;	
?>