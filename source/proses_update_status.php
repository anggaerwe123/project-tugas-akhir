<?php
include '../source/koneksi.php';

if (isset($_GET['id_pesanan'])) {
    $id_pesanan = $_GET['id_pesanan'];

    // Update status pesanan menjadi "berhasil"
    $updateQuery = "UPDATE pesanan SET status = 'Sudah dibayar' WHERE id_pesanan = $id_pesanan";
    if (mysqli_query($koneksi, $updateQuery)) {

        // Ambil data pesanan untuk memasukkan ke tabel pembayaran
        $selectQuery = "SELECT id_user, total_harga FROM pesanan WHERE id_pesanan = $id_pesanan";
        $result = mysqli_query($koneksi, $selectQuery);
        $data = mysqli_fetch_assoc($result);

        if ($data) {
            // Tentukan metode pembayaran, misal "transfer bank"
            $metode_pembayaran = 'transfer bank';
            $status_pembayaran = 'Belum Dikirim';

            // Insert data ke tabel pembayaran
            $insertQuery = "INSERT INTO pembayaran (id_pesanan, metode_pembayaran, status_pembayaran)
                            VALUES ($id_pesanan, '$metode_pembayaran', '$status_pembayaran')";
            mysqli_query($koneksi, $insertQuery);

            // Set pesan berhasil
            $_SESSION['message'] = '<div class="alert alert-success">Status pesanan berhasil diubah dan data pembayaran ditambahkan.</div>';
        } else {
            $_SESSION['message'] = '<div class="alert alert-danger">Data pesanan tidak ditemukan.</div>';
        }
    } else {
        $_SESSION['message'] = '<div class="alert alert-danger">Gagal mengubah status pesanan.</div>';
    }

    // Redirect kembali ke halaman pesanan
    header("Location: ../Admin/pesanan.php");
    exit();
}
?>
