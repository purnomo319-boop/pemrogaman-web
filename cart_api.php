<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

function json($data) {
    echo json_encode($data);
    exit;
}

$action = $_POST['action'] ?? null;
if (!$action) json(['success' => false, 'message' => 'No action provided']);

if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

function cart_count_items() {
    $count = 0;
    foreach ($_SESSION['cart'] as $it) $count += ($it['qty'] ?? 0);
    return $count;
}

switch ($action) {
    case 'add':
        $name = trim($_POST['name'] ?? '');
        $price = (int)($_POST['price'] ?? 0);
        if ($name === '' || $price <= 0) json(['success' => false, 'message' => 'Data produk tidak valid']);

        $id = $_POST['id'] ?? md5($name . '|' . $price);

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['qty'] = ($_SESSION['cart'][$id]['qty'] ?? 0) + 1;
        } else {
            $_SESSION['cart'][$id] = [
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'qty' => 1,
            ];
        }

        json(['success' => true, 'message' => 'Produk ditambahkan ke keranjang', 'items' => cart_count_items()]);
        break;

    case 'update':
        $id = $_POST['id'] ?? '';
        $qty = max(1, (int)($_POST['qty'] ?? 1));
        if ($id === '' || !isset($_SESSION['cart'][$id])) json(['success' => false, 'message' => 'Item tidak ditemukan']);
        $_SESSION['cart'][$id]['qty'] = $qty;
        json(['success' => true]);
        break;

    case 'remove':
        $id = $_POST['id'] ?? '';
        if ($id === '' || !isset($_SESSION['cart'][$id])) json(['success' => false, 'message' => 'Item tidak ditemukan']);
        unset($_SESSION['cart'][$id]);
        json(['success' => true, 'items' => cart_count_items()]);
        break;

    case 'get':
        $cart = array_values($_SESSION['cart']);
        json(['success' => true, 'cart' => $cart, 'items' => cart_count_items()]);
        break;

    default:
        json(['success' => false, 'message' => 'Aksi tidak dikenal']);
}
