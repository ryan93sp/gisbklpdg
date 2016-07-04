<?php
require 'inc/connect.php';
$gid=$_GET['gid'];
$ken=$_GET['ken'];

$querysearch="select * from layanan_detail join layanan on layanan_detail.layanan_id=layanan.layanan_id where kendaraan_id=$ken";
$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil))
	{
		$layid=$row['layanan_id'];
		$layanan=$row['jenis_layanan'];

		$dataarray[]=array('layid'=>$layid,'layanan'=>$layanan);
	}
echo json_encode ($dataarray);
?>