<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Sidebar</title>
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
            <div class="card mb-3">
                <h2 class="ms-3 my-2"><i class="fa-solid fa-cookie-bite"></i> Halaman Produk</h2>
            </div>

            <div class="card shadow box-area">
              <div class="text-center mb-3 mt-3 d-flex">
                <h4 class="ms-3">Tabel Produk</h4>
                <h4 class="ms-auto"><i class="fa-solid fa-cookie-bite"></i></h4>
                <hr class="bg-dark me-3">
            </div>
  
            <div class="d-flex align-items-center ms-3 me-3 p-3 my-2 text-white rounded shadow-sm" style="background: #ffd167;">
                
                <div class="ms-auto">
                  <a href="produk.php"  type="button" class="btn btn-success" data-bs-toggle="tooltip" title="Kembali" > Kembali</a>
                </div>
            </div> 
  
            <div class="mt-3 mb-3 ms-3 me-3">
<?php
// Ambil data produk berdasarkan id_produk
include '../source/koneksi.php';

$id_produk = $_GET['id_produk'];
$query = "SELECT * FROM produk WHERE id_produk = '$id_produk'";
$result = mysqli_query($koneksi, $query);
$produk = mysqli_fetch_assoc($result);
?>
  
            <form action="../source/proses_edit.php" method="post" enctype="multipart/form-data">
                          <div class="row mb-3">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Thumbnail</label>
                              <div class="col-sm-10">
                                <div class="d-flex">
                                <input type="hidden" name="id_produk" value="<?= $produk['id_produk'] ?>" required>
                                <img src="../Database/<?= $produk['gambar']; ?>" width="150px" class="img-thumbnail">
                                <input type="file" class="form-control ms-2 py-5 my-5" name="gambar" value="<?= $produk['gambar']; ?>">
                                </div>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_produk" id="nama_produk" value="<?= $produk['nama_produk']; ?>" required>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="inputPassword3" class="col-sm-2 col-form-label">Deskripsi</label>
                              <div class="col-sm-10">
                                <input class="form-control" name="deskripsi" id="deskripsi" value="<?= $produk['deskripsi']; ?>" rows="3"></input>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="inputPassword3" class="col-sm-2 col-form-label">Harga</label>
                              <div class="col-sm-10">
                                <div class="input-group">
                                  <input type="number" class="form-control" name="harga" id="harga" value="<?= $produk['harga']; ?>" required>
                                  <span class="input-group-text">$</span>
                                  <span class="input-group-text">0.00</span>
                                </div>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="inputPassword3" class="col-sm-2 col-form-label">Stok</label>
                              <div class="col-sm-10">
                                <input type="number" class="form-control" name="stok" id="stok" value="<?= $produk['stok']; ?>" required>
                              </div>
                            </div>
                            
                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-danger">Batal</button>
                          </form>
  
            </div>
            </div>  

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>