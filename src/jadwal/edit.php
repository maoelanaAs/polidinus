<?php

include '../../config/database.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $id_dokter = $_SESSION['id'];
  $id_jadwal = $_POST['id_jadwal'];

  // Nonaktifkan semua jadwal sebelumnya
  $query = "UPDATE jadwal_periksa SET jadwal_periksa.status = 0 WHERE id_dokter = '$id_dokter'";
  mysqli_query($mysqli, $query);

  // Aktifkan jadwal yang dipilih
  $query = "UPDATE jadwal_periksa SET jadwal_periksa.status = 1 WHERE id = '$id_jadwal'";
  if (mysqli_query($mysqli, $query)) {
    echo '<script>';
    echo 'alert("Jadwal berhasil diaktifkan!");';
    echo 'window.location.href = "../../dokter_jadwal.php";';
    echo '</script>';
    exit();
  } else {
    echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
  }
}

mysqli_close($mysqli);
