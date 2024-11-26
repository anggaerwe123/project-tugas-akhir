<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="../images/logo.png">
    <title>Admin WeKresss</title>
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
                <h4 class="ms-3">Form Tambah Produk</h4>
                <h4 class="ms-auto"><i class="fa-solid fa-cookie-bite"></i></h4>
                <hr class="bg-dark me-3">
            </div>
  
            <div class="d-flex align-items-center ms-3 me-3 p-3 my-2 text-white rounded shadow-sm" style="background: #ffd167;">
                <div class="ms-auto">
                  <a href="produk.php"  type="button" class="btn btn-success" data-bs-toggle="tooltip" title="Kembali" > Kembali</a>
                </div>
            </div> 
  
            <div class="mt-3 mb-3 ms-3 me-3">
  
            <form method="post" action="../source/proses_tambah.php" enctype="multipart/form-data">
    <div class="row mb-3">
        <label for="gambar" class="col-sm-2 col-form-label">Thumbnail</label>
        <div class="col-sm-10">
            <input type="file" class="form-control mb-3" name="gambar" id="gambar" required onchange="previewImage()">
            <img id="preview" src="../Database/default_produk.png" style="width: 150px; height: 150px;" alt="Preview Image">
        </div>
    </div>
    <div class="row mb-3">
        <label for="nama_produk" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="nama_produk" id="nama_produk" required>
        </div>
    </div>
    <div class="row mb-3">
        <label for="id_kategori" class="col-sm-2 col-form-label">Kategori</label>
        <div class="col-sm-10">
        <select class="form-select" name="id_kategori" id="id_kategori" aria-label="Default select example">
        <option value="">Pilih Kategori</option>
        <?php
        include '../source/koneksi.php';
                  $query_kategori = "SELECT * FROM kategori";
                  $result_kategori = mysqli_query($koneksi, $query_kategori);
                  while ($row = mysqli_fetch_assoc($result_kategori)) {
                      echo "<option value='" . $row['id_kategori'] . "'>" . $row['nama_kategori'] . "</option>";
                  }
                  ?>
        </select>
        </div>
    </div>
    <div class="row mb-3">
        <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" required></textarea>
        </div>
    </div>
    <div class="row mb-3">
        <label for="harga" class="col-sm-2 col-form-label">Harga</label>
        <div class="col-sm-10">
            <div class="input-group">
                <input type="number" class="form-control" name="harga" id="harga" required>
                <span class="input-group-text">$</span>
                <span class="input-group-text">0.00</span>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <label for="stok" class="col-sm-2 col-form-label">Stok</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" name="stok" id="stok" required>
        </div>
    </div>

    <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip" title="Simpan">Simpan</button>
    <button type="reset" class="btn btn-danger" data-bs-toggle="tooltip" title="Batal"><i class="fa-solid fa-ban"></i></button>
</form>

<script>
    function previewImage() {
        const input = document.getElementById('gambar');
        const preview = document.getElementById('preview');

        // Cek apakah ada file yang diunggah
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result; // Ganti sumber gambar dengan file yang diunggah
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

  
            </div>
            </div>  

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>