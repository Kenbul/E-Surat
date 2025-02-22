<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Surat.xls");

include '../config/config.php';

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

echo "<table border='1'>";
echo "<tr><th colspan='4'>Laporan Surat Masuk dan Keluar</th></tr>";
echo "<tr><th colspan='4'>Periode: $filter_awal s/d $filter_akhir</th></tr>";

// Surat Masuk
echo "<tr><th colspan='4'>Surat Masuk</th></tr>";
echo "<tr><th>Nomor Surat</th><th>Pengirim</th><th>Perihal</th><th>Tanggal</th></tr>";
while ($data = mysqli_fetch_assoc($result_masuk)) {
    echo "<tr>";
    echo "<td>{$data['nomor_surat']}</td>";
    echo "<td>{$data['pengirim']}</td>";
    echo "<td>{$data['perihal']}</td>";
    echo "<td>{$data['tanggal']}</td>";
    echo "</tr>";
}

// Surat Keluar
echo "<tr><th colspan='4'>Surat Keluar</th></tr>";
echo "<tr><th>Nomor Surat</th><th>Penerima</th><th>Perihal</th><th>Tanggal</th></tr>";
while ($data = mysqli_fetch_assoc($result_keluar)) {
    echo "<tr>";
    echo "<td>{$data['nomor_surat']}</td>";
    echo "<td>{$data['penerima']}</td>";
    echo "<td>{$data['perihal']}</td>";
    echo "<td>{$data['tanggal']}</td>";
    echo "</tr>";
}

echo "</table>";
