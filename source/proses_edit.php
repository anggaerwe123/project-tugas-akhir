<?php
session_start();
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $id_produk = $_POST['id_produk'];
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Cek apakah ada gambar baru yang diupload
    if ($_FILES['gambar']['name']) {
        $gambar = $_FILES['gambar']['name'];
        $target_dir = "../Database/";
        $target_file = $target_dir . basename($gambar);

        // Pindahkan file ke folder 'uploads'
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            // Update query dengan gambar
            $query = "UPDATE produk SET nama_produk='$nama_produk', deskripsi='$deskripsi', harga='$harga', stok='$stok', gambar='$gambar' WHERE id_produk='$id_produk'";
        }
    } else {
        // Update query tanpa gambar
        $query = "UPDATE produk SET nama_produk='$nama_produk', deskripsi='$deskripsi', harga='$harga', stok='$stok' WHERE id_produk='$id_produk'";
    }

    if (mysqli_query($koneksi, $query)) {
        $_SESSION['message'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Berhasil!</strong> Data Produk Telah Di Edit
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
    } else {
        $_SESSION['message'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <strong>Gagal!</strong> Data Produk Telah Di Gagal DiEdit
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
    }
}

header("Location: ../admin/produk.php");
exit();
