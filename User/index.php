<?php include 'session.php'; ?>
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

    <!-- Style -->
     <link rel="stylesheet" href="style.css">

     <!-- Icon -->
    <link rel="icon" href="../images/logo.png">

    <title>WeKresss</title>
  </head>
  <body>

  <?php 
  $id_user = $_SESSION['user_id'];

  $tampil = "SELECT * FROM user WHERE id_user = '$id_user'";
  $result = mysqli_query($koneksi, $tampil);

// Periksa apakah query berhasil
if ($result) {
    // Ambil data user
    $user_data = mysqli_fetch_assoc($result);


mysqli_close($koneksi);
?>
  
    <!-- Container -->
    <?php include 'header.php'; ?>

     <div class="container-fluid pt-5 pb-5 mb-5">
        <div class="container">
            <div class="card shadow box-area">
                <div class="card-header d-flex">
                  <img src="images/logo.png" width="50" alt="" srcset="">
                  <div class="ms-auto my-2">
                    Beranda
                  </div>
                </div>
                <div class="card-body text-center mt-5 mb-5">
                  <h5 class="card-title">Selamat Datang <?php echo $user_data['nama'] ?> di WeKress</h5>
                  <p class="card-text">Tempatnya Beli Snack Mudah Murah Enak Apalagi</p>
                  <a href="produk.php" class="btn btn-warning" title="Belanja Sekarang">Pergi Untuk Belanja!!</a>
                </div>
                <div class="row row-cols-1 row-cols-md-3 g-4 pb-5 ms-3 me-3">
                  <a href="produk.php" class="text-dark text-decoration-none" title="Produk">
                  <div class="col">
                    <div class="card text-center shadow-sm">
                    <i class="fa-solid fa-cookie fa-6x mt-3"></i>
                      <div class="card-body">
                        <h5 class="card-title">Produk</h5>
                      </div>
                    </div>
                  </div>
                  </a>
                  <a href="feedback.php" class="text-dark text-decoration-none" title="Feedback">
                  <div class="col">
                    <div class="card text-center shadow-sm">
                    <i class="fa-solid fa-comment fa-6x mt-3"></i>
                      <div class="card-body">
                        <h5 class="card-title">Kirim Umpan Balik</h5>
                      </div>
                    </div>
                  </div>
                  </a>
                  <a href="akun.php" class="text-dark text-decoration-none" title="Profil">
                  <div class="col">
                    <div class="card text-center shadow-sm">
                    <i class="fa-solid fa-user fa-6x mt-3"></i>
                      <div class="card-body">
                        <h5 class="card-title">Profil</h5>
                      </div>
                    </div>
                  </div>
                  </a>
                </div>
                <div class="card-footer text-muted">
                  <?php echo $user_data['email'] ?>
                </div>
              </div>
        </div>
     </div>
    <!-- Akhir Container -->

    <br>

    <?php } ?>
    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>