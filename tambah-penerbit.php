<?php
include 'koneksi.php';

function generatePenerbitID($conn)
{
  $sql_last_id = "SELECT id FROM tb_penerbit ORDER BY id DESC LIMIT 1";
  $result_last_id = $conn->query($sql_last_id);

  // Jika tidak ada id sebelumnya dalam tabel
  if ($result_last_id->num_rows == 0) {
    return 'SP01';
  } else {
    // Jika ada id sebelumnya, hitung id berikutnya
    $last_id_row = $result_last_id->fetch_assoc();
    $last_id = $last_id_row['id'];

    // Ambil angka dari id sebelumnya
    $last_number = intval(substr($last_id, 2));

    // Increment angka
    $new_number = $last_number + 1;

    // Bangun id baru
    return 'SP' . str_pad($new_number, 2, '0', STR_PAD_LEFT);
  }
}

if (isset($_POST['submit'])) {
  $id = generatePenerbitID($conn);
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $kota = $_POST['kota'];
  $telepon = $_POST['telepon'];

  $sql = "INSERT INTO tb_penerbit (id, nama, alamat, kota, telepon) VALUES ('$id', '$nama', '$alamat', '$kota', '$telepon')";

  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Data penerbit berhasil ditambahkan.'); window.location.href = 'tampil-penerbit.php';</script>";
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Penerbit</title>
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
          <h3 class="mt-3">Tambah Penerbit</h3>
          <form action="" method="POST">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Penerbit</label>
              <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat</label>
              <input type="text" class="form-control" id="alamat" name="alamat" required>
            </div>
            <div class="mb-3">
              <label for="kota" class="form-label">Kota</label>
              <input type="text" class="form-control" id="kota" name="kota" required>
            </div>
            <div class="mb-3">
              <label for="telepon" class="form-label">Telepon</label>
              <input type="test" class="form-control" id="telepon" name="telepon" required>
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