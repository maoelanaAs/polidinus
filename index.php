<?php
session_start();
require 'config/database.php';

$isLogin = isset($_SESSION['nama']);
$nama = $isLogin ? $_SESSION['nama'] : null;
$role = $isLogin ? $_SESSION['role'] : null;

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
              <a href="#" class="fw-bold"><span><?php echo $nama ?></span>
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

        <a class="cta-btn d-none d-sm-block" href="<?php echo $isLogin ? 'register_pasien.php' : '#appointment' ?>">Buat
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
                <a href="<?php echo $isLogin ? 'register_pasien.php' : '#appointment' ?>" class="more-btn"><span>Buat
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
                    <span data-purecounter-start="0" data-purecounter-end="<?php echo $jmlDokter ?>"
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
                    <span data-purecounter-start="0" data-purecounter-end="<?php echo $jmlPoli ?>"
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
        <form action="forms/appointment.php" method="post" role="form" class="php-email-form">
          <div class="row align-items-center">
            <div class="col-md-8">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="input_name" placeholder="Nama Lengkap"
                    required disabled />
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="medrec" id="input_medrec" placeholder="No. Rekam Medis"
                    required disabled />
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group mt-3">
                  <select name="department" id="department" class="form-select" required="">
                    <option value="">Pilih Poli</option>
                    <option value="Department 1">Department 1</option>
                    <option value="Department 2">Department 2</option>
                    <option value="Department 3">Department 3</option>
                  </select>
                </div>
                <div class="col-md-6 form-group mt-3">
                  <select name="doctor" id="doctor" class="form-select" required="">
                    <option value="">Pilih Dokter & Jadwal</option>
                    <option value="Doctor 1">Doctor 1</option>
                    <option value="Doctor 2">Doctor 2</option>
                    <option value="Doctor 3">Doctor 3</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <textarea class="form-control" name="complaint" rows="4" placeholder="Keluhan"></textarea>
              </div>
            </div>
          </div>

          <div class="mt-3">
            <div class="text-center">
              <button type="submit">Buat Janji Temu</button>
            </div>
          </div>
        </form>
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
        <div class="row">
          <div class="col-lg-3">
            <ul class="nav nav-tabs flex-column">
              <li class="nav-item">
                <a class="nav-link active show" data-bs-toggle="tab" href="#departments-tab-1">Cardiology</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#departments-tab-2">Neurology</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#departments-tab-3">Hepatology</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#departments-tab-4">Pediatrics</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#departments-tab-5">Eye Care</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-9 mt-4 mt-lg-0">
            <div class="tab-content">
              <div class="tab-pane active show" id="departments-tab-1">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Cardiology</h3>
                    <p class="fst-italic">
                      Qui laudantium consequatur laborum sit qui ad sapiente
                      dila parde sonata raqer a videna mareta paulona mark
                    </p>
                    <p>
                      Et nobis maiores eius. Voluptatibus ut enim blanditiis
                      atque harum sint. Laborum eos ipsum ipsa odit magni.
                      Incidunt hic ut molestiae aut qui. Est repellat minima
                      eveniet eius et quis magni nihil. Consequatur dolorem
                      quaerat quos qui similique accusamus nostrum rem vero
                    </p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/departments-1.jpg" alt="" class="img-fluid" />
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="departments-tab-2">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Et blanditiis nemo veritatis excepturi</h3>
                    <p class="fst-italic">
                      Qui laudantium consequatur laborum sit qui ad sapiente
                      dila parde sonata raqer a videna mareta paulona marka
                    </p>
                    <p>
                      Ea ipsum voluptatem consequatur quis est. Illum error
                      ullam omnis quia et reiciendis sunt sunt est. Non
                      aliquid repellendus itaque accusamus eius et velit ipsa
                      voluptates. Optio nesciunt eaque beatae accusamus lerode
                      pakto madirna desera vafle de nideran pal
                    </p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/departments-2.jpg" alt="" class="img-fluid" />
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="departments-tab-3">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Impedit facilis occaecati odio neque aperiam sit</h3>
                    <p class="fst-italic">
                      Eos voluptatibus quo. Odio similique illum id quidem non
                      enim fuga. Qui natus non sunt dicta dolor et. In
                      asperiores velit quaerat perferendis aut
                    </p>
                    <p>
                      Iure officiis odit rerum. Harum sequi eum illum corrupti
                      culpa veritatis quisquam. Neque necessitatibus illo
                      rerum eum ut. Commodi ipsam minima molestiae sed
                      laboriosam a iste odio. Earum odit nesciunt fugiat sit
                      ullam. Soluta et harum voluptatem optio quae
                    </p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/departments-3.jpg" alt="" class="img-fluid" />
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="departments-tab-4">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>
                      Fuga dolores inventore laboriosam ut est accusamus
                      laboriosam dolore
                    </h3>
                    <p class="fst-italic">
                      Totam aperiam accusamus. Repellat consequuntur iure
                      voluptas iure porro quis delectus
                    </p>
                    <p>
                      Eaque consequuntur consequuntur libero expedita in
                      voluptas. Nostrum ipsam necessitatibus aliquam fugiat
                      debitis quis velit. Eum ex maxime error in consequatur
                      corporis atque. Eligendi asperiores sed qui veritatis
                      aperiam quia a laborum inventore
                    </p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/departments-4.jpg" alt="" class="img-fluid" />
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="departments-tab-5">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>
                      Est eveniet ipsam sindera pad rone matrelat sando reda
                    </h3>
                    <p class="fst-italic">
                      Omnis blanditiis saepe eos autem qui sunt debitis porro
                      quia.
                    </p>
                    <p>
                      Exercitationem nostrum omnis. Ut reiciendis repudiandae
                      minus. Omnis recusandae ut non quam ut quod eius qui.
                      Ipsum quia odit vero atque qui quibusdam amet. Occaecati
                      sed est sint aut vitae molestiae voluptate vel
                    </p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/departments-5.jpg" alt="" class="img-fluid" />
                  </div>
                </div>
              </div>
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
        <div class="row gy-4">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="team-member d-flex align-items-start">
              <div class="pic">
                <img src="assets/img/doctors/doctors-1.jpg" class="img-fluid" alt="" />
              </div>
              <div class="member-info">
                <h4>Walter White</h4>
                <span>Chief Medical Officer</span>
                <p>
                  Explicabo voluptatem mollitia et repellat qui dolorum quasi
                </p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""> <i class="bi bi-linkedin"></i> </a>
                </div>
              </div>
            </div>
          </div>
          <!-- End Team Member -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="team-member d-flex align-items-start">
              <div class="pic">
                <img src="assets/img/doctors/doctors-2.jpg" class="img-fluid" alt="" />
              </div>
              <div class="member-info">
                <h4>Sarah Jhonson</h4>
                <span>Anesthesiologist</span>
                <p>
                  Aut maiores voluptates amet et quis praesentium qui senda
                  para
                </p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""> <i class="bi bi-linkedin"></i> </a>
                </div>
              </div>
            </div>
          </div>
          <!-- End Team Member -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="team-member d-flex align-items-start">
              <div class="pic">
                <img src="assets/img/doctors/doctors-3.jpg" class="img-fluid" alt="" />
              </div>
              <div class="member-info">
                <h4>William Anderson</h4>
                <span>Cardiology</span>
                <p>
                  Quisquam facilis cum velit laborum corrupti fuga rerum quia
                </p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""> <i class="bi bi-linkedin"></i> </a>
                </div>
              </div>
            </div>
          </div>
          <!-- End Team Member -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
            <div class="team-member d-flex align-items-start">
              <div class="pic">
                <img src="assets/img/doctors/doctors-4.jpg" class="img-fluid" alt="" />
              </div>
              <div class="member-info">
                <h4>Amanda Jepson</h4>
                <span>Neurosurgeon</span>
                <p>
                  Dolorum tempora officiis odit laborum officiis et et
                  accusamus
                </p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""> <i class="bi bi-linkedin"></i> </a>
                </div>
              </div>
            </div>
          </div>
          <!-- End Team Member -->
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
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Poliklinik</span>
          </a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Appointment History Modal -->
  <div class="modal" id="appointmentHistoryModalToggle" aria-labelledby="appointmentHistoryModalToggleLabel"
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
                  <th scope="col">Mulai</th>
                  <th scope="col">Selesai</th>
                  <th scope="col">Antrian</th>
                  <th scope="col">Status</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody class="table-group-divider">
                <tr>
                  <th scope="row">1</th>
                  <td>Poli 1</td>
                  <td>Dr. A</td>
                  <td>Selasa</td>
                  <td>00:00</td>
                  <td>23:59</td>
                  <td>1</td>
                  <td>Menunggu</td>
                  <td>
                    <!-- button detail -->
                    <button class="btn btn-primary btn-sm" data-bs-target="#appointmentHistoryModalToggle2"
                      data-bs-toggle="modal">
                      Detail
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Appointment History Modal -->

  <!-- Detail Appointment Modal -->
  <div class="modal" id="appointmentHistoryModalToggle2" aria-labelledby="appointmentHistoryModalToggleLabel2"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="appointmentHistoryModalToggleLabel2">
            Riwayat Periksa
          </h1>
        </div>
        <div class="modal-body">
          Hide this modal and show the first with the button below.
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-bs-target="#appointmentHistoryModalToggle" data-bs-toggle="modal">
            Kembali ke Riwayat
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- End Detail Appointment Modal -->

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
</body>

</html>