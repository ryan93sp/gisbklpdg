<?php
include ('../inc/connect.php');
$gid = $_POST['gid'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$telepon = $_POST['telepon'];
$kendaraan = $_POST['selectken'];
$merk = $_POST['selectmerk'];
$des = $_POST['deskripsi'];
$geom = $_POST['geom'];

$sql = pg_query("insert into bengkel_region (gid, nama_bengkel, alamat, telpon, foto, merk_id, kendaraan_id, deskripsi, geom) values ('$gid', '$nama', '$alamat', '$telepon', 'null', '$merk', '$kendaraan', '$des', ST_GeomFromText('$geom', 4326))");
if ($sql){
	header("location:../?page=formjl&gid=$gid");
}
else {
	echo 'error';
	//header("location:./?q=0&msg=".pg_error());
}
?>