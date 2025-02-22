<?php
include "config/config.php";
if (isset($_POST['submit'])) {
    // Cek apakah data POST terkirim
    // Untuk melihat apakah data terkirim

    $nomor_surat = mysqli_real_escape_string($conn, $_POST['nomor_surat']);
    $pengirim = mysqli_real_escape_string($conn, $_POST['pengirim']);
    $perihal = mysqli_real_escape_string($conn, $_POST['perihal']);
    $tanggal = $_POST['tanggal'];
    $file_masuk = $_FILES['file_masuk']['name'];

    // Cek apakah file berhasil diupload
    if (!move_uploaded_file($_FILES['file_masuk']['tmp_name'], "./surat/$file_masuk")) {
        die("Gagal mengupload file: " . $_FILES['file_masuk']['error']);
    }
    $query = "INSERT INTO surat_masuk (id_surat,nomor_surat, pengirim, perihal, tanggal, file_masuk) 
              VALUES (NULL,'$nomor_surat', '$pengirim', '$perihal', '$tanggal', '$file_masuk')";

    echo "Query : $query";
    exit();
    // Eksekusi query
    if (mysqli_query($conn, $query)) {
    } else {
        die("Error Query: " . mysqli_error($conn));
    }
    header("location:index.php?page=surat/masuk");
    exit();
}
