<?php
include './conn.php';

  $nama_admin   = $_POST['nama_admin'];
  $mail = $_POST['email_admin'];
  $no_admin = $_POST['no_admin'];
  $user = $_POST['username'];
  $pass = $_POST['pass'];
 
    $query = "INSERT INTO tb_admin (id_adm, nama_adm, mail_adm, no_adm, username, password) VALUES ('', '$nama_admin', '$mail', '$no_admin','$user','$pass')";
    $result = mysqli_query($conn, $query);
    
    if(!$result){
        die ("Query gagal dijalankan: ".mysqli_errno($conn).
             " - ".mysqli_error($conn));
    } else {
      echo "<script>alert('Admin berhasil ditambah.');window.location='login.php';</script>";
    }