<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Query untuk menghapus data buku berdasarkan ID
  $sql = "DELETE FROM tb_buku WHERE id='$id'";

  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Data buku berhasil dihapus');</script>";
    echo "<script>window.location.href = 'admin.php';</script>";
    exit;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
