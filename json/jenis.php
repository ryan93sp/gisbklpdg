<?php
include ('connect.php');
$id=$_GET["id"];
$dataarray=array();
 
$sql=pg_query("SELECT * from jenis_bengkel where kendaraan_id=$id");
			
while($row = pg_fetch_array($sql)){
	$id=$row['jenis_id'];
	$jenis=$row['jenis_nama'];
	$dataarray[]=array('id'=>$id,'jenis'=>$jenis);
}
echo json_encode ($dataarray);
   			  
?>