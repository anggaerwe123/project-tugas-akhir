<?php
session_start();
include 'koneksi.php';

$gambar = $_FILES['gambar']['name'];
$nama_produk = $_POST['nama_produk'];
$deskripsi = $_POST['deskripsi'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];
$id_kategori = $_POST['id_kategori']; // Ambil id_kategori dari form input

// Pastikan harga disimpan dalam format numerik dengan dua desimal
$harga_formatted = number_format((float)$harga, 2, '.', '');

if ($gambar != "") {
    $ekstensi_diperbolehkan = array('png', 'jpg');
    $x = explode('.', $gambar);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambar']['tmp_name'];
    $angka_acak = rand(1, 999);
    $nama_gambar_baru = $angka_acak . '-' . $gambar;

    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        move_uploaded_file($file_tmp, '../Database/' . $nama_gambar_baru);

        $query = "INSERT INTO produk (gambar, nama_produk, id_kategori, deskripsi, harga, stok) 
                  VALUES ('$nama_gambar_baru', '$nama_produk', '$id_kategori', '$deskripsi', '$harga_formatted', '$stok')";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            $_SESSION['message'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <b><i class='fa-solid fa-check'></i></b> Data Produk Telah Ditambahkan!!
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        } else {
            $_SESSION['message'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <b><i class='fa-solid fa-circle-exclamation'></i></b> Data Produk Gagal Ditambahkan!!
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        }
    } else {
        $_SESSION['message'] = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <b><i class='fa-solid fa-triangle-exclamation'></i></b> Ekstensi Gambar Hanya Berupa JPG dan PNG!!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }
} else {
    $query = "INSERT INTO produk (nama_produk, id_kategori, deskripsi, harga, stok) 
              VALUES ('$nama_produk', '$id_kategori', '$deskripsi', '$harga_formatted', '$stok')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $_SESSION['message'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Berhasil!</strong> Data Produk Telah Ditambahkan
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    } else {
        $_SESSION['message'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Gagal!</strong> Data Produk Gagal Ditambahkan
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }
}

header("Location: ../admin/produk.php");
exit();
?>
