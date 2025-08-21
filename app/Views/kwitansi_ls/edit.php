<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
  <h2>Edit Kwitansi</h2>

  <form action="<?= base_url('kwitansi_ls/update/' . $kwitansi_ls['id']) ?>" method="post">
    <?= csrf_field() ?>

    <div class="mb-3">
      <label for="nomor_kwitansi" class="form-label">Nomor Kwitansi</label>
      <input type="text" name="nomor_kwitansi" id="nomor_kwitansi" class="form-control"
        value="<?= esc($kwitansi_ls['nomor_kwitansi']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="tanggal" class="form-label">Tanggal</label>
      <input type="date" name="tanggal" id="tanggal" class="form-control"
        value="<?= esc($kwitansi_ls['tanggal']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="penerima" class="form-label">Penerima</label>
      <input type="text" name="penerima" id="penerima" class="form-control"
        value="<?= esc($kwitansi_ls['penerima']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="jumlah" class="form-label">Jumlah</label>
      <input type="number" name="jumlah" id="jumlah" class="form-control"
        value="<?= esc($kwitansi_ls['jumlah']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="keterangan" class="form-label">Keterangan</label>
      <textarea name="keterangan" id="keterangan" rows="3" class="form-control"><?= esc($kwitansi_ls['keterangan']) ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="<?= base_url('kwitansi_ls') ?>" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?= $this->endSection() ?>