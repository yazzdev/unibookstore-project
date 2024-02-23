<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <script>
    function confirmDelete() {
      return confirm("Apakah Anda yakin ingin menghapus penerbit ini?");
    }
  </script>
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
          <h3>Tabel Penerbit</h3>
          <div>
            <a href="admin.php" class="btn btn-outline-primary btn-sm">Lihat Tabel Buku</a>
          </div>
          <div class="d-flex justify-content-end mb-3">
            <a href="tambah-penerbit.php" class="btn btn-primary">Tambah Penerbit</a>
          </div>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ID Penerbit</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Kota</th>
                <th>Telepon</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include 'koneksi.php';

              $sql =
                "SELECT * FROM tb_penerbit";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["nama"] . "</td>
                    <td>" . $row["alamat"] . "</td>
                    <td>" . $row["kota"] . "</td>
                    <td>" . $row["telepon"] . "</td>
                    <td>
                        <a href='edit-penerbit.php?id=" . $row['id'] . "' class='btn btn-sm btn-primary'>Edit</a>
                        <a href='hapus-penerbit.php?id=" . $row['id'] . "' class='btn btn-sm btn-danger' onclick='return confirmDelete()'>Hapus</a>
                    </td>
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