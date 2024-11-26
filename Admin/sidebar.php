<style>
  @keyframes blink {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.2;
    }
}
      .nav-link:hover{
      background-color: #ca8a04;
    }
    .nav-link.active {
    background-color: #f59e0b !important;
    color: black !important; /* Opsional: atur teks menjadi hitam untuk kontras */
    font-weight: bold;
    border-radius: 5px;
}

.nav-link.active i {
    animation: blink 1s infinite; /* Animasi berkedip */
}
  .logout:hover {
    background-color: red;
    border-radius: 5px;
  }

  li .active {
    background-color: #0D6EbD;
  }

  .sosmed:hover {
    background-color: yellowgreen;
    color: #000;
  }

  body {
    background: #f0f0f0;
  }

  #sidebar {
    position: fixed;
    min-width: 250px;
    max-width: 250px;
    height: 100vh;
    background-color: #343a40;
    color: white;
    transition: margin 0.3s;
  }

  #sidebar .nav-link {
    color: white;
  }

  #content {
    margin-left: 250px;
    padding: 20px;
  }

  @media (max-width: 768px) {
    #sidebar {
      margin-left: -250px;
    }

    #sidebar.active {
      margin-left: 0;
    }

    #content {
      margin-left: 0;
    }

    #content.active {
      margin-left: 250px;
    }
  }
</style>

<ul class="nav nav-pills flex-column mb-auto ">
  <hr>
  <li class="nav-item">
    <a href="index.php" class="nav-link text-white mb-1 <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>" aria-current="page">
      <i class="fa-solid fa-house"></i>
      Home
    </a>
  </li>
  <li>
    <a href="dashboard.php" class="nav-link text-white mb-1 <?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">
      <i class="fa-solid fa-gauge"></i>
      Dashboard
    </a>
  </li>
  <li>
    <a href="user.php" class="nav-link text-white mb-1 <?= basename($_SERVER['PHP_SELF']) == 'user.php' ? 'active' : '' ?>">
      <i class="fa-solid fa-users"></i>
      Pengguna
    </a>
  </li>


  <li class="nav-link" data-bs-toggle="collapse" href="#collapseExample">
  <i class="fa-solid fa-cookie"></i> Produk
  </li>
 

<div class="collapse bg-dark" id="collapseExample">
  <div class="card card-body bg-dark">
  <li>
    <a href="produk.php" class="nav-link text-white mb-1 <?= basename($_SERVER['PHP_SELF']) == 'produk.php' ? 'active' : '' ?>">
    <i class="fa-solid fa-cookie-bite"></i>
      Data Produk
    </a>
  </li>
  <li>
    <a href="kategori.php" class="nav-link text-white mb-1 <?= basename($_SERVER['PHP_SELF']) == 'kategori.php' ? 'active' : '' ?>">
    <i class="fa-solid fa-list"></i>
      Data Kategori
    </a>
  </li>
  </div>
</div>

  <li>
    <a href="pesanan.php" class="nav-link text-white mb-1 <?= basename($_SERVER['PHP_SELF']) == 'pesanan.php' ? 'active' : '' ?>">
    <i class="fa-solid fa-clock"></i>
      Pesanan
    </a>
  </li>
  <li>
    <a href="pembayaran.php" class="nav-link text-white mb-1 <?= basename($_SERVER['PHP_SELF']) == 'pembayaran.php' ? 'active' : '' ?>">
    <i class="fa-solid fa-money-bill"></i>
      Pembayaran
    </a>
  </li>
  <li>
    <a href="feedback.php" class="nav-link text-white mb-1 <?= basename($_SERVER['PHP_SELF']) == 'feedback.php' ? 'active' : '' ?>">
      <i class="fa-solid fa-comments"></i>
      FeedBack
    </a>
  </li>
  <hr>
  <li>
    <a href="account.php" class="nav-link text-white mb-1 <?= basename($_SERVER['PHP_SELF']) == 'account.php' ? 'active' : '' ?>">
      <i class="fa-solid fa-user"></i>
      Akun
    </a>
  </li>
  <li>
    <a href="../source/proses_logout.php" class="nav-link text-white mb-1 logout" onclick="return confirm('Apakah Anda Yakin Mau Log Out?')">
      <i class="fa-solid fa-right-from-bracket"></i>
      Logout
    </a>
  </li>
</ul>

<script>
  document.querySelector('.navbar-toggler').addEventListener('click', function() {
    document.getElementById('sidebar').classList.toggle('active');
    document.getElementById('content').classList.toggle('active');
  });
</script>