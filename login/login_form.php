<?php
@include '../source/koneksi.php';
session_start();

if(isset($_POST['submit'])){
   $email = mysqli_real_escape_string($koneksi, $_POST['email']);
   $pass = md5($_POST['password']);

   $select = "SELECT * FROM user WHERE email = '$email' AND password = '$pass'";
   $result = mysqli_query($koneksi, $select);

   if(mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_assoc($result);

      if ($row['role'] == 'admin') {
        $_SESSION['admin_id'] = $row['id_user'];
        header('location:../Admin/index.php');
        exit();
    } elseif ($row['role'] == 'user') {
        $_SESSION['user_id'] = $row['id_user'];
        header('location:../User/index.php');
        exit();
    }
    
   } else {
      $_SESSION['message'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <b><i class='fa-solid fa-circle-exclamation'></i></b> Kesalahan Pada Email Atau Password
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
   }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="../images/logo.png">
   <title>WeKresss</title>

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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



<div class="container mt-3">
<?php
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']); // Menghapus pesan setelah ditampilkan
}
?>
<div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 text-center">
    <form class="rounded bg-white shadow p-5" action="" method="post">
        <h3 class="text-dark fw-bolder fs-4 mb-3">Login</h3>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
            <label for="email">Email address</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
            <label for="password">Password</label>
        </div>
        <div class="text-end mt-2">
            <a id="togglePassword" class="text-decoration-none text-dark" href="javascript:void(0)">Tampilkan Kata Sandi</a>
        </div>
        <button type="submit" name="submit" style="background-color: #F3C623;" class="btn submit-btn w-100 my-4">Submit</button>
        <div class="mt-2 d-flex text-center">
            <p>Belum Mempunyai Akun? </p><a href="register_form.php" style="color: #F3C623;" class="fw-bold text-decoration-none">Daftar</a>
        </div>
    </form>
</div>

</div>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');

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