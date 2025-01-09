<?php

session_start();
include "../../../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Ambil data dari session
  $id_dokter = $_SESSION["id"];
  $id_jadwal = $_POST["id_jadwal"];

  // Nonaktifkan semua jadwal yang dimiliki dokter
  $query = "UPDATE jadwal_periksa SET jadwal_periksa.status = 0 WHERE id_dokter = $id_dokter";
  mysqli_query($mysqli, $query);

  // Aktifkan jadwal yang dipilih
  $query = "UPDATE jadwal_periksa SET jadwal_periksa.status = 1 WHERE id = $id_jadwal";
  if (mysqli_query($mysqli, $query)) {
    // Jika berhasil, redirect ke halaman dokter jadwal
    echo "<script>";
    echo "alert('Data jadwal berhasil diaktifkan!');";
    echo "window.location.href = '../../../dokter_jadwal.php';";
    echo "</script>";
    exit();
  } else {
    // Jika terjadi kesalahan, tampilkan pesan error
    echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
  }
}
mysqli_close($mysqli);