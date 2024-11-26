<?php
include 'session.php';
include '../source/koneksi.php';

// Ambil data user dari database berdasarkan user_id dari session
$user_id = $_SESSION['admin_id'];
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
        header("Location: account.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($koneksi);
    }
}
?>
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
                        <button type="submit" name="update_profile" class="btn btn-primary">Update Profil</button>
                        <a href="account.php" class="btn btn-success">Kembali</a>
                    </form>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>