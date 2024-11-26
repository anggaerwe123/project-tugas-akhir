<!-- remove_from_cart.php -->
<?php
session_start();
include 'koneksi.php';

if (isset($_GET['id_produk'])) {
    $id_produk = $_GET['id_produk'];

    // Periksa apakah produk ada di dalam keranjang
    if (isset($_SESSION['cart'][$id_produk])) {
        // Hapus produk dari keranjang
        unset($_SESSION['cart'][$id_produk]);
    }
}

// Redirect kembali ke halaman keranjang
header('Location: ../User/keranjang.php');
exit();
?>
