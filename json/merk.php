<?php
include ('connect.php');
$id=$_GET["id"];
$dataarray=array();
 
$sql=pg_query("SELECT merk.merk_id,nama_merk from kendaraan join merk on merk.merk_id=kendaraan.merk_id where jenis_kendaraan_id=$id order by kendaraan.merk_id");
			
while($row = pg_fetch_array($sql)){
	$id=$row['merk_id'];
	$merk=$row['nama_merk'];
	$dataarray[]=array('id'=>$id,'merk'=>$merk);
}
echo json_encode ($dataarray); 			  
?>