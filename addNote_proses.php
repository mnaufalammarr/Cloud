<?php
include './conn.php';

  $nama   = $_POST['nama'];
  $id_admin = $_SESSION['id_adm'];
  $tanggal = date('d-m-Y');
  $des = $_POST['des'];


    $query = "INSERT INTO tb_note (id_note,id_adm,nama_note,tanggal_note, des_note) VALUES ('', '$id_admin', '$nama', '$tanggal','$des')";
    $result = mysqli_query($conn, $query);
    
    if(!$result){
        die ("Query gagal dijalankan: ".mysqli_errno($conn).
             " - ".mysqli_error($conn));
    } else {
      echo "<script>alert('Note berhasil ditambah.');window.location='Note.php';</script>";
    }
