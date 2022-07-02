<?php
include './conn.php';

  $nama   = $_POST['nama'];
  $tanggal = date('d-m-Y');
  $id_note  = $_POST['id_note'];
  $des  = $_POST['des'];


    $query = "UPDATE tb_note SET nama_note = '$nama', tanggal_note = '$tanggal' , des_note = '$des' WHERE id_note = $id_note";
    $result = mysqli_query($conn, $query);
    
    if(!$result){
        die ("Query gagal dijalankan: ".mysqli_errno($conn).
             " - ".mysqli_error($conn));
    } else {
      
      echo "<script>alert('Note berhasil dirubah.');window.location='note.php';</script>";
    }
