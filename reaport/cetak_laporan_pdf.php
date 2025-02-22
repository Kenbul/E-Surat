<?php
require('../fpdf/fpdf.php');
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

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(190, 10, 'Laporan Surat Masuk dan Keluar', 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 10, "Periode: $filter_awal s/d $filter_akhir", 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(190, 7, 'Surat Masuk', 0, 1, 'L');
$pdf->Cell(50, 7, 'Nomor Surat', 1);
$pdf->Cell(50, 7, 'Pengirim', 1);
$pdf->Cell(50, 7, 'Perihal', 1);
$pdf->Cell(40, 7, 'Tanggal', 1);
$pdf->Ln();

$pdf->SetFont('Arial', '', 10);
while ($data = mysqli_fetch_assoc($result_masuk)) {
    $pdf->Cell(50, 7, $data['nomor_surat'], 1);
    $pdf->Cell(50, 7, $data['pengirim'], 1);
    $pdf->Cell(50, 7, $data['perihal'], 1);
    $pdf->Cell(40, 7, $data['tanggal'], 1);
    $pdf->Ln();
}

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(190, 7, 'Surat Keluar', 0, 1, 'L');
$pdf->Cell(50, 7, 'Nomor Surat', 1);
$pdf->Cell(50, 7, 'Penerima', 1);
$pdf->Cell(50, 7, 'Perihal', 1);
$pdf->Cell(40, 7, 'Tanggal', 1);
$pdf->Ln();

$pdf->SetFont('Arial', '', 10);
while ($data = mysqli_fetch_assoc($result_keluar)) {
    $pdf->Cell(50, 7, $data['nomor_surat'], 1);
    $pdf->Cell(50, 7, $data['penerima'], 1);
    $pdf->Cell(50, 7, $data['perihal'], 1);
    $pdf->Cell(40, 7, $data['tanggal'], 1);
    $pdf->Ln();
}

$pdf->Output('D', 'Laporan_Surat.pdf');
