<?php 
include ('../inc/connect.php');
$gid = $_POST['gid'];
	
	$jenis_gambar=$_FILES['image']['type'];
	if(($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif"  || $jenis_gambar=="image/png") && ($_FILES["image"]["size"] <= 500000)){
		$sourcename=$_FILES["image"]["name"];
		$name=$gid.'_'.$sourcename;
		$filepath="../../img/foto/".$name;
		move_uploaded_file($_FILES["image"]["tmp_name"],$filepath);
		$sql = pg_query("update bengkel_region set foto='$name' where gid='$gid'");
		if($sql){
			header("location:../?page=detail&gid=$gid");
		}
	}
	else{
		echo "Gambar tidak valid!<br>";
		echo "Kembali ke <a href='../?page=detail&gid=$gid'>halaman detail</a>";
	}
?>