<?php
require '../../config/database.php';

$id_poli = $_POST['id_poli'];

$query = "SELECT jadwal_periksa.id as idJadwal, dokter.nama, jadwal_periksa.hari, DATE_FORMAT(jadwal_periksa.jam_mulai, '%H:%i') as jamMulai, DATE_FORMAT(jadwal_periksa.jam_selesai, '%H:%i') as jamSelesai FROM jadwal_periksa INNER JOIN dokter ON jadwal_periksa.id_dokter = dokter.id INNER JOIN poli ON dokter.id_poli = poli.id WHERE poli.id = '$id_poli' AND jadwal_periksa.status = '1'";
$result = mysqli_query($mysqli, $query);

if ($result) {
  if (mysqli_num_rows($result) > 0) {
    $jadwalOptions = "";
    while ($dataJadwal = mysqli_fetch_assoc($result)) {
      $jadwalOptions .= "<option value='" . $dataJadwal['idJadwal'] . "'>" . $dataJadwal['nama'] . ' | ' . $dataJadwal['hari'] . ' ' . $dataJadwal['jamMulai'] . ' - ' . $dataJadwal['jamSelesai'] . "</option>";
    }
    echo $jadwalOptions;
  } else {
    echo "<option value='' disabled selected>Jadwal tidak ditemukan</option>";
  }

  mysqli_free_result($result);
} else {
  echo "Error: " . mysqli_error($mysqli);
}

mysqli_close($mysqli);
