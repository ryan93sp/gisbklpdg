<?php
require 'connect.php';
$id = $_GET["id"];

$querysearch = "SELECT count(*) as review, AVG(rating) AS rating FROM rating_bengkel where gid=$id";
			   
$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil)){
	$rating=$row['rating'];
	$review=$row['review'];
	$dataarray[]=array('rating'=>$rating,'review'=>$review);
}
echo json_encode ($dataarray);
?>
