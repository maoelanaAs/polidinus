<?php
session_start();
include 'config/database.php';

$nama = $_SESSION['nama'];
$role = $_SESSION['role'];

// menghitung jumlah pasien
$query = "SELECT COUNT(*) as jmlPasien FROM pasien";
$result = mysqli_query($mysqli, $query);
$row = mysqli_fetch_assoc($result);
$jmlPasien = $row['jmlPasien'];

// menghitung jumlah dokter
$query = "SELECT COUNT(*) as jmlDokter FROM dokter";
$result = mysqli_query($mysqli, $query);
$row = mysqli_fetch_assoc($result);
$jmlDokter = $row['jmlDokter'];

// menghitung jumlah poli
$query = "SELECT COUNT(*) as jmlPoli FROM poli";
$result = mysqli_query($mysqli, $query);
$row = mysqli_fetch_assoc($result);
$jmlPoli = $row['jmlPoli'];

// menghitung jumlah obat
$query = "SELECT COUNT(*) as jmlObat FROM obat";
$result = mysqli_query($mysqli, $query);
$row = mysqli_fetch_assoc($result);
$jmlObat = $row['jmlObat'];

if ($nama == "") {
  header("location:login_dokter.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

  <title>Dashboard</title>

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
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="" />
        <span class="d-none d-lg-block">Poliklinik</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle" href="#">
            <i class="bi bi-search"></i>
          </a>
        </li>
        <!-- End Search Icon-->

        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/doctor.jpg" alt="Profile" class="rounded-circle" />
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $nama ?></span> </a>
          <!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $nama ?></h6>
              <span><?php echo $role ?></span>
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
        <a class="nav-link" href="index.html">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- End Jadwal Periksa Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="doctors.html">
          <i class="bi bi-person-plus"></i>
          <span>Dokter</span>
        </a>
      </li>
      <!-- End Dokter Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="patients.html">
          <i class="bi bi-people"></i>
          <span>Pasien</span>
        </a>
      </li>
      <!-- End Pasien Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="departments.html">
          <i class="bi bi-building"></i>
          <span>Poli</span>
        </a>
      </li>
      <!-- End Poli Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="medicines.html">
          <i class="bi bi-capsule"></i>
          <span>Obat</span>
        </a>
      </li>
      <!-- End Obat Nav -->
    </ul>
  </aside>
  <!-- End Sidebar-->

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">
            <!-- Pasien Card -->
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card pasien-card">
                <div class="card-body">
                  <h5 class="card-title">Pasien</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $jmlPasien ?></h6><span class="text-muted small pt-2 ps-1">Jumlah Pasien</span>

                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- End Pasien Card -->

            <!-- Dokter Card -->
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card dokter-card">
                <div class="card-body">
                  <h5 class="card-title">Dokter</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-plus"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $jmlDokter ?></h6><span class="text-muted small pt-2 ps-1">Jumlah Dokter</span>

                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- End Dokter Card -->

            <!-- Poli Card -->
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card poli-card">
                <div class="card-body">
                  <h5 class="card-title">Poli</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-building"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $jmlPoli ?></h6><span class="text-muted small pt-2 ps-1">Jumlah Poli</span>

                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- End Poli Card -->
            <!-- Obat Card -->
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card obat-card">
                <div class="card-body">
                  <h5 class="card-title">Obat</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-capsule"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $jmlObat ?></h6><span class="text-muted small pt-2 ps-1">Jumlah Obat</span>

                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- End Obat Card -->
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