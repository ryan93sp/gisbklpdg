<?php
require 'connect.php';
$id = $_GET["id"];
$querysearch = "SELECT * FROM rating_bengkel where gid=$id order by time DESC limit 10";
			   
$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil))
	{
		$pengguna=$row['pengguna'];
		$rating=$row['rating'];
		$komentar=$row['komentar'];
		$time=$row['time'];
		$dataarray[]=array('pengguna'=>$pengguna,'rating'=>$rating,'komentar'=>$komentar,'time'=>$time);
	}
echo json_encode ($dataarray);
?>
