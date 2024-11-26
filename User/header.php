  <!-- Style -->
   <style>
    .nav-link:hover{
      background-color: #ca8a04;
    }
    .nav-link.active {
    background-color: #f59e0b !important;
    color: black !important; /* Opsional: atur teks menjadi hitam untuk kontras */
}
    .nav li{
      margin-right: 10px;
    }

   </style>
  <!-- Style -->
  <!-- Header -->
  <div class="container-fluid bg-dark sticky-top">
        <div class="container">
            <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4">
              <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <img src="images/wekress.png" width="150">
              </a>
        
              <ul class="nav nav-pills nav-fill mx-auto d-flex g-3">
                <li><a href="index.php" class="nav-link px-2 text-white <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">Beranda</a></li>
                <li><a href="produk.php" class="nav-link px-2 text-white <?= basename($_SERVER['PHP_SELF']) == 'produk.php' ? 'active' : '' ?>">Produk</a></li>
                <li><a href="feedback.php" class="nav-link px-2 text-white <?= basename($_SERVER['PHP_SELF']) == 'feedback.php' ? 'active' : '' ?>">FeedBack</a></li>
                <li><a href="akun.php" class="nav-link px-2 text-white <?= basename($_SERVER['PHP_SELF']) == 'akun.php' ? 'active' : '' ?>">Profil</a></li>
              </ul>
        
              <div class="ms-auto">
              
                <a href="keranjang.php" type="button" class="btn btn-warning position-relative ms-3">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                      <span class="visually-hidden">unread messages</span>
                    </span>
                  </a>
                  <a href="#" class="btn btn-danger ms-2 delete-button" data-url="../source/proses_logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
              </div>
            </header>
          </div>
     </div>
    <!-- Akhir Header -->

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