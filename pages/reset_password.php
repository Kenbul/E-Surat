<?php
include '../config/config.php';

$token = $_GET['token'] ?? '';

// Cek token valid atau tidak
$cek = $conn->prepare("SELECT * FROM users WHERE reset_token = ? AND reset_token_expiry > NOW()");
$cek->bind_param("s", $token);
$cek->execute();
$result = $cek->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "Link reset password tidak valid atau sudah kadaluarsa.";
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Reset Password</title>
</head>

<body>
    <h2>Reset Password</h2>
    <form action="proses_reset.php" method="POST">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
        <label>Password Baru:</label>
        <input type="password" name="password" required>
        <label>Konfirmasi Password:</label>
        <input type="password" name="confirm_password" required>
        <button type="submit">Reset Password</button>
    </form>
</body>

</html>