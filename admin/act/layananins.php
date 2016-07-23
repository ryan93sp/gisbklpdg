<?php
include ('../inc/connect.php');

$query = pg_query("SELECT MAX(layanan_id) AS id FROM layanan");
$result = pg_fetch_array($query);
$idmax = $result['id'];
if ($idmax==null) {$idmax=1;}
else {$idmax++;}
					
$layanan = $_POST['layanan'];


$count = count($layanan);
$sql  = "insert into layanan (layanan_id, jenis_layanan) VALUES ";
 
for( $i=0; $i < $count; $i++ ){
	$sql .= "('{$idmax}','{$layanan[$i]}')";
	$sql .= ",";
	$idmax++;
}
$sql = rtrim($sql,",");
$insert = pg_query($sql);

if ($insert){
	header("location:../?page=layanan");
}else{
	echo 'error';
}
?>