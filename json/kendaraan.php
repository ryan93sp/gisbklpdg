<?php
include ('connect.php');
$dataarray=array();
 
$sql=pg_query("SELECT * from jenis_kendaraan");
			
while($row = pg_fetch_array($sql)){
	$id=$row['jenis_kendaraan_id'];
	$kendaraan=$row['nama_kendaraan'];
	$dataarray[]=array('id'=>$id,'kendaraan'=>$kendaraan);
}
echo json_encode ($dataarray);
   			  
?>