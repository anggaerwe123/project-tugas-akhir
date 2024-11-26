<?php 
include 'session.php';
include '../source/proses_keranjang.php';
?>
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
     <link rel="stylesheet" href="asset/produk.css">

     <!-- Icon -->
    <link rel="icon" href="../images/logo.png">

    <!-- Tittle -->
    <title>WeKresss</title>
    </head>
    <body>

    <!-- Style Untuk Card Produk -->
    <style>
        .card img {
    width: 100%; /* Mengatur lebar gambar sesuai dengan lebar card */
    height: 400px; /* Atur tinggi gambar sesuai keinginan */
    object-fit: cover;
}
    </style>
    <!--Akhir Style Untuk Card Produk -->
    
  <!-- Header -->
   <?php include 'header.php'; ?>
  <!-- End Header -->
    
    <!-- Container -->
    <div class="container-fluid pt-5 pb-5 mb-5">
        <div class="container">
            <div class="text-center">
                <h3>Produk</h3>
                <p>Pada Halaman ini anda dapat melihat produk kami dan anda dapat melihat detail maupun memesan produk</p>
                <form action="" method="get" class="col-md-7 mx-auto mb-3 shadow-sm">
                    <div class="input-group">
                        <input type="search" name="keyword" class="form-control" placeholder="Cari Produk Disini" size="40">
                        <button class="btn btn-warning" type="submit" data-bs-toggle="tooltip" title="Search" ><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
                <hr>
          </div>

          <!-- Proses Perulangan Produk -->
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php
                include '../source/koneksi.php';

                // Mengatur jumlah produk per halaman untuk paginasi
                $limit = 8; 
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $start = ($page > 1) ? ($page * $limit) - $limit : 0;

                // Mengecek apakah ada keyword pencarian
                $keyword = isset($_GET['keyword']) ? mysqli_real_escape_string($koneksi, $_GET['keyword']) : '';

                // Jika ada pencarian, gunakan query dengan WHERE
                if (!empty($keyword)) {
                    $query = "SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR deskripsi LIKE '%$keyword%' LIMIT $start, $limit";
                    $count_query = "SELECT COUNT(*) as total FROM produk WHERE nama_produk LIKE '%$keyword%' OR deskripsi LIKE '%$keyword%'";
                } else {
                    // Jika tidak ada pencarian, tampilkan semua produk dengan paginasi
                    $query = "SELECT * FROM produk LIMIT $start, $limit";
                    $count_query = "SELECT COUNT(*) as total FROM produk";
                }

                $result = mysqli_query($koneksi, $query);
                $count_result = mysqli_query($koneksi, $count_query);
                $total_data = mysqli_fetch_assoc($count_result)['total'];
                $total_pages = ceil($total_data / $limit);  // Hitung total halaman

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '
                        <div class="col">
                            <div class="card mb-4">
                                <img src="../Database/' . $row["gambar"] . '" class="card-img-top border-bottom">
                                <div class="card-body bg-light">
                                    <h5 class="card-title">' . $row["nama_produk"] . '</h5>
                                    <p class="card-text">' . $row["deskripsi"] . '</p>
                                    <div class="d-flex">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal" 
                                            onclick="openModal(\'' . $row["gambar"] . '\', \'' . $row["nama_produk"] . '\', \'' . $row["harga"] . '\', \'' . $row["stok"] . '\', \'' . $row["deskripsi"] . '\')" title="Detail Produk">
                                            <i class="fa-solid fa-circle-info"></i>
                                        </button>
                                        <form method="POST" action="" class="ms-2">
                                            <input type="hidden" name="product_image" value="../Database/' . $row["gambar"] . '">
                                            <input type="hidden" name="product_id" value="' . $row["id_produk"] . '">
                                            <input type="hidden" name="product_name" value="' . $row["nama_produk"] . '">
                                            <input type="hidden" name="product_price" value="' . $row["harga"] . '">
                                            <button type="submit" name="keranjang" class="btn btn-warning" title="Keranjang Belanja">
                                                <i class="fa fa-shopping-cart"></i>
                                            </button>
                                        </form>
                                        <form method="POST" action="../source/beli_sekarang.php" class="ms-auto">
                                            <input type="hidden" name="product_image" value="../Database/' . $row["gambar"] . '">
                                            <input type="hidden" name="product_id" value="' . $row["id_produk"] . '">
                                            <input type="hidden" name="product_name" value="' . $row["nama_produk"] . '">
                                            <input type="hidden" name="product_price" value="' . $row["harga"] . '">
                                            <button type="submit" name="beli_sekarang" class="btn btn-success" title="Keranjang Belanja">
                                                Beli Sekarang
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ';
                    }
                } else {
                    echo '<h4 class="text-center py-5" ><b>Tidak ada produk</b></h4>';
                }
                ?>
            </div>
            <!-- Akhir Proses Perulangan Produk -->

            <!-- Modal -->
                <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalProductName">Detail Produk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img id="modalProductImage" src="" class="img-fluid" alt="Gambar Produk">
                                <h5 id="modalProductName"></h5>
                                <p>Harga: Rp <span id="modalProductPrice"></span></p>
                                <p>Stok: <span id="modalProductStock"></span></p>
                                <p id="modalProductDescription"></p> <!-- Deskripsi produk -->
                            </div>
                        </div>
                    </div>
                </div>
            <!-- Akhir Modal -->

            <!-- Script Untuk Menampilkan Modal -->
                <script>
                    function formatRupiah(angka) {
                        return 'Rp ' + parseInt(angka).toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                    }
                    function openModal(gambar, nama, harga, stok, deskripsi) {
                        document.getElementById('modalProductImage').src = '../Database/' + gambar;
                        document.getElementById('modalProductName').textContent = nama;
                        document.getElementById('modalProductPrice').textContent = harga;
                        document.getElementById('modalProductStock').textContent = stok;
                        document.getElementById('modalProductDescription').textContent = deskripsi; // Set deskripsi
                    }
                </script>
            <!-- Ahir Script Untuk Menampilkan Modal -->


            <!-- Paginaton -->
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
            <!-- Akhir Pagination -->

          </div>
        </div>
     </div>
     
    <!-- Akhir Container -->

    <!-- Footer -->
    <?php include 'footer.php'; ?>
    <!-- Akhir Footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
