<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "SELECT * FROM tb_penerbit WHERE id = '$id'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nama = $row['nama'];
    $alamat = $row['alamat'];
    $kota = $row['kota'];
    $telepon = $row['telepon'];
  } else {
    echo "Data penerbit tidak ditemukan.";
    exit();
  }
} else {
  echo "ID penerbit tidak ditemukan.";
  exit();
}

if (isset($_POST['submit'])) {
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $kota = $_POST['kota'];
  $telepon = $_POST['telepon'];

  $sql_update = "UPDATE tb_penerbit SET nama = '$nama', alamat = '$alamat', kota = '$kota', telepon = '$telepon' WHERE id = '$id'";

  if ($conn->query($sql_update) === TRUE) {
    echo "<script>alert('Data penerbit berhasil diperbarui.'); window.location.href = 'tampil-penerbit.php';</script>";
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
  <title>Edit Penerbit</title>
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
          <h3 class="mt-3">Edit Penerbit</h3>
          <form action="" method="POST">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Penerbit</label>
              <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>" required>
            </div>
            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat</label>
              <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat; ?>" required>
            </div>
            <div class="mb-3">
              <label for="kota" class="form-label">Kota</label>
              <input type="text" class="form-control" id="kota" name="kota" value="<?php echo $kota; ?>" required>
            </div>
            <div class="mb-3">
              <label for="telepon" class="form-label">Telepon</label>
              <input type="text" class="form-control" id="telepon" name="telepon" value="<?php echo $telepon; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
            <a href="tampil-penerbit.php" class="btn btn-secondary">Batal</a>
          </form>
        </div>
      </div>
    </div>
    <div class="footer">
      <p>&copy; Copyright by Dyaz Amrullah</p>
    </div>
</body>

</html>