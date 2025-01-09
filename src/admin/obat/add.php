<?php

include "../../../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Ambil data dari form
  $nama_obat = $_POST["nama_obat"];
  $kemasan = $_POST["kemasan"];
  $harga = $_POST["harga"];

  // Cek apakah obat sudah ada
  $check = "SELECT * FROM obat WHERE nama_obat = '$nama_obat'";
  $checkQuery = mysqli_query($mysqli, $check);

  if (mysqli_num_rows($checkQuery) > 0) {
    // Jika obat sudah ada, tampilkan pesan error
    echo "<script>";
    echo "alert('Obat tersebut sudah ada!');";
    echo "window.location.href = '../../../admin_obat.php';";
    echo "</script>";
    exit();
  } else {
    // Query
    $query = "INSERT INTO obat (nama_obat, kemasan, harga) VALUES ('$nama_obat', '$kemasan', '$harga')";

    if (mysqli_query($mysqli, $query)) {
      // Jika berhasil, redirect ke halaman admin obat
      echo "<script>";
      echo "alert('Data obat berhasil ditambahkan!');";
      echo "window.location.href = '../../../admin_obat.php';";
      echo "</script>";
      exit();
    } else {
      // Jika terjadi kesalahan, tampilkan pesan error
      echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }
  }
}
mysqli_close($mysqli);