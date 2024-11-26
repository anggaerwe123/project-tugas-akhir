<?php
session_start();
include 'koneksi.php';

if (isset($_POST['edit'])) {
    $id_kategori = $_POST['id_kategori']; // Pastikan nama 'id_kategori' sesuai dengan input hidden
    $nama_kategori = mysqli_real_escape_string($koneksi, $_POST['nama_kategori']); // Gunakan name yang sesuai

    $update_query = "UPDATE kategori SET nama_kategori = '$nama_kategori' WHERE id_kategori = '$id_kategori'";
    if (mysqli_query($koneksi, $update_query)) {
        $_SESSION['message'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Berhasil!</strong> Data Kategori Telah Diubah
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    } else {
        $_SESSION['message'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <strong>Gagal!</strong> Data Kategori Gagal Diubah
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
}
header("Location: ../Admin/kategori.php");
exit();
?>
?>