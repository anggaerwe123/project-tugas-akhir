<?php
// Mulai session untuk mengambil user_id dari session login
include '../User/session.php';

// Koneksi ke database
include 'koneksi.php';

// Pastikan user sudah login dan session user_id tersedia
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    echo "<script>alert('Anda harus login terlebih dahulu!'); window.location.href = 'login.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $komentar = $_POST['komentar'];
    $rating = $_POST['rating'];

    // Simpan feedback ke dalam database
    $sql = "INSERT INTO feedback (id_user, komentar, rating) VALUES ('$user_id', '$komentar', '$rating')";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>
            alert('Feedback berhasil disimpan!');
            window.location.href = '../User/feedback.php';
            </script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}
?>
