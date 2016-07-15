<?php
include ('../inc/connect.php');
$gid = $_POST['gid'];
$hari = $_POST['hari'];
$buka = $_POST['buka'];
$tutup = $_POST['tutup'];


$sqldel = "delete from jam_kerja where gid=$gid";
$delete = pg_query($sqldel);

$counth = count($hari);
$sqlj   = "insert into jam_kerja (gid, hari_id, jam_buka, jam_tutup) VALUES ";
 
for( $i=0; $i < $counth; $i++ ){
	$sqlj .= "('{$gid}','{$hari[$i]}','{$buka[$i]}','{$tutup[$i]}')";
	$sqlj .= ",";
}
$sqlj = rtrim($sqlj,",");
$insert = pg_query($sqlj);

if ($insert  && $delete){
	header("location:../?page=detail&gid=$gid");
}
else {
	echo 'error';
	//header("location:./?q=0&msg=".pg_error());
}
?>