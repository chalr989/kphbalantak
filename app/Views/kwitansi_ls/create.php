<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
  <h2>Tambah Kwitansi</h2>

  <form action="<?= base_url('kwitansi_ls/store') ?>" method="post">
    <?= csrf_field() ?>

    <div class="mb-3">
      <label for="nomor_kwitansi" class="form-label">Nomor Kwitansi LS</label>
      <input type="text" name="nomor_kwitansi" id="nomor_kwitansi" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="tanggal" class="form-label">Tanggal</label>
      <input type="date" name="tanggal" id="tanggal" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="penerima" class="form-label">Penerima</label>
      <input type="text" name="penerima" id="penerima" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="jumlah" class="form-label">Jumlah</label>
      <input type="number" name="jumlah" id="jumlah" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="keterangan" class="form-label">Keterangan</label>
      <textarea name="keterangan" id="keterangan" rows="3" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="<?= base_url('kwitansi_ls') ?>" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?= $this->endSection() ?>