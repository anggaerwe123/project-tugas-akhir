<?php
include 'session.php';
include '../source/koneksi.php';

// Ambil data user dari database berdasarkan user_id dari session
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM user WHERE id_user = '$user_id'";
$result = mysqli_query($koneksi, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $fetch = mysqli_fetch_assoc($result);
} else {
    echo "Data user tidak ditemukan. Pastikan Anda sudah login dengan benar.";
    exit();
}

if (isset($_POST['update_profile'])) {
    $new_name = $_POST['nama'];
    $new_email = $_POST['email'];
    $new_alamat = $_POST['alamat'];

    // Proses upload gambar jika ada
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $file_tmp = $_FILES['gambar']['tmp_name'];
        $file_name = $_FILES['gambar']['name'];
        $target_dir = "../Database/user/";
        move_uploaded_file($file_tmp, $target_dir . $file_name);
        
        $update_query = "UPDATE user SET nama='$new_name', email='$new_email', alamat='$new_alamat', gambar='$file_name' WHERE id_user='$user_id'";
    } else {
        $update_query = "UPDATE user SET nama='$new_name', email='$new_email', alamat='$new_alamat' WHERE id_user ='$user_id'";
    }

    if (mysqli_query($koneksi, $update_query)) {
        // Perbarui session 'user_id' jika nama user berubah
        $_SESSION['nama'] = $new_name;
        header("Location: akun.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($koneksi);
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Meta tags, Bootstrap CSS, Font Awesome, Style, and Icon -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="../images/logo.png">
    <title>WeKresss</title>
</head>
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
<body>

<!-- Header -->
<div class="container-fluid bg-dark sticky-top">
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4">
            <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <img src="images/wekress.png" width="150">
            </a>
            <ul class="nav nav-pills mx-auto d-flex">
                <li><a href="index.php" class="nav-link px-2 text-white disabled">Beranda</a></li>
                <li><a href="produk.php" class="nav-link px-2 text-white disabled">Produk</a></li>
                <li><a href="feedback.php" class="nav-link px-2 text-white disabled">FeedBack</a></li>
                <li><a href="akun.php" class="nav-link px-2 text-white disabled active">Akun</a></li>
            </ul>
            <div class="ms-auto">
                <a href="keranjang.php" type="button" class="btn btn-warning position-relative ms-3 disabled">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </a>
                <a href="../source/proses_logout.php" onclick="return confirm('Apakah Anda Yakin Akan Log Out')" class="btn btn-danger ms-2 disabled"><i class="fa-solid fa-right-from-bracket"></i></a>
            </div>
        </header>
    </div>
</div>
<!-- Akhir Header -->

<!-- Container -->
<div class="container pt-5 pb-5 mb-5">
    <div class="container">
        <div class="text-center">
            <h3>Halaman Akun</h3>
            <p>Pada Halaman ini merupakan akun anda, anda dapat edit profil maupun log out</p>
        </div>
    </div>
    <div class="card shadow box-area">

        <div class="card-header d-flex">
            <img src="images/logo.png" width="50" alt="Logo">
            <div class="ms-auto my-2">
                Edit Profil
            </div>
        </div>

        <div class="card-body mt-5 mb-5 d-flex">
    <!-- Bagian untuk Menampilkan Gambar -->
    <div class="" style="width: 18rem;">
        <img id="preview" 
            src="../Database/user/<?php echo $fetch['gambar'] ?? 'default_profile.png'; ?>" 
            class="card-img-top rounded-circle" 
            alt="User Image"
            style="width: 150px; height: 150px;">
    </div>

    <!-- Bagian untuk Form -->
    <div class="col-md-8">
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <!-- Nama -->
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" 
                           value="<?php echo htmlspecialchars($fetch['nama'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" 
                           value="<?php echo htmlspecialchars($fetch['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                </div>

                <!-- Alamat -->
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" 
                           value="<?php echo htmlspecialchars($fetch['alamat'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                </div>

                <!-- Gambar -->
                <div class="mb-3">
                    <label for="gambar" class="form-label">Foto Profil</label>
                    <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" onchange="previewImage(event)">
                </div>

                <!-- Tombol Submit -->
                <button type="submit" name="update_profile" class="btn btn-primary">Update Profil</button>
                <a href="akun.php" class="btn btn-success">Kembali</a>
            </form>
        </div>
    </div>
</div>

<script>
    // JavaScript untuk preview gambar
    function previewImage(event) {
        const preview = document.getElementById('preview');
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result; // Mengubah src dengan data file
            };
            reader.readAsDataURL(file);
        }
    }
</script>


    </div>
</div>
<!-- Akhir Container -->

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
