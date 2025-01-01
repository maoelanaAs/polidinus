<?php

include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $id = $_POST['id'];
  $tanggal = $_POST['tanggal'];
  $catatan = $_POST['catatan'];
  $arrayObat = $_POST['obat'];

  $updateStatus = "UPDATE daftar_poli SET daftar_poli.status = '1' WHERE id = '$id'";
  $query = mysqli_query($mysqli, $updateStatus);

  if ($query) {
    $insertPeriksa = "INSERT INTO periksa (id_daftar_poli, tgl_periksa, catatan, biaya_periksa) VALUES ('$id', '$tanggal', '$catatan', 150000)";
    $queryInsertPeriksa = mysqli_query($mysqli, $insertPeriksa);

    if ($queryInsertPeriksa) {
      $getLastData = "SELECT * FROM periksa ORDER BY id DESC LIMIT 1";
      $queryGetLastData = mysqli_query($mysqli, $getLastData);
      $getIdPeriksa = mysqli_fetch_assoc($queryGetLastData);

      $idPeriksa = $getIdPeriksa['id'];

      $totalBiaya = 150000;

      foreach ($arrayObat as $obat) {
        $inserDetailPeriksa = "INSERT INTO detail_periksa (id_periksa, id_obat) VALUES ('$idPeriksa', '$obat')";
        $queryDetailPeriksa = mysqli_query($mysqli, $inserDetailPeriksa);

        $getHargaObat = "SELECT harga FROM obat WHERE id = '$obat'";
        $queryHargaObat = mysqli_query($mysqli, $getHargaObat);
        $hargaObat = mysqli_fetch_assoc($queryHargaObat)['harga'];

        $totalBiaya += $hargaObat;

        if (!$queryDetailPeriksa) {
          echo '<script>alert("Pasien gagal diperiksa");window.location.href="../../dokter_pasien.php"</script>';
          exit;
        }
      }

      $updateTotalBiaya = "UPDATE periksa SET biaya_periksa = '$totalBiaya' WHERE id = '$idPeriksa'";
      $queryUpdateTotalBiaya = mysqli_query($mysqli, $updateTotalBiaya);

      if ($queryUpdateTotalBiaya) {
        echo '<script>alert("Pasien telah diperiksa");window.location.href="../../dokter_pasien.php"</script>';
      } else {
        echo '<script>alert("Pasien gagal diperiksa");window.location.href="../../dokter_pasien.php"</script>';
      }
    }
  }
}