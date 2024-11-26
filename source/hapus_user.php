<?php 
session_start();
include 'koneksi.php';

if (isset($_GET['id_user'])) {
    $id_user = $_GET['id_user'];

    // Hapus data terkait di tabel yang memiliki foreign key id_user terlebih dahulu
    $query_feedback = "DELETE FROM feedback WHERE id_user = '$id_user'"; // jika ada tabel detail_pesanan yang mengacu ke id_user
    $query_pesanan = "DELETE FROM pesanan WHERE id_user = '$id_user'";

    // Eksekusi query di atas
    mysqli_query($koneksi, $query_feedback);
    mysqli_query($koneksi, $query_pesanan);

    // Hapus data dari tabel user setelah data terkait sudah dihapus
    $query_user = "DELETE FROM user WHERE id_user = '$id_user'";
    $result_user = mysqli_query($koneksi, $query_user);

    if (!$result_user) {
        die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    } else {
        $_SESSION['message'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
          <strong>Berhasil!</strong> Data Pengguna Telah DiHapus
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
} else {
    $_SESSION['message'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
      <strong>Gagal!</strong> Data Pengguna Tidak Ditemukan
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
}

header("Location: ../admin/user.php");
exit();
?>
