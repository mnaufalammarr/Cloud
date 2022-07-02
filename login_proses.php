<?php
//session_start();
include "./conn.php";
$user = $_POST['user'];
$pass = $_POST['password'];
$a = mysqli_query($conn , "SELECT * FROM tb_admin WHERE username = '$user' AND password = '$pass' OR mail_adm = '$user' AND password = '$pass'  ");
$jum = mysqli_num_rows($a);
if($jum == 0){
	echo "<script>alert('Login Gagal..');</script>";
	echo "<meta http-equiv='refresh' content='0;URL=login.php' />";
}else{
	while($b = mysqli_fetch_array($a)){
		$_SESSION['id_adm'] = $b['id_adm'];
		$_SESSION['nama']= $b['nama_adm'];
		echo "<script>alert('Login Berhasil..');</script>";
		echo "<meta http-equiv='refresh' content='0;URL=index.php' />";
	}
	
}


?>