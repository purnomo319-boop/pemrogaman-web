<?php
$total = isset($_GET['total']) ? (int) $_GET['total'] : 28000;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - EsKu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">

        <a class="navbar-brand fw-bold" href="index.php">
            🥤 EsKu
        </a>

    </div>
</nav>

<div class="container mt-5 mb-5">

    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

        <div class="card-header bg-primary text-white py-4">
            <h3 class="text-center mb-0">
                Pembayaran QRIS
            </h3>
        </div>

        <div class="card-body p-4 p-md-5 text-center">

            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <div class="p-3 rounded-4 bg-light border">
                        <h5 class="fw-bold">Total Pembayaran</h5>
                        <h2 class="text-success mb-3">Rp <?= number_format($total, 0, ',', '.') ?></h2>
                        <p class="text-muted mb-0">Silakan scan QRIS di bawah ini untuk melakukan pembayaran.</p>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="p-3 rounded-4 bg-white border shadow-sm">
                        <h5 class="fw-bold mb-3">Scan QRIS Berikut</h5>
                        <img src="../assets/img/qris.jpeg"
                             class="img-fluid rounded-4 shadow"
                             style="max-width: 360px; width: 100%;"
                             alt="QRIS EsKu">
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="mx-auto" style="max-width: 520px;">
                <h5 class="fw-bold mb-3">Bayar Sekarang</h5>
                <form action="" method="post" enctype="multipart/form-data">

                    <div class="mb-3 text-start">
                        <label class="form-label fw-semibold">Upload Bukti Pembayaran</label>
                        <input type="file" name="bukti" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success btn-lg w-100 shadow-sm">
                        Kirim Bukti Pembayaran
                    </button>

                </form>
            </div>

            <br>

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['bukti']) && $_FILES['bukti']['error'] === UPLOAD_ERR_OK) {
                $targetDir = "../assets/img/";
                $fileName = time() . "_" . basename($_FILES['bukti']['name']);
                $targetFile = $targetDir . $fileName;

                if (move_uploaded_file($_FILES['bukti']['tmp_name'], $targetFile)) {
                    echo "<div class='alert alert-success mt-3'>
                            Bukti pembayaran berhasil diupload.
                            <br>
                            Admin akan segera memverifikasi pembayaran Anda.
                          </div>";
                } else {
                    echo "<div class='alert alert-danger mt-3'>Gagal mengupload bukti pembayaran.</div>";
                }
            }
            ?>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>