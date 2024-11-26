<?php 
session_start();
include 'koneksi.php';

$id = $_GET['id_pesanan'];

// Hapus data terkait di tabel pembayaran yang memiliki foreign key id_pesanan terlebih dahulu
$query_pembayaran = "DELETE FROM pembayaran WHERE id_pesanan = '$id'";
$sql_pembayaran = mysqli_query($koneksi, $query_pembayaran);

// Hapus detail pesanan terkait dengan id_pesanan
$query1 = "DELETE FROM detail_pesanan WHERE id_pesanan = '$id'";
$sql1 = mysqli_query($koneksi, $query1);

// Periksa jika penghapusan di pembayaran dan detail_pesanan berhasil
if ($sql_pembayaran && $sql1) {
    // Hapus pesanan setelah data terkait di tabel pembayaran dan detail_pesanan terhapus
    $query2 = "DELETE FROM pesanan WHERE id_pesanan = '$id'";
    $sql2 = mysqli_query($koneksi, $query2);

    if ($sql2) {
        $_SESSION['message'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Berhasil!</strong> Data pesanan telah dihapus.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    } else {
        $_SESSION['message'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Gagal!</strong> Data pesanan tidak dapat dihapus.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
} else {
    $_SESSION['message'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Gagal!</strong> Tidak dapat menghapus data terkait di tabel pembayaran atau detail pesanan.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
}

// Redirect kembali ke halaman pesanan
header("Location: ../admin/pesanan.php");
exit();
?>
