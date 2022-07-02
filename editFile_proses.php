<?php
include './conn.php';

  $nama   = $_POST['nama'];
  $tanggal = date('d-m-Y');
  $id  = $_POST['id_file'];
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
                $urlQuery = "SELECT url_file FROM tb_file WHERE id_file='$id'";
                  $url = mysqli_query($conn, $urlQuery);
                  while($row = mysqli_fetch_assoc($url))
                                    {$piclama = "./storage/file/".$row['url_file'];}
                  $query = "UPDATE tb_file SET nama_file = '$nama', tanggal_file = '$tanggal',  url_file = '$nama_gambar_baru' WHERE id_file = $id";
                  $result = mysqli_query($conn, $query);
                  
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($conn).
                           " - ".mysqli_error($conn));
                  } else {

                    
                    unlink($piclama);
                    echo "<script>alert('File berhasil dirubah.');window.location='file.php';</script>";
                  }

            } else {     
             //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                echo "<script>alert('Ekstensi file yang boleh hanya PDF.');window.location='file.php';</script>";
            }
        }else{
            echo "<script>alert('Maaf Ukuran Terbesar!!');window.location='file.php';</script>";
        }
} else {
    $query = "UPDATE tfile SET namfile = '$nama', tanggafile = '$tanggal' WHERE ifile = $id";
    $result = mysqli_query($conn, $query);
    
    if(!$result){
        die ("Query gagal dijalankan: ".mysqli_errno($conn).
             " - ".mysqli_error($conn));
    } else {
      
      echo "<script>alert('file berhasil dirubah.');window.location='file.php';</script>";
    }
}