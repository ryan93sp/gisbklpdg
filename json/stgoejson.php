<?php
include('connect.php');
$querysearch="select st_asgeojson(geom) as aa from bengkel_region"; 
$hasil=pg_query($querysearch);
  while($data=pg_fetch_array($hasil)){
	  $load=$data['aa'];
	  echo $load;
  }
  //echo $load;
?>