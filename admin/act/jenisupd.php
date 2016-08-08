<?php
include ('../inc/connect.php');

$id	= $_POST['id_jenis'];
$jenis = $_POST['jenis'];

$sql  = "update jenis_bengkel set jenis_nama='$jenis' where jenis_id=$id";
$insert = pg_query($sql);

if ($insert){
	header("location:../?page=jenis");
}else{
	echo 'error';
}
?>