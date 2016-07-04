<?php
include ('inc/connect.php');
$gid = $_POST['gid'];
$kendaraan = $_POST['kendaraan'];
$layanan = $_POST['layanan'];


$sqldel = "delete from layanan_bengkel where gid=$gid";
$delete = pg_query($sqldel);

$countl = count($layanan);
$sqll   = "insert into layanan_bengkel (gid, kendaraan_id, layanan_id) VALUES ";

for( $i=0; $i < $countl; $i++ ){
	$sqll .= "('{$gid}','{$kendaraan}','{$layanan[$i]}')";
	$sqll .= ",";
}
$sqll = rtrim($sqll,",");
$insert = pg_query($sqll);
if ($insert && $delete){
	header("location:index.php?page=detail&gid=$gid");
}
else{
	echo 'error';
}

?>