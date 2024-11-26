<?php
include '../source/koneksi.php';

// Ambil ID produk dari URL
$id_produk = $_GET['id_produk'];

// Query untuk mengambil data produk berdasarkan ID
$query = "SELECT * FROM produk WHERE id_produk = '$id_produk'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "Produk tidak ditemukan!";
    exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Icon -->
    <link rel="icon" href="../images/logo.png">

    <!-- Font Aswesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS Style -->
     <link rel="stylesheet" href="asset/detail.css">

    <title>WeKress</title>
  </head>
  <body>
    
  <!-- Header -->
<div class="container-fluid bg-dark sticky-top">
        <div class="container">
            <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4">
              <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <img src="images/wekress.png" width="150">
              </a>
        
              <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="index.php" class="nav-link px-2 text-white">Beranda</a></li>
                <li><a href="produk.php" class="nav-link px-2 text-white">Produk</a></li>
                <li><a href="feedback.php" class="nav-link px-2 text-white">FeedBack</a></li>
                <li><a href="../source/proses_logout.php" class="nav-link px-2 text-white">Akun</a></li>
              </ul>
        
              <div class="col-md-3 text-end d-flex">
              <form action="" method="get" >
                    <div class="input-group">
                      <input type="search" name="keyword" class="form-control" placeholder="Cari Data Disini" size="40">
                      <button class="btn btn-warning" type="submit" data-bs-toggle="tooltip" title="Search" ><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                    </form>
                <a href="keranjang.php" type="button" class="btn btn-warning position-relative ms-3">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?= include '../source/proses_keranjang.php'; $total_items; ?>
                      <span class="visually-hidden">unread messages</span>
                    </span>
                  </a>
              </div>
            </header>
          </div>
     </div>
    <!-- Akhir Header -->

      <!-- Bread -->
       <div class="container-fluid pt-5 bg-secondary">
        <div class="container pt-5">
            <nav class="white" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a class="text-decoration-none text-primary text-white" href="produk.php">Produk</a></li>
                  <li class="breadcrumb-item text-white" aria-current="page"><?= $row['nama_produk'] ?></li>
                </ol>
              </nav>
        </div>
       </div>
       <!-- Akhir Bread -->

    <!-- Produk -->
     <div class="container-fluid pt-5">
        <div class="container mt-5 pt-5 mb-5">
            <div class="card shadow">
                <div class="row">
                
                    <!-- Produk Image -->
                    <div class="col-md-5 col-lg-4">
                    <img src="../Database/<?= $row['gambar'] ?>" class="img-fluid">
                    </div>
                    <!-- Produk Detail -->
                     <div class="col-md-6 offset-md-1 mt-5 mb-2 mx-auto">
                        <h1><?= $row['nama_produk'] ?></h1>
                        <p><?= $row['deskripsi'] ?></p>
                        <p class="mb-3">Rp <?= $row['harga'] ?></p>
                        <p class="mb-3">Stok <?= $row['stok'] ?></p>
                        <button type="button" class="btn btn-success" data-bs-toggle="tooltip" title="Beli" >Beli Sekarang</button>
                        <a href="../source/proses_keranjang.php?id_produk=<?= $row['id_produk'] ?>" class="btn btn-warning ms-2"  data-bs-toggle="tooltip"  title="Keranjang Belanja"><i class="fa-solid fa-cart-shopping"></i></a>
                     </div>
                     <!-- Akhir Produk Detail -->
                </div>
            </div>
        </div>
     </div>
     <!-- Akhir Produk -->



     <!-- Produk Lainya -->
      <div class="container pt-5 pb-5">

      <!-- Produk Random -->
       <?php 
       include '../source/koneksi.php';

       $current_product_id = $_GET['id_produk']; // id_produk produk yang sedang ditampilkan
      $query = "SELECT * FROM produk WHERE id_produk != $current_product_id ORDER BY RAND() LIMIT 4";
      $result = mysqli_query($koneksi, $query);

      if (mysqli_num_rows($result) > 0){
        echo '<div class="row row-cols-1 row-cols-md-4 g-4">';
        
        while ($row = mysqli_fetch_assoc($result)){
          echo '<div class="col">';
          echo '<div class="card produk shadow">';
          echo '<img src="../Database/'.$row['gambar'].'" class="card-img-top">';
          echo '<div class="card-body">';
          echo '<h5 class="card-title">' . $row['nama_produk'] . '</h5>';
          echo '<p class="card-text">' . $row['deskripsi'] . '</p>';
          echo '<a href="detail.php?id_produk=' . $row["id_produk"] . '" class="btn btn-primary rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Produk"><i class="fa-solid fa-circle-info"></i></a>';
          echo '<a href="../source/proses_keranjang.php?id_produk=' . $row['id_produk'] . '" class="btn btn-warning ms-2"  data-bs-toggle="tooltip"  title="Keranjang Belanja"><i class="fa-solid fa-cart-shopping"></i></a>';  
          echo '<a href="cart.php?add=' . $row["id_produk"] . '" class="btn btn-success ms-5" data-bs-toggle="tooltip" title="Check Out">Beli Sekarang</a>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
        }

        echo '</div>';
        // Produk Random End

      }else {
        echo "Tidak Ada Produk Lainya";
      }
       ?>
       </div>
       <!-- Akhir Produk Lainya -->



      <!-- Footer -->
      <footer class="bg-dark text-light pt-4">
        <div class="container">
            <div class="row">
              <div class="col">
                <h5>Follow Kami</h5>
                <div class="d-flex">
                    <h4><a href="https://www.facebook.com/profile.php?id=61564783572665&locale=id_ID" class="text-light mx-2"><i class="fab fa-facebook-f"></i></a></h4>
                    <h4><a href="https://x.com/erwe_njyy" class="text-light mx-2"><i class="fab fa-twitter"></i></a></h4>
                    <h4> <a href="https://www.instagram.com/angga_erwe/" class="text-light mx-2"><i class="fab fa-instagram"></i></a></h4>
                    <h4><a href="https://www.linkedin.com/in/angga-rizki-626126313/" class="text-light mx-2"><i class="fab fa-linkedin-in"></i></a></h4>
                </div>
              </div>
              <div class="col">
                <h5>Maps</h5>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" 
                      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3163.3588997692396!2d-122.08385168469062!3d37.386051879830045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb0fa78b71043%3A0xada244aeae4df0b2!2sGoogleplex!5e0!3m2!1sen!2sus!4v1632601673210!5m2!1sen!2sus" 
                      allowfullscreen loading="lazy"></iframe>
                  </div>
              </div>
              <div class="col">
                <h5>Lain lain</h5>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
              </div>
            </div>
          </div>

          <div class="text-center py-3">
            <p>&copy; 2024 Your Company Name. All rights reserved.</p>
          </div>
        </div>
      </footer>
      <!-- Akhir Footer -->

      <script src="../source/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>