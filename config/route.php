<?php

$page = '';
if (isset($_GET['route'])) {
    $page = $_GET['route'];
}
$level = $_SESSION['level'] ?? ''; // level bisa 'admin' atau 'pegawai'

switch ($page) {
    case 'dashboaard':
        $content = "include 'pages/dashboard.php';";
        break;
    case 'surat/masuk':
        $content = "include 'mail/surat_masuk.php';";
        break;
    case 'surat/tambah':
        $content = "include 'mail/tambah_surat.php';";
        break;
    case 'proses/tambah':
        $content = "include 'mail/proses_tambah.php';";
        break;
    case 'surat/edit':
        $content = "include 'mail/edit_surat.php';";
        break;
    case 'surat/hapus':
        $content = "include 'mail/hapus_surat.php';";
        break;
    case 'surat/keluar':
        $content = "include 'mail/surat_keluar.php';";
        break;
    case 'laporan':
        $content = "include 'reaport/laporan.php';";
        break;
    // case 'login':
    //     $content = "include 'pages/login.php';";
    //     break;
    case 'logout':
        $content = "include 'pages/logout.php';";
        break;
    default:
        $content = "include 'pages/dashboard.php';";
        break;
}

$halamanUtama = $content;
