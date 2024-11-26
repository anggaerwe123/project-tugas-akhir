<?php include 'session.php' ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

     <!-- Icon -->
     <link rel="icon" href="../images/logo.png">

     <!-- Title -->
    <title>Admin WeKress</title>
  </head>
  <style>

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
                <h2 class="ms-3 my-2"><i class="fa-solid fa-house"></i> Halaman Home</h2>
            </div>

            <div class="card shadow box-area">
          <div class="card bg-dark text-white text-center">
              <img src="piww.jpg" class="card-img" alt="...">
              <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center">
                  <h5 class="card-title">Selamat Datang Admin</h5>
                  <p class="card-text">Pada Website Ini Admin Dapat Mengelola Semua Proses Website Mulai Dari Mengelola User, Produk, Pesanan, Pembayaran Maupun FeedBack</p>
                  <a href="dashboard.php" class="btn btn-warning">Kelola Sekarang!!</a>
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