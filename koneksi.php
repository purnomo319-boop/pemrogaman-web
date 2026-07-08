<?php
// =====================================
// KONEKSI DATABASE ESKU
// =====================================

$host = "localhost";
$user = "root";
$pass = "";
$db   = "esku";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");
date_default_timezone_set("Asia/Jakarta");
?>