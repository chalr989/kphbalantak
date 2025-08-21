<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
  <h2>Daftar Kwitansi LS</h2>

  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
  <?php endif; ?>

  <a href="<?= base_url('kwitansi_ls/create') ?>" class="btn btn-primary mb-3">+ Tambah Kwitansi LS</a>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Nomor Kwitansi</th>
        <th>Tanggal</th>
        <th>Penerima</th>
        <th>Jumlah</th>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($kwitansi_ls)): ?>
        <?php foreach ($kwitansi_ls as $i => $row): ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td><?= esc($row['nomor_kwitansi']) ?></td>
            <td><?= esc(tanggalIndo($row['tanggal'])) ?></td>
            <td><?= esc($row['penerima']) ?></td>
            <td>Rp <?= number_format($row['jumlah'], 0, ',', '.') ?></td>
            <td><?= esc($row['keterangan']) ?></td>
            <td>
              <a href="<?= base_url('kwitansi_ls/edit/' . $row['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
              <a href="<?= base_url('kwitansi_ls/delete/' . $row['id']) ?>"
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