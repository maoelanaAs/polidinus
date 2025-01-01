<?php

include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

  $id = $_POST['id'];
  $tanggal = $_POST['tanggal'];
  $catatan = $_POST['catatan'];

  $queryUpdate = mysqli_query($mysqli, "UPDATE periksa SET tgl_periksa = '$tanggal', catatan = '$catatan' WHERE id_daftar_poli = '$id'");
  if ($queryUpdate) {
    echo '<script>alert("Data berhasil diubah");window.location.href="../../dokter_pasien.php"</script>';
  } else {
    echo '<script>alert("Data gagal diubah");window.location.href="../../dokter_pasien.php"</script>';
  }
}