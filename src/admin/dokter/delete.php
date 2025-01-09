<?php

include "../../../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Ambil data dari form
  $id = $_POST["id"];

  // Query
  $query = "DELETE FROM dokter WHERE id = $id";

  // Eksekusi query
  if (mysqli_query($mysqli, $query)) {
    // Jika berhasil, redirect ke halaman admin dokter
    echo "<script>";
    echo "alert('Data dokter berhasil dihapus!');";
    echo "window.location.href = '../../../admin_dokter.php';";
    echo "</script>";
    exit();
  } else {
    // Jika terjadi kesalahan, tampilkan pesan error
    echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
  }
}

// Tutup koneksi
mysqli_close($mysqli);