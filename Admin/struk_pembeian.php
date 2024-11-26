<?php
include '../source/koneksi.php';

if (isset($_GET['id_pesanan'])) {
    $id_pesanan = $_GET['id_pesanan'];

    // Query untuk mendapatkan data user, pesanan, dan pembayaran
    $queryPesanan = "SELECT pesanan.*, user.nama, user.email, user.alamat, pembayaran.metode_pembayaran 
                     FROM pesanan 
                     JOIN user ON pesanan.id_user = user.id_user
                     JOIN pembayaran ON pesanan.id_pesanan = pembayaran.id_pesanan
                     WHERE pesanan.id_pesanan = ?";
    $stmt = $koneksi->prepare($queryPesanan);
    $stmt->bind_param("i", $id_pesanan);
    $stmt->execute();
    $resultPesanan = $stmt->get_result();
    $dataPesanan = $resultPesanan->fetch_assoc();

    // Query untuk mendapatkan data produk yang dipesan
    $queryProduk = "SELECT produk.nama_produk, produk.harga, detail_pesanan.kuantitas
                    FROM detail_pesanan 
                    JOIN produk ON detail_pesanan.id_produk = produk.id_produk
                    WHERE detail_pesanan.id_pesanan = ?";
    $stmtProduk = $koneksi->prepare($queryProduk);
    $stmtProduk->bind_param("i", $id_pesanan);
    $stmtProduk->execute();
    $resultProduk = $stmtProduk->get_result();
} else {
    echo "ID pesanan tidak ditemukan.";
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="icon" href="../images/logo.png">
    <title>Admin WeKress</title>
    <style>
        .receipt-container { padding: 20px; max-width: 500px; margin: 0 auto; background-color: #fff; }
        .text-center { text-align: center; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        .box-area { border-radius: 8px; overflow: hidden; }
        .shadow { box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
    </style>
</head>
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
            <span class="fs-4"><img src="../images/wekress.png" width="150"></span>
            <?php include 'sidebar.php' ?>
        </div>

        <div class="col-lg-10 p-3" id="content">
            <h2 class="text-center">Admin WeKress</h2>
            <hr>
            <div class="card mb-3">
                <h2 class="ms-3 my-2"><i class="fa-solid fa-money-bill"></i> Halaman Pembayaran</h2>
            </div>

            <div class="card shadow box-area">
                <div class="text-center mb-3 mt-3 d-flex">
                    <h4 class="ms-3">Struk Pembayaran</h4>
                    <h4 class="ms-auto"><i class="fa-solid fa-cookie-bite"></i></h4>
                    <hr class="bg-dark me-3">
                </div>

                <div class="d-flex align-items-center ms-3 me-3 p-3 my-2 text-white rounded shadow-sm" style="background: #ffd167;">
                    <div class="row g-3 me-auto">
                        <button class="btn btn-primary" id="download-btn"><i class="fa-solid fa-print"></i> Cetak struk</button>
                    </div>
                    <div class="ms-auto">
                        <a href="pembayaran.php" class="btn btn-success">Kembali</a>
                    </div>
                </div>  

                <div class="d-flex justify-content-center align-items-center min-vh-100">
                    <div class="receipt-container shadow box-area">
                        <div class="receipt-header text-center">
                            <img src="../images/wekress.png" alt="Logo Indomaret" width="200">
                            <p>Jl. Pertamanan No. 5<br>Kepuharjo, Karangploso, Malang<br>Telp: 0895-6221-92248</p>
                            <hr>
                        </div>

                        <p><strong><?= htmlspecialchars($dataPesanan['nama'] ?? '') ?></strong></p>
                        <p><strong><?= htmlspecialchars($dataPesanan['email'] ?? '') ?></strong></p>
                        <p><strong><?= htmlspecialchars($dataPesanan['alamat'] ?? '') ?></strong></p>
                        <p><strong><?= htmlspecialchars($dataPesanan['metode_pembayaran'] ?? '') ?></strong></p>
                        <p><strong>Pesanan ID: <?= htmlspecialchars($dataPesanan['id_pesanan'] ?? '') ?></strong></p>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                while ($rowProduk = $resultProduk->fetch_assoc()) {
                                    $subtotal = $rowProduk['harga'] * $rowProduk['kuantitas'];
                                    $total += $subtotal;
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($rowProduk['nama_produk']) . "</td>";
                                    echo "<td>" . htmlspecialchars($rowProduk['kuantitas']) . "</td>";
                                    echo "<td>Rp" . number_format($rowProduk['harga'], 0, ',', '.') . "</td>";
                                    echo "<td>Rp" . number_format($subtotal, 0, ',', '.') . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                                <tr>
                                    <td colspan="3"><strong>Total</strong></td>
                                    <td><strong>Rp<?= number_format($total, 0, ',', '.') ?></strong></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="footer-text text-center">
                            <p>Terima kasih telah berbelanja di WeKresss</p>
                            <p>Unduh struk ini sebagai riwayat belanja yang sah</p>
                            <p><?= date("d M Y"); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    document.getElementById("download-btn").addEventListener("click", function() {
        const receiptContainer = document.querySelector(".receipt-container");
        html2canvas(receiptContainer).then(canvas => {
            const link = document.createElement("a");
            link.href = canvas.toDataURL("image/png");
            link.download = "struk<?= htmlspecialchars($dataPesanan['id_pesanan'] ?? '') ?>.png";
            link.click();
        });
    });
</script>

<?php $koneksi->close(); ?>
</body>
</html>
