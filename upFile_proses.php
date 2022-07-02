<?php
include './conn.php';

  $nama   = $_POST['nama'];
  $id_admin = $_SESSION['id_adm'];
  $tanggal = date('d-m-Y');
  $size = $_FILES['file']['size'];
  $gambar = $_FILES['file']['name'];


if($gambar != "") {
    if($size < 10000000){
        $ekstensi_diperbolehkan = array('pdf');  
        $x = explode('.', $gambar);
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['file']['tmp_name'];   
        $angka_acak     = rand(1,999);
        $nama_gambar_baru = $angka_acak.'-'.$gambar; 
              if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {     
                      move_uploaded_file($file_tmp, './storage/file/'.$nama_gambar_baru); 
                        $query = "INSERT INTO tb_file (id_file,id_adm,nama_file,tanggal_file, url_file) VALUES ('', '$id_admin', '$nama', '$tanggal','$nama_gambar_baru')";
                        $result = mysqli_query($conn, $query);
                        
                        if(!$result){
                            die ("Query gagal dijalankan: ".mysqli_errno($conn).
                                 " - ".mysqli_error($conn));
                        } else {
                          echo $nama_gambar_baru;
                          echo "<script>alert('File berhasil ditambah.');window.location='file.php';</script>";
                        }
      
                  } else {     
                   //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                      echo "<script>alert('Ekstensi File yang boleh hanya PDF.');window.location='upFile.php';</script>";
                  }
    }else{
        echo "<script>alert('Maaf Ukuran Terbesar!!');window.location='upFile.php';</script>";
    }
  
} else {
    $query = "INSERT INTO tb_file (id_file,id_adm,nama_file,tanggal_file, url_file) VALUES ('', '$id_admin', '$nama', '$tanggal','')";
    $result = mysqli_query($conn, $query);
    
    if(!$result){
        die ("Query gagal dijalankan: ".mysqli_errno($conn).
             " - ".mysqli_error($conn));
    } else {
        echo $gambar;
      echo "<script>alert('File berhasil ditambah.');window.location='file.php';</script>";
    }
}