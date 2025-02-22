<?php
include "config/config.php";

// Total surat masuk
$query_surat_masuk = mysqli_query($conn, "SELECT COUNT(*) AS total FROM surat_masuk");
$total_surat_masuk = mysqli_fetch_assoc($query_surat_masuk)['total'];

// Total surat keluar
$query_surat_keluar = mysqli_query($conn, "SELECT COUNT(*) AS total FROM surat_keluar");
$total_surat_keluar = mysqli_fetch_assoc($query_surat_keluar)['total'];

// Surat masuk dalam seminggu terakhir
$query_surat_masuk_minggu = mysqli_query($conn, "SELECT COUNT(*) AS total FROM surat_masuk WHERE tanggal >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)");
$total_surat_masuk_minggu = mysqli_fetch_assoc($query_surat_masuk_minggu)['total'];

// Surat keluar dalam seminggu terakhir
$query_surat_keluar_minggu = mysqli_query($conn, "SELECT COUNT(*) AS total FROM surat_keluar WHERE tanggal >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)");
$total_surat_keluar_minggu = mysqli_fetch_assoc($query_surat_keluar_minggu)['total'];

// Ambil 5 surat masuk terbaru
$query_latest_surat_masuk = mysqli_query($conn, "SELECT * FROM surat_masuk ORDER BY tanggal DESC LIMIT 5");

// Ambil 5 surat keluar terbaru
$query_latest_surat_keluar = mysqli_query($conn, "SELECT * FROM surat_keluar ORDER BY tanggal DESC LIMIT 5");

?>

<div class="ms-3">
    <h3 class="mb-0 h4 font-weight-bolder">Dashboard</h3>
    <p class="mb-4">
        Check the latter, value and bounce rate by country.
    </p>
</div>
<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
        <div class="card-header p-2 ps-3">
            <div class="d-flex justify-content-between">
                <div>
                    <p class="text-sm mb-0 text-capitalize">Surat Masuk</p>
                    <h4 class="mb-0"><?= $total_surat_masuk ?></h4>
                </div>
                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                    <i class="material-symbols-rounded opacity-10">weekend</i>
                </div>
            </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
            <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+55% </span>than last week</p>
        </div>
    </div>
</div>
<div class="col-xl-3 col-sm-6">
    <div class="card">
        <div class="card-header p-2 ps-3">
            <div class="d-flex justify-content-between">
                <div>
                    <p class="text-sm mb-0 text-capitalize">Surat Keluar</p>
                    <h4 class="mb-0"><?= $total_surat_keluar ?></h4>
                </div>
                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                    <i class="material-symbols-rounded opacity-10">weekend</i>
                </div>
            </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
            <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+5% </span>than yesterday</p>
        </div>
    </div>
</div>
<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
        <div class="card-header p-2 ps-3">
            <div class="d-flex justify-content-between">
                <div>
                    <p class="text-sm mb-0 text-capitalize">Surat Masuk Minggi ini </p>
                    <h4 class="mb-0"><?= $total_surat_masuk_minggu ?></h4>
                </div>
                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                    <i class="material-symbols-rounded opacity-10">leaderboard</i>
                </div>
            </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
            <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">7 </span>Hari Terakhir</p>
        </div>
    </div>
</div>
<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
        <div class="card-header p-2 ps-3">
            <div class="d-flex justify-content-between">
                <div>
                    <p class="text-sm mb-0 text-capitalize">Surat Keluar Minggu ini </p>
                    <h4 class="mb-0"><?= $total_surat_keluar_minggu ?></h4>
                </div>
                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                    <i class="material-symbols-rounded opacity-10">leaderboard</i>
                </div>
            </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
            <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">7 </span>Hari Terakhir</p>
        </div>
    </div>
</div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-6 mt-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h6 class="mb-0 ">Website Views</h6>
                <p class="text-sm ">Last Campaign Performance</p>
                <div class="pe-2">
                    <div class="chart">
                        <canvas id="chartSurat" class="chart-canvas" width="400" height="200"></canvas>
                    </div>
                </div>
                <hr class="dark horizontal">
                <div class="d-flex ">
                    <i class="material-symbols-rounded text-sm my-auto me-1">schedule</i>
                    <p class="mb-0 text-sm"> campaign sent 2 days ago </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mb-4">
    <!-- Surat Masuk -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info text-white">Surat Masuk Terbaru</div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php while ($row = mysqli_fetch_assoc($query_latest_surat_masuk)) { ?>
                            <li class="list-group-item">
                                <strong><?= $row['nomor_surat'] ?></strong> - <?= $row['pengirim'] ?> - <?= $row['perihal'] ?> - (<?= $row['tanggal'] ?>)
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Surat Keluar -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">Surat Keluar Terbaru</div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php while ($row = mysqli_fetch_assoc($query_latest_surat_keluar)) { ?>
                            <li class="list-group-item">
                                <strong><?= $row['nomor_surat'] ?></strong> - <?= $row['penerima'] ?> - <?= $row['perihal'] ?> - (<?= $row['tanggal'] ?>)
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer py-4  ">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="copyright text-center text-sm text-muted text-lg-start">
                        © <script>
                            document.write(new Date().getFullYear())
                        </script>,
                        made with <i class="fa fa-heart"></i> by
                        <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                        for a better web.
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>