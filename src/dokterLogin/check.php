<?php

session_start();
include "../../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Ambil data dari form
  $nama = $_POST["nama"];
  $password = md5($_POST["password"]);


  // Cek apakah login sebagai admin atau dokter
  if ($nama == "admin" && $password == md5("admin123")) {
    $_SESSION["nama"] = $nama;
    $_SESSION["password"] = $password;
    $_SESSION["role"] = "Admin";
    $_SESSION["isLogin"] = true;

    header("location:../../admin_dashboard.php");
  } else {
    $query = "SELECT * FROM dokter WHERE nama = '$nama' && password = '$password'";
    $result = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($result) > 0) {
      $data = mysqli_fetch_assoc($result);

      $_SESSION['id'] = $data['id'];
      $_SESSION['role'] = "Dokter";
      $_SESSION['isLogin'] = true;

      header("location:../../dokter_dashboard.php");
    } else {
      echo "<script>";
      echo "alert('Nama atau password salah!');";
      echo "location.href = '../../dokter_login.php';";
      echo "</script>";
    }
  }
}