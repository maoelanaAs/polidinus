<?php

include("../../config/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $id = $_POST["id"];
  $nama = $_POST["nama"];
  $alamat = $_POST["alamat"];
  $no_ktp = $_POST["no_ktp"];
  $no_hp = $_POST["no_hp"];
  $password = md5($_POST["password"]);

  // Query untuk melakukan update data pasien jika password tidak diubah
  if ($password == "") {
    $query = "UPDATE pasien SET nama = '$nama', alamat = '$alamat', no_ktp = '$no_ktp', no_hp = '$no_hp' WHERE id = $id";
  } else {
    // Query untuk melakukan update data pasien jika password diubah
    $query = "UPDATE pasien SET nama = '$nama', alamat = '$alamat', no_ktp = '$no_ktp', no_hp = '$no_hp', password = '$password' WHERE id = $id";
  }

  // Eksekusi query
  if (mysqli_query($mysqli, $query)) {
    // Jika berhasil, redirect kembali ke halaman index atau sesuaikan dengan kebutuhan Anda
    echo '<script>';
    echo 'alert("Data pasien berhasil diubah!");';
    echo 'window.location.href = "../../pasien_admin.php";';
    echo '</script>';
    exit();
  } else {
    // Jika terjadi kesalahan, tampilkan pesan error
    echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
  }
}