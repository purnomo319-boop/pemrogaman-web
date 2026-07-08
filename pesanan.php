<?php
session_start();
require_once __DIR__ . "/config/koneksi.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    mysqli_query($conn, "UPDATE pesanan SET status='Diproses' WHERE id_pesanan=$id");
    header("Location: pesanan.php");
    exit;
}

$data = mysqli_query($conn, "SELECT * FROM pesanan ORDER BY id_pesanan DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Data Pesanan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<nav class="navbar navbar-dark bg-primary">

<div class="container">

<span class="navbar-brand">
🥤 Admin EsKu
</span>

<a href="dashboard.php" class="btn btn-light">
Dashboard
</a>

</div>

</nav>

<div class="container mt-5">

<h2 class="mb-4 text-center">
Data Pesanan
</h2>

<table class="table table-bordered table-striped">

<thead class="table-primary">

<tr>

<th>No</th>

<th>Nama</th>

<th>No HP</th>

<th>Total</th>

<th>Status</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

while($row=mysqli_fetch_assoc($data)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $row['nama']; ?></td>

<td><?= $row['no_hp']; ?></td>

<td>Rp <?= number_format($row['total']); ?></td>

<td>

<?php

if($row['status']=="Menunggu"){

echo "<span class='badge bg-warning'>Menunggu</span>";

}elseif($row['status']=="Diproses"){

echo "<span class='badge bg-primary'>Diproses</span>";

}else{

echo "<span class='badge bg-success'>Selesai</span>";

}

?>

</td>

<td>

<?php if($row['status']=="Menunggu"){ ?>

<a href="?id=<?= $row['id_pesanan']; ?>" class="btn btn-success btn-sm">

Proses

</a>

<?php }else{ ?>

-

<?php } ?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>