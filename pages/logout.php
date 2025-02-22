<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

session_destroy();
echo "<script>
            alert('Anda berhasil Logout!');
            window.location.href = 'pages/login.php';
        </script>";
