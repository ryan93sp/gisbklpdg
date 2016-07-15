<?php
include ('../inc/connect.php');
session_start();
//jika ditekan tombol login
if(isset($_POST['username'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$pass = md5(md5($password));
	$sql = pg_query("SELECT * FROM login WHERE username='$username' and password='$pass'");
	$num = pg_num_rows($sql);
	$dt = pg_fetch_array($sql);
	if($num==1){
			// login benar //
			$_SESSION['admin'] = true;
			$_SESSION['username'] = $username;
			$result = pg_query("update login set last_login = now() where username='$username'");
			?><script language="JavaScript">
				 document.location='../'</script>
			<?php
		} 
	else{
			// jika login salah //
			echo "<script>
			alert (' Maaf Login Gagal, Silahkan Isi Username dan Password Anda Dengan Benar');
			eval(\"parent.location='../login.php '\");	
			</script>";
		}
	}
?>