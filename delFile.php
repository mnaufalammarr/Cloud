<?php
  include './conn.php';
  $id = $_GET["id"];
  $query = "SELECT count(*) AS total , url_file FROM tb_file WHERE id_file='$id'";
  $result = mysqli_query($conn,$query);
  while($row = mysqli_fetch_assoc($result))
  { $total = $row['total'];
    $file = "./storage/file/".$row['url_file'];}

  if(!$result){
    die ("Query Error: ".mysqli_errno($conn).
       " - ".mysqli_error($conn));
  }else if($total != 0){
    
     if(!unlink($file)){
      echo ("Error deleting $file");
  }else{

     $query = "DELETE FROM tb_file WHERE id_file='$id' ";
      $hasil_query = mysqli_query($conn, $query);

      if(!$hasil_query) {
        die ("Gagal menghapus data: ".mysqli_errno($conn).
        " - ".mysqli_error($conn));
      } else {
        echo "<script>alert('Data berhasil dihapus.');window.location='file.php';</script>";
      }
  }
  }else{
    $query = "DELETE FROM tb_file WHERE id_file='$id' ";
    $hasil_query = mysqli_query($conn, $query);

    if(!$hasil_query) {
      die ("Gagal menghapus data: ".mysqli_errno($conn).
      " - ".mysqli_error($conn));
    } else {
      echo "<script>alert('Data berhasil dihapus.');window.location='file.php';</script>";
    }
  }