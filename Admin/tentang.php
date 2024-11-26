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
            <div class="card my-3 ms-3 me-3">
            <h2 class="text-center">Tentang</h2>
                <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, consequuntur!</p>

                <div class="clearfix pt-5">
                    <img src="../images/background.jpg" class="img-fluid col-md-6 float-md-end mb-3">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati sapiente ex, quasi, quos, quaerat excepturi rem culpa illum quod earum corporis. Ab animi consequuntur modi repellat? Rerum corporis nihil ratione possimus quibusdam laborum dolorum. Quibusdam, labore, necessitatibus laborum deleniti, dolorum ea autem rem accusamus debitis ipsa voluptas cumque. Deserunt, eveniet!</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati sapiente ex, quasi, quos, quaerat excepturi rem culpa illum quod earum corporis. Ab animi consequuntur modi repellat? Rerum corporis nihil ratione possimus quibusdam laborum dolorum. Quibusdam, labore, necessitatibus laborum deleniti, dolorum ea autem rem accusamus debitis ipsa voluptas cumque. Deserunt, eveniet!</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati sapiente ex, quasi, quos, quaerat excepturi rem culpa illum quod earum corporis. Ab animi consequuntur modi repellat? Rerum corporis nihil ratione possimus quibusdam laborum dolorum. Quibusdam, labore, necessitatibus laborum deleniti, dolorum ea autem rem accusamus debitis ipsa voluptas cumque. Deserunt, eveniet!</p>
                </div>
              </div>
            </div>
            
          </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>