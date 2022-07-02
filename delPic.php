<?php
  include './conn.php';
  $id = $_GET["id"];
  $query = "SELECT count(*) AS total , url_pic FROM tb_pic WHERE id_pic='$id'";
  $result = mysqli_query($conn,$query);
  while($row = mysqli_fetch_assoc($result))
  { $total = $row['total'];
    $img = "./storage/img/".$row['url_pic'];}

  if(!$result){
    die ("Query Error: ".mysqli_errno($conn).
       " - ".mysqli_error($conn));
  }else if($total != 0){
    
     if(!unlink($img)){
      echo ("Error deleting $img");
  }else{

     $query = "DELETE FROM tb_pic WHERE id_pic='$id' ";
      $hasil_query = mysqli_query($conn, $query);

      if(!$hasil_query) {
        die ("Gagal menghapus data: ".mysqli_errno($conn).
        " - ".mysqli_error($conn));
      } else {
        echo "<script>alert('Data berhasil dihapus.');window.location='picture.php';</script>";
      }
  }
  }else{
    $query = "DELETE FROM tb_pic WHERE id_pic='$id' ";
    $hasil_query = mysqli_query($conn, $query);

    if(!$hasil_query) {
      die ("Gagal menghapus data: ".mysqli_errno($conn).
      " - ".mysqli_error($conn));
    } else {
      echo "<script>alert('Data berhasil dihapus.');window.location='picture.php';</script>";
    }
  }