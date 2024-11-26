<?php
session_start();
require 'koneksi.php'; // Sesuaikan dengan file koneksi database Anda

// Periksa apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Periksa apakah keranjang memiliki item
if (empty($_SESSION['cart'])) {
    echo "Keranjang belanja kosong!";
    exit();
}

$user_id = $_SESSION['user_id'];
$total_harga = 0;
$total_pesanan = 0;

// Hitung total harga dan jumlah pesanan dari keranjang
foreach ($_SESSION['cart'] as $item) {
    $total_harga += $item['harga'] * $item['kuantitas'];
    $total_pesanan += $item['kuantitas'];
}

// Format tanggal pesanan
$tanggal_pesanan = date("Y-m-d");

// Simpan pesanan ke tabel pesanan
$query = "INSERT INTO pesanan (id_user, total_harga, total_pesanan, tanggal_pesanan, status) VALUES ('$user_id', '$total_harga', '$total_pesanan', '$tanggal_pesanan', 'pending')";
if (mysqli_query($koneksi, $query)) {
    $id_pesanan = mysqli_insert_id($koneksi);

    // Kosongkan keranjang setelah checkout
    unset($_SESSION['cart']);
    echo "Checkout berhasil!";
} else {
    echo "Gagal melakukan checkout!";
}
?>
