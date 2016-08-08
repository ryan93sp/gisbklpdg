<?php
include ('connect.php');
$id=$_GET["id"];
$dataarray=array();
 
$sql=pg_query("SELECT distinct jenis_bengkel.jenis_id,jenis_nama from jenis_bengkel join bengkel_region on bengkel_region.jenis_id=jenis_bengkel.jenis_id where kendaraan_id=$id order by jenis_bengkel.jenis_id");
			
while($row = pg_fetch_array($sql)){
	$id=$row['jenis_id'];
	$jenis=$row['jenis_nama'];
	$dataarray[]=array('id'=>$id,'jenis'=>$jenis);
}
echo json_encode ($dataarray);
   			  
?>