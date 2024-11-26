<?php 
session_start();
include 'koneksi.php';

if (isset($_GET['id_kategori'])) {
    $id_kategori = $_GET['id_kategori'];
    
    // Mulai transaksi
    mysqli_begin_transaction($koneksi);

    try {
        // Hapus produk terkait
        $query_hapus_produk = "DELETE FROM produk WHERE id_kategori = '$id_kategori'";
        $result_produk = mysqli_query($koneksi, $query_hapus_produk);

        if (!$result_produk) {
            throw new Exception("Gagal menghapus produk terkait!");
        }

        // Hapus kategori
        $query_hapus_kategori = "DELETE FROM kategori WHERE id_kategori = '$id_kategori'";
        $result_kategori = mysqli_query($koneksi, $query_hapus_kategori);

        if (!$result_kategori) {
            throw new Exception("Gagal menghapus kategori!");
        }

        // Commit transaksi jika berhasil
        mysqli_commit($koneksi);
        $_SESSION['message'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Berhasil!</strong> Data Kategori Telah Dihapus
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    } catch (Exception $e) {
        // Rollback transaksi jika terjadi kesalahan
        mysqli_rollback($koneksi);
        $_SESSION['message'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <strong>Gagal!</strong> Data Kategori Gagal Dihapus
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
}
header("Location: ../Admin/kategori.php");
exit();
?>