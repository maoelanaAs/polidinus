<?php
include '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $rekam_medis = $_POST['no_rm'];
  $id_jadwal = $_POST['jadwal'];
  $keluhan = $_POST['keluhan'];
  $no_antrian = 0;

  $cariPasien = "SELECT * FROM pasien WHERE no_rm = '$rekam_medis'";
  $query = $mysqli->query($cariPasien);
  $data = $query->fetch_assoc();
  $id_pasien = $data['id'];

  $cekData = "SELECT * FROM daftar_poli";
  $queryCekData = $mysqli->query($cekData);

  if ($queryCekData->num_rows > 0) {
    $cekNoAntrian = "SELECT * FROM daftar_poli WHERE id_jadwal = '$id_jadwal' ORDER BY no_antrian DESC LIMIT 1";
    $queryNoAntrian = $mysqli->query($cekNoAntrian);
    $dataPoli = $queryNoAntrian->fetch_assoc();
    $antrianTerakhir = (int) $dataPoli['no_antrian'];
    $antrianBaru = $antrianTerakhir += 1;

    $daftarPoli = "INSERT INTO daftar_poli (id_pasien, id_jadwal, keluhan, no_antrian, daftar_poli.status) VALUES ('$id_pasien', '$id_jadwal', '$keluhan', '$antrianBaru', '0')";
    $queryDaftarPoli = $mysqli->query($daftarPoli);

    if ($queryDaftarPoli) {
      echo '<script>alert("Berhasil mendaftar poli");window.location.href="../../index.php";</script>';
    } else {
      echo '<script>alert("Gagal mendaftar poli");window.location.href="../../index.php";</script>';
    }
  } else {
    $no_antrian = 1;

    $daftarPoli = "INSERT INTO daftar_poli (id_pasien, id_jadwal, keluhan, no_antrian, daftar_poli.status) VALUES ('$id_pasien', '$id_jadwal', '$keluhan', '$no_antrian', '0')";
    $queryDaftarPoli = $mysqli->query($daftarPoli);

    if ($queryDaftarPoli) {
      echo '<script>alert("Berhasil mendaftar poli");window.location.href="../../index.php";</script>';
    } else {
      echo '<script>alert("Gagal mendaftar poli");window.location.href="../../index.php";</script>';
    }
  }
}
