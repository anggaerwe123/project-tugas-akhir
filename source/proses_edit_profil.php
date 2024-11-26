<?php

include 'koneksi.php';

$gambar = $_FILES['gambar']['name'];
$nama_produk = $_POST['nama'];
$deskripsi = $_POST['email'];
$harga = $_POST['har'];
$stok = $_POST['stok'];

if ($gambar != "") {
    $ekstensi_diperbolehkan = array('png','jpg');
    $x = explode('.', $gambar);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambar']['tmp_name'];
    $angka_acak = rand(1, 999);
    $nama_gambar_baru = $angka_acak.'-'.$gambar;
    
    if (in_array($ekstensi,  $ekstensi_diperbolehkan) === true) {
        move_uploaded_file($file_tmp, '../Database/'.$nama_gambar_baru);

        $query = "INSERT INTO produk (gambar, nama_produk, deskripsi, harga, stok) VALUES ('$nama_gambar_baru','$nama_produk','$deskripsi','$harga','$stok')";
        $result = mysqli_query($koneksi, $query);

        if (!$result) {
            die("Query Error :".mysqli_error($koneksi)."-".mysqli_error($koneksi));
        }else {
            echo "<script>alert('Data Berhasil Ditambahkan');
            window.location.href = '../admin/produk.php';
            </script>";
        }
    }else{
        echo "<script>
        alert('Ekstensi gambar hanya berupa PNG dan JPG');
        window.location.href = '../admin/produk.php';
        </script>";
    }
}else {
    $query = "INSERT INTO produk (nama_produk, deskripsi, harga, stok) VALUES ('$nama_produk','$deskripsi','$harga','$stok')";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query Error :".mysqli_error($koneksi)."-".mysqli_error($koneksi));
    }else {
        echo "<script>alert('Data Berhasil Ditambahkan');
        window.location.href = '../admin/produk.php';
        </script>";
    }
}

?>