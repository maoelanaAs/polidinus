<?php

session_start();
include "../../../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Ambil data dari session
  $id_dokter = $_SESSION["id"];
  $id_poli = $_SESSION["id_poli"];

  // Ambil data dari form
  $hari = $_POST["hari"];
  $jam_mulai = $_POST["jam_mulai"];
  $jam_selesai = $_POST["jam_selesai"];

  // Cek apakah jadwal yang diinputkan sudah ada yang mengambil atau tidak
  $queryOverlap = "SELECT * FROM jadwal_periksa
      INNER JOIN dokter ON jadwal_periksa.id_dokter = dokter.id 
      INNER JOIN poli ON dokter.id_poli = poli.id 
      WHERE id_poli = '$id_poli'
      AND hari = '$hari' 
      AND ((jam_mulai < '$jam_selesai' 
      AND jam_selesai > '$jam_mulai') 
      OR (jam_mulai < '$jam_mulai' 
      AND jam_selesai > '$jam_mulai'))";

  $queryOverlap = mysqli_query($mysqli, $queryOverlap);

  if (mysqli_num_rows($queryOverlap) > 0) {
    // Jika ada jadwal yang overlap, tampilkan pesan error
    echo "<script>";
    echo "alert('Dokter lain telah mengambil jadwal ini');";
    echo "window.location.href = '../../../dokter_jadwal.php';";
    echo "</script>";
    exit();
  } else {
    // Jika tidak ada jadwal yang overlap, tambahkan jadwal
    $query = "INSERT INTO jadwal_periksa (id_dokter, hari, jam_mulai, jam_selesai) VALUES ('$id_dokter', '$hari', '$jam_mulai', '$jam_selesai')";

    if (mysqli_query($mysqli, $query)) {
      // Jika berhasil, redirect ke halaman dokter jadwal
      echo "<script>";
      echo "alert('Data jadwal berhasil ditambahkan!');";
      echo "window.location.href = '../../../dokter_jadwal.php';";
      echo "</script>";
      exit();
    } else {
      // Jika terjadi kesalahan, tampilkan pesan error
      echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }
  }
}
mysqli_close($mysqli);