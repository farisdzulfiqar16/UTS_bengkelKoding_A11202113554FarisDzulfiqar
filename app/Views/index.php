<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Informasi Poliklinik</title>
  <link rel="stylesheet" href="<?= base_url('public/css/style.css') ?>">
  <!-- Boostrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>

  <!-- Tampilan Dinamis / Dynamic View -->
  <main role="main" class="container">
    <?php
    if (isset($_GET['page'])) {
      echo '<h2>' . ucwords($_GET['page']) . '</h2>';
      include($_GET['page'] . ".php");
    } else {
      echo '<div class="running-text">Selamat Datang Di Sistem Informasi Poliklinik! Sistem ini menyediakan layanan terbaik untuk kesehatan Anda.</div>';
    }
    ?>
  </main>

  <!-- NavBar / Bilah Navigasi -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?= base_url('index') ?>">Sistem Informasi Poliklinik</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>

          <!-- Tampilkan hanya untuk pasien -->
          <?php if (session()->get('role') === 'pasien' || session()->get('role') === 'guest'): ?>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?= base_url('periksa') ?>">Periksa</a>
            </li>
          <?php endif; ?>

          <?php if (session()->get('role') === 'admin'): ?>
            <!-- Menu untuk Admin -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Data Master
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= base_url('pasien') ?>">Halaman Pasien</a></li>
                <li><a class="dropdown-item" href="<?= base_url('dokter') ?>">Halaman Dokter</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Tentang Kami</a></li>
              </ul>
            </li>
          <?php endif; ?>

          <?php if (session()->get('role') === 'admin' || session()->get('role') === 'pasien'): ?>
            <!-- Menu untuk Admin dan Pasien, misalnya Periksa -->
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?= base_url('periksa') ?>">Periksa</a>
            </li>
          <?php endif; ?>

          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('/logout') ?>">Logout</a>
          </li>
        </ul>

        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <h3> Selamat Datang di Sistem Informasi Poliklinik</h3>
  <!-- Boostrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>