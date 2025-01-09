<?php

include "../../../config/database.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

  // Ambil data dari form
  $id = $_POST["id"];
  $tanggal = $_POST["tanggal"];
  $catatan = $_POST["catatan"];
  $arrayObat = $_POST["obat"];

  $updateStatus = "UPDATE daftar_poli SET daftar_poli.status = '1' WHERE id = $id";

  if (mysqli_query($mysqli, $updateStatus)) {
    // Jika berhasil, tambahkan data periksa
    $insertPeriksa = "INSERT INTO periksa (id_daftar_poli, tgl_periksa, catatan, biaya_periksa) VALUES ('$id', '$tanggal', '$catatan', 150000)";

    if (mysqli_query($mysqli, $insertPeriksa)) {
      // Jika berhasil, tambahkan data detail periksa
      $getLastData = "SELECT * FROM periksa ORDER BY id DESC LIMIT 1";
      $queryGetLast = mysqli_query($mysqli, $getLastData);

      $getIdPeriksa = mysqli_fetch_assoc($queryGetLast);
      $id_periksa = $getIdPeriksa["id"];
      $totalBiaya = 150000;

      foreach ($arrayObat as $obat) {
        $inserDetailPeriksa = "INSERT INTO detail_periksa (id_periksa, id_obat) VALUES ('$id_periksa', '$obat')";

        $getHargaObat = "SELECT harga FROM obat WHERE id = '$obat'";
        $queryHargaObat = mysqli_query($mysqli, $getHargaObat);

        $hargaObat = mysqli_fetch_assoc($queryHargaObat)["harga"];
        $totalBiaya += $hargaObat;

        if (!mysqli_query($mysqli, $inserDetailPeriksa)) {
          echo "<script>";
          echo "alert('Pasien gagal diperiksa');";
          echo "window.location.href = '../../../dokter_periksa.php';";
          echo "</script>";
          exit();
        }
      }

      $updateTotalBiaya = "UPDATE periksa SET biaya_periksa = '$totalBiaya' WHERE id = '$id_periksa'";

      if (mysqli_query($mysqli, $updateTotalBiaya)) {
        // Jika berhasil, redirect ke halaman dokter periksa
        echo "<script>";
        echo "alert('Pasien telah diperiksa');";
        echo "window.location.href = '../../../dokter_periksa.php';";
        echo "</script>";
      } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
      }
    }
  }
}
mysqli_close($mysqli);