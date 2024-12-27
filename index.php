<?php
include 'config/database.php';
session_start();

// Cek apakah user sudah login
$isLogin = isset($_SESSION['isLogin']) ? $_SESSION['isLogin'] : false;

// Jika user sudah login, maka ambil data user
$id_pasien = $isLogin ? $_SESSION['id'] : '';
$nama = $isLogin ? $_SESSION['nama'] : '';
$role = $isLogin ? $_SESSION['role'] : '';

// jika role adalah dokter, maka pindah ke dashboard dokter
if ($isLogin && $role === 'Dokter') {
  header("location:dashboard_dokter.php");
}

// jika role adalah admin, maka pindah ke dashboard admin
if ($isLogin && $role === 'Admin') {
  header("location:dashboard_admin.php");
}

// Menghitung jumlah dokter
$query = "SELECT COUNT(*) as jumlah FROM dokter";
$result = mysqli_query($mysqli, $query);
$data = mysqli_fetch_assoc($result);
$jmlDokter = $data['jumlah'];

// Menghitung jumlah poli
$query = "SELECT COUNT(*) as jumlah FROM poli";
$result = mysqli_query($mysqli, $query);
$data = mysqli_fetch_assoc($result);
$jmlPoli = $data['jumlah'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Poliklinik</title>

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon" />

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect" />
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet" />

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
  <link href="assets/vendor/aos/aos.css" rel="stylesheet" />
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet" />

  <!-- =======================================================
  * Template Name: Medilab
  * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">
  <header id="header" class="header sticky-top">
    <div class="branding d-flex align-items-center">
      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center me-auto">
          <img src="assets/img/logo.png" alt="" />
          <h1 class="sitename">Poliklinik</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li>
              <a href="#hero" class="active">Home<br /></a>
            </li>
            <li><a href="#departments">Poli</a></li>
            <li><a href="#doctors">Dokter</a></li>
            <?php if ($isLogin && $role === 'Pasien'): ?>
            <li class="dropdown">
              <a href="#" class="fw-bold"><span><?= $nama ?></span>
                <i class="bi bi-person-circle toggle-dropdown fs-5 ms-2"></i></a>
              <ul>
                <li>
                  <a data-bs-toggle="modal" href="#appointmentHistoryModalToggle" role="button">Riwayat Periksa</a>
                </li>
                <li><a href="src/logout.php">Keluar</a></li>
              </ul>
            </li>
            <?php endif; ?>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <?php if (!$isLogin): ?>
        <a class="adl-btn d-none d-sm-block" href="login_dokter.php">Sebagai Dokter</a>
        <?php endif; ?>

        <a class="cta-btn d-none d-sm-block"
          href="<?= $isLogin && $role === 'Pasien' ? '#appointment' : 'register_pasien.php' ?>">Buat
          Janji</a>

      </div>
    </div>
  </header>

  <main class="main">
    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">
      <img src="assets/img/hero-bg.jpg" alt="" data-aos="fade-in" />

      <div class="container position-relative">
        <div class="welcome position-relative" data-aos="fade-down" data-aos-delay="100">
          <h2>Selamat Datang di Poliklinik</h2>
          <p>Solusi Modern untuk Janji Temu Dokter Tanpa Ribet</p>
        </div>
        <!-- End Welcome -->

        <div class="content row gy-4 justify-content-evenly">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="why-box" data-aos="zoom-out" data-aos-delay="200">
              <h3>Kenapa Poliklinik?</h3>
              <p>
                Poliklinik menjadi pilihan terbaik karena menyediakan berbagai
                layanan poli lengkap yang memenuhi semua kebutuhan kesehatan
                Anda, didukung oleh dokter-dokter terpercaya dan berpengalaman
                yang siap memberikan perawatan terbaik. Anda mendapatkan
                kemudahan, kualitas, dan kepedulian dalam satu tempat.
              </p>
              <div class="text-center">
                <a href="<?= $isLogin && $role === 'Pasien' ? '#appointment' : 'register_pasien.php' ?>"
                  class="more-btn"><span>Buat
                    Janji</span> <i class="bi bi-chevron-right"></i></a>
              </div>
            </div>
          </div>
          <!-- End Why Box -->

          <div class="col-lg-6 d-flex align-items-stretch">
            <div class="d-flex flex-column justify-content-center">
              <div class="row gy-4">
                <div class="col-xl-6 d-flex align-items-stretch">
                  <div class="icon-box" data-aos="zoom-out" data-aos-delay="300">
                    <i class="fas fa-user-md"></i>
                    <span data-purecounter-start="0" data-purecounter-end="<?= $jmlDokter ?>"
                      data-purecounter-duration="1" class="purecounter">
                    </span>
                    <h4>Dokter</h4>
                    <p>
                      Didukung oleh tim dokter berpengalaman dan terpercaya
                      memberikan layanan kesehatan terbaik
                    </p>
                  </div>
                </div>
                <!-- End Icon Box -->

                <div class="col-xl-6 d-flex align-items-stretch">
                  <div class="icon-box" data-aos="zoom-out" data-aos-delay="300">
                    <i class="fas fa-house-chimney-medical"></i>
                    <span data-purecounter-start="0" data-purecounter-end="<?= $jmlPoli ?>"
                      data-purecounter-duration="1" class="purecounter">
                    </span>
                    <h4>Poli</h4>
                    <p>
                      Tersedia berbagai poli spesialis lengkap untuk memenuhi
                      beragam kebutuhan kesehatan Anda
                    </p>
                  </div>
                </div>
                <!-- End Icon Box -->
              </div>
            </div>
          </div>
        </div>
        <!-- End  Content-->
      </div>
    </section>
    <!-- /Hero Section -->

    <!-- Appointment Section -->
    <?php if ($isLogin && $role === 'Pasien'): ?>
    <section id="appointment" class="appointment section">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Buat Janji Temu</h2>
        <p>
          Buat janji temu dengan dokter pilihan Anda secara mudah dan cepat
        </p>
      </div>
      <!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <form action="src/daftarPoli/add.php" method="post" class="row g-3">
              <div class="col-12">
                <label for="inputNo_RM" class="form-label fw-bold">No. Rekam Medis</label>
                <input type="text" class="form-control" id="inputNo_RM" name="no_rm" value="<?= $_SESSION['no_rm'] ?>"
                  disabled required />
              </div>
              <div class="col-12">
                <label for="selectPoli" class="form-label fw-bold">Pilih Poli</label>
                <select class="form-control" id="selectPoli" name="poli" required>
                  <option value="" disabled selected>Pilih poli</option>
                  <?php
                    $query = "SELECT * FROM poli";
                    $result = mysqli_query($mysqli, $query);
                    while ($data_poli = mysqli_fetch_assoc($result)) {
                    ?>
                  <option value="<?= $data_poli['id'] ?>">
                    <?= $data_poli['nama_poli'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-12">
                <label for="selectJadwal" class="form-label fw-bold">Pilih Dokter & Jadwal</label>
                <select class="form-control" id="selectJadwal" name="jadwal" required>
                  <option value="" disabled selected>Pilih Dokter & Jadwal</option>
                </select>
              </div>
              <div class="col-12">
                <label for="inputKeluhan" class="form-label fw-bold
                  ">Keluhan</label>
                <textarea class="form-control" id="inputKeluhan" name="keluhan" rows="3" required></textarea>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary rounded-pill">
                  Buat Janji
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <?php endif; ?>
    <!-- /Appointment Section -->

    <!-- Departments Section -->
    <section id="departments" class="departments section">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Daftar Poli</h2>
        <p>
          Tersedia berbagai poli spesialis lengkap untuk memenuhi beragam
          kebutuhan kesehatan Anda
        </p>
      </div>
      <!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-center">
          <div class="col-lg-2">
            <ul class="nav nav-tabs flex-column">
              <?php
              $query = "SELECT * FROM poli";
              $result = mysqli_query($mysqli, $query);
              $isFirst = true;
              while ($data = mysqli_fetch_assoc($result)) {
              ?>
              <li class="nav-item">
                <a class="nav-link <?= $isFirst ? 'active show' : '' ?>" data-bs-toggle="tab"
                  href="#departments-tab-<?= $data['id'] ?>"><?= $data['nama_poli'] ?></a>
              </li>
              <?php
                $isFirst = false;
              }
              ?>
            </ul>
          </div>
          <div class="col-lg-6 mt-4 mt-lg-0">
            <div class="tab-content">
              <?php
              $query = "SELECT * FROM poli";
              $result = mysqli_query($mysqli, $query);
              $isFirst = true;
              while ($data = mysqli_fetch_assoc($result)) {
              ?>
              <div class="tab-pane <?= $isFirst ? 'active show' : '' ?>" id="departments-tab-<?= $data['id'] ?>">
                <div class="row">
                  <div class="details order-2 order-lg-1">
                    <h3><?= $data['nama_poli'] ?></h3>
                    <p class="fst-italic">
                      <?= $data['keterangan'] ?>
                    </p>
                  </div>
                </div>
              </div>
              <?php
                $isFirst = false;
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /Departments Section -->

    <!-- Doctors Section -->
    <section id="doctors" class="doctors section">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Daftar Dokter</h2>
        <p>
          Didukung oleh tim dokter berpengalaman dan terpercaya memberikan
          layanan kesehatan terbaik
        </p>
      </div>
      <!-- End Section Title -->
      <div class="container">
        <div class="row gy-4 justify-content-evenly">
          <?php
          $query = "SELECT dokter.id, dokter.nama, poli.nama_poli FROM dokter INNER JOIN poli ON dokter.id_poli = poli.id";
          $result = mysqli_query($mysqli, $query);
          $delay = 100;
          while ($data = mysqli_fetch_assoc($result)) {
          ?>
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
            <div class="team-member d-flex align-items-center">
              <div class="pic">
                <img src="assets/img/doctor.jpg" class="img-fluid" alt="" />
              </div>
              <div class="member-info">
                <h4><?= $data['nama'] ?></h4>
                <span><?= $data['nama_poli'] ?></span>
              </div>
            </div>
          </div>
          <?php
            $delay += 100;
          }
          ?>
        </div>
      </div>
    </section>
    <!-- /Doctors Section -->
  </main>

  <footer id="footer" class="footer light-background">
    <div class="container mt-4">
      <div class="row gy-4 justify-content-between">
        <div class="col-lg-4 col-md-6 footer-links">
          <p>
            © <span>Copyright</span>
            <strong class="px-1 sitename">Medilab</strong>
            <span>All Rights Reserved</span>
          </p>
          <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you've purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
          </div>
        </div>
        <div class="col-lg-2 col-md-3 footer-about text-center">
          <a href="index.php" class="logo d-flex align-items-center">
            <span class="sitename">Poliklinik</span>
          </a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Appointment History Modal -->
  <div class="modal fade" id="appointmentHistoryModalToggle" aria-labelledby="appointmentHistoryModalToggleLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="appointmentHistoryModalToggleLabel">
            Riwayat Periksa
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table class="table table-hover text-center">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Poli</th>
                  <th scope="col">Dokter</th>
                  <th scope="col">Hari</th>
                  <th scope="col">Jam Mulai</th>
                  <th scope="col">Jam Selesai</th>
                  <th scope="col">Antrian</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody class="table-group-divider">
                <?php
                $no = 1;
                $query = "SELECT daftar_poli.id, poli.nama_poli, dokter.nama, jadwal_periksa.hari, DATE_FORMAT(jadwal_periksa.jam_mulai, '%H:%i') as jam_mulai, DATE_FORMAT(jadwal_periksa.jam_selesai, '%H:%i') as jam_selesai, daftar_poli.no_antrian FROM daftar_poli INNER JOIN jadwal_periksa ON daftar_poli.id_jadwal = jadwal_periksa.id INNER JOIN dokter ON jadwal_periksa.id_dokter = dokter.id INNER JOIN poli ON dokter.id_poli = poli.id WHERE daftar_poli.id_pasien = '$id_pasien'";
                $result = mysqli_query($mysqli, $query);

                while ($data = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $data['nama_poli'] ?></td>
                  <td><?= $data['nama'] ?></td>
                  <td><?= $data['hari'] ?></td>
                  <td><?= $data['jam_mulai'] ?></td>
                  <td><?= $data['jam_selesai'] ?></td>
                  <td><?= $data['no_antrian'] ?></td>
                  <td>
                    <button type='button' class='btn btn-sm btn-primary' data-bs-toggle="modal"
                      data-bs-target="#detailModal<?= $data['id'] ?>"><i class="bi bi-eye"></i></button>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Appointment History Modal -->

  <!-- Detail Appointment Modal -->
  <?php
  $query = "SELECT daftar_poli.id, poli.nama_poli, dokter.nama, jadwal_periksa.hari, DATE_FORMAT(jadwal_periksa.jam_mulai, '%H:%i') as jam_mulai, DATE_FORMAT(jadwal_periksa.jam_selesai, '%H:%i') as jam_selesai, daftar_poli.no_antrian, daftar_poli.keluhan FROM daftar_poli INNER JOIN jadwal_periksa ON daftar_poli.id_jadwal = jadwal_periksa.id INNER JOIN dokter ON jadwal_periksa.id_dokter = dokter.id INNER JOIN poli ON dokter.id_poli = poli.id WHERE daftar_poli.id_pasien = '$id_pasien'";
  $result = mysqli_query($mysqli, $query);

  while ($data = mysqli_fetch_assoc($result)) {
  ?>
  <!-- Detail Modal -->
  <div class="modal fade" id="detailModal<?= $data['id'] ?>" tabindex="-1"
    aria-labelledby="detailModalLabel<?= $data['id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="detailModalLabel<?= $data['id'] ?>">
            Detail Periksa
          </h1>
          <button type="button" class="btn-close" data-bs-toggle="modal"
            data-bs-target="#appointmentHistoryModalToggle"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-7">
              <h2 class="lead"><b><?= $data['nama'] ?></b></h2>
              <h6 class="text-muted text-lg">Poli <?= $data['nama_poli'] ?></h6>
              <h6 class="text-muted text-lg"><?= $data['hari'] ?></h6>
              <ul class="ml-4 mb-0 fa-ul text-muted">
                <li class="large"><span class="fa-li"><i class="fas fa-lg fa-clock"></i></span>
                  <?= $data['jam_mulai'] ?> - <?= $data['jam_selesai'] ?></li>
              </ul>
              <br><br>
              <p class="text-muted text-lg"> Obat : <br>
                <?php
                  $queryObat = "SELECT o.nama_obat FROM detail_periksa dp INNER JOIN obat o ON dp.id_obat = o.id WHERE dp.id_periksa = '$data[id]'";
                  $resultObat = mysqli_query($mysqli, $queryObat);
                  $namaObatArray = [];
                  while ($dataObat = mysqli_fetch_assoc($resultObat)) {
                    $namaObatArray[] = $dataObat['nama_obat'];
                  }
                  foreach ($namaObatArray as $index => $namaObat) {
                    echo ($index + 1) . ". " . $namaObat . "<br>";
                  }
                  ?>
              </p>
              <h5 class="text-muted
                                text-lg"><strong>Biaya Periksa : <?= $data['biaya_periksa'] ?></strong>
              </h5>
            </div>
            <div class="col-5 flex
                              justify-center items-center flex-col">
              <h3 class="text-muted
                                text-lg">Catatan</h3>

              <p><?= $data['catatan'] ?></p>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type='button' class='btn btn-sm btn-secondary' data-bs-toggle="modal"
            data-bs-target="#appointmentHistoryModalToggle">Kembali</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End Detail Modal -->
  <?php } ?>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
  <script>
  $(document).ready(function() {
    $('#selectPoli').on('change', function() {
      var id_poli = $(this).val();

      $.ajax({
        type: 'POST',
        url: 'src/daftarPoli/getJadwal.php',
        data: {
          id_poli: id_poli
        },
        success: function(data) {
          $('#selectJadwal').html(data);
        }
      });
    });
  });
  </script>
</body>

</html>