<?php
include 'koneksi.php';

if (isset($_GET['id_pembayaran'])) {    
    $id_pembayaran = $_GET['id_pembayaran'];

    // Update status pembayaran menjadi "berhasil"
    $updateQuery = "UPDATE pembayaran SET status_pembayaran = 'Sudah dikirim' WHERE id_pembayaran = $id_pembayaran";
    if (mysqli_query($koneksi, $updateQuery)) {

            // Set pesan berhasil
            $_SESSION['message'] = '<div class="alert alert-success">Status pemabayaran berhasil diubah</div>';
        } else {
            $_SESSION['message'] = '<div class="alert alert-danger">Data pembayaran tidak ditemukan.</div>';
        }

    // Redirect kembali ke halaman pembayaran
    header("Location: ../Admin/pembayaran.php");
    exit();
}
?>
