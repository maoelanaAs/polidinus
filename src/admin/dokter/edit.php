<?php

include "../../../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Ambil data dari form
  $id = $_POST["id"];
  $nama = $_POST["nama"];
  $alamat = $_POST["alamat"];
  $no_hp = $_POST["no_hp"];
  $poli = $_POST["poli"];
  $password = $_POST["password"];

  if ($password == "") {
    // Query untuk melakukan update data dokter jika password tidak diubah
    $query = "UPDATE dokter SET 
        nama = '$nama', 
        alamat = '$alamat',
        no_hp = '$no_hp',
        id_poli = $poli
        WHERE id = $id";
  } else {
    // Query untuk melakukan update data dokter jika password diubah
    $query = "UPDATE dokter SET 
        nama = '$nama', 
        alamat = '$alamat',
        no_hp = '$no_hp',
        id_poli = $poli,
        password = md5('$password')
        WHERE id = $id";
  }

  // Eksekusi query
  if (mysqli_query($mysqli, $query)) {
    // Jika berhasil, redirect ke halaman admin dokter
    echo "<script>";
    echo "alert('Data dokter berhasil diubah!');";
    echo "window.location.href = '../../../admin_dokter.php';";
    echo "</script>";
    exit();
  } else {
    // Jika terjadi kesalahan, tampilkan pesan error
    echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
  }
}
mysqli_close($mysqli);