<?php require_once 'config/route.php';

include 'config/config.php';
session_start();

if (!isset($_SESSION['email'])) {

  // Kalau belum login, alihkan ke halaman login
  header('Location: pages/login.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
    E-Surat
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/a49b250db2.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">
  <?php include 'includes/sidebar.php' ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <?php include 'includes/navbar.php' ?>
    <div class="container-fluid py-2">
      <div class="row">
        <?php eval($halamanUtama); ?>
      </div>
  </main>
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <script>
    var ctx = document.getElementById('chartSurat').getContext('2d');
    var chartSurat = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Surat Masuk', 'Surat Keluar', 'Surat Minggu Ini (Masuk)', 'Surat Minggu Ini (Keluar)'],
        datasets: [{
          label: 'Jumlah Surat',
          data: [<?= $total_surat_masuk ?>, <?= $total_surat_keluar ?>, <?= $total_surat_masuk_minggu ?>, <?= $total_surat_keluar_minggu ?>],
          backgroundColor: ['blue', 'green', 'orange', 'red']
        }]
      }
    });
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>

</html>