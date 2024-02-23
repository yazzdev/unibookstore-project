<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Query untuk menghapus data buku berdasarkan ID
  $sql = "DELETE FROM tb_penerbit WHERE id='$id'";

  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Data penerbit berhasil dihapus');</script>";
    echo "<script>window.location.href = 'tampil-penerbit.php';</script>";
    exit;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
