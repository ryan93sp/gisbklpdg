<?php
include ('../inc/connect.php');

$id	= $_POST['id_layanan'];
$layanan = $_POST['layanan'];

$sql  = "update layanan set jenis_layanan='$layanan' where layanan_id=$id";
$insert = pg_query($sql);

if ($insert){
	header("location:../?page=layanan");
}else{
	echo 'error';
}
?>