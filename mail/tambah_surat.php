<?php

$jenis_surat = isset($_GET['jenis_surat']) ? $_GET['jenis_surat'] : 'masuk';
?>
<div class="card-body">
    <form role="form" method="POST" enctype="multipart/form-data">
        <label class="form-label">Nomor Surat</label>
        <div class="input-group input-group-outline my-3">
            <input type="text" class="form-control" name="nomor_surat">
        </div>

        <label class="form-label"><?= ($jenis_surat == 'keluar') ? 'Penerima' : 'Pengirim' ?></label>
        <div class="input-group input-group-outline my-3">
            <input type="text" class="form-control" name="pengirim_penerima">
        </div>

        <label class="form-label">Perihal</label>
        <div class="input-group input-group-outline my-3">
            <input type="text" class="form-control" name="perihal">
        </div>

        <label class="form-label">Tanggal</label>
        <div class="input-group input-group-outline my-3">
            <input type="date" class="form-control" name="tanggal">
        </div>

        <label class="form-label">File</label>
        <div class="input-group input-group-outline my-3">
            <input type="file" class="form-control" name="file_surat">
        </div>

        <button type="submit" name="submit" class="btn bg-gradient-dark">Tambah Surat</button>
    </form>
    <?php
    include "config/config.php";

    $jenis_surat = isset($_GET['jenis_surat']) ? $_GET['jenis_surat'] : 'masuk';
    $file = 'file_' . $_GET['jenis_surat'];
    $tabel_surat = ($jenis_surat == 'keluar') ? 'surat_keluar' : 'surat_masuk';
    $kolom_pengirim_penerima = ($jenis_surat == 'keluar') ? 'penerima' : 'pengirim';

    if (isset($_POST['submit'])) {
        $nomor_surat = mysqli_real_escape_string($conn, $_POST['nomor_surat']);
        $pengirim_penerima = mysqli_real_escape_string($conn, $_POST['pengirim_penerima']);
        $perihal = mysqli_real_escape_string($conn, $_POST['perihal']);
        $tanggal = $_POST['tanggal'];
        $file_surat = $_FILES['file_surat']['name'];
        // var_dump($file_surat);
        // exit();


        // Cek apakah ada file yang diupload
        if ($_FILES['file_surat']['name'] != '') {
            $file_surat = $_FILES['file_surat']['name'];
            $file_type = pathinfo($file_surat, PATHINFO_EXTENSION);
            $file_mime = mime_content_type($_FILES['file_surat']['tmp_name']);

            // Cek ekstensi dan MIME type
            if ($file_type != 'pdf' || $file_mime != 'application/pdf') {
                die("Error: Hanya file PDF yang diperbolehkan.");
            }

            move_uploaded_file($_FILES['file_surat']['tmp_name'], "surat/$file_surat");
        } else {
            $file_surat = null; // Jika tidak ada file diupload
        }

        // Perbaiki query sesuai dengan struktur tabel
        $query = "INSERT INTO $tabel_surat (nomor_surat, $kolom_pengirim_penerima, perihal, tanggal, $file) 
              VALUES ('$nomor_surat', '$pengirim_penerima', '$perihal', '$tanggal', '$file_surat')";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Surat berhasil ditambahkan'); window.location='index.php?route=surat/$jenis_surat';</script>";
        } else {
            die("Error Query: " . mysqli_error($conn));
        }
    }
    ?>

</div>