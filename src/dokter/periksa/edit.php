<?php

include "../../../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Ambil data dari form
  $id = $_POST["id"];
  $tanggal = $_POST["tanggal"];
  $catatan = $_POST["catatan"];

  // Query
  $query = "UPDATE periksa SET tgl_periksa = '$tanggal', catatan = '$catatan' WHERE id_daftar_poli = $id";

  if (mysqli_query($mysqli, $query)) {
    // Jika berhasil, redirect ke halaman dokter periksa
    echo "<script>";
    echo "alert('Data periksa berhasil diubah!');";
    echo "window.location.href = '../../../dokter_periksa.php';";
    echo "</script>";
    exit();
  } else {
    // Jika terjadi kesalahan, tampilkan pesan error
    echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
  }
}
mysqli_close($mysqli);