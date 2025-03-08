<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Pastikan ini ada

$mail = new PHPMailer(true);

try {
    // Konfigurasi SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Pakai Gmail
    $mail->SMTPAuth = true;
    $mail->Username = 'excample@gmail.com'; // Ganti dengan email kamu
    $mail->Password = 'xxxxxxxxxxxxxxx'; // Ganti dengan password aplikasi Gmail kamu
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Pengirim & Penerima
    $mail->setFrom('excample@gmail.com', 'Kenbul');
    $mail->addAddress('penerima@gmail.com', 'Penerima'); // Ganti dengan email tujuan

    // Konten email
    $mail->isHTML(true);
    $mail->Subject = 'Coba Kirim Email dengan PHPMailer';
    $mail->Body    = '<h3>Hello!</h3><p>Ini email pertama kamu pakai PHPMailer 🎉</p>';

    // Kirim email
    $mail->send();
    echo 'Email berhasil dikirim!';
} catch (Exception $e) {
    echo "Gagal mengirim email. Error: {$mail->ErrorInfo}";
}
?>
