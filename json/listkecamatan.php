<?php
include ('connect.php');
$dataarray=array();
 
$sql=pg_query("SELECT gid, kecamatan from kecamatan_region Order by kecamatan asc");
			
while($row = pg_fetch_array($sql))
	{
		  $gid=$row['gid'];
		  $kecamatan=$row['kecamatan'];
		  $dataarray[]=array('gid'=>$gid,'kecamatan'=>$kecamatan);
	}
echo json_encode ($dataarray);
   			  
?>