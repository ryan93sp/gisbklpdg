<?php
$kec='1,2,3,4';
echo $kec;
$kec = explode(",", $kec);
$c = "";
for($i=0;$i<count($kec);$i++){
	if($i == count($kec)-1){
		$c .= "'".$kec[$i]."'";
	}else{
		$c .= "'".$kec[$i]."',";
	}
}
echo $i;
?>