<?php
include("../../config/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $id = $_POST["id"];

  $query = "DELETE FROM dokter WHERE id = $id";

  // Eksekusi query
  if (mysqli_query($mysqli, $query)) {
    // Jika berhasil, redirect kembali ke halaman index atau sesuaikan dengan kebutuhan Anda
    echo '<script>';
    echo 'alert("Data dokter berhasil dihapus!");';
    echo 'window.location.href = "../../dokter_admin.php";';
    echo '</script>';
    exit();
  } else {
    // Jika terjadi kesalahan, tampilkan pesan error
    echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
  }
}

// Tutup koneksi
mysqli_close($mysqli);