<?php
include "config/config.php";

if (isset($_GET['id']) && isset($_GET['file'])) {
    $id = $_GET['id'];
    $file = $_GET['file'];
    $jenis_surat = 'surat_' . $_GET['jenis'];

    // Hapus file dari folder
    $file_path = "surat/" . $file;
    if (file_exists($file_path)) {
        unlink($file_path);
    }

    // Hapus data dari database
    $query = "DELETE FROM $jenis_surat WHERE id_surat = '$id'";
    if (mysqli_query($conn, $query)) {
        echo "<script>
            alert('Surat berhasil dihapus!');
            window.location.href='index.php?route=surat/masuk';
        </script>";
    } else {
        echo "Gagal menghapus: " . mysqli_error($conn);
    }
}
