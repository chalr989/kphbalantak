<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
  <h3>Dashboard</h3>
  <div class="row">
    <!-- Card Statistik -->
    <div class="col-md-4">
      <div class="card text-white bg-primary mb-3 shadow">
        <div class="card-body">
          <h5 class="card-title">Surat Masuk</h5>
          <p class="card-text fs-3"><?= $suratMasuk ?></p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card text-white bg-success mb-3 shadow">
        <div class="card-body">
          <h5 class="card-title">Surat Keluar</h5>
          <p class="card-text fs-3"><?= $suratKeluar ?></p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card text-white bg-warning mb-3 shadow">
        <div class="card-body">
          <h5 class="card-title">Total Kwitansi</h5>
          <p class="card-text fs-3"><?= $totalKwitansi ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-white bg-danger mb-3 shadow">
        <div class="card-body">
          <h5 class="card-title">Total SPPD</h5>
          <p class="card-text fs-3"><?= $totalSppd ?></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Filter Tahun -->
  <form method="get" class="mb-3">
    <label for="tahun">Pilih Tahun:</label>
    <select name="tahun" id="tahun" class="form-select d-inline-block w-auto" onchange="this.form.submit()">
      <?php foreach ($tahunList as $t): ?>
        <option value="<?= $t ?>" <?= ($t == $tahun) ? 'selected' : '' ?>><?= $t ?></option>
      <?php endforeach; ?>
    </select>
  </form>

  <!-- Grafik -->
  <div class="card mt-4 shadow">
    <div class="card-body">
      <h5 class="card-title">Statistik Bulanan Tahun <?= $tahun ?></h5>
      <canvas id="statistikChart" height="120"></canvas>
    </div>
  </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('statistikChart').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?= json_encode($bulan) ?>,
      datasets: [{
          label: 'Surat Masuk',
          data: <?= json_encode($suratMasukBulanan) ?>,
          backgroundColor: 'rgba(54, 162, 235, 0.7)',
        },
        {
          label: 'Surat Keluar',
          data: <?= json_encode($suratKeluarBulanan) ?>,
          backgroundColor: 'rgba(75, 192, 192, 0.7)',
        },
        {
          label: 'Kwitansi',
          data: <?= json_encode($kwitansiBulanan) ?>,
          backgroundColor: 'rgba(255, 206, 86, 0.7)',
        },
        {
          label: 'SPPD',
          data: <?= json_encode($sppdBulanan) ?>,
          backgroundColor: 'rgba(231, 43, 26, 0.7)',
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          precision: 0
        }
      }
    }
  });
</script>

<?= $this->endSection() ?>