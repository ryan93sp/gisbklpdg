<?php
include ('connect.php');
$id=$_GET["id"];
$dataarray=array();
 
$sql=pg_query("select distinct layanan.layanan_id,jenis_layanan from bengkel_region,layanan_bengkel,layanan where layanan_bengkel.layanan_id=layanan.layanan_id and bengkel_region.gid=layanan_bengkel.gid and jenis_kendaraan_id=$id order by layanan.layanan_id");
			
while($row = pg_fetch_array($sql)){
	$id=$row['layanan_id'];
	$lay=$row['jenis_layanan'];
	$dataarray[]=array('id'=>$id,'layanan'=>$lay);
}
echo json_encode ($dataarray);
   			  
?>