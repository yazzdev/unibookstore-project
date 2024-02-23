<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "SELECT * FROM tb_buku WHERE id = '$id'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $kategori = $row['kategori'];
    $nama_buku = $row['nama_buku'];
    $harga = $row['harga'];
    $stok = $row['stok'];
    $id_penerbit = $row['id_penerbit'];
  } else {
    echo "Data buku tidak ditemukan.";
    exit();
  }
} else {
  echo "ID buku tidak ditemukan.";
  exit();
}

if (isset($_POST['submit'])) {
  $kategori = $_POST['kategori'];
  $nama_buku = $_POST['nama_buku'];
  $harga = $_POST['harga'];
  $stok = $_POST['stok'];
  $id_penerbit = $_POST['id_penerbit'];

  $sql_update = "UPDATE tb_buku SET kategori = '$kategori', nama_buku = '$nama_buku', harga = '$harga', stok = '$stok', id_penerbit = '$id_penerbit' WHERE id = '$id'";

  if ($conn->query($sql_update) === TRUE) {
    echo "<script>alert('Data buku berhasil diperbarui.'); window.location.href = 'admin.php';</script>";
  } else {
    echo "Error: " . $sql_update . "<br>" . $conn->error;
  }

  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Buku</title>
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
        <div class="container">
          <h3 class="mt-3">Edit Buku</h3>
          <form action="" method="POST">
            <div class="mb-3">
              <label for="kategori" class="form-label">Kategori</label>
              <input type="text" class="form-control" id="kategori" name="kategori" value="<?php echo $kategori; ?>" required>
            </div>
            <div class="mb-3">
              <label for="nama_buku" class="form-label">Nama Buku</label>
              <input type="text" class="form-control" id="nama_buku" name="nama_buku" value="<?php echo $nama_buku; ?>" required>
            </div>
            <div class="mb-3">
              <label for="harga" class="form-label">Harga</label>
              <input type="number" class="form-control" id="harga" name="harga" value="<?php echo $harga; ?>" required>
            </div>
            <div class="mb-3">
              <label for="stok" class="form-label">Stok</label>
              <input type="number" class="form-control" id="stok" name="stok" value="<?php echo $stok; ?>" required>
            </div>
            <div class="mb-3">
              <label for="id_penerbit" class="form-label">Penerbit</label>
              <select class="form-select" id="id_penerbit" name="id_penerbit" required>
                <?php
                $sql_penerbit = "SELECT id, nama FROM tb_penerbit";
                $result_penerbit = $conn->query($sql_penerbit);

                if ($result_penerbit->num_rows > 0) {
                  while ($row_penerbit = $result_penerbit->fetch_assoc()) {
                    $selected = ($row_penerbit['id'] == $id_penerbit) ? 'selected' : '';
                    echo "<option value='" . $row_penerbit['id'] . "' $selected>" . $row_penerbit['nama'] . "</option>";
                  }
                } else {
                  echo "<option value=''>Tidak ada data penerbit</option>";
                }
                ?>
              </select>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
            <a href="admin.php" class="btn btn-secondary">Batal</a>
          </form>
        </div>
      </div>
    </div>
    <div class="footer">
      <p>&copy; Copyright by Dyaz Amrullah</p>
    </div>
</body>

</html>