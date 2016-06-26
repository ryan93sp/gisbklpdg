<?php
include ('connect.php');
$id=$_GET["id"];
$dataarray=array();
 
$sql=pg_query("SELECT * from layanan where kendaraan_id=$id");
			
while($row = pg_fetch_array($sql)){
	$id=$row['layanan_id'];
	$lay=$row['jenis_layanan'];
	$dataarray[]=array('id'=>$id,'layanan'=>$lay);
}
echo json_encode ($dataarray);
   			  
?>