<?php
require 'connect.php';
$gid = $_GET["gid"];
$querysearch	="select jenis_layanan from layanan_bengkel join layanan on layanan.layanan_id=layanan_bengkel.layanan_id where gid=$gid";
			   
$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil))
	{
		$layanan=$row['jenis_layanan'];
		$dataarray[]=array('layanan'=>$layanan);
	}
echo json_encode ($dataarray);
?>
