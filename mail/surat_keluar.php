<div class="row">
    <div class="col-12">
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
                            <?php

                            $surat = mysqli_query($conn, "SELECT * FROM surat_keluar");

                            while ($data = mysqli_fetch_array($surat)) { ?>
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
                                    <td class="align-middle">
                                        <a href="index.php?route=surat/hapus&id=<?= $data['id_surat'] ?>&file=<?= $data['file_keluar'] ?>&jenis=keluar" class="btn btn-danger"><i class="fa-solid fa-trash"></i> </a>
                                        <a href="index.php?route=surat/edit&id=<?= $data['id_surat'] ?>&jenis=keluar" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> </a>
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