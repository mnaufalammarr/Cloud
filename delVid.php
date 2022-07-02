<?php
  include './conn.php';
  $id = $_GET["id"];
  $query = "SELECT count(*) AS total , url_vid FROM tb_vid WHERE id_vid='$id'";
  $result = mysqli_query($conn,$query);
  while($row = mysqli_fetch_assoc($result))
  { $total = $row['total'];
    $vid = "./storage/vid/".$row['url_vid'];}

  if(!$result){
    die ("Query Error: ".mysqli_errno($conn).
       " - ".mysqli_error($conn));
  }else if($total != 0){
    
     if(!unlink($vid)){
      echo ("Error deleting $vid");
  }else{

     $query = "DELETE FROM tb_vid WHERE id_vid='$id' ";
      $hasil_query = mysqli_query($conn, $query);

      if(!$hasil_query) {
        die ("Gagal menghapus data: ".mysqli_errno($conn).
        " - ".mysqli_error($conn));
      } else {
        echo "<script>alert('Data berhasil dihapus.');window.location='video.php';</script>";
      }
  }
  }else{
    $query = "DELETE FROM tb_vid WHERE id_vid='$id' ";
    $hasil_query = mysqli_query($conn, $query);

    if(!$hasil_query) {
      die ("Gagal menghapus data: ".mysqli_errno($conn).
      " - ".mysqli_error($conn));
    } else {
      echo "<script>alert('Data berhasil dihapus.');window.location='video.php';</script>";
    }
  }