<?php
// $time adalah tanggal dari table, dibuat seperti ini dulu
date_default_timezone_set('Asia/Jakarta');
$buka = strtotime('06:00:00');
$newbuka = date('H:i:s',$buka);
$tutup = strtotime('08:00:00');
$newtutup = date('H:i:s',$tutup);
$now = date('H:i:s');

if($now >= $newbuka && $now <= $newtutup){
echo "Buka - ";
echo $newbuka.'<br>';
}else{
echo "Tutup - ";
echo $now.'<br>';
}
?>