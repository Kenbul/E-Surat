<?php
include "config/config.php";

// Pastikan ada ID yang dikirim
if (!isset($_GET['id']) || !isset($_GET['jenis'])) {
    die("Error: ID atau jenis surat tidak ditemukan.");
}

$id_surat = $_GET['id'];
$jenis_surat = $_GET['jenis'];
// var_dump($jenis_surat);
$file_surat = 'file_' . $_GET['jenis'];



// Pilih tabel berdasarkan jenis surat
if ($jenis_surat == 'masuk') {
    $query = "SELECT * FROM surat_masuk WHERE id_surat = '$id_surat'";
} else {
    $query = "SELECT * FROM surat_keluar WHERE id_surat = '$id_surat'";
}

$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);


if (!$data) {
    die("Data tidak ditemukan.");
}

// Jika form disubmit
if (isset($_POST['update'])) {
    $nomor_surat = mysqli_real_escape_string($conn, $_POST['nomor_surat']);
    $pengirim_penerima = mysqli_real_escape_string($conn, $_POST['pengirim_penerima']);
    $perihal = mysqli_real_escape_string($conn, $_POST['perihal']);
    $tanggal = $_POST['tanggal'];
    $file_surat = $_FILES['file_surat']['name'];

    // Jika ada file baru yang diupload
    if ($_FILES['file_surat']['name'] != '') {
        $file_surat = $_FILES['file_surat']['name'];
        $file_type = pathinfo($file_surat, PATHINFO_EXTENSION);
        $file_mime = mime_content_type($_FILES['file_surat']['tmp_name']);

        // Cek ekstensi dan MIME type
        if ($file_type != 'pdf' || $file_mime != 'application/pdf') {
            die("Error: Hanya file PDF yang diperbolehkan.");
        }

        move_uploaded_file($_FILES['file_surat']['tmp_name'], "surat/$file_surat");

        // Update dengan file baru
        if ($jenis_surat == 'masuk') {
            $query_update = "UPDATE surat_masuk SET 
                nomor_surat = '$nomor_surat', 
                pengirim = '$pengirim_penerima', 
                perihal = '$perihal', 
                tanggal = '$tanggal', 
                file_masuk = '$file_surat' 
                WHERE id_surat = '$id_surat'";
        } else {
            $query_update = "UPDATE surat_keluar SET 
                nomor_surat = '$nomor_surat', 
                penerima = '$pengirim_penerima', 
                perihal = '$perihal', 
                tanggal = '$tanggal', 
                file_keluar = '$file_surat' 
                WHERE id_surat = '$id_surat'";
        }
    } else {
        // Update tanpa file baru
        if ($jenis_surat == 'masuk') {
            $query_update = "UPDATE surat_masuk SET 
                nomor_surat = '$nomor_surat', 
                pengirim = '$pengirim_penerima', 
                perihal = '$perihal', 
                tanggal = '$tanggal' 
                WHERE id_surat = '$id_surat'";
        } else {
            $query_update = "UPDATE surat_keluar SET 
                nomor_surat = '$nomor_surat', 
                penerima = '$pengirim_penerima', 
                perihal = '$perihal', 
                tanggal = '$tanggal' 
                WHERE id_surat = '$id_surat'";
        }
    }

    if (mysqli_query($conn, $query_update)) {
        echo "<script>
            alert('Surat berhasil diperbarui!');
            window.location.href = 'index.php?route=surat/$jenis_surat';
        </script>";
    } else {
        die("Error Query: " . mysqli_error($conn));
    }
}
?>

<div class="card-body">
    <form method="POST" enctype="multipart/form-data">
        <label class="form-label">Nomor Surat</label>
        <div class="input-group input-group-outline my-3">
            <input type="text" class="form-control" name="nomor_surat" value="<?= $data['nomor_surat'] ?>">
        </div>

        <label class="form-label"><?= ($jenis_surat == 'masuk') ? "Pengirim" : "Penerima"; ?></label>
        <div class="input-group input-group-outline my-3">
            <input type="text" class="form-control" name="pengirim_penerima" value="<?= ($jenis_surat == 'masuk') ? $data['pengirim'] : $data['penerima']; ?>">
        </div>

        <label class="form-label">Perihal</label>
        <div class="input-group input-group-outline my-3">
            <input type="text" class="form-control" name="perihal" value="<?= $data['perihal'] ?>">
        </div>

        <label class="form-label">Tanggal</label>
        <div class="input-group input-group-outline my-3">
            <input type="date" class="form-control" name="tanggal" value="<?= $data['tanggal'] ?>">
        </div>

        <label class="form-label">File Surat</label>
        <div class="input-group input-group-outline my-3">
            <input type="file" class="form-control" name="file_surat" accept="application/pdf">
        </div>
        <p>File Saat Ini:
            <?php if (!empty($data[$file_surat])) { ?>
                <a href="surat/<?= $data[$file_surat] ?>" target="_blank"><i class="fa-solid fa-file-pdf fa-2x"></i> <br><?= $data[$file_surat] ?></a>
            <?php } else { ?>
                Tidak ada file
            <?php } ?>
        </p>

        <button type="submit" name="update" class="btn bg-gradient-success">Update Surat</button>
        <a href="index.php?route=surat/<?= $jenis_surat ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>