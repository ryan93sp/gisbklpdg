<?php
include ('../inc/connect.php');
			
$merk = $_POST['merk'];
$kendaraan = $_POST['kendaraan'];
$count = count($merk);

$sql  = "insert into kendaraan (jenis_kendaraan_id, merk_id) VALUES ";
for( $i=0; $i < $count; $i++ ){
	echo $merk[$i];
	
	$q1 = pg_query("select * from merk where nama_merk='$merk[$i]'");
	$r1 = pg_fetch_array($q1);
	$merk_id = $r1['merk_id'];
	$merk_j = $r1['nama_merk'];

	if($r1['nama_merk']==$merk[$i]){
		$sql .= "('{$kendaraan[$i]}','{$merk_id}')";
		$sql .= ",";
	}else{
		$query = pg_query("SELECT MAX(merk_id) AS id FROM merk");
		$result = pg_fetch_array($query);
		$idmax = $result['id'];
		if ($idmax==null) {$idmax=1;}
		else {$idmax++;}
		echo $idmax;
		$insertmerk = pg_query("insert into merk (merk_id, nama_merk) values ('$idmax', '$merk[$i]')");
		$sql .= "('{$kendaraan[$i]}','{$idmax}')";
		$sql .= ",";
	}
}
$sql = rtrim($sql,",");
$insert = pg_query($sql);

if ($insert){
	header("location:../?page=kendaraan");
}else{
	echo 'error';
}
?>