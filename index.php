<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Utama</title>
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
              <a class="nav-link active" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="admin.php">Admin</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pengadaan.php">Pengadaan</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-10">
        <div class="content pt-3">
          <h3>Tabel Buku</h3>
          <!-- Form pencarian -->
          <form action="" method="GET" class="mb-3">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Cari berdasarkan nama buku" name="search">
              <button class="btn btn-outline-secondary" type="submit">Cari</button>
            </div>
          </form>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ID Buku</th>
                <th>Kategori</th>
                <th>Judul Buku</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Penerbit</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include 'koneksi.php';

              // Pencarian berdasarkan nama buku
              if (isset($_GET['search'])) {
                $search = $_GET['search'];
                $sql = "SELECT tb_buku.id, tb_buku.kategori, tb_buku.nama_buku, tb_buku.harga, tb_buku.stok, tb_penerbit.nama  
                        FROM tb_buku 
                        INNER JOIN tb_penerbit 
                        ON tb_buku.id_penerbit=tb_penerbit.id 
                        WHERE tb_buku.nama_buku LIKE '%$search%'";
              } else {
                $sql = "SELECT tb_buku.id, tb_buku.kategori, tb_buku.nama_buku, tb_buku.harga, tb_buku.stok, tb_penerbit.nama  
                        FROM tb_buku 
                        INNER JOIN tb_penerbit 
                        ON tb_buku.id_penerbit=tb_penerbit.id";
              }

              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>" . $row["kategori"] . "</td>
                            <td>" . $row["nama_buku"] . "</td>
                            <td>" . $row["harga"] . "</td>
                            <td>" . $row["stok"] . "</td>
                            <td>" . $row["nama"] . "</td>
                        </tr>";
                }
              } else {
                echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
              }
              $conn->close();
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="footer">
    <p>&copy; Copyright by Dyaz Amrullah</p>
  </div>
</body>

</html>