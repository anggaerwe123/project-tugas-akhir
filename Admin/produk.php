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

<div class="d-flex flex-column flex-lg-row">
        <div class="col-lg-2 bg-dark text-white p-3" id="sidebar">
        <span class="fs-4"><img src="../images/wekress.png" width="150" ></span>
            <?php include 'sidebar.php' ?>
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
                <h2 class="ms-3 my-2"><i class="fa-solid fa-cookie-bite"></i> Halaman Produk</h2>
              </div>
              
              <div class="card shadow box-area">
              <div class="text-center mb-3 mt-3 d-flex">
                <h4 class="ms-3">Tabel Produk</h4>
                <h4 class="ms-auto"><i class="fa-solid fa-cookie-bite"></i></h4>
                <hr class="bg-dark me-3">
            </div>
  
            <div class="d-flex align-items-center ms-3 me-3 p-3 my-2 text-white rounded shadow-sm" style="background: #ffd167;">
                <div class="row g-3 me-auto">
                  <div class="col-auto">
                    <form action="" method="get" >
                    <div class="input-group">
                      <input type="search" name="keyword" class="form-control" placeholder="Cari Data Disini" size="40">
                      <button class="btn btn-success" type="submit" data-bs-toggle="tooltip" title="Search" ><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                    </form>
                  </div>
                </div>
                <div class="ms-auto">
                  <a href="tambahproduk.php"  type="button" class="btn btn-success" data-bs-toggle="tooltip" title="Tambah Data" ><i class="fa-solid fa-plus"></i> Tambah Produk</a>
                </div>
            </div> 
  
            <div class="mt-3 ms-3 me-3">
              <!-- Modal Konfirmasi Hapus -->
              <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Apakah Anda yakin ingin menghapus produk ini?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <a href="#" class="btn btn-danger" id="confirmDeleteButton">Hapus</a>
                    </div>
                  </div>
                </div>
              </div>
  
              <div class="table-responsive">
              <table class="table table-hover">
                    <thead class="">
                      <tr>
                        <th scope=>No</th>
                        <th scope=>Thumbnail</th>
                        <th scope=>Nama Produk</th>
                        <th scope=>Kategori</th>
                        <th scope=>Deskripsi</th>
                        <th scope=>Harga</th>
                        <th scope=>Stok</th>
                        <th scope=>Perintah</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    include '../source/koneksi.php';

                    // Mengatur jumlah produk per halaman untuk paginasi
                    $limit = 3;  // Tampilkan 3 produk per halaman
                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $start = ($page > 1) ? ($page * $limit) - $limit : 0;

                    // Mengecek apakah ada keyword pencarian
                    $keyword = isset($_GET['keyword']) ? mysqli_real_escape_string($koneksi, $_GET['keyword']) : '';

                    // Jika ada pencarian, gunakan query dengan WHERE
                    if (!empty($keyword)) {
                        $query = "SELECT produk.*, kategori.nama_kategori 
                                  FROM produk 
                                  JOIN kategori ON produk.id_kategori = kategori.id_kategori 
                                  WHERE produk.nama_produk LIKE '%$keyword%' OR produk.deskripsi LIKE '%$keyword%' 
                                  ORDER BY produk.id_produk DESC LIMIT $start, $limit";
                        $count_query = "SELECT COUNT(*) as total 
                                        FROM produk 
                                        JOIN kategori ON produk.id_kategori = kategori.id_kategori 
                                        WHERE produk.nama_produk LIKE '%$keyword%' OR produk.deskripsi LIKE '%$keyword%'";
                    } else {
                        // Jika tidak ada pencarian, tampilkan semua produk dengan paginasi
                        $query = "SELECT produk.*, kategori.nama_kategori 
                                  FROM produk 
                                  JOIN kategori ON produk.id_kategori = kategori.id_kategori 
                                  ORDER BY produk.id_produk DESC LIMIT $start, $limit";
                        $count_query = "SELECT COUNT(*) as total FROM produk";
                    }

                    $result = mysqli_query($koneksi, $query);
                    $count_result = mysqli_query($koneksi, $count_query);
                    $total_data = mysqli_fetch_assoc($count_result)['total'];
                    $total_pages = ceil($total_data / $limit);  // Hitung total halaman
                    ?>

                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        $no = $start + 1;  // Untuk penomoran berdasarkan halaman
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . $no++ . '</td>';
                            echo '<td><img src="../Database/' . $row['gambar'] . '" alt="' . $row['nama_produk'] . '" width="100"></td>';
                            echo '<td>' . $row['nama_produk'] . '</td>';
                            echo '<td>' . $row['nama_kategori'] . '</td>'; // Menggunakan nama_kategori
                            echo '<td>' . $row['deskripsi'] . '</td>';
                            echo '<td>Rp ' . number_format($row['harga'], 0, ',', '.') . '</td>';
                            echo '<td>' . $row['stok'] . '</td>';
                            echo '<td>
                                    <a href="editproduk.php?id_produk=' . $row['id_produk'] . '" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger delete-button" data-url="../source/proses_hapus.php?id_produk=' . $row['id_produk'] . '"><i class="fa fa-trash"></i></a>
                                  </td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="8" class="py-5 text-center">Tidak ada produk yang ditemukan.</td></tr>'; // Disesuaikan jumlah kolom
                    }
                    ?>
                    </tbody>
                  </table> 
              </div>
                  
                  <!-- Pagination -->
        <div class="d-flex">
        <p>Menampilkan Halaman <?php echo $page; ?> dari <?php echo $total_pages; ?> Halaman</p>
          <div class="ms-auto">
          <nav>
            <ul class="pagination">
                <!-- Tombol sebelumnya -->
                <?php if($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php endif; ?>

                <!-- Nomor halaman -->
                <?php for($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php if($i == $page) echo 'active'; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
                <?php endfor; ?>

                <!-- Tombol berikutnya -->
                <?php if($page < $total_pages): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </nav>
        <!-- End Pagination -->
          </div>
        </div>
      </div>
    </div>  
  </div>
  </div>
  
  
  <div class="text-end me-5 py-3">
            <p>&copy; 2024 WeKresss | Powered by <i>@angga_erwe</i></p>
          </div>

  <script>
        document.addEventListener("DOMContentLoaded", function() {

            // Confirm delete
            document.querySelectorAll(".delete-button").forEach(button => {
                button.addEventListener("click", function(event) {
                    event.preventDefault();
                    const deleteUrl = this.getAttribute("data-url");
                    document.getElementById("confirmDeleteButton").setAttribute("href", deleteUrl);
                    new bootstrap.Modal(document.getElementById("confirmDeleteModal")).show();
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>