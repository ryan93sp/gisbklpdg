<?php
require 'connect.php';
$gid = $_GET["gid"];
$querysearch="select * from jam_kerja join hari on hari.hari_id=jam_kerja.hari_id where gid=$gid order by hari.hari_id";
			   
$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil))
	{
		$hari_id=$row['hari_id'];
		$hari=$row['hari'];
		$jam_buka=$row['jam_buka'];
		$jam_tutup=$row['jam_tutup'];
		$dataarray[]=array('hari_id'=>$hari_id,'hari'=>$hari,'jam_buka'=>$jam_buka,'jam_tutup'=>$jam_tutup);
	}
echo json_encode ($dataarray);
?>
