<?php
include ('../inc/connect.php');

$query = pg_query("SELECT MAX(jenis_id) AS id FROM jenis_bengkel");
$result = pg_fetch_array($query);
$idmax = $result['id'];
if ($idmax==null) {$idmax=1;}
else {$idmax++;}
					
$jenis = $_POST['jenis'];


$count = count($jenis);
$sql  = "insert into jenis_bengkel (jenis_id, jenis_nama) VALUES ";
 
for( $i=0; $i < $count; $i++ ){
	$sql .= "('{$idmax}','{$jenis[$i]}')";
	$sql .= ",";
	$idmax++;
}
$sql = rtrim($sql,",");
$insert = pg_query($sql);

if ($insert){
	header("location:../?page=jenis");
}else{
	echo 'error';
}
?>