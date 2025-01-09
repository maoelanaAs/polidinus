<?php

include "../../../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Ammbil data dari form
  $no_rm = $_POST["no_rm"];
  $id_jadwal = $_POST["jadwal"];
  $keluhan = $_POST["keluhan"];
  $no_antrian = 0;

  // Cek data pasien
  $cariPasien = "SELECT * FROM pasien WHERE no_rm = '$no_rm'";
  $queryCariPasien = $mysqli->query($cariPasien);
  $dataPasien = $queryCariPasien->fetch_assoc();
  $id_pasien = $dataPasien["id"];

  $cekData = "SELECT * FROM daftar_poli";
  $queryCekData = $mysqli->query($cekData);

  if ($queryCekData->num_rows > 0) {
    $cekNoAntrian = "SELECT * FROM daftar_poli WHERE id_jadwal = '$id_jadwal' ORDER BY no_antrian DESC LIMIT 1";
    $queryNoAntrian = $mysqli->query($cekNoAntrian);
    $dataPoli = $queryNoAntrian->fetch_assoc();

    $antrianTerakhir = (int) $dataPoli["no_antrian"];
    $antrianBaru = $antrianTerakhir += 1;

    $daftarPoli = "INSERT INTO daftar_poli (id_pasien, id_jadwal, keluhan, no_antrian, daftar_poli.status) VALUES ('$id_pasien', '$id_jadwal', '$keluhan', '$antrianBaru', '0')";
    $queryDaftarPoli = $mysqli->query($daftarPoli);

    if ($queryDaftarPoli) {
      // Jika berhasil, redirect ke halaman admin dokter
      echo "<script>";
      echo "alert('Berhasil mendaftar poli!');";
      echo "window.location.href = '../../../index.php';";
      echo "</script>";
      exit();
    } else {
      // Jika terjadi kesalahan, tampilkan pesan error
      echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }
  } else {
    $no_antrian = 1;

    $daftarPoli = "INSERT INTO daftar_poli (id_pasien, id_jadwal, keluhan, no_antrian, daftar_poli.status) VALUES ('$id_pasien', '$id_jadwal', '$keluhan', '$no_antrian', '0')";
    $queryDaftarPoli = $mysqli->query($daftarPoli);

    if ($queryDaftarPoli) {
      // Jika berhasil, redirect ke halaman admin dokter
      echo "<script>";
      echo "alert('Berhasil mendaftar poli!');";
      echo "window.location.href = '../../../index.php';";
      echo "</script>";
      exit();
    } else {
      // Jika terjadi kesalahan, tampilkan pesan error
      echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }
  }
}