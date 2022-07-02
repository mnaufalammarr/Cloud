<?php
include './conn.php';


$nama_admin   = $_POST['nama_admin'];
$mail = $_POST['email_admin'];
$no_admin = $_POST['no_admin'];
$user = $_POST['username'];
$pass = $_POST['pass'];
$id = $_POST['id_adm'];

    $query = "UPDATE tb_admin SET nama_adm = '$nama_admin', no_adm = '$no_admin' , mail_adm = '$mail', username = '$user' , password = '$pass' WHERE id_adm = $id";
    $result = mysqli_query($conn, $query);
    
    if(!$result){
        die ("Query gagal dijalankan: ".mysqli_errno($conn).
             " - ".mysqli_error($conn));
    } else {
        $_SESSION['nama']= $nama_admin;
      echo "<script>alert('Profile berhasil dirubah.');window.location='index.php';</script>";
    }
