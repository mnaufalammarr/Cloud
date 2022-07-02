
<?php
  include './conn.php';
  $id = $_GET["id"];
      $query = "DELETE FROM tb_note WHERE id_note='$id' ";
      $hasil_query = mysqli_query($conn, $query);

      if(!$hasil_query) {
        die ("Gagal menghapus data: ".mysqli_errno($conn).
        " - ".mysqli_error($conn));
      } else {
        echo "<script>alert('Data berhasil dihapus.');window.location='note.php';</script>";
      }
