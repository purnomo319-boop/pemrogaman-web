<?php
$products = [
    ['name' => 'Es Strawberry', 'price' => 12000, 'image' => 'admin/assets/img/es-strawberry.jpg'],
    ['name' => 'Es Mangga', 'price' => 15000, 'image' => 'admin/assets/img/es-mangga.jpg'],
    ['name' => 'Es Matcha', 'price' => 16000, 'image' => 'admin/assets/img/es-matcha.jpg'],
    ['name' => 'Es Coklat', 'price' => 13000, 'image' => 'admin/assets/img/es-coklat.jpg'],
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EsKu - Pesan Minuman Favoritmu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4ea8de;
            --primary-dark: #2e86de;
            --accent: #34c759;
            --soft: #f7fbff;
            --text: #243447;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            color: var(--text);
            background: linear-gradient(180deg, #ffffff 0%, var(--soft) 100%);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .hero {
            padding: 90px 0;
            background: linear-gradient(135deg, #eaf7ff 0%, #ffffff 100%);
        }

        .hero h1 {
            font-size: 2.6rem;
            font-weight: 700;
        }

        .hero p {
            font-size: 1.08rem;
            color: #4e6474;
        }

        .btn-primary {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .btn-primary:hover {
            background: var(--primary);
            border-color: var(--primary);
        }

        .btn-outline-primary {
            color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .btn-outline-primary:hover {
            background: var(--primary-dark);
            color: white;
        }

        .card-product {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(46, 134, 222, 0.12);
            transition: transform 0.2s ease;
        }

        .card-product:hover {
            transform: translateY(-4px);
        }

        .card-product img {
            height: 220px;
            object-fit: cover;
        }

        .section-title {
            font-weight: 700;
            color: var(--primary-dark);
        }

        footer {
            background: #1e3f5a;
            color: white;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand text-primary" href="#">🥤 EsKu</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="#menu">Menu</a></li>
                <li class="nav-item"><a class="nav-link" href="#tentang">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                <li class="nav-item"><a class="nav-link" href="cart.php">Keranjang</a></li>
            </ul>
        </div>
    </div>
</nav>

<section id="beranda" class="hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <h1>Pesan Minuman Favoritmu Secara Online</h1>
                <p class="mt-3">
                    Nikmati berbagai pilihan minuman segar dengan proses pemesanan yang mudah, cepat, dan praktis.
                    Pilih menu favoritmu, lakukan pembayaran melalui QRIS, dan tunggu pesanan diproses oleh admin.
                </p>
                <div class="mt-4">
                    <a href="cart.php" class="btn btn-primary btn-lg me-2">Pesan Sekarang</a>
                    <a href="#menu" class="btn btn-outline-primary btn-lg">Lihat Menu</a>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card border-0 shadow-lg rounded-4 p-3">
                    <img src="admin/assets/img/es-strawberry.jpg" class="img-fluid rounded-4" alt="EsKu hero">
                </div>
            </div>
        </div>
    </div>
</section>

<section id="menu" class="py-5">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="section-title">Menu Minuman Favorit</h2>
            <p class="text-muted">Pilih minuman segar yang paling kamu sukai.</p>
        </div>
        <div class="row g-4">
            <?php foreach ($products as $product): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card card-product h-100">
                        <img src="<?= $product['image']; ?>" class="card-img-top" alt="<?= $product['name']; ?>">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold"><?= $product['name']; ?></h5>
                            <p class="text-primary fw-semibold">Rp <?= number_format($product['price'], 0, ',', '.'); ?></p>
                                <button type="button" class="btn btn-success add-to-cart" data-name="<?= htmlspecialchars($product['name']) ?>" data-price="<?= (int)$product['price'] ?>">Tambah ke Keranjang</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="tentang" class="py-5 bg-white">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h2 class="section-title">Tentang Kami</h2>
                <p class="text-muted">
                    Selamat datang di EsKu, tempat menikmati berbagai minuman segar dengan rasa berkualitas.
                    Kami menyediakan berbagai pilihan minuman seperti Es Strawberry, Es Mangga, Es Matcha, Es Coklat,
                    dengan rasa berkualitas. Kami menyediakan berbagai pilihan minuman seperti Es Strawberry, Es Mangga, Es Matcha, dan Es Coklat. Dengan website ini, pelanggan dapat memesan minuman kapan saja tanpa harus datang langsung ke toko.
                </p>
            </div>
            <div class="col-lg-6">
                <div class="card shadow-sm border-0 rounded-4 p-4">
                    <h5 class="fw-bold">Segar di Setiap Tegukan</h5>
                    <p class="mb-0 text-muted">Pesan minuman favoritmu dengan cepat, aman, dan praktis melalui sistem online EsKu.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="kontak" class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card shadow-sm border-0 rounded-4 p-4 h-100">
                    <h3 class="section-title">Informasi Toko</h3>
                    <ul class="list-unstyled mt-3 mb-0">
                        <li><strong>Nama Toko:</strong> EsKu</li>
                        <li><strong>Alamat:</strong> Jl. Kaliurang No. 25, Sleman, Yogyakarta</li>
                        <li><strong>Jam Operasional:</strong> 09.00 - 21.00 WIB</li>
                        <li><strong>No. HP:</strong> 0812-3456-7890</li>
                        <li><strong>Metode Pembayaran:</strong> QRIS</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow-sm border-0 rounded-4 p-4 h-100">
                    <h3 class="section-title">Hubungi Kami</h3>
                    <p class="text-muted">Kami siap melayani pesanan Anda dengan cepat dan ramah.</p>
                    <a href="https://wa.me/6281234567890" class="btn btn-success">Hubungi via WhatsApp</a>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="py-4">
    <div class="container text-center">
        <h5 class="fw-bold">EsKu</h5>
        <p class="mb-1">Jl. Kaliurang No. 25, Sleman, Yogyakarta</p>
        <p class="mb-1">0812-3456-7890</p>
        <p class="mb-0">Jam Operasional: 09.00 - 21.00 WIB</p>
        <p class="mt-2 mb-0">© <?= date('Y'); ?> EsKu. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.querySelectorAll('.add-to-cart').forEach(function(btn){
    btn.addEventListener('click', function(){
        const name = btn.dataset.name || '';
        const price = btn.dataset.price || 0;
        const form = new URLSearchParams();
        form.append('action','add');
        form.append('name', name);
        form.append('price', price);

        fetch('admin/config/cart_api.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: form.toString()
        }).then(r => r.json()).then(data => {
            if (data.success) {
                // setelah berhasil, buka halaman keranjang
                window.location.href = 'cart.php';
            } else {
                alert(data.message || 'Gagal menambahkan ke keranjang');
            }
        }).catch(() => alert('Kesalahan jaringan'));
    });
});
</script>
</body>
</html>
