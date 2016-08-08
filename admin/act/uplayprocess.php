<?php
include ('../inc/connect.php');
$gid = $_POST['gid'];
$layanan = $_POST['layanan'];

$sqldel = "delete from layanan_bengkel where gid=$gid";
$delete = pg_query($sqldel);

$countl = count($layanan);
$sqll   = "insert into layanan_bengkel (gid, layanan_id) VALUES ";
for( $i=0; $i < $countl; $i++ ){
	$sqll .= "('{$gid}','{$layanan[$i]}')";
	$sqll .= ",";
}
$sqll = rtrim($sqll,",");
$insert = pg_query($sqll);
if ($insert && $delete){
	header("location:../?page=detail&gid=$gid");
}
else{
	echo 'error';
	header("location:../?page=detail&gid=$gid");
}

?>