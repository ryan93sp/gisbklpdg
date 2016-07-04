<?php
include ('connect.php');
$id=$_GET["id"];
$dataarray=array();
 
$sql=pg_query("SELECT * from layanan_detail as a join layanan as b on a.layanan_id=b.layanan_id where kendaraan_id=$id");
			
while($row = pg_fetch_array($sql)){
	$id=$row['layanan_id'];
	$lay=$row['jenis_layanan'];
	$dataarray[]=array('id'=>$id,'layanan'=>$lay);
}
echo json_encode ($dataarray);
   			  
?>