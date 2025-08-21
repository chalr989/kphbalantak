<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= base_url('/') ?>">🦥 KPH BLT</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('surat') ?>">📑 Surat</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('kwitansi') ?>">💵 KW GU</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('kwitansi_ls') ?>">💶 KW LS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('sppd') ?>">🚙 SPPD</a>
        </li>
      </ul>

      <ul class="navbar-nav">
        <?php if (session()->get('logged_in')): ?>
          <li class="nav-item">
            <span class="navbar-text text-white me-2">
              Halo, <?= session()->get('username') ?>
            </span>
          </li>
          <li class="nav-item">
            <a class="btn btn-danger btn-sm" href="<?= base_url('logout') ?>">Logout</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="btn btn-success btn-sm" href="<?= base_url('login') ?>">Login</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>