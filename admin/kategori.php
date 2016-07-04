<?php
include ('inc/connect.php');
$id=$_GET["id"];
$dataarray=array();
 
$sql=pg_query("SELECT * from kategori where kendaraan_id=$id");
			
while($row = pg_fetch_array($sql)){
	$id=$row['kat_id'];
	$kategori=$row['kat_nama'];
	$dataarray[]=array('id'=>$id,'kategori'=>$kategori);
}
echo json_encode ($dataarray);
   			  
?>