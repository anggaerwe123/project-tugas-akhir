<?php 
session_start();
include 'koneksi.php';

if (isset($_GET['id_produk'])) {
    $id_produk = $_GET['id_produk'];

    // Hapus data terkait di tabel detail_pesanan yang memiliki foreign key id_produk terlebih dahulu
    $query_detail = "DELETE FROM detail_pesanan WHERE id_produk = '$id_produk'";
    $result_detail = mysqli_query($koneksi, $query_detail);

    // Periksa jika penghapusan di detail_pesanan berhasil
    if ($result_detail) {
        // Hapus produk setelah data terkait di tabel detail_pesanan terhapus
        $query_produk = "DELETE FROM produk WHERE id_produk = '$id_produk'";
        $result_produk = mysqli_query($koneksi, $query_produk);

        if ($result_produk) {
            $_SESSION['message'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Berhasil!</strong> Data Produk Telah Dihapus.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        } else {
            $_SESSION['message'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Gagal!</strong> Data Produk Gagal Dihapus.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
    } else {
        $_SESSION['message'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Gagal!</strong> Tidak dapat menghapus data di tabel detail pesanan.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
} else {
    $_SESSION['message'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Gagal!</strong> Data Produk Gagal Dihapus.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
}

// Redirect kembali ke halaman produk
header("Location: ../admin/produk.php");
exit();
?>
