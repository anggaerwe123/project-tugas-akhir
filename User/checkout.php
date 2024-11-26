<?php
include 'session.php';
include '../source/koneksi.php';

// Periksa apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Periksa apakah keranjang memiliki item
if (empty($_SESSION['cart'])) {
    echo "<script>
    alert('Keranjang belanja Anda kosong');
    window.location.href = 'keranjang.php';
    </script>";
    exit();
}

$user_id = $_SESSION['user_id'];
$total_harga = 0;
$total_pesanan = 0;

// Salin cart ke variabel baru sebelum di-unset
$cart = $_SESSION['cart'];

// Hitung total harga dan jumlah pesanan dari keranjang
foreach ($cart as $item) {
    $total_harga += $item['price'] * $item['quantity'];
    $total_pesanan += $item['quantity'];
}

// Format tanggal pesanan
$tanggal_pesanan = date("Y-m-d H:i:s");

// Mulai transaksi
mysqli_begin_transaction($koneksi);

try {
    // Simpan pesanan ke tabel pesanan
    $stmt = $koneksi->prepare("INSERT INTO pesanan (id_user, total_harga, total_pesanan, tanggal_pesanan, status) VALUES (?, ?, ?, ?, 'Belum dibayar')");
    $stmt->bind_param("iids", $user_id, $total_harga, $total_pesanan, $tanggal_pesanan);

    if ($stmt->execute()) {
        $id_pesanan = $koneksi->insert_id;

        // Update stok produk dan simpan detail pesanan
        foreach ($cart as $item) {
            // Validasi apakah item memiliki kunci 'id' dan 'quantity'
            if (!isset($item['id'], $item['quantity'])) {
                throw new Exception("Data produk tidak lengkap dalam keranjang");
            }

            $id_produk = $item['id'];
            $kuantitas = $item['quantity'];

            // Pastikan stok produk mencukupi
            $cek_stok_query = "SELECT stok FROM produk WHERE id_produk = ?";
            $cek_stok_stmt = $koneksi->prepare($cek_stok_query);
            $cek_stok_stmt->bind_param("i", $id_produk);
            $cek_stok_stmt->execute();
            $cek_stok_result = $cek_stok_stmt->get_result();
            $produk = $cek_stok_result->fetch_assoc();

            if (!$produk || $produk['stok'] < $kuantitas) {
                throw new Exception("Stok produk tidak mencukupi untuk produk ID: $id_produk");
            }

            // Update stok produk
            $update_stok_query = "UPDATE produk SET stok = stok - ? WHERE id_produk = ?";
            $update_stmt = $koneksi->prepare($update_stok_query);
            $update_stmt->bind_param("ii", $kuantitas, $id_produk);

            if (!$update_stmt->execute()) {
                throw new Exception("Gagal mengupdate stok produk untuk ID: $id_produk");
            }

            // Simpan detail pesanan ke tabel detail_pesanan
            $insert_detail_query = "INSERT INTO detail_pesanan (id_pesanan, id_produk, kuantitas) VALUES (?, ?, ?)";
            $detail_stmt = $koneksi->prepare($insert_detail_query);
            $detail_stmt->bind_param("iii", $id_pesanan, $id_produk, $kuantitas);

            if (!$detail_stmt->execute()) {
                throw new Exception("Gagal menyimpan detail pesanan untuk produk ID: $id_produk");
            }
        }

        // Kosongkan keranjang setelah checkout
        unset($_SESSION['cart']);

        // Simpan variabel cart dan total harga ke session sementara untuk halaman sukses
        $_SESSION['checkout_cart'] = $cart;
        $_SESSION['checkout_total_harga'] = $total_harga;

        // Commit transaksi
        mysqli_commit($koneksi);

        // Redirect ke halaman checkout sukses
        header("Location: ../User/struk.php");
        exit();
    } else {
        throw new Exception("Gagal menyimpan pesanan");
    }
} catch (Exception $e) {
    // Rollback transaksi jika terjadi kesalahan
    mysqli_rollback($koneksi);
    echo "<script>
    alert('Terjadi kesalahan: " . $e->getMessage() . "');
    window.location.href = 'keranjang.php';
    </script>";
    exit();
}
?>
