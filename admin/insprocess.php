<?php
include ('inc/connect.php');
$gid = $_POST['gid'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$telepon = $_POST['telepon'];
$kat = $_POST['selectkat'];
$des = $_POST['deskripsi'];

$sql = pg_query("insert into bengkel_region (gid, nama_bengkel, alamat, telpon, foto, kat_id, deskripsi) values ('$gid', '$nama', '$alamat', '$telepon', 'null', '$kat', '$des')");
if ($sql){
	header("location:index.php?page=formjl&gid=$gid");
}
else {
	echo 'error';
	//header("location:./?q=0&msg=".pg_error());
}
?>