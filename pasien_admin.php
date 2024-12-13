<?php
session_start();

$nama = $_SESSION['nama'];
$role = $_SESSION['role'];

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
        <a class="nav-link collapsed" href="dashboard_admin.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- End Jadwal Periksa Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="dokter_admin.php">
          <i class="bi bi-person-plus"></i>
          <span>Dokter</span>
        </a>
      </li>
      <!-- End Dokter Nav -->

      <li class="nav-item">
        <a class="nav-link" href="pasien_admin.php">
          <i class="bi bi-people"></i>
          <span>Pasien</span>
        </a>
      </li>
      <!-- End Pasien Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="poli_admin.php">
          <i class="bi bi-building"></i>
          <span>Poli</span>
        </a>
      </li>
      <!-- End Poli Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="obat_admin.php">
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
      <h1>Daftar Pasien</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard_admin.php">Home</a></li>
          <li class="breadcrumb-item active">Pasien</li>
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
              <h5 class="card-title">Tambah Pasien</h5>
              <form action="src/pasien/add.php" method="post" class="row g-3">
                <div class="col-12">
                  <label for="inputNama" class="form-label">Nama Pasien</label>
                  <input type="text" class="form-control" id="inputNama" name="nama" />
                </div>
                <div class="col-12">
                  <label for="inputAlamat" class="form-label">Alamat</label>
                  <textarea class="form-control" id="inputAlamat" name="alamat"></textarea>
                </div>
                <div class="col-12">
                  <label for="inputNoKTP" class="form-label">No. KTP</label>
                  <input type="text" class="form-control" id="inputNoKTP" name="no_ktp" />
                </div>
                <div class="col-12">
                  <label for="inputNoHp" class="form-label">No. Hp</label>
                  <input type="text" class="form-control" id="inputNoHp" name="no_hp" />
                </div>
                <div class="col-12">
                  <label for="inputPassword" class="form-label">Password</label>
                  <input type="password" class="form-control" id="inputPassword" name="password" />
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
                  <h5 class="card-title">Daftar Pasien</h5>

                  <table class="table datatable">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No. KTP/NIK</th>
                        <th>No. Hp</th>
                        <th>No. Rekam Medis</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      require 'config/database.php';
                      $no = 1;
                      $query = "SELECT * FROM pasien";
                      $result = mysqli_query($mysqli, $query);
                      while ($data = mysqli_fetch_array($result)) {
                      ?>
                        <tr>
                          <td><?php echo $no++ ?></td>
                          <td><?php echo $data['nama'] ?></td>
                          <td><?php echo $data['alamat'] ?></td>
                          <td><?php echo $data['no_ktp'] ?></td>
                          <td><?php echo $data['no_hp'] ?></td>
                          <td><?php echo $data['no_rm'] ?></td>
                          <td>
                            <button type='button' class='btn btn-sm btn-primary' data-toggle="modal"
                              data-target="#editModal<?php echo $data['id'] ?>"><i class="bi bi-pencil"></i></button>
                            <button type='button' class='btn btn-sm btn-danger' data-toggle="modal"
                              data-target="#hapusModal<?php echo $data['id'] ?>"><i class="bi bi-trash"></i></button>
                          </td>
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