<?php
include 'koneksi.php';
$sql_penerbit = "SELECT id, nama FROM tb_penerbit";
$result_penerbit = $conn->query($sql_penerbit);

function generateBookID($conn, $kategori)
{
  $first_char = substr($kategori, 0, 1);

  // Query untuk mendapatkan id terakhir dari buku dengan kategori yang sama
  $sql_last_id = "SELECT id FROM tb_buku WHERE SUBSTRING(id, 1, 1) = '$first_char' ORDER BY id DESC LIMIT 1";
  $result_last_id = $conn->query($sql_last_id);

  // Jika tidak ada id sebelumnya dalam kategori tersebut, mulai dengan 1001
  if ($result_last_id->num_rows == 0) {
    return $first_char . '1001';
  } else {
    // Jika ada id sebelumnya, hitung id berikutnya
    $last_id_row = $result_last_id->fetch_assoc();
    $last_id = $last_id_row['id'];

    // Ambil angka dari id sebelumnya
    $last_number = intval(substr($last_id, 1));

    // Increment angka
    $new_number = $last_number + 1;

    // Bangun id baru
    return $first_char . $new_number;
  }
}


if (isset($_POST['submit'])) {

  $id = generateBookID($conn, $_POST['kategori']);
  $kategori = $_POST['kategori'];
  $nama_buku = $_POST['nama_buku'];
  $harga = $_POST['harga'];
  $stok = $_POST['stok'];
  $id_penerbit = $_POST['id_penerbit'];

  $sql = "INSERT INTO tb_buku (id, kategori, nama_buku, harga, stok, id_penerbit) VALUES ('$id', '$kategori', '$nama_buku', '$harga', '$stok', '$id_penerbit')";

  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Data buku berhasil ditambahkan.'); window.location.href = 'tampil-penerbit.php';</script>";
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
  <title>Tambah Buku</title>
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
          <h3 class="mt-3">Tambah Buku</h3>
          <form action="" method="POST">
            <div class="mb-3">
              <label for="kategori" class="form-label">Kategori</label>
              <select class="form-select" id="kategori" name="kategori" required>
                <option value="Bisnis">Bisnis</option>
                <option value="Keilmuan">Keilmuan</option>
                <option value="Novel">Novel</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="nama_buku" class="form-label">Nama Buku</label>
              <input type="text" class="form-control" id="nama_buku" name="nama_buku" required>
            </div>
            <div class="mb-3">
              <label for="harga" class="form-label">Harga</label>
              <input type="number" class="form-control" id="harga" name="harga" required>
            </div>
            <div class="mb-3">
              <label for="stok" class="form-label">Stok</label>
              <input type="number" class="form-control" id="stok" name="stok" required>
            </div>
            <div class="mb-3">
              <label for="id_penerbit" class="form-label">Penerbit</label>
              <select class="form-select" id="id_penerbit" name="id_penerbit" required>
                <?php
                if ($result_penerbit->num_rows > 0) {
                  while ($row_penerbit = $result_penerbit->fetch_assoc()) {
                    echo "<option value='" . $row_penerbit["id"] . "'>" . $row_penerbit["nama"] . "</option>";
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