<?php include 'session.php'; ?>
<?php
include '../source/koneksi.php';

// Cek apakah ada parameter pencarian
$search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';

// Query SQL untuk menampilkan kategori (dengan atau tanpa filter search)
$sql = "SELECT * FROM kategori";
if (!empty($search)) {
    $sql .= " WHERE nama_kategori LIKE '%$search%'";
}
$result = mysqli_query($koneksi, $sql);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
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
          <h2 class="ms-3 my-2"><i class="fa-solid fa-list"></i> Halaman Kategori</h2>
        </div>
        
        <div class="card shadow box-area">
        <div class="text-center mb-3 mt-3 d-flex">
          <h4 class="ms-3">Tabel Kategori</h4>
          <h4 class="ms-auto"><i class="fa-solid fa-list"></i></h4>
          <hr class="bg-dark me-3">
        </div>

          <div class="d-flex align-items-center ms-3 me-3 p-3 my-2 text-white rounded shadow-sm" style="background: #ffd167;">
            <div class="row g-3 me-auto">
              <div class="col-auto">
                <form action="" method="get">
                  <div class="input-group">
                    <input type="search" name="search" class="form-control" placeholder="Cari Data Kategori" size="40" value="<?php echo htmlspecialchars($search); ?>">
                    <button class="btn btn-success" type="submit" data-bs-toggle="tooltip" title="Search"><i class="fa-solid fa-magnifying-glass"></i></button>
                  </div>
                </form>
              </div>
            </div>
            <div class="ms-auto">
              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah Kategori
              </button>

              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content text-dark">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Form Tambah Kategori</h5>
                      <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form action="../source/proses_tambah_kategori.php" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" name="kategori" class="form-control" id="floatingInput" placeholder="Masukkan Kategori" required>
                        <label for="floatingInput">Masukan Kategori</label>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                  </form>
                </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

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

          <div class="mt-3 ms-3 me-3">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                       <th>No</th>
                       <th>Kategori</th>
                       <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row['nama_kategori'] ?></td>
                    <td>
                      <!-- Tombol Edit dan Hapus -->
                      <a href="#" class="btn btn-danger delete-button" data-url="../source/proses_hapus_kategori.php?id_kategori=<?php echo $row['id_kategori'] ?>"><i class="fa fa-trash"></i></a>
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#Modal<?php echo $row['id_kategori'] ?>"><i class="fa-solid fa-pen"></i></button>

<!-- Modal -->
<div class="modal fade" id="Modal<?php echo $row['id_kategori'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../source/proses_edit_kategori.php" method="post">
                    <!-- Input hidden untuk id_kategori -->
                    <input type="hidden" name="id_kategori" value="<?php echo $row['id_kategori']; ?>">
                    
                    <!-- Input untuk nama kategori -->
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="kategori" name="nama_kategori" value="<?php echo $row['nama_kategori']; ?>">
                    </div>
                    
                    <button type="submit" class="btn btn-primary" name="edit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Scripts -->
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
