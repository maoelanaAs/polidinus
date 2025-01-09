<?php

include "../../../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $thn = date("Y");
  $bln = date("m");

  // Ambil data dari form
  $nama = $_POST["nama"];
  $alamat = $_POST["alamat"];
  $no_ktp = $_POST["no_ktp"];
  $no_hp = $_POST["no_hp"];
  $password = $_POST["password"];

  $no_rm = $thn . $bln . '-' . '001';

  // Query
  $cekNoKTP = "SELECT * FROM pasien WHERE no_ktp = '$no_ktp'";
  $queryCekKTP = mysqli_query($mysqli, $cekNoKTP);

  $searchData = "SELECT * FROM pasien";
  $querySearch = mysqli_query($mysqli, $searchData);

  if (mysqli_num_rows($queryCekKTP) > 0) {
    // Jika no ktp sudah terdaftar
    echo "<script>";
    echo "alert('No KTP telah terdaftar sebelumnya!');";
    echo "window.location.href = '../../../admin_pasien.php';";
    echo "</script>";
    exit();
  } else {
    // Jika no ktp belum terdaftar
    if (mysqli_num_rows($querySearch) < 1) {
      // Jika belum ada data pasien
      $insertData = "INSERT INTO pasien (nama, password, alamat, no_ktp, no_hp, no_rm) VALUES ('$nama', '$password', '$alamat', '$no_ktp', '$no_hp', '$no_rm')";

      // Eksekusi query
      if (mysqli_query($mysqli, $insertData)) {
        // Jika berhasil, redirect ke halaman admin pasien
        echo "<script>";
        echo "alert('Data pasien berhasil ditambahkan!');";
        echo "window.location.href = '../../../admin_pasien.php';";
        echo "</script>";
        exit();
      } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
      }
    } else {
      // Jika sudah ada data pasien
      $getLastData = "SELECT * FROM pasien ORDER BY no_rm DESC limit 1";
      $queryGetLast = mysqli_query($mysqli, $getLastData);

      $lastData = mysqli_fetch_assoc($queryGetLast);
      $substring = substr($lastData["no_rm"], 7);
      $urutanTerakhir = (int) $substring;
      $urutanTerakhir += 1;

      // Generate no rm
      if ($urutanTerakhir < 10) {
        $no_rm = $thn . $bln . '-00' . $urutanTerakhir;
      } else if ($urutanTerakhir < 100) {
        $no_rm = $thn . $bln . '-0' . $urutanTerakhir;
      } else {
        $no_rm = $thn . $bln . '-' . $urutanTerakhir;
      }

      $insertData = "INSERT INTO pasien (nama, password, alamat, no_ktp, no_hp, no_rm) VALUES ('$nama', '$password', '$alamat', '$no_ktp', '$no_hp', '$no_rm')";

      // Eksekusi query
      if (mysqli_query($mysqli, $insertData)) {
        // Jika berhasil, redirect ke halaman admin pasien
        echo "<script>";
        echo "alert('Data pasien berhasil ditambahkan!');";
        echo "window.location.href = '../../../admin_pasien.php';";
        echo "</script>";
        exit();
      } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
      }
    }
  }
}
mysqli_close($mysqli);