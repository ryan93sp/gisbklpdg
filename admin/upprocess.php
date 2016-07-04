<?php
include ('inc/connect.php');
$gid = $_POST['gid'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$telepon = $_POST['telepon'];
$kat = $_POST['selectkat'];
$des = $_POST['deskripsi'];

$sql = pg_query("update bengkel_region set nama_bengkel='$nama', alamat='$alamat', telpon='$telepon', kat_id='$kat', deskripsi='$des' where gid='$gid'");
if ($sql){
	header("location:index.php?page=detail&gid=$gid");
}
else {
	echo 'error';
	//header("location:./?q=0&msg=".pg_error());
}
?>