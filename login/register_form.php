<?php
session_start();
@include '../source/koneksi.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($koneksi, $_POST['nama']);
   $email = mysqli_real_escape_string($koneksi, $_POST['email']);
   $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['role'];

   $select = " SELECT * FROM user WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($koneksi, $select);

   if(mysqli_num_rows($result) > 0){

      $_SESSION['message'] = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
  <b><i class='fa-solid fa-triangle-exclamation'></i></b> Pengguna Sudah Terdaftar
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";

   }else{

      if($pass != $cpass){
        $_SESSION['message'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <b><i class='fa-solid fa-circle-exclamation'></i></b> Kesalahan Pada Password dan Konfirmasi Password
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
      }else{
         $insert = "INSERT INTO user(nama, alamat, email, password, role) VALUES('$name','$alamat','$email','$pass','$user_type')";
         mysqli_query($koneksi, $insert);
         header('location:login_form.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>WeKresss</title>
   <!-- Custom Css -->
   <link rel="icon" href="../images/logo.png">

   <!-- CDNS Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<style>
html, body {
    height: 100%;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #f8f9fa;
}
</style>
<body>
   
<div class="container banner">
<?php
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']); // Menghapus pesan setelah ditampilkan
}
?>
            <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 text-center">
                <form class="rounded bg-white shadow p-5" action="" method="post">
                    <h3 class="text-dark fw-bolder fs-4 mb-3">Register</h3>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="nama" id="name" placeholder="name@example.com" required>
                        <label for="floatingInput">Nama Lengkap</label>
                      </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="alamat" id="alamat" placeholder="name@example.com" required>
                        <label for="floatingInput">Alamat Lengkap</label>
                      </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                        <label for="floatingInput">Email address</label>
                      </div>
                      <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                        <label for="floatingPassword">Password</label>
                      </div>
                      <div class="form-floating">
                        <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Password" required>
                        <label for="floatingPassword">Konfirmasi Password</label>
                      </div>
                      <div class="text-end mb-3">
                        <a id="togglePassword" class="text-decoration-none text-dark" href="javascript:void(0)">Tampilkan Kata Sandi</a>
                    </div>
                      <div class="form-floating">
                        <select name="role" class="form-select" id="floatingSelect" aria-label="Floating label select example" required>
                          <option selected>Klik Menu Berikut ini</option>
                          <option value="user">Pengguna</option>
                          <option value="admin">Administrasi</option>
                        </select>
                        <label for="floatingSelect">Daftar Sebagai</label>
                      </div>
                      <button type="submit" name="submit" class="btn submit-btn w-100 my-4" style="background-color: #F3C623;">Submit</button>
                      <div class="mt-2 d-flex text-center">
                        <p>Sudah Mempunyai Akun? </p><a href="login_form.php" style="color: #F3C623;" class="fw-bold text-decoration-none">Login</a>
                      </div>
                </form>
                
            </div>
        </div>

        <!-- Footer -->
         
        <!-- End Footer -->
        <script>
          const togglePassword = document.getElementById('togglePassword');
          const password = document.getElementById('cpassword');

          togglePassword.addEventListener('click', function () {
              if (password.type === 'password') {
                  password.type = 'text';
                  togglePassword.textContent = 'Sembunyikan Kata Sandi';
              } else {
                  password.type = 'password';
                  togglePassword.textContent = 'Tampilkan Kata Sandi';
              }
          });
</script>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>