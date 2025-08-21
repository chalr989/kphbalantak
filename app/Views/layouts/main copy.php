<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $this->renderSection('title') ?? 'Aplikasi Surat Masuk & Keluar' ?></title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <style>
    body {
      background-color: #f8f9fa;
    }

    .navbar {
      border-radius: 0 0 10px 10px;
    }

    .container {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">🦥 KPH-Balantak</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item"><a class="nav-link" href="/surat">📑 Surat</a></li>
          <li class="nav-item"><a class="nav-link" href="/kwitansi">💵 Kwitansi</a></li>
          <li class="nav-item"><a class="nav-link" href="/kwitansi_ls">💶 Kwitansi LS</a></li>
          <li class="nav-item"><a class="nav-link" href="/sppd">🚙 SPPD</a></li>
          <li class="nav-item"><a href="<?= base_url('logout') ?>" class="btn btn-danger btn-sm">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Konten Halaman -->
  <div class="container">
    <?= $this->renderSection('content') ?>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>