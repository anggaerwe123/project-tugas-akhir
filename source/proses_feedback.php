<?php
// Sertakan file koneksi ke database
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $komentar = htmlspecialchars($_POST['komentar']);

    // Validasi sederhana (bisa ditambah sesuai kebutuhan)
    if (!empty($nama) && !empty($email) && !empty($komentar)) {
        // Query untuk memasukan data ke database
        $sql = "INSERT INTO feedback (nama, email, komentar) VALUES (?, ?, ?)";

        // Persiapkan statement
        $stmt = $koneksi->prepare($sql);

        // Binding parameter (menggunakan prepared statement untuk keamanan)
        $stmt->bind_param("sss", $nama, $email, $komentar);

        // Eksekusi statement
        if ($stmt->execute()) {
            echo "<script>alert('Umpan balik berhasil dikirim!'); window.location.href='../User/dashboard.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Tutup statement
        $stmt->close();
    } else {
        echo "<script>alert('Semua field harus diisi.'); window.history.back();</script>";
    }

    // Tutup koneksi
    $koneksi->close();
}
?>
