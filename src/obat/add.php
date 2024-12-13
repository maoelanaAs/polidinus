<?php
include '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $nama_obat = $_POST["nama_obat"];
  $kemasan = $_POST["kemasan"];
  $harga = $_POST["harga"];

  $check = "SELECT * FROM obat WHERE nama_obat = '$nama_obat'";
  $data = mysqli_query($mysqli, $check);

  if (mysqli_num_rows($data) > 0) {
    echo '<script>alert("Obat sudah ada");window.location.href = "../../obat_admin.php";</script>';
  } else {
    // Query untuk menambahkan data obat ke dalam tabel
    $query = "INSERT INTO obat (nama_obat, kemasan, harga) VALUES ('$nama_obat', '$kemasan', '$harga')";

    if (mysqli_query($mysqli, $query)) {
      echo '<script>';
      echo 'alert("Data obat berhasil ditambahkan!");';
      echo 'window.location.href = "../../obat_admin.php";';
      echo '</script>';
      exit();
    } else {
      // Jika terjadi kesalahan, tampilkan pesan error
      echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }
  }
}

// Tutup koneksi
mysqli_close($mysqli);
