<?php
require 'connect.php';
$id = $_GET["id"];
$querysearch	="select jenis_layanan from layanan_bengkel join layanan on layanan_bengkel.layanan_id=layanan.layanan_id where gid=$id";
			   
$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil))
	{
		$layanan=$row['jenis_layanan'];
		$dataarray[]=array('layanan'=>$layanan);
	}
echo json_encode ($dataarray);
?>
