<?php
session_start();
require 'config/database.php';

$id_dokter = $_SESSION['id'];
$role = $_SESSION['role'];
$isLogin = $_SESSION['isLogin'];

$query = "SELECT * FROM dokter WHERE id = '$id_dokter'";
$result = mysqli_query($mysqli, $query);
$data = mysqli_fetch_assoc($result);
$nama = $data['nama'];
$id_poli = $data['id_poli'];

// mendapatkan nama poli berdasarkan id_poli
$query = "SELECT * FROM poli WHERE id = '$id_poli'";
$result = mysqli_query($mysqli, $query);
$data = mysqli_fetch_assoc($result);
$nama_poli = $data['nama_poli'];

// mendapatkan data dokter berdasarkan id
$query = "SELECT * FROM dokter WHERE id = '$id_dokter'";
$result = mysqli_query($mysqli, $query);
$data = mysqli_fetch_assoc($result);
$alamat = $data['alamat'];
$no_hp = $data['no_hp'];

if (!$isLogin) {
  header('Location: dokter_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

  <title>Dashboard Dokter</title>

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon" />

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect" />
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet" />

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet" />
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet" />
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet" />

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet" />

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="" />
        <span class="d-none d-lg-block">Poliklinik</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/doctor.jpg" alt="Profile" class="rounded-circle" />
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $nama ?></span> </a>
          <!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $nama ?></h6>
              <span><?php echo $nama_poli ?></span>
            </li>
            <li>
              <hr class="dropdown-divider" />
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="dokter_profile.php">
                <i class="bi bi-person"></i>
                <span>Profil Saya</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider" />
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="src/logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Keluar</span>
              </a>
            </li>
          </ul>
          <!-- End Profile Dropdown Items -->
        </li>
        <!-- End Profile Nav -->
      </ul>
    </nav>
    <!-- End Icons Navigation -->
  </header>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- End Jadwal Periksa Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="dokter_jadwal.php">
          <i class="bi bi-journal-medical"></i>
          <span>Jadwal Periksa</span>
        </a>
      </li>
      <!-- End Jadwal Periksa Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="dokter_periksa.php">
          <i class="bi bi-people"></i>
          <span>Daftar Pasien</span>
        </a>
      </li>
      <!-- End Daftar Pasien Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="dokter_riwayat.php">
          <i class="bi bi-hourglass-split"></i>
          <span>Riwayat Pasien</span>
        </a>
      </li>
      <!-- End Riwayat Pasien Nav -->
    </ul>
  </aside>
  <!-- End Sidebar-->

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Profil Saya</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Profil</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">
          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              <img src="assets/img/doctor.jpg" alt="Profile" class="rounded-circle" />
              <h2><?= $nama ?></h2>
              <h3><?= $nama_poli ?></h3>
              <h3><?= $no_hp ?></h3>
              <h6><?= $alamat ?></h6>
            </div>
          </div>
        </div>

        <div class="col-xl-8">
          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">
                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">
                    Ubah Profil
                  </button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">
                    Ubah Kata Sandi
                  </button>
                </li>
              </ul>
              <div class="tab-content pt-2">
                <div class="tab-pane show active fade profile-edit pt-3" id="profile-edit">
                  <!-- Profile Edit Form -->
                  <form action="src/dokter/profile/update.php" method="post">
                    <input type="hidden" name="id" value="<?= $id_dokter ?>" />
                    <div class="row mb-3">
                      <label for="inputNama" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nama" type="text" class="form-control" id="inputNama" value="<?= $nama ?>" />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="inputAlamat" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="alamat" type="text" class="form-control" id="inputAlamat" value="<?= $alamat ?>" />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="inputNoHp" class="col-md-4 col-lg-3 col-form-label">Nomor HP</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="no_hp" type="text" class="form-control" id="inputNoHp" value="<?= $no_hp ?>" />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="selectPoli" class="col-md-4 col-lg-3 col-form-label">Posisi Poli</label>
                      <div class="col-md-8 col-lg-9">
                        <select name="poli" id="selectPoli" class="form-control" style="pointer-events: none;">
                          <?php
                          $query = "SELECT * FROM poli";
                          $result = mysqli_query($mysqli, $query);
                          while ($dataPoli = mysqli_fetch_array($result)) {
                          ?>
                          <option value="<?= $dataPoli['id'] ?>" <?= ($dataPoli['id'] == $id_poli) ? 'selected' : '' ?>>
                            <?= $dataPoli['nama_poli'] ?>
                          </option>
                          <?php } ?>
                        </select>
                        <!-- <input type="text" class="form-control" value="<?= $nama_poli ?>" name="poli" id="selectPoli"
                          readonly /> -->
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">
                        Ubah Profile
                      </button>
                    </div>
                  </form>
                  <!-- End Profile Edit Form -->
                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form action="src/dokter/profile/password.php" method="post">
                    <input type="hidden" name="id" value="<?= $id_dokter ?>" />
                    <div class="row mb-3">
                      <label for="passwordSekarang" class="col-md-4 col-lg-3 col-form-label">Kata Sandi
                        Sekarang</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="passwordSekarang" />
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="passwordBaru" class="col-md-4 col-lg-3 col-form-label">Kata Sandi Baru</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password_baru" type="password" class="form-control" id="passwordBaru" />
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="konfirmasiPassword" class="col-md-4 col-lg-3 col-form-label">Konfirmasi Kata
                        Sandi</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="konfirmasi_password" type="password" class="form-control"
                          id="konfirmasiPassword" />
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">
                        Ubah Kata Sandi
                      </button>
                    </div>
                  </form>
                  <!-- End Change Password Form -->
                </div>
              </div>
              <!-- End Bordered Tabs -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/script.js"></script>
</body>

</html>