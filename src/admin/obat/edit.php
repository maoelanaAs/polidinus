<?php

include "../../../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Ambil data dari form
  $id = $_POST["id"];
  $nama_obat = $_POST["nama_obat"];
  $kemasan = $_POST["kemasan"];
  $harga = $_POST["harga"];

  // Query
  $query = "UPDATE obat SET 
      nama_obat = '$nama_obat', 
      kemasan = '$kemasan', 
      harga = '$harga' 
      WHERE id = $id";

  // Eksekusi query
  if (mysqli_query($mysqli, $query)) {
    // Jika berhasil, redirect ke halaman admin obat
    echo "<script>";
    echo "alert('Data obat berhasil diubah!');";
    echo "window.location.href = '../../../admin_obat.php';";
    echo "</script>";
    exit();
  } else {
    // Jika terjadi kesalahan, tampilkan pesan error
    echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
  }
}
mysqli_close($mysqli);