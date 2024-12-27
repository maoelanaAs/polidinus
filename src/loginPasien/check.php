<?php
session_start();
require '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $no_ktp = $_POST['no_ktp'];
  $password = md5($_POST['password']);

  $query = "SELECT * FROM pasien WHERE no_ktp = '$no_ktp' && password = '$password'";
  $result = mysqli_query($mysqli, $query);
  if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);

    $_SESSION['id'] = $data['id'];
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['password'] = $data['password'];
    $_SESSION['no_rm'] = $data['no_rm'];
    $_SESSION['role'] = "Pasien";
    $_SESSION['isLogin'] = true;

    header("location:../../index.php");
  } else {
    echo '<script>alert("No KTP atau password salah");location.href="../../login_pasien.php";</script>';
  }
}