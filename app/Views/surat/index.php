<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
  <h3 class="mb-3">📑 Daftar Surat Masuk & Keluar</h3>

  <!-- Pesan sukses -->
  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
  <?php endif; ?>

  <!-- Form Pencarian -->
  <form method="get" action="/surat" class="row mb-3">
    <div class="col-md-4">
      <input type="text" name="keyword" class="form-control" placeholder="Cari surat..." value="<?= esc($_GET['keyword'] ?? '') ?>">
    </div>
    <div class="col-md-3">
      <select name="jenis" class="form-control">
        <option value="">-- Semua Jenis --</option>
        <option value="masuk" <?= (($_GET['jenis'] ?? '') == 'masuk') ? 'selected' : '' ?>>Surat Masuk</option>
        <option value="keluar" <?= (($_GET['jenis'] ?? '') == 'keluar') ? 'selected' : '' ?>>Surat Keluar</option>
      </select>
    </div>
    <div class="col-md-2">
      <button class="btn btn-primary">Cari</button>
    </div>
    <div class="row mb-3 mt-4">
      <div class="col-md-6">
        <a href="<?= base_url('surat/export-pdf') ?>" class="btn btn-danger">📄 Export PDF</a>
        <a href="<?= base_url('surat/export-excel') ?>" class="btn btn-success">📊 Export Excel</a>
      </div>
      <div class="col-md-6 text-end">
        <a href="/surat/create" class="btn btn-primary">➕ Tambah Surat</a>
      </div>
    </div>
  </form>

  <!-- Tabel Surat -->
  <table class="table table-bordered table-striped">
    <thead>
      <tr class="text-center">
        <th>No</th>
        <th>Nomor Surat</th>
        <th>Tanggal</th>
        <th>Jenis</th>
        <th>Asal/Tujuan</th>
        <th>Perihal</th>
        <th>Lampiran</th>
        <th>Status</th>
        <th width="150">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($surat)): ?>
        <?php $no = 1 + (10 * (($_GET['page'] ?? 1) - 1)); ?>
        <?php foreach ($surat as $s): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= esc($s['nomor_surat']) ?></td>
            <td><?= esc($s['tanggal_surat']) ?></td>
            <td>
              <span class="badge bg-<?= $s['jenis'] == 'masuk' ? 'info' : 'warning' ?>">
                <?= ucfirst($s['jenis']) ?>
              </span>
            </td>
            <td><?= esc($s['asal_tujuan']) ?></td>
            <td><?= esc($s['perihal']) ?></td>
            <td>
              <?php if ($s['lampiran_file']): ?>
                <a href="<?= base_url('uploads/' . $s['lampiran_file']) ?>" target="_blank" class="btn btn-sm btn-secondary">📂 Lihat</a>
              <?php else: ?>
                -
              <?php endif; ?>
            </td>
            <td><?= esc($s['status']) ?></td>
            <td class="text-center">
              <a href="/surat/edit/<?= $s['id'] ?>" class="btn btn-sm btn-primary">✏️</a>

              <form action="/surat/delete/<?= $s['id'] ?>" method="post" style="display:inline;" onsubmit="return confirm('Yakin hapus data ini?')">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-sm btn-danger">🗑️</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="9" class="text-center">Tidak ada data surat.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>

  <!-- Pagination -->
  <div>
    <?= $pager->links() ?>
  </div>
</div>

<?= $this->endSection() ?>