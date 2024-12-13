<?php
session_start();
require '../../config/database.php';


if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $nama = $_POST['nama'];
  $password = md5($_POST['password']);

  if ($nama == "admin" && $password == md5("admin123")) {
    $_SESSION['nama'] = $nama;
    $_SESSION['password'] = $password;
    $_SESSION['role'] = "Admin";

    header("location:../../dashboard_admin.php");
  } else {
    $query = "SELECT * FROM dokter WHERE nama = '$nama' && password = '$password'";
    $result = mysqli_query($mysqli, $query);
    if (mysqli_num_rows($result) > 0) {
      $data = mysqli_fetch_assoc($result);

      $_SESSION['id'] = $data['id'];
      $_SESSION['nama'] = $data['nama'];
      $_SESSION['password'] = $data['password'];
      $_SESSION['id_poli'] = $data['id_poli'];
      $_SESSION['role'] = "Dokter";

      header("location:../../dashboard_dokter.php");
    } else {
      echo '<script>alert("Email atau password salah");location.href="../../login_dokter.php";</script>';
    }
  }
}
