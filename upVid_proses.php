<?php
include './conn.php';

  $nama   = $_POST['nama'];
  $id_admin = $_SESSION['id_adm'];
  $tanggal = date('d-m-Y');
  $size = $_FILES['vid']['size'];
  $gambar = $_FILES['vid']['name'];


if($gambar != "") {
    if($size < 10000000){
        $ekstensi_diperbolehkan = array('mp4','3gp','webm');  
        $x = explode('.', $gambar);
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['vid']['tmp_name'];   
        $angka_acak     = rand(1,999);
        $nama_gambar_baru = $angka_acak.'-'.$gambar; 
              if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {     
                      move_uploaded_file($file_tmp, './storage/vid/'.$nama_gambar_baru); 
                        $query = "INSERT INTO tb_vid (id_vid,id_adm,nama_vid,tanggal_vid, url_vid) VALUES ('', '$id_admin', '$nama', '$tanggal','$nama_gambar_baru')";
                        $result = mysqli_query($conn, $query);
                        
                        if(!$result){
                            die ("Query gagal dijalankan: ".mysqli_errno($conn).
                                 " - ".mysqli_error($conn));
                        } else {
                          echo $nama_gambar_baru;
                          echo "<script>alert('Video berhasil ditambah.');window.location='video.php';</script>";
                        }
      
                  } else {     
                   //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                      echo "<script>alert('Ekstensi Video yang boleh hanya mp4 atau webm.');window.location='upVid.php';</script>";
                  }
    }else{
        echo "<script>alert('Maaf Ukuran Terbesar!!');window.location='upVid.php';</script>";
    }
  
} else {
    $query = "INSERT INTO tb_vid (id_vid,id_adm,nama_vid,tanggal_vid, url_vid) VALUES ('', '$id_admin', '$nama', '$tanggal','')";
    $result = mysqli_query($conn, $query);
    
    if(!$result){
        die ("Query gagal dijalankan: ".mysqli_errno($conn).
             " - ".mysqli_error($conn));
    } else {
        echo $gambar;
      echo "<script>alert('Video berhasil ditambah.');window.location='Video.php';</script>";
    }
}