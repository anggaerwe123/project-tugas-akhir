<?php include 'session.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Style -->
     <link rel="stylesheet" href="style.css">

    <!-- Icon -->
    <link rel="icon" href="../images/logo.png">

    <title>WeKresss</title>
  </head>
  <body>
    
    <!-- Header -->
     <?php include 'header.php'; ?>
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

    <?php
    $user_id = $_SESSION['user_id'];
    $fetch = null;
    
    $select = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$user_id'");
    if ($select && mysqli_num_rows($select) > 0) {
        $fetch = mysqli_fetch_assoc($select);
    } else {
        echo "Data user tidak ditemukan. Pastikan Anda sudah login dengan benar.";
        exit();
    }
      ?>

        <div class="card-header d-flex">
            <img src="images/logo.png" width="50" alt="Logo">
            <div class="ms-auto my-2">
                Profil
            </div>
        </div>

        <div class="card-body mt-5 mb-5 d-flex">
            <div class="" style="width: 18rem;">
                <img src="../Database/user/<?php echo $fetch['gambar'] ?? 'default_profile.png'; ?>" class="card-img-top rounded-circle" alt="User Image">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                <?php if ($fetch): ?>
                <h5><?php echo $fetch['nama']; ?></h5>
                <p><?php echo $fetch['email']; ?></p>
                <p><?php echo $fetch['alamat']; ?></p>
                <a href="editakun.php" class="btn btn-warning" title="Edit Profil">Edit Profil</a>
                <a href="#" class="btn btn-danger delete-button" data-url="../source/proses_logout.php" title="Log Out">Log Out</a>
            <?php else: ?>
                <p>Data user tidak ditemukan. Pastikan Anda sudah login dengan benar.</p>
            <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Akhir Container -->

<br>

    <?php include 'footer.php'; ?>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>