<?php
session_start();
include "config/koneksi.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - EsKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <span class="navbar-brand fw-bold">🥤 Admin EsKu</span>
        <a href="../index.php" class="btn btn-light btn-sm">Beranda</a>
    </div>
</nav>

<div class="container py-5">
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow h-100">
                <div class="card-body text-center">
                    <h4>Data Menu</h4>
                    <p>Kelola menu minuman yang tersedia.</p>
                    <a href="menu.php" class="btn btn-primary">Buka Menu</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow h-100">
                <div class="card-body text-center">
                    <h4>Data Pesanan</h4>
                    <p>Lihat dan proses pesanan pelanggan.</p>
                    <a href="pesanan.php" class="btn btn-success">Buka Pesanan</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
