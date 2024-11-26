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
      body {
        background: #f0f0f0;
      }
    </style>
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
          unset($_SESSION['message']);
        }
      ?>
      <h2 class="text-center">Admin WeKress</h2>
      <hr>
      <div class="card mb-3">
        <h2 class="ms-3 my-2"><i class="fa-solid fa-users"></i> Halaman Pengguna</h2>
      </div>

      <div class="card shadow box-area">
        <div class="text-center mb-3 mt-3 d-flex">
          <h4 class="ms-3">Tabel Pengguna</h4>
          <h4 class="ms-auto"><i class="fa-solid fa-users"></i></h4>
          <hr class="bg-dark me-3">
        </div>

        <div class="d-flex align-items-center ms-3 me-3 p-3 my-2 text-white rounded shadow-sm" style="background: #ffd167;">
          <div class="row g-3 me-auto">
            <div class="col-auto">
              <form action="" method="get">
                <div class="input-group">
                  <input type="search" name="search" class="form-control" placeholder="Cari Data Disini" size="40">
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
                    <p>1. Pastikan ada kontrol akses yang ketat untuk mencegah akses tidak sah.</p>
                    <p>2. Lakukan backup data secara rutin.</p>
                    <p>3. Patuhi regulasi privasi seperti GDPR atau UU Perlindungan Data Pribadi.</p>
                    <p>4. Pastikan data yang disimpan akurat dan terkini.</p>
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
          <!-- Modal Konfirmasi Hapus -->
          <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Apakah Anda yakin ingin menghapus user ini?
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
            <thead class="b">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Profil</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Alamat</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                include '../source/koneksi.php';
                $limit = 5;
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $start = ($page > 1) ? ($page * $limit) - $limit : 0;
                $search = "";
                if (isset($_GET['search']) && !empty($_GET['search'])) {
                  $search = mysqli_real_escape_string($koneksi, $_GET['search']);
                  $tampil = "SELECT * FROM user WHERE nama LIKE '%$search%' OR email LIKE '%$search%' ORDER BY id_user DESC LIMIT $start, $limit";
                  $count_query = "SELECT COUNT(*) AS total FROM user WHERE nama LIKE '%$search%' OR email LIKE '%$search%'";
                } else {
                  $tampil = "SELECT * FROM user ORDER BY id_user DESC LIMIT $start, $limit";
                  $count_query = "SELECT COUNT(*) AS total FROM user";
                }

                $query = mysqli_query($koneksi, $tampil);
                $total_result = mysqli_query($koneksi, $count_query);
                $total = mysqli_fetch_assoc($total_result)['total'];
                $pages = ceil($total / $limit);
                $no = $start + 1;

                while ($data = mysqli_fetch_array($query)) {
                  $id_user = $data['id_user'];
                  $gambar = $data['gambar'];
                  $alamat = $data['alamat'];
                  $nama = $data['nama'];
                  $email = $data['email'];
                  $password = $data['password'];
              ?>
                <tr>
                  <td><?php echo $no++ ?></td>
                  <td><img src="../Database/user/<?php echo $gambar ?? 'default_profile.png'; ?>" width="80" class="rounded-circle"></td>
                  <td><?php echo $nama ?></td>
                  <td><?php echo $email ?></td>
                  <td><?php echo $alamat ?></td>
                  <td>
                    <a href="#" class="btn btn-danger delete-button" data-url="../source/hapus_user.php?id_user=<?php echo $id_user ?>"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
              <?php } ?>
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

  <script>
    document.addEventListener("DOMContentLoaded", function() {
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