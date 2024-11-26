<?php
include '../User/session.php';
include 'koneksi.php'; // Koneksi ke database

// Ambil data dari session dan form
$id_user = $_SESSION['id_user']; // Asumsikan user login
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$telp = $_POST['telp'];
$total_pesanan = $_POST['total_pesanan'];
$total_harga = $_POST['total_harga'];
$tanggal_pesanan = date('Y-m-d'); // Mengambil tanggal sekarang
$order_id = rand(); // Membuat order_id acak
$status = 1; // Set status default (misalnya 1 = 'pending')

// Insert data ke tabel pesanan (pastikan kolom yang diinsert sesuai dengan tabel pesanan)
mysqli_query($koneksi, "insert into pesanan values('','$nama','$alamat','$telp','$total_pesanan','$total_pesanan','$status')");

// Kosongkan keranjang setelah checkout
unset($_SESSION['cart']);

// Redirect ke halaman Midtrans untuk proses pembayaran
header("Location:../midtrans/examples/snap/checkout-process-simple-version.php?order_id=$order_id");
exit();
?>
