<?php

include "../../../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Ambil data dari form
  $id = $_POST["id"];

  // Query
  $query = "DELETE FROM poli WHERE id = $id";

  // Eksekusi query
  if (mysqli_query($mysqli, $query)) {
    // Jika berhasil, redirect ke halaman admin poli
    echo "<script>";
    echo "alert('Data poli berhasil dihapus!');";
    echo "window.location.href = '../../../admin_poli.php';";
    echo "</script>";
    exit();
  } else {
    // Jika terjadi kesalahan, tampilkan pesan error
    echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
  }
}
mysqli_close($mysqli);