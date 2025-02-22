<?php
include "config/config.php";

$filter_awal = isset($_GET['filter_awal']) ? $_GET['filter_awal'] : '';
$filter_akhir = isset($_GET['filter_akhir']) ? $_GET['filter_akhir'] : '';

$query_masuk = "SELECT * FROM surat_masuk";
$query_keluar = "SELECT * FROM surat_keluar";

if ($filter_awal && $filter_akhir) {
    $query_masuk .= " WHERE tanggal BETWEEN '$filter_awal' AND '$filter_akhir'";
    $query_keluar .= " WHERE tanggal BETWEEN '$filter_awal' AND '$filter_akhir'";
}

$result_masuk = mysqli_query($conn, $query_masuk);
$result_keluar = mysqli_query($conn, $query_keluar);
?>

<div class="card-body">
    <form method="GET" role="form" action="index.php">
        <input type="hidden" name="route" value="laporan">

        <label class="form-label">Filter Waktu</label>
        <div class="input-group input-group-outline my-3">
            <label for="filter_awal" class="mx-2">Tanggal Awal</label>
            <input type="date" name="filter_awal" value="<?= htmlspecialchars($filter_awal) ?>" class="form-control mx-3" required>

            <label for="filter_akhir" class="mx-2">Tanggal Akhir</label>
            <input type="date" name="filter_akhir" value="<?= htmlspecialchars($filter_akhir) ?>" class="form-control mx-3" required>
        </div>

        <button type="submit" name="action" value="filter" class="btn btn-info">Filter</button>
        <button type="submit" name="action" value="cetak" formaction="reaport/cetak_laporan_pdf.php" target="_blank" class="btn btn-primary">Cetak PDF</button>
        <button type="submit" name="action" value="cetak_excel" formaction="reaport/cetak_laporan_excel.php" target="_blank" class="btn btn-success">Cetak Excel</button>

    </form>

    <div class="row">
        <div class="col-6">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Surat Masuk</h6>
                        <a href="index.php?route=surat/tambah&jenis_surat=masuk" class="btn btn-success mx-2"><i class="fa-solid fa-square-plus mx-1"></i>Surat</a>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Surat</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pengirim</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($data = mysqli_fetch_assoc($result_masuk)) { ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <?php if (!empty($data['file_masuk'])) { ?>
                                                        <a href="surat/<?= $data['file_masuk']; ?>" target="_blank">
                                                            <i class="fa-solid fa-file-pdf fa-2x"></i> <!-- Ikon file -->
                                                        </a>
                                                    <?php } else { ?>
                                                        <p class="text-xs text-secondary">Tidak ada file</p>
                                                    <?php } ?>
                                                </div>

                                                <div class="d-flex flex-column justify-content-center mx-3">
                                                    <h6 class="mb-0 text-sm"><?= $data['nomor_surat'] ?></h6>
                                                    <p class="text-xs text-secondary mb-0"></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"><?= $data['pengirim'] ?></p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-secondary text-xs font-weight-bold"><?= $data['perihal'] ?></span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold"><?= $data['tanggal'] ?></span>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Surat Keluar</h6>
                        <a href="index.php?route=surat/tambah&jenis_surat=keluar" class="btn btn-success mx-2"><i class="fa-solid fa-square-plus mx-1"></i>Surat</a>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Surat</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pengirim</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($data = mysqli_fetch_assoc($result_keluar)) { ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <?php if (!empty($data['file_keluar'])) { ?>
                                                        <a href="surat/<?= $data['file_keluar']; ?>" target="_blank">
                                                            <i class="fa-solid fa-file-pdf fa-2x"></i> <!-- Ikon file -->
                                                        </a>
                                                    <?php } else { ?>
                                                        <p class="text-xs text-secondary">Tidak ada file</p>
                                                    <?php } ?>
                                                </div>

                                                <div class="d-flex flex-column justify-content-center mx-3">
                                                    <h6 class="mb-0 text-sm"><?= $data['nomor_surat'] ?></h6>
                                                    <p class="text-xs text-secondary mb-0"></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"><?= $data['penerima'] ?></p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-secondary text-xs font-weight-bold"><?= $data['perihal'] ?></span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold"><?= $data['tanggal'] ?></span>
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
</div>