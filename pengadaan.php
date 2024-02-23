<?php
include 'koneksi.php';

$sql = "SELECT tb_buku.nama_buku AS judul_buku, tb_penerbit.nama AS nama_penerbit, tb_buku.stok
        FROM tb_buku
        INNER JOIN tb_penerbit ON tb_buku.id_penerbit = tb_penerbit.id
        WHERE tb_buku.stok <= 15"; // Misalnya, ambil buku yang memiliki sisa stok kurang dari atau sama dengan 15

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Kebutuhan Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-2 pt-3">
        <div class="sidebar">
          <h3>Menu</h3>
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="admin.php">Admin</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pengadaan.php">Pengadaan</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-10">
        <div class="content pt-3">
          <h3>Laporan Kebutuhan Buku</h3>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Judul Buku</th>
                <th>Nama Penerbit</th>
                <th>Sisa Stok</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>
                      <td>" . $row["judul_buku"] . "</td>
                      <td>" . $row["nama_penerbit"] . "</td>
                      <td>" . $row["stok"] . "</td>
                  </tr>";
                }
              } else {
                echo "<tr><td colspan='3'>Tidak ada buku yang perlu dibeli saat ini.</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="footer">
      <p>&copy; Copyright by Dyaz Amrullah</p>
    </div>
</body>

</html>