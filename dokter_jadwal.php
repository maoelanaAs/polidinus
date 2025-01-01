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

if (!$isLogin) {
  header('Location: login_dokter.php');
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
      <li class="nav-item collapsed">
        <a class="nav-link collapsed" href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- End Jadwal Periksa Nav -->

      <li class="nav-item">
        <a class="nav-link" href="dokter_jadwal.php">
          <i class="bi bi-journal-medical"></i>
          <span>Jadwal Periksa</span>
        </a>
      </li>
      <!-- End Jadwal Periksa Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="dokter_pasien.php">
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
      <h1>Jadwal Periksa</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Jadwal</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-4">
          <!-- Recent Activity -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah Jadwal</h5>
              <form action="src/jadwal/add.php" method="post" class="row g-3">
                <div class="col-12">
                  <label for="selectHari" class="mb-2">Hari</label>
                  <select class="form-select" id="selectHari" name="hari">
                    <?php
                    $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                    foreach ($hari as $h) {
                    ?>
                      <option value="<?php echo $h ?>"><?php echo $h ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-12">
                  <label for="inputJamMulai" class="form-label">Jam Mulai</label>
                  <input type="time" class="form-control" id="inputJamMulai" name="jam_mulai" />
                </div>
                <div class="col-12">
                  <label for="inputJamSelesai" class="form-label">Jam Selesai</label>
                  <input type="time" class="form-control" id="inputJamSelesai" name="jam_selesai" />
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">
                    Tambah
                  </button>
                </div>
              </form>
            </div>
          </div>
          <!-- End Recent Activity -->
        </div>
        <!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-8">
          <div class="row">
            <!-- Reports -->
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Daftar Jadwal</h5>

                  <table class="table datatable">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Hari</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      require 'config/database.php';
                      $no = 1;
                      $query = "SELECT jadwal_periksa.id, jadwal_periksa.id_dokter, jadwal_periksa.hari, jadwal_periksa.jam_mulai, jadwal_periksa.jam_selesai, jadwal_periksa.status FROM jadwal_periksa INNER JOIN dokter ON jadwal_periksa.id_dokter = dokter.id WHERE dokter.id = '$id_dokter'";
                      $result = mysqli_query($mysqli, $query);
                      while ($data = mysqli_fetch_assoc($result)) {
                      ?>
                        <tr>
                          <td><?php echo $no++ ?></td>
                          <td><?php echo $data['hari'] ?></td>
                          <td><?php echo $data['jam_mulai'] ?></td>
                          <td><?php echo $data['jam_selesai'] ?></td>
                          <td>
                            <span
                              class="badge bg-<?= $data['status'] ? 'success' : 'danger' ?>"><?= $data['status'] ? 'Aktif' : 'Tidak Aktif' ?></span>
                          </td>
                          <?php if ($data['status']) { ?>
                            <td>
                            </td>
                          <?php } else { ?>
                            <td>
                              <form action="src/jadwal/edit.php" method="post">
                                <input type="hidden" name="id_jadwal" value="<?php echo $data['id'] ?>">
                                <button type='submit' class='btn btn-sm btn-success'><i
                                    class="bi bi-power me-2"></i>Aktifkan</button>
                              </form>
                            </td>
                          <?php } ?>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- End Reports -->
          </div>
        </div>
        <!-- End Right side columns -->
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