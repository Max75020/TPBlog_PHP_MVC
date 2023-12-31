<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Tableau de bord - Blog</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= ROOT_URL ?>/Public/img/favicon.png" rel="icon">
  <link href="<?= ROOT_URL ?>/Public/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= ROOT_URL ?>/Public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= ROOT_URL ?>/Public/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= ROOT_URL ?>/Public/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= ROOT_URL ?>/Public/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<?= ROOT_URL ?>/Public/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="<?= ROOT_URL ?>/Public/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= ROOT_URL ?>/Public/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= ROOT_URL ?>/Public/css/theme_back.css" rel="stylesheet">
  <link href="<?= ROOT_URL ?>/Public/css/back.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Nov 17 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">NiceAdmin</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="<?= ROOT_URL ?>">
          <i class="bi bi-grid"></i>
          <span>Retour blog</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link " href="<?= ROOT_URL ?>/admin">
          <i class="bi bi-grid"></i>
          <span>Articles</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link " href="<?= ROOT_URL ?>/admin/user">
          <i class="bi bi-grid"></i>
          <span>Membres</span>
        </a>
      </li><!-- End Dashboard Nav -->
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <?= $content; ?>

  </main><!-- End #main -->

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
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?= ROOT_URL ?>/Public/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="<?= ROOT_URL ?>/Public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= ROOT_URL ?>/Public/vendor/chart.js/chart.umd.js"></script>
  <script src="<?= ROOT_URL ?>/Public/vendor/echarts/echarts.min.js"></script>
  <script src="<?= ROOT_URL ?>/Public/vendor/quill/quill.min.js"></script>
  <script src="<?= ROOT_URL ?>/Public/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="<?= ROOT_URL ?>/Public/vendor/tinymce/tinymce.min.js"></script>
  <script src="<?= ROOT_URL ?>/Public/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?= ROOT_URL ?>/Public/js/theme_back.js"></script>
  <script src="<?= ROOT_URL ?>/Public/js/back.js"></script>

</body>

</html>