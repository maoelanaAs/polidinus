<?php

include "../../../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Ambil data dari form
  $id = $_POST["id"];
  $nama_poli = $_POST["nama_poli"];
  $keterangan = $_POST["keterangan"];

  // Query
  $query = "UPDATE poli SET
      nama_poli = '$nama_poli',
      keterangan = '$keterangan'
      WHERE id = $id";

  // Eksekusi query
  if (mysqli_query($mysqli, $query)) {
    // Jika berhasil, redirect ke halaman admin poli
    echo "<script>";
    echo "alert('Data poli berhasil diubah!');";
    echo "window.location.href = '../../../admin_poli.php';";
    echo "</script>";
    exit();
  } else {
    // Jika terjadi kesalahan, tampilkan pesan error
    echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
  }
}
mysqli_close($mysqli);