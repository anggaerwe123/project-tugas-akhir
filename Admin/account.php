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

    <div class="d-flex">
        <div class="d-flex col-md-2 flex-column flex-shrink-0 p-3 text-white bg-dark" id="sidebar">
              <span class="fs-4"><img src="../images/wekress.png" width="150" ></span>
            <?php include 'sidebar.php' ?>
          </div>
          <!-- Aksi PHP -->
          <?php
    $user_id = $_SESSION['admin_id'];
    $fetch = null;
    
    $select = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$user_id'");
    if ($select && mysqli_num_rows($select) > 0) {
        $fetch = mysqli_fetch_assoc($select);
    } else {
        echo "Data user tidak ditemukan. Pastikan Anda sudah login dengan benar.";
        exit();
    }
      ?>
          <!-- Aksi PHP End -->


          <!-- Modal Konfirmasi Hapus -->
          <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Log Out</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Apakah Anda yakin akan log out
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <a href="#" class="btn btn-danger" id="confirmDeleteButton">Hapus</a>
                </div>
              </div>
            </div>
          </div>
    
          <div class="d-flex col-md-10 flex-column flex-shrin-0 p-3" id="content">
                <h2 class="text-center">Admin WeKress</h2>
            <hr>
            <div class="card mb-3 shadow-sm">
                <h2 class="ms-3 my-2"><i class="fa-solid fa-house"></i> Halaman Akun</h2>
            </div>

            <div class="card shadow box-area">
            <div class="card my-3 ms-3" style="max-width: 540px;">
              <div class="row g-0">
                <div class="col-md-4">
                <img src="../Database/user/<?php echo $fetch['gambar'] ?? 'default_profile.png'; ?>" class="card-img-top rounded-circle" alt="User Image">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                  <?php if ($fetch): ?>
                <h5><?php echo $fetch['nama']; ?></h5>
                <p><?php echo $fetch['email']; ?></p>
                <p><?php echo $fetch['alamat']; ?></p>
                <a href="account_edit.php" class="btn btn-warning" title="Edit Profil">Edit Profil</a>
                <a href="#" class="btn btn-danger delete-button" data-url="../source/proses_logout.php" title="Log Out">Log Out</a>
            <?php else: ?>
                <p>Data user tidak ditemukan. Pastikan Anda sudah login dengan benar.</p>
            <?php endif; ?>
                  </div>
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