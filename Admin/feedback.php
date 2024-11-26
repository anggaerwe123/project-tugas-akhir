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
    
          <div class="d-flex col-md-10 flex-column flex-shrin-0 p-3" id="content">
                <h2 class="text-center">Admin WeKress</h2>
                <hr>
            <div class="card mb-3">
                <h2 class="ms-3 my-2"><i class="fa-solid fa-comments"></i> Halaman FeedBack</h2>
            </div>

            <div class="card shadow box-area">
              <div class="text-center mb-3 mt-3 d-flex">
                <h4 class="ms-3">Tabel FeedBack</h4>
                <h4 class="ms-auto"><i class="fa-solid fa-comments"></i></h4>
                <hr class="bg-dark me-3">
            </div>
  
            <div class="d-flex align-items-center ms-3 me-3 p-3 my-2 text-white rounded shadow-sm" style="background: #ffd167;">
                <div class="row g-3 me-auto">
                  <div class="col-auto">
                    <form action="" method="get" >
                    <div class="input-group">
                      <input type="search" name="keyword" class="form-control" placeholder="Cari Data Disini" size="40">
                      <button class="btn btn-success" type="submit" data-bs-toggle="tooltip" title="Search" ><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                    </form>
                  </div>
                </div>
                <div class="ms-auto">
                  <!-- Button trigger modal -->
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
                          <p>1. Dilarang membalas feedback dengan keras atau toxic</p>
                          <p>2. Jika Pelanggan feedback dengan toxic jawab dengan Tegas!</p>
                          <p>3. Jika Pelanggan mengkritik terimalah kritikan dan terus Berkreatif</p>
                          <p>4. Tunjukan kalau anda adalah admin ramah tamah sopan dan santun</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-success" data-bs-dismiss="modal">Siap!!</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div> 
  
            <div class="mt-3 mb-3 ms-3 me-3">
  
            <?php
// Koneksi ke database
include '../source/koneksi.php';

$no = 1;
// Ambil data feedback beserta email user dari database
$sql = "SELECT feedback.komentar, feedback.rating, user.email 
        FROM feedback 
        JOIN user ON feedback.id_user = user.id_user";
$result = mysqli_query($koneksi, $sql);
?>

<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Email</th>
            <th>Komentar</th>
            <th>Bintang</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['komentar']; ?></td>
            <td><?php echo $row['rating']; ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>


                  
                  <!-- Pagination -->
                   <hr>
                    <nav>
                    <ul class="pagination">
                        <!-- Tombol sebelumnya -->
                        <li class="page-item">
                            <a class="page-link" data-bs-toggle="tooltip" title="Sebelumnya" href=""><span aria-hidden="true">&laquo;</span></a>
                        </li>
  
                        <!-- Nomor halaman -->
                            <li class="page-item">
                                <a class="page-link" href="">1</a>
                            </li>
  
                        <!-- Tombol berikutnya -->
                        <li class="page-item">
                            <a class="page-link" data-bs-toggle="tooltip" title="Selanjutnya" href=""><span aria-hidden="true">&raquo;</span></a>
                        </li>
                    </ul>
                </nav>
  
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