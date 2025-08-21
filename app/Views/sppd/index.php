<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
  <h2>Daftar SPPD</h2>

  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
  <?php endif; ?>

  <a href="<?= base_url('sppd/create') ?>" class="btn btn-primary mb-3">+ Tambah SPPD</a>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Nomor SPT</th>
        <th>Nomor SPPD</th>
        <th>Tanggal</th>
        <th>Pelaksana</th>
        <th>Perihal</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($sppd)): ?>
        <?php foreach ($sppd as $i => $row): ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td><?= esc($row['nomor_spt']) ?></td>
            <td><?= esc($row['nomor_sppd']) ?></td>
            <td><?= esc(tanggalIndo($row['tanggal'])) ?></td>
            <td><?= esc($row['pelaksana']) ?></td>
            <td><?= esc($row['perihal']) ?></td>
            <td>
              <a href="<?= base_url('sppd/edit/' . $row['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
              <a href="<?= base_url('sppd/delete/' . $row['id']) ?>"
                class="btn btn-danger btn-sm"
                onclick="return confirm('Yakin mau hapus data ini?')">Hapus</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="7" class="text-center">Belum ada data</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<?= $this->endSection() ?>