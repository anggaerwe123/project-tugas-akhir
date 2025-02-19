<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['keranjang'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image']; // Menyimpan gambar produk
    $product_quantity = 1; // Default quantity

    // Cek apakah produk sudah ada di keranjang
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += 1;
    } else {
        $_SESSION['cart'][$product_id] = [
            'id' => $product_id,
            'name' => $product_name,
            'price' => $product_price,
            'image' => $product_image, // Tambahkan gambar produk
            'quantity' => $product_quantity
        ];
    }
}

// Hitung jumlah item di keranjang untuk badge
$total_items = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

?>
