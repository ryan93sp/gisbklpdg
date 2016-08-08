<?php
include ('../inc/connect.php');
$gid = $_POST['gid'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$telepon = $_POST['telepon'];
$kendaraan = $_POST['selectken'];
$jenis = $_POST['selectjenis'];
$des = $_POST['deskripsi'];
$sql = pg_query("update bengkel_region set nama_bengkel='$nama', alamat='$alamat', telpon='$telepon', kendaraan_id='$kendaraan', jenis_id='$jenis', deskripsi='$des' where gid='$gid'");
if ($sql){
	header("location:../?page=detail&gid=$gid");
}else {
	echo 'error';
}
?>