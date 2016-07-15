<?php
include ('connect.php');
$id=$_GET["id"];
$dataarray=array();
 
$sql=pg_query("SELECT * from kategori where kendaraan_id=$id");
			
while($row = pg_fetch_array($sql)){
	$id=$row['jenis_id'];
	$kategori=$row['jenis_nama'];
	$dataarray[]=array('id'=>$id,'kategori'=>$kategori);
}
echo json_encode ($dataarray);
   			  
?>