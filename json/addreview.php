<?php
require 'connect.php';
date_default_timezone_set('Asia/Jakarta');
$gid = htmlspecialchars($_GET["gid"]);
$pengguna = htmlspecialchars($_GET["pengguna"]);
$rating = htmlspecialchars($_GET["rating"]);
$komentar = htmlspecialchars($_GET["komentar"]);
$time = date('Y/m/d H:i:s');

$query = "insert into rating_bengkel (gid,pengguna,rating,komentar,time) values ($gid,'$pengguna',$rating,'$komentar','$time')";

//$result = pg_query($query);
if (!$result = @pg_query($query)){
  echo '[{"error":"true"}]';
  exit;
}else{echo '[{"error":"false"}]';
  exit;}
?>
