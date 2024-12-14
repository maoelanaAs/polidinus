<?php
include("../../config/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $id = $_POST["id"];
  $nama_obat = $_POST["nama_obat"];
  $kemasan = $_POST["kemasan"];
  $harga = $_POST["harga"];

  $query = "UPDATE obat SET nama_obat = '$nama_obat', kemasan = '$kemasan', harga = '$harga' WHERE id = '$id'";

  // Eksekusi query
  if (mysqli_query($mysqli, $query)) {
    // Jika berhasil, redirect kembali ke halaman index atau sesuaikan dengan kebutuhan Anda
    echo '<script>';
    echo 'alert("Data obat berhasil diubah!");';
    echo 'window.location.href = "../../obat_admin.php";';
    echo '</script>';
    exit();
  } else {
    // Jika terjadi kesalahan, tampilkan pesan error
    echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
  }
}

// Tutup koneksi
mysqli_close($mysqli);