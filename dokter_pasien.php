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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
  <!-- Or for RTL support -->
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
  <link href="assets/vendor/select2/css/select2.min.css" rel="stylesheet">
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
            <span class="d-none d-md-block dropdown-toggle ps-2"><?= $nama ?></span> </a>
          <!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?= $nama ?></h6>
              <span><?= $nama_poli ?></span>
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
        <a class="nav-link collapsed" href="dokter_jadwal.php">
          <i class="bi bi-journal-medical"></i>
          <span>Jadwal Periksa</span>
        </a>
      </li>
      <!-- End Jadwal Periksa Nav -->

      <li class="nav-item">
        <a class="nav-link" href="dokter_pasien.php">
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
      <h1>Daftar Pasien</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Pasien</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Daftar Pasien</h5>

              <table class="table datatable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>No. Rekam Medis</th>
                    <th>Nama Pasien</th>
                    <th>Keluhan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $query = "SELECT pasien.nama, pasien.no_rm, daftar_poli.keluhan, daftar_poli.status, daftar_poli.id FROM daftar_poli INNER JOIN pasien ON daftar_poli.id_pasien = pasien.id INNER JOIN jadwal_periksa ON daftar_poli.id_jadwal = jadwal_periksa.id INNER JOIN dokter ON jadwal_periksa.id_dokter = dokter.id WHERE dokter.id = '$id_dokter'";
                  $result = mysqli_query($mysqli, $query);

                  while ($data = mysqli_fetch_assoc($result)) {
                  ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $data['no_rm'] ?></td>
                    <td><?= $data['nama'] ?></td>
                    <td><?= $data['keluhan'] ?></td>
                    <td>
                      <button type='button' class='btn btn-sm btn-warning' data-bs-toggle="modal"
                        data-bs-target="#<?= $data['status'] == 0 ? 'periksaModal' . $data['id'] : 'editModal' . $data['id'] ?>"><i
                          class="bi bi-<?= $data['status'] == 0 ? 'eye' : 'pencil' ?>"></i></button>
                    </td>
                    <!-- Periksa Modal -->
                    <div class="modal fade" id="periksaModal<?= $data['id']; ?>" tabindex="-1"
                      aria-labelledby="periksaModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="periksaModalLabel">Periksa Pasien</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form action="src/periksa/periksa.php" method="post">
                              <input type="hidden" class="form-control" id="id" name="id" value="<?= $data['id']; ?>">
                              <div class="mb-3">
                                <label for="namaPasien" class="form-label">Nama Pasien</label>
                                <input type="text" class="form-control" id="namaPasien" value="<?= $data['nama'] ?>"
                                  name="nama" readonly />
                              </div>
                              <div class="mb-3">
                                <label for="tanggal_periksa" class="form-label">Tanggal Periksa</label>
                                <input type="datetime-local" class="form-control" id="tanggal_periksa" name="tanggal"
                                  required />
                              </div>
                              <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan</label>
                                <textarea class="form-control" id="catatan" name="catatan" required></textarea>
                              </div>
                              <div class="mb-3">
                                <label for="multiple-select-field" class="form-label">Obat</label>
                                <select id="multiple-select-field" multiple data-placeholder="Pilih Obat" name="obat[]">
                                  <?php
                                    $getObat = "SELECT * FROM obat";
                                    $queryObat = mysqli_query($mysqli, $getObat);
                                    while ($datas = mysqli_fetch_assoc($queryObat)) {
                                    ?>
                                  <option value="<?php echo $datas['id'] ?>">
                                    <?php echo $datas['nama_obat'] ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                  Periksa
                                </button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Periksa Modal-->
                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal<?= $data['id']; ?>" tabindex="-1"
                      aria-labelledby="editModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Ubah Catatan Periksa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form action="src/periksa/ubah.php" method="post">
                              <input type="hidden" class="form-control" id="id" name="id" value="<?= $data['id']; ?>">
                              <div class="mb-3">
                                <label for="namaPasien" class="form-label">Nama Pasien</label>
                                <input type="text" class="form-control" id="namaPasien" value="<?= $data['nama'] ?>"
                                  name="nama" readonly />
                              </div>
                              <div class="mb-3">
                                <label for="tanggal_periksa" class="form-label">Tanggal Periksa</label>
                                <input type="datetime-local" class="form-control" id="tanggal_periksa" name="tanggal"
                                  required />
                              </div>
                              <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan</label>
                                <textarea class="form-control" id="catatan" name="catatan" required></textarea>
                              </div>
                              <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                  Ubah Catatan Periksa
                                </button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Edit Modal -->
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
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
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/script.js"></script>
  <script>
  $(function() {
    // Inisialisasi Select2 ketika modal dibuka
    $(document).on('shown.bs.modal', function(e) {
      const modal = $(e.target); // Modal yang saat ini dibuka
      const selectElement = modal.find('#multiple-select-field');
      if (selectElement.length) {
        selectElement.select2({
          theme: "bootstrap-5",
          width: selectElement.data('width') ? selectElement.data('width') : selectElement.hasClass(
            'w-100') ? '100%' : 'style',
          placeholder: selectElement.data('placeholder'),
          closeOnSelect: false,
        });
      }
    });
  });
  </script>
</body>

</html>