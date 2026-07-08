<?php
session_start();
$items = $_SESSION['cart'] ?? [];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - EsKu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="../index.php">🥤 EsKu</a>

        <div class="ms-auto">
            <a href="../index.php" class="btn btn-light btn-sm">Kembali</a>
        </div>
    </div>
</nav>

<div class="container mt-5 mb-5">
    <h2 class="text-center mb-4">Keranjang Belanja</h2>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <table class="table table-bordered table-hover align-middle">
                <caption class="visually-hidden">Daftar item di keranjang belanja</caption>
                <thead class="table-primary">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Minuman</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody id="cartBody">
                    <?php $i = 0; foreach ($items as $id => $item): $i++; ?>
                        <tr class="cart-row" data-id="<?= htmlspecialchars($id) ?>">
                            <th scope="row"><?= $i ?></th>
                            <td><?= htmlspecialchars($item['name']) ?></td>
                            <td class="price" data-price="<?= (int)$item['price'] ?>">Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                            <td>
                                <label class="visually-hidden" for="qty-<?= $i ?>">Jumlah untuk <?= htmlspecialchars($item['name']) ?></label>
                                <input id="qty-<?= $i ?>" type="number" class="form-control qty-input" min="1" value="<?= (int)$item['qty'] ?>" style="max-width: 90px;" aria-label="Jumlah <?= htmlspecialchars($item['name']) ?>">
                            </td>
                            <td class="subtotal">Rp <?= number_format($item['price'] * $item['qty'], 0, ',', '.') ?></td>
                            <td>
                                <button type="button" class="btn btn-outline-danger btn-sm remove-item" data-id="<?= htmlspecialchars($id) ?>" aria-label="Hapus <?= htmlspecialchars($item['name']) ?>">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-end">Total</th>
                        <th id="totalAmount" colspan="2">Rp 0</th>
                    </tr>
                </tfoot>
            </table>

            <form id="checkoutForm" action="pembayaran.php" method="get" class="text-end">
                <input type="hidden" name="total" id="totalInput" value="0">
                <button type="submit" class="btn btn-success btn-lg">Checkout</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function formatRupiah(value) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0
        }).format(value);
    }

    function updateTotal() {
        let total = 0;
        document.querySelectorAll('.cart-row').forEach(function(row) {
            const price = parseInt(row.querySelector('.price').dataset.price || 0, 10);
            const qty = parseInt(row.querySelector('.qty-input').value || 0, 10);
            const subtotal = price * qty;
            row.querySelector('.subtotal').textContent = formatRupiah(subtotal);
            total += subtotal;
        });

        document.getElementById('totalAmount').textContent = formatRupiah(total);
        document.getElementById('totalInput').value = total;
    }

    document.addEventListener('DOMContentLoaded', function () {
        updateTotal();

        // update qty via API
        document.querySelectorAll('.qty-input').forEach(function(input) {
            input.addEventListener('change', function () {
                const row = input.closest('.cart-row');
                if (!row) return;
                const id = row.dataset.id;
                const qty = parseInt(input.value || 1, 10);

                const form = new URLSearchParams();
                form.append('action', 'update');
                form.append('id', id);
                form.append('qty', qty);

                fetch('cart_api.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: form.toString() })
                    .then(r => r.json()).then(data => {
                        if (data.success) {
                            updateTotal();
                        } else {
                            alert(data.message || 'Gagal update jumlah');
                        }
                    }).catch(() => alert('Kesalahan jaringan'));
            });
        });

        // remove via API
        document.querySelectorAll('.remove-item').forEach(function(button) {
            button.addEventListener('click', function () {
                const id = button.dataset.id;
                if (!id) return;
                const form = new URLSearchParams();
                form.append('action', 'remove');
                form.append('id', id);

                fetch('cart_api.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: form.toString() })
                    .then(r => r.json()).then(data => {
                        if (data.success) {
                            const row = button.closest('.cart-row');
                            if (row) row.remove();
                            updateTotal();
                        } else {
                            alert(data.message || 'Gagal menghapus item');
                        }
                    }).catch(() => alert('Kesalahan jaringan'));
            });
        });

        document.getElementById('checkoutForm').addEventListener('submit', function (event) {
            updateTotal();
            if (document.querySelectorAll('.cart-row').length === 0) {
                event.preventDefault();
                alert('Keranjang masih kosong. Silakan pilih minuman terlebih dahulu.');
            }
        });
    });
</script>

</body>
</html>