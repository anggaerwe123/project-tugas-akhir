<?php include 'session.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="../images/logo.png">
    <title>Admin WeKress</title>
    <style>
      body { background: #f0f0f0; }
    </style>
  </head>
  <body>
    <!-- Navbar for mobile view -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark d-lg-none sticky-top">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#"><img src="../images/wekress.png" width="150"></a>
      </div>
    </nav>

    <div class="d-flex flex-column flex-lg-row">
      <div class="col-lg-2 bg-dark text-white p-3" id="sidebar">
        <span class="fs-4"><img src="../images/wekress.png" width="150"></span>
        <?php include 'sidebar.php'; ?>
      </div>
      
      <div class="col-lg-10 p-3" id="content">
      <?php
          if (isset($_SESSION['message'])) {
              echo $_SESSION['message'];
              unset($_SESSION['message']); // Menghapus pesan setelah ditampilkan
          }
          ?>

        <h2 class="text-center">Admin WeKress</h2>
        <hr>

        <div class="card mb-3">
          <h2 class="ms-3 my-2"><i class="fa-solid fa-circle-info"></i> Halaman Detail Pesanan</h2>
        </div>
        
        <div class="card shadow box-area">
        <div class="text-center mb-3 mt-3 d-flex">
          <h4 class="ms-3">Detail Pesanan</h4>
          <h4 class="ms-auto"><i class="fa-solid fa-circle-info"></i></h4>
          <hr class="bg-dark me-3">
        </div>

          <div class="d-flex align-items-center ms-3 me-3 p-3 my-2 text-white rounded shadow-sm" style="background: #ffd167;">
            <div class="row g-3 me-auto">
              <a href="pesanan.php" class="btn btn-success">Kembali</a>
            </div>
            <div class="ms-auto">
              <button type="button" class="btn btn-info rounded-circle" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa-solid fa-circle-exclamation"></i>
              </button>

              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content text-dark">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Harap Diperhatikan!</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>Beberapa Peraturan yang harus diperhatikan Admin Yaitu:</p>
                      <p>1. Pastikan data pesanan akurat.</p>
                      <p>2. Periksa ketersediaan produk.</p>
                      <p>3. Tetapkan status pesanan yang jelas.</p>
                      <p>4. Sesuaikan pengiriman sesuai estimasi waktu.</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-success" data-bs-dismiss="modal">Siap!!</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="mt-3 ms-3 me-3">
            
          <?php
include '../source/koneksi.php';

$order_id = $_GET['id_pesanan'];

// Fetch order details
$query = "SELECT o.*, u.nama, u.email, u.alamat FROM pesanan o 
          JOIN user u ON o.id_user = u.id_user 
          WHERE o.id_pesanan = '$order_id'";
$result = mysqli_query($koneksi, $query);
$order = mysqli_fetch_assoc($result);

// Fetch products in the order
$query_products = "SELECT d.*, p.nama_produk, p.harga AS harga_perproduk 
                   FROM detail_pesanan d
                   JOIN produk p ON d.id_produk = p.id_produk
                   WHERE d.id_pesanan = '$order_id'";
$result_products = mysqli_query($koneksi, $query_products);

// Check if products exist
if (!$result_products) {
    die("Error fetching products: " . mysqli_error($koneksi));
}

$products = mysqli_fetch_all($result_products, MYSQLI_ASSOC);
?>
    <h3>Detail Pesanan</h3>
    <p><strong>Nama:</strong> <?= $order['nama']; ?></p>
    <p><strong>Email:</strong> <?= $order['email']; ?></p>
    <p><strong>Alamat:</strong> <?= $order['alamat']; ?></p>
    <p><strong>Tanggal Pesanan:</strong> <?= $order['tanggal_pesanan']; ?></p>
    <p><strong>Status:</strong> <?= $order['status']; ?></p>

    <h4>Produk yang Dipesan</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Kuantitas</th>
                <th>Harga per Produk</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product['nama_produk']; ?></td>
                    <td><?= $product['kuantitas']; ?></td>
                    <td>Rp <?= number_format($product['harga_perproduk'], 2, ',', '.'); ?></td>
                    <td>Rp <?= number_format($product['harga_perproduk'] * $product['kuantitas'], 2, ',', '.');  ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

            </div>
          </div>
        </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
      document.querySelectorAll('.delete-button').forEach(button => {
        button.addEventListener('click', function() {
          document.getElementById('confirmDeleteButton').href = this.getAttribute('data-url');
        });
      });
    </script>
  </body>
</html>