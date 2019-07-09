<?php
header('Content-Type: application/json');
include('connect.php');
$querysearch="SELECT row_to_json(fc) FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features FROM (SELECT 'Feature' As type , ST_AsGeoJSON(loc.geom)::json As geometry , row_to_json((SELECT l FROM (SELECT kecamatan) As l )) As properties FROM kecamatan_region As loc) As f ) As fc"; 

$hasil=pg_query($querysearch);
while($data=pg_fetch_array($hasil)){
	$load=$data['row_to_json'];
}
echo $load;	
?>