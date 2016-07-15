<?php
	include ('../inc/connect.php');
	$user = $_POST['username'];
	$password = $_POST['password'];
	$pass = md5(md5($password));
		
	$sql = pg_query("insert into login (username, password) values ('$user', '$pass')");
	if ($sql){
		header("location:../?page=user");
		//echo 'sukses';
	}
	else {
		echo 'error';
	}
?>