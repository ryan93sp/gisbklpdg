<?php
include("inc/connect.php");

$passwordlama = $_POST["passlama"];
$passlama = md5(md5($passwordlama));
$passwordbaru = $_POST["passbaru"];
$passbaru = md5(md5($passwordbaru));
$konfirmasipassword = $_POST["konfirm"];
$username = $_POST["user"];

	$querycek = pg_query("select * from login where username = '$username' and password = '$passlama'");
	$count = pg_num_rows($querycek);
	
	if ($count >= 1 && $passwordbaru==$konfirmasipassword){
	$queryupdate = pg_query("update login set password = '$passbaru' where username = '$username'");
		if($queryupdate){
		 header("location:index.php?page=profil");
		}
	}
	else {
		echo 'error';
	}
?>