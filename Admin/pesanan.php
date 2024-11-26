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
          <h2 class="ms-3 my-2"><i class="fa-solid fa-clock"></i> Halaman Pesanan</h2>
        </div>
        
        <div class="card shadow box-area">
        <div class="text-center mb-3 mt-3 d-flex">
          <h4 class="ms-3">Tabel Pesanan</h4>
          <h4 class="ms-auto"><i class="fa-solid fa-clock"></i></h4>
          <hr class="bg-dark me-3">
        </div>

          <div class="d-flex align-items-center ms-3 me-3 p-3 my-2 text-white rounded shadow-sm" style="background: #ffd167;">
            <div class="row g-3 me-auto">
              <div class="col-auto">
                <form action="" method="get">
                  <div class="input-group">
                    <input type="search" name="search" class="form-control" placeholder="Cari Data Berdasarkan Nama Pembeli" size="40">
                    <button class="btn btn-success" type="submit" data-bs-toggle="tooltip" title="Search"><i class="fa-solid fa-magnifying-glass"></i></button>
                  </div>
                </form>
              </div>
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
            <!-- Modal Konfirmasi Penghapusan -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Penghapusan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus data ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteButton">Hapus</button>
      </div>
    </div>
  </div>
</div>


            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                       <th>No</th>
                       <th>Tanggal Pesanan</th>
                       <th>Total Pesanan</th>
                       <th>Total Harga</th>
                       <th>Status</th>
                       <th>Pembeli</th>
                       <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
include '../source/koneksi.php';

// Variabel untuk pagination
$limit = 6;
$no = 1;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Ambil data dari input search
$search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';

// Hitung total data dengan filter search
$total_data_query = mysqli_query($koneksi, 
    "SELECT COUNT(*) AS total 
     FROM pesanan 
     JOIN user ON pesanan.id_user = user.id_user
     WHERE user.nama LIKE '%$search%'"
);
$total_data = mysqli_fetch_assoc($total_data_query)['total'];
$total_pages = ceil($total_data / $limit);

// Query untuk menampilkan data sesuai pencarian dan pagination
$query = mysqli_query($koneksi, 
    "SELECT pesanan.*, user.nama, user.alamat, user.email 
     FROM pesanan 
     JOIN user ON pesanan.id_user = user.id_user 
     WHERE user.nama LIKE '%$search%'  
     ORDER BY pesanan.id_pesanan ASC 
     LIMIT $start, $limit"
);
?>
<?php while ($data = mysqli_fetch_array($query)): ?>
    <tr>
      <td><?php echo $no++ ?></td>
      <td><?php echo $data['tanggal_pesanan'] ?></td>
      <td><?php echo $data['total_pesanan'] ?></td>
      <td><?php echo number_format($data['total_harga'], 2, '.', '.') ?></td>
      <td><?php echo $data['status'] ?></td>
      <td><?php echo htmlspecialchars($data['nama']) ?></td>
      <td>
      <a href="../source/proses_update_status.php?id_pesanan=<?php echo $data['id_pesanan'] ?>"  class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
      <a href="detail_pesanan.php?id_pesanan=<?php echo $data['id_pesanan'] ?>" class="btn btn-primary ms-2"><i class="fa-solid fa-circle-info"></i></a>
      <button class="btn btn-danger ms-2" data-id="<?php echo $data['id_pesanan'] ?>" onclick="openDeleteModal(this)"><i class="fa-solid fa-trash"></i></button>
      </td>
    </tr>
<?php endwhile; ?>


                </tbody>
              </table>

                    <!-- Pagination -->
        <hr>
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

      <div class="text-end me-5 py-3">
            <p>&copy; 2024 WeKresss | Powered by <i>@angga_erwe</i></p>
          </div>

    <!-- Scripts -->
    <script>
  let deleteId = null;

  // Fungsi untuk membuka modal dan menyimpan ID pesanan yang ingin dihapus
  function openDeleteModal(button) {
    deleteId = button.getAttribute("data-id");
    var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
  }

  // Event listener untuk tombol konfirmasi hapus di modal
  document.getElementById("confirmDeleteButton").addEventListener("click", function() {
    if (deleteId) {
      window.location.href = "../source/proses_hapus_pesanan.php?id_pesanan=" + deleteId;
    }
  });

</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>