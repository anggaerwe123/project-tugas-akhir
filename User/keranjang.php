<?php 
// Import Session
include 'session.php';
// IMport Proses Keranjang
include '../source/proses_keranjang.php';
// Import Koneksi
include '../source/koneksi.php';

// Fungsi format Rupiah
function formatRupiah($angka) {
    return "Rp " . number_format($angka, 2, ',', '.');
}

// Hapus produk dari keranjang
if (isset($_POST['remove'])) {
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
}

// Hitung Total Produk
$total_price = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total_price += floatval($item['price']) * intval($item['quantity']);
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="style.css">

    <!-- Website Icon -->
    <link rel="icon" href="../images/logo.png">

    <!-- Tittle -->
    <title>WeKresss</title>
</head>

<body>
    
<div class="container-fluid bg-dark sticky-top">
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4">
            <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <img src="images/wekress.png" width="150">
            </a>
            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="index.php" class="nav-link px-2 text-white">Beranda</a></li>
                <li><a href="produk.php" class="nav-link px-2 text-white">Produk</a></li>
                <li><a href="feedback.php" class="nav-link px-2 text-white">Feedback</a></li>
                <li><a href="akun.php" class="nav-link px-2 text-white">Akun</a></li>
            </ul>
            <div class="col-md-3 text-end d-flex">
                <form action="" method="get" class="disabled">
                    <div class="input-group">
                        <input type="search" name="keyword" class="form-control disabled" placeholder="Cari Data Disini" size="40">
                        <button class="btn btn-warning" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
                <a href="../source/proses_keranjang.php" type="button" class="btn btn-warning position-relative ms-3 disabled">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?= $total_items; ?>
                    </span>
                </a>
            </div>
        </header>
    </div>
</div>

<div class="container pt-5 pb-5">
    <div class="text-center">
        <h3>Keranjang Belanja</h3>
        <p>Pada Halaman Ini User Dapat Menghapus produk yang telah di tambah ke keranjang, user juga dapat checkout.</p>
    </div>
    <div class="card shadow box-area">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Thumbnail</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Kuantitas</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($_SESSION['cart'])): ?>
                            <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                                <tr>
                                    <td><img src="../Database/<?= $item['image']; ?>" class="img-thumbnail img-fluid" width="100"></td>
                                    <td><?= $item['name']; ?></td>
                                    <td><?= formatRupiah(floatval($item['price'])); ?></td>
                                    <td><?= $item['quantity']; ?></td>
                                    <td><?= formatRupiah(floatval($item['price']) * intval($item['quantity'])); ?></td>

                                    <td>
                                        <form method="POST" action="">
                                            <input type="hidden" name="product_id" value="<?= $id; ?>">
                                            <button type="submit" name="remove" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="py-5 text-center">Keranjang Belanja Anda Sedang kosong.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="row mb-3">
                    <div class="col-sm-10">
                        <!-- Tombol Modal -->
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                          Lanjutkan Pembayaran
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">

                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Payment Method</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>

                              <div class="modal-body">
                              <form action="checkout.php">

                                <div class="row mb-3">
                                  <label for="inputEmail3" class="col-sm-2 col-form-label">Total Harga</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="inputEmail3" value="<?= formatRupiah($total_price); ?>" readonly>
                                    </div>
                                </div>

                                <fieldset class="row mb-3">
                                  <legend class="col-form-label col-sm-2 pt-0">Pilih</legend>
                                  <div class="col-sm-10">
                                    <div class="form-check shadow-sm">
                                      <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                      <label class="form-check-label" for="gridRadios1">
                                        Dana
                                        <img src="images/dana.png" >
                                      </label>
                                    </div>

                                    <div class="form-check shadow-sm">
                                      <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                      <label class="form-check-label" for="gridRadios1">
                                        Ovo
                                        <img src="images/ovo.png">
                                      </label>
                                    </div>

                                    <div class="form-check shadow-sm">
                                      <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                      <label class="form-check-label" for="gridRadios1">
                                        Qris
                                        <img src="images/qris.png">
                                      </label>
                                    </div>

                                    <div class="form-check shadow-sm">
                                      <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                      <label class="form-check-label" for="gridRadios1">
                                        Gopay
                                        <img src="images/gopay.png">
                                      </label>
                                    </div>
                                    
                                  </div>
                                </fieldset>
                          
                          <button type="submit" class="btn btn-success">Konfirmasi Pembayaran</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
