<?php
include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $id = $_POST['id'];
  $password = md5($_POST['password']);
  $password_baru = md5($_POST['password_baru']);
  $konfirmasi_password = md5($_POST['konfirmasi_password']);

  $query = "SELECT * FROM dokter WHERE dokter.id='$id' AND dokter.password='$password'";
  $result = mysqli_query($mysqli, $query);

  if ($result) {
    if (mysqli_num_rows($result) > 0) {
      if ($password_baru == $konfirmasi_password) {
        $query = "UPDATE dokter SET password='$password_baru' WHERE id='$id'";
        if (mysqli_query($mysqli, $query)) {
          echo '<script>';
          echo 'alert("Password berhasil diubah!");';
          echo 'window.location.href = "../../dokter_profile.php";';
          echo '</script>';
          exit();
        } else {
          echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
        }
      } else {
        echo '<script>';
        echo 'alert("Konfirmasi password tidak sesuai!");';
        echo 'window.location.href = "../../dokter_profile.php";';
        echo '</script>';
        exit();
      }
    } else {
      echo '<script>';
      echo 'alert("Password lama salah!");';
      echo 'window.location.href = "../../dokter_profile.php";';
      echo '</script>';
      exit();
    }
  } else {
    echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
  }
}

mysqli_close($mysqli);
