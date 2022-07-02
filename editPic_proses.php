<?php
include './conn.php';

  $nama   = $_POST['nama'];
  $tanggal = date('d-m-Y');
  $id_pic  = $_POST['id_pic'];
  
  $gambar = $_FILES['userImage']['name'];


if($gambar != "") {
  $ekstensi_diperbolehkan = array('png','jpeg','jpg');  
  $x = explode('.', $gambar);
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['userImage']['tmp_name'];   
  $angka_acak     = rand(1,999);
  $nama_gambar_baru = $angka_acak.'-'.$gambar; 
        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {     
                move_uploaded_file($file_tmp, './storage/img/'.$nama_gambar_baru); 
                $urlQuery = "SELECT url_pic FROM tb_pic WHERE id_pic='$id_pic'";
                  $url = mysqli_query($conn, $urlQuery);
                  while($row = mysqli_fetch_assoc($url))
                                    {$piclama = "./storage/img/".$row['url_pic'];}
                  $query = "UPDATE tb_pic SET nama_pic = '$nama', tanggal_pic = '$tanggal',  url_pic = '$nama_gambar_baru' WHERE id_pic = $id_pic";
                  $result = mysqli_query($conn, $query);
                  
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($conn).
                           " - ".mysqli_error($conn));
                  } else {

                    
                    unlink($piclama);
                    echo "<script>alert('Picture berhasil dirubah.');window.location='picture.php';</script>";
                  }

            } else {     
             //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='picture';</script>";
            }
} else {
    $query = "UPDATE tb_pic SET nama_pic = '$nama', tanggal_pic = '$tanggal' WHERE id_pic = $id_pic";
    $result = mysqli_query($conn, $query);
    
    if(!$result){
        die ("Query gagal dijalankan: ".mysqli_errno($conn).
             " - ".mysqli_error($conn));
    } else {
      
      echo "<script>alert('Picture berhasil dirubah.');window.location='picture.php';</script>";
    }
}