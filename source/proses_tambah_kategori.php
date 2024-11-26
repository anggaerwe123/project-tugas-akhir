<?php 
session_start();
include '../source/koneksi.php';
    if (isset($_POST['submit'])) {
    $nama_kategori = $_POST['kategori'];
    $query = "INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES (NULL, '$nama_kategori');";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
    $_SESSION['message'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Berhasil!</strong> Data Kategori Telah Disimpan
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }else{
    $_SESSION['message'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <strong>Gagal!</strong> Data Kategori Tidak Ditemukan
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
} 
header("Location: ../Admin/kategori.php");
exit();
?>