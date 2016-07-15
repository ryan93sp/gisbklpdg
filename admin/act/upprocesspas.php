<?php
include ('../inc/connect.php');
$gid = $_POST['gid'];
$geom = $_POST['geom'];

$sql = pg_query("update bengkel_region set geom=ST_GeomFromText('$geom', 4326) where gid='$gid'");
if ($sql){
	header("location:../?page=detail&gid=$gid");
}
else {
	echo 'error';
	//header("location:./?q=0&msg=".pg_error());
}
?>