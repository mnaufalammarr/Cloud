<?php
include './conn.php';

  $nama   = $_POST['nama'];
  $tanggal = date('d-m-Y');
  $id  = $_POST['id_vid'];
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
                $urlQuery = "SELECT url_vid FROM tb_vid WHERE id_vid='$id'";
                  $url = mysqli_query($conn, $urlQuery);
                  while($row = mysqli_fetch_assoc($url))
                                    {$piclama = "./storage/vid/".$row['url_vid'];}
                  $query = "UPDATE tb_vid SET nama_vid = '$nama', tanggal_vid = '$tanggal',  url_vid = '$nama_gambar_baru' WHERE id_vid = $id";
                  $result = mysqli_query($conn, $query);
                  
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($conn).
                           " - ".mysqli_error($conn));
                  } else {

                    
                    unlink($piclama);
                    echo "<script>alert('Video berhasil dirubah.');window.location='video.php';</script>";
                  }

            } else {     
             //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                echo "<script>alert('Ekstensi video yang boleh hanya mp4 atau webm.');window.location='video.php';</script>";
            }
        }else{
            echo "<script>alert('Maaf Ukuran Terbesar!!');window.location='video.php';</script>";
        }
} else {
    $query = "UPDATE tb_vid SET nama_vid = '$nama', tanggal_vid = '$tanggal' WHERE id_vid = $id";
    $result = mysqli_query($conn, $query);
    
    if(!$result){
        die ("Query gagal dijalankan: ".mysqli_errno($conn).
             " - ".mysqli_error($conn));
    } else {
      
      echo "<script>alert('Video berhasil dirubah.');window.location='video.php';</script>";
    }
}