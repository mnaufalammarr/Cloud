<?php
include './conn.php';

  $nama   = $_POST['nama'];
  $id_admin = $_SESSION['id_adm'];
  $tanggal = date('d-m-Y');
  $gambar = $_FILES['userImage']['name'];
echo $gambar;
echo $nama;

if($gambar != "") {
  $ekstensi_diperbolehkan = array('png','jpeg','jpg');  
  $x = explode('.', $gambar);
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['userImage']['tmp_name'];   
  $angka_acak     = rand(1,999);
  $nama_gambar_baru = $angka_acak.'-'.$gambar; 
        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {     
                move_uploaded_file($file_tmp, './storage/img/'.$nama_gambar_baru); 
                  $query = "INSERT INTO tb_pic (id_pic,id_adm,nama_pic,tanggal_pic, url_pic) VALUES ('', '$id_admin', '$nama', '$tanggal','$nama_gambar_baru')";
                  $result = mysqli_query($conn, $query);
                  
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($conn).
                           " - ".mysqli_error($conn));
                  } else {
                    echo $nama_gambar_baru;
                    echo "<script>alert('Picture berhasil ditambah.');window.location='picture.php';</script>";
                  }

            } else {     
             //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='up_pic.php';</script>";
            }
} else {
    $query = "INSERT INTO tb_pic (id_pic,id_adm,nama_pic,tanggal_pic, url_pic) VALUES ('', '$id_admin', '$nama', '$tanggal','')";
    $result = mysqli_query($conn, $query);
    
    if(!$result){
        die ("Query gagal dijalankan: ".mysqli_errno($conn).
             " - ".mysqli_error($conn));
    } else {
        echo $gambar;
      echo "<script>alert('Picture berhasil ditambah.');window.location='picture.php';</script>";
    }
}