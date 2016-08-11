<?php
include ('../inc/connect.php');
$id=$_GET["id"];
$dataarray=array();
 
$sql=pg_query("select * from jenis_bengkel join merk on merk.merk_id=jenis_bengkel.merk_id where kendaraan_id=$id");
			
while($row = pg_fetch_array($sql)){
	$id=$row['merk_id'];
	$merk=$row['merk_jenis'];
	$dataarray[]=array('id'=>$id,'merk'=>$merk);
}
echo json_encode ($dataarray); 			  
?>