<?php
session_start();
require_once __DIR__ . "/config/koneksi.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit;
}

$data = mysqli_query($conn, "SELECT * FROM menu");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Menu - EsKu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="container mt-5">

    <h2 class="mb-4 text-center">Data Menu Minuman</h2>

    <div class="mb-3">
        <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
    </div>

    <table class="table table-bordered table-striped">

        <thead class="table-primary">

            <tr>
                <th>No</th>
                <th>Nama Menu</th>
                <th>Harga</th>
                <th>Gambar</th>
            </tr>

        </thead>

        <tbody>

        <?php
        $no = 1;

        while($row = mysqli_fetch_assoc($data)){
        ?>

            <tr>

                <td><?= $no++; ?></td>

                <td><?= $row['nama_menu']; ?></td>

                <td>Rp <?= number_format($row['harga']); ?></td>

                <td>

                    <img src="assets/img/<?= $row['gambar']; ?>" width="80">

                </td>

            </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>