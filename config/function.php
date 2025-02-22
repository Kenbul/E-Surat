<?php
function escape($string) {
    global $conn;
    return mysqli_real_escape_string($conn, $string);
}
?>