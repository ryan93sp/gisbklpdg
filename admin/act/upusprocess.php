<?php
	include ('../inc/connect.php');
	$user = $_POST['username'];
	$password = $_POST['password'];
	$pass = md5(md5($password));
	$sql = pg_query("update login set password='$pass' where username='$user'");
	if ($sql){
		header("location:../?page=user");
	}
	else {
		echo 'error';
	}
?>