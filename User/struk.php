<?php
include '../source/koneksi.php'; // Pastikan koneksi ke database tersedia
include 'session.php';

// Dapatkan data pesanan dari session
$user_id = $_SESSION['user_id'];
$cart = $_SESSION['checkout_cart'];
$total_harga = $_SESSION['checkout_total_harga'];

// Ambil data nama dan email user dari database
$query = "SELECT nama, email, alamat FROM user WHERE id_user = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$user_name = $user['nama'];
$user_email = $user['email'];
$user_alamat = $user['alamat'];

// Update status pesanan menjadi 2 (pembayaran berhasil) berdasarkan order_id
$update_status_query = "UPDATE pesanan SET status = 2 WHERE id_pesanan = ?";
$update_status_stmt = $koneksi->prepare($update_status_query);
$update_status_stmt->bind_param("i", $order_id);

// Hapus data checkout setelah ditampilkan
unset($_SESSION['checkout_cart']);
unset($_SESSION['checkout_total_harga']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeKresss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="asset/struk.css">
    <!-- Icon -->
    <link rel="icon" href="../images/logo.png">
</head>
<body>

  <!-- Style -->
  <style>
    .nav-link:hover{
      background-color: #ca8a04;
    }
    .nav-link.active {
      background-color: #f59e0b !important;
      color: black !important;
    }
    .nav li{
      margin-right: 10px;
    }
  </style>
  <!-- Style -->

  <!-- Header -->
  <div class="container-fluid bg-dark sticky-top">
    <div class="container">
      <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3">
        <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
          <img src="images/wekress.png" width="150">
        </a>
  
        <ul class="nav nav-pills nav-fill ms-auto d-flex g-3">
        <li><a href="#" class="nav-link px-2 text-white" id="download-btn">Cetak struk</a></li>
          <li><a href="feedback.php" class="nav-link px-2 text-white <?= basename($_SERVER['PHP_SELF']) == 'feedback.php' ? 'active' : '' ?>">Kembali Ke Halaman Website</a></li>
        </ul>
      </header>
    </div>
  </div>
  <!-- Akhir Header -->

  <div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="receipt-container shadow box-area">
      <div class="receipt-header">
        <img src="images/barcode.png" width="200">
        <p>Scan Untuk Bayar<br> Angga Rizki Wijaya <br>Telp: 0895-6221-92248</p>
        <hr>
      </div>
      <table class="table receipt-table">
        <thead>
          <tr>
            <th>Produk</th>
            <th class="text-end">Qty</th>
            <th class="text-end">Harga</th>
            <th class="text-end">Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($cart as $item): ?>
            <tr>
              <td><?= htmlspecialchars($item['name']); ?></td>
              <td class="text-end"><?= htmlspecialchars($item['quantity']); ?></td>
              <td class="text-end">Rp<?= number_format($item['price'], 0, ',', '.'); ?></td>
              <td class="text-end">Rp<?= number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?></td>
            </tr>
          <?php endforeach; ?>
          <tr class="total-row">
            <td colspan="3" class="text-end">Total</td>
            <td class="text-end">Rp<?= number_format($total_harga, 0, ',', '.'); ?></td>
          </tr>
        </tbody>
      </table>

      <div class="footer-text">
        <p>Terima kasih telah berbelanja di WeKresss</p>
        <p>Unduh struk ini sebagai riwayat belanja yang sah</p>
        <p><?= date("d M Y"); ?></p>
      </div>
    </div>
  </div>

  <footer class="pt-2">
    <div class="container">
      <div class="text-center py-3">
        <p>© 2024 WeKresss | Powered by <i>@angga_erwe</i>.</p>
      </div>
    </div>
  </footer>

  <script>
  document.getElementById("download-btn").addEventListener("click", function() {
    // Tangkap elemen struk
    const receiptContainer = document.querySelector(".receipt-container");

    // Konversi ke gambar menggunakan html2canvas
    html2canvas(receiptContainer).then(canvas => {
      // Buat link untuk download
      const link = document.createElement("a");
      link.href = canvas.toDataURL("image/png");
      link.download = "struk_wekresss.png";

      // Klik link untuk download
      link.click();
    });
  });
</script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
</body>
</html>
