<?php
include 'session.php';

include '../source/koneksi.php';

// Handle search
$search = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$no = 1;
// Pagination setup
$perPage = 10; // Number of records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $perPage;

// Fetch data from database
$sql = "SELECT * FROM pembayaran WHERE id_pesanan LIKE '%$search%' LIMIT $offset, $perPage";
$result = $koneksi->query($sql);

// Total pages calculation
$totalSql = "SELECT COUNT(*) FROM pembayaran WHERE metode_pembayaran LIKE '%$search%'";
$totalResult = $koneksi->query($totalSql);
$totalRows = $totalResult->fetch_row()[0];
$pages = ceil($totalRows / $perPage);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="../images/logo.png">
    <title>Admin WeKress</title>
  </head>
  <style>
    body{
      background: #f0f0f0;
    }
  </style>
  <body>
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

          <?php
          if (isset($_SESSION['message'])) {
              echo $_SESSION['message'];
              unset($_SESSION['message']);
          }
          ?>
    
          <div class="col-lg-10 p-3" id="content">
                <h2 class="text-center">Admin WeKress</h2>
                <hr>
            <div class="card mb-3">
                <h2 class="ms-3 my-2"><i class="fa-solid fa-money-bill"></i> Halaman Pembayaran</h2>
            </div>

            <div class="card shadow box-area">
              <div class="text-center mb-3 mt-3 d-flex">
                <h4 class="ms-3">Tabel Pembayaran</h4>
                <h4 class="ms-auto"><i class="fa-solid fa-cookie-bite"></i></h4>
                <hr class="bg-dark me-3">
            </div>
  
            <div class="d-flex align-items-center ms-3 me-3 p-3 my-2 text-white rounded shadow-sm" style="background: #ffd167;">
                <div class="row g-3 me-auto">
                  <div class="col-auto">
                    <form action="" method="get" >
                    <div class="input-group">
                      <input type="search" name="keyword" class="form-control" placeholder="Cari Berdasarkan ID Pesanan" size="40">
                      <button class="btn btn-success" type="submit" data-bs-toggle="tooltip" title="Search"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                    </form>
                  </div>
                </div>
                <div class="ms-auto">
                  <button type="button" class="btn btn-info rounded-circle" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <i class="fa-solid fa-circle-exclamation"></i>
                  </button>

                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content text-dark">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Harap Diperhatikan!</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <p>Beberapa Peraturan yang harus diperhatikan Admin Yaitu:</p>
                          <p>1. Admin harus memverifikasi setiap transaksi pembayaran yang masuk, memastikan bahwa dana benar-benar diterima sebelum memproses pesanan.</p>
                          <p>2. Pastikan bahwa metode pembayaran yang diterima (transfer bank, kartu kredit, e-wallet) telah diverifikasi dan terintegrasi dengan baik dalam sistem.</p>
                          <p>3. Informasi pribadi dan finansial pelanggan harus dilindungi. Gunakan enkripsi untuk data sensitif seperti informasi kartu kredit.</p>
                          <p>4. Jika ada masalah dengan pembayaran (misalnya, gagal atau pending), segera berkomunikasi dengan pelanggan.</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-success" data-bs-dismiss="modal">Siap!!</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div> 
  
            <div class="mt-3 mb-3 ms-3 me-3">
  
            <div class="table-responsive">
            <table class="table table-hover">
                    <thead class="">
                      <tr>
                        <th scope=>No</th>
                        <th scope=>ID Pesanan</th>
                        <th scope=>Metode Pembayaran</th>
                        <th scope=>Status Pembayaran</th>
                        <th scope=>Perintah</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                          <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['id_pesanan']; ?></td>
                            <td><?php echo $row['metode_pembayaran']; ?></td>
                            <td><?php echo $row['status_pembayaran']; ?></td>                      
                            <td>
                              <a href="../source/proses_update_status_pembayaran.php?id_pembayaran=<?php echo $row['id_pembayaran']; ?>" class="btn btn-success"><i class="fa-solid fa-check"></i></a>   
                              <a href="struk_pembeian.php?id_pesanan=<?php echo $row['id_pesanan']; ?>" class="btn btn-primary"><i class="fa-solid fa-bag-shopping"></i></a>
                            </td>
                          </tr>
                        <?php endwhile; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="5" class="text-center">Data tidak ditemukan</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table> 
            </div>
                  
            <div class="d-flex">
            <p>Menampilkan halaman <?php echo $page; ?> dari <?php echo $pages; ?> Halaman</p>
            <div class="ms-auto">
              <nav>
                <ul class="pagination">
                  <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>&search=<?php echo $search; ?>" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>

                  <?php for ($i = 1; $i <= $pages; $i++) { ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                      <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>"><?php echo $i; ?></a>
                    </li>
                  <?php } ?>

                  <li class="page-item <?php if ($page >= $pages) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo $search; ?>" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
              </nav>
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

<?php $koneksi->close(); ?>