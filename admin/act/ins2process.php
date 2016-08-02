<?php
include ('../inc/connect.php');
$gid = $_POST['gid'];
$hari = $_POST['hari'];
$buka = $_POST['buka'];
$tutup = $_POST['tutup'];

$kendaraan = $_POST['kendaraan'];
$layanan = $_POST['layanan'];

$counth = count($hari);
$sqlj   = "insert into jam_kerja (gid, hari_id, jam_buka, jam_tutup) VALUES ";
 
for( $i=0; $i < $counth; $i++ ){
	$sqlj .= "('{$gid}','{$hari[$i]}','{$buka[$i]}','{$tutup[$i]}')";
	$sqlj .= ",";
}
$sqlj = rtrim($sqlj,",");
$insert = pg_query($sqlj);

if ($insert){
	$countl = count($layanan);
	$sqll   = "insert into layanan_bengkel (gid, kendaraan_id, layanan_id) VALUES ";

	for( $i=0; $i < $countl; $i++ ){
		$sqll .= "('{$gid}','{$kendaraan}','{$layanan[$i]}')";
		$sqll .= ",";
	}
	$sqll = rtrim($sqll,",");
	$insert2 = pg_query($sqll);
	if ($insert2){
		header("location:../?page=detail&gid=$gid");
	}
	else{
		echo 'error';
		header("location:../?page=detail&gid=$gid");
	}
}
else {
	echo 'error';
	//header("location:./?q=0&msg=".pg_error());
}
?>