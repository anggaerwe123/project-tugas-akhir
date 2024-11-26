<?php include 'session.php' ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Icon -->
    <link rel="icon" href="../images/logo.png">

<!-- Title -->
<title>Admin WeKress</title>
  </head>
  <style>
    body{
      background: #f0f0f0;
    }
  </style>
  <body>

  <!-- Navbar for mobile view -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark d-lg-none">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#"><img src="../images/wekress.png" width="150" ></a>
    </div>
  </nav>

    <div class="d-flex">
        <div class="d-flex col-md-2 flex-column flex-shrink-0 p-3 text-white bg-dark" id="sidebar">
        <span class="fs-4"><img src="../images/wekress.png" width="150" ></span>
            <?php include 'sidebar.php' ?>
          </div>
    
          <div class="d-flex col-md-10 flex-column flex-shrin-0 p-3" id="content">
                <h2 class="text-center">Admin WeKress</h2>
            <hr>
            <div class="card mb-3 shadow-sm">
                <h2 class="ms-3 my-2"><i class="fa-solid fa-gauge"></i> Halaman Dashboard</h2>
            </div>

            <!-- Aksi PHP -->
            <?php
            include '../source/koneksi.php';
            // Query to count users
            $user = "SELECT COUNT(*) as total FROM user";
            $user_result = $koneksi->query($user);
            $total_user = $user_result->fetch_assoc()['total'];

            // Query to count products
            $produk = "SELECT COUNT(*) as total FROM produk";
            $product_result = $koneksi->query($produk);
            $total_produk = $product_result->fetch_assoc()['total'];

            // Query to count pesanan
            $pesanan = "SELECT COUNT(*) as total FROM pesanan";
            $pesanan_result = $koneksi->query($pesanan);
            $total_pesanan = $pesanan_result->fetch_assoc()['total'];

            // Query to count pembayaran
            $pembayaran = "SELECT COUNT(*) as total FROM pembayaran";
            $pembayaran_result = $koneksi->query($pembayaran);
            $total_pembayaran = $pembayaran_result->fetch_assoc()['total'];

            // Query to count feedback
            $feedback = "SELECT COUNT(*) as total FROM feedback";
            $feedback_result = $koneksi->query($feedback);
            $total_feedback = $feedback_result->fetch_assoc()['total'];
            ?>
            <!-- Aksi PHP -->

            <div class="row row-cols-1 row-cols-md-2 g-4">
              <div class="col">
                <div class="card shadow box-area">
                  <div class="card-header">User</div>
                    <div class="card-body">
                      <h5 class="card-title"><?php echo number_format($total_user); ?></h5>
                      <p class="card-text">Akun pengguna adalah identitas yang dibuat untuk seseorang di komputer atau sistem komputasi.</p>
                      <a href="user.php" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
              </div>
              <div class="col">
                <div class="card shadow box-area">
                  <div class="card-header">Produk</div>
                    <div class="card-body">
                      <h5 class="card-title"><?php echo number_format($total_produk); ?></h5>
                      <p class="card-text">Produk barang merupakan semua produk yang dapat ditambah, dibaca, diedit, dan dihapus</p>
                      <a href="produk.php" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
              </div>
              <div class="col">
                <div class="card shadow box-area">
                  <div class="card-header">Pesanan</div>
                    <div class="card-body">
                      <h5 class="card-title"><?php echo number_format($total_pesanan); ?></h5>
                      <p class="card-text">Langkah-langkah pemesanan yakni melakukan kontak secara langsung dengan penjual dan konsumen akan memesan barang yang ingin dibeli.</p>
                      <a href="pesanan.php" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
              </div>
              <div class="col">
                <div class="card shadow box-area">
                  <div class="card-header">Pembayaran</div>
                    <div class="card-body">
                      <h5 class="card-title"><?php echo number_format($total_pembayaran); ?></h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="pembayaran.php" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
              </div>
              <div class="col">
                <div class="card shadow box-area">
                  <div class="card-header">Umpan Balik</div>
                    <div class="card-body">
                      <h5 class="card-title"><?php echo number_format($total_feedback) ?></h5>
                      <p class="card-text">informasi yang kita terima sebagai bentuk respon terhadap pesan yang telah dikirimkan sebelumnya. </p>
                      <a href="feedback.php" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
              </div>
            </div>
          </div>
    </div>

    <div class="text-end me-5 py-3">
            <p>&copy; 2024 WeKresss | Powered by <i>@angga_erwe</i></p>
          </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>