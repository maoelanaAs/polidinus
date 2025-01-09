<?php

include "../../../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Ambil data dari form
  $nama_poli = $_POST["nama_poli"];
  $keterangan = $_POST["keterangan"];

  // Cek apakah poli sudah ada
  $check = "SELECT * FROM poli WHERE nama_poli = '$nama_poli'";
  $data = mysqli_query($mysqli, $check);

  if (mysqli_num_rows($data) > 0) {
    // Jika poli sudah ada, tampilkan pesan error
    echo "<script>";
    echo "alert('Poli tersebut sudah ada!');";
    echo "window.location.href = '../../../admin_Poli.php';";
    echo "</script>";
    exit();
  } else {
    // Query
    $query = "INSERT INTO poli (nama_poli, keterangan) VALUES ('$nama_poli', '$keterangan')";

    if (mysqli_query($mysqli, $query)) {
      // Jika berhasil, redirect ke halaman admin obat
      echo "<script>";
      echo "alert('Data poli berhasil ditambahkan!');";
      echo "window.location.href = '../../../admin_poli.php';";
      echo "</script>";
      exit();
    } else {
      // Jika terjadi kesalahan, tampilkan pesan error
      echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }
  }
}
mysqli_close($mysqli);