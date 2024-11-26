<?php
include 'koneksi.php'; // Pastikan koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pesanan = $_POST['id_pesanan'];
    $metode_pembayaran = $_POST['metode_pembayaran'];

    // Set status pembayaran sebagai 'pending' atau sesuai proses verifikasi
    $status_pembayaran = 'pending';

    // Simpan data pembayaran
    $sql = "INSERT INTO pembayaran (id_pesanan, metode_pembayaran, status_pembayaran)
            VALUES (?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("iss", $id_pesanan, $metode_pembayaran, $status_pembayaran);
    
    if ($stmt->execute()) {
        echo "Pembayaran berhasil disimpan.";
        // Redirect atau lakukan aksi setelah penyimpanan
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $koneksi->close();
}
?>
