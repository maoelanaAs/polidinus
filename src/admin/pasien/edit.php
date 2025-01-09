<?php

include "../../../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Ambil data dari form
  $id = $_POST["id"];
  $nama = $_POST["nama"];
  $alamat = $_POST["alamat"];
  $no_ktp = $_POST["no_ktp"];
  $no_hp = $_POST["no_hp"];
  $password = $_POST["password"];

  if ($password == "") {
    // Query untuk melakukan update data pasien jika password tidak diubah
    $query = "UPDATE pasien SET
        nama = '$nama', 
        alamat = '$alamat', 
        no_ktp = '$no_ktp', 
        no_hp = '$no_hp' 
        WHERE id = $id";
  } else {
    // Query untuk melakukan update data pasien jika password diubah
    $query = "UPDATE pasien SET
        nama = '$nama',
        alamat = '$alamat',
        no_ktp = '$no_ktp',
        no_hp = '$no_hp',
        password = md5('$password')
        WHERE id = $id";
  }

  // Eksekusi query
  if (mysqli_query($mysqli, $query)) {
    // Jika berhasil, redirect ke halaman admin dokter
    echo "<script>";
    echo "alert('Data pasien berhasil diubah!');";
    echo "window.location.href = '../../../admin_pasien.php';";
    echo "</script>";
    exit();
  } else {
    // Jika terjadi kesalahan, tampilkan pesan error
    echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
  }
}
mysqli_close($mysqli);