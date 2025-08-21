<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
  <h2>Tambah Surat</h2>

  <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
  <?php endif; ?>

  <form action="<?= base_url('surat/store') ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="mb-3">
      <label for="nomor_surat" class="form-label">Nomor Surat <small>(contoh: 094/01.PRKK/KPH-BLT/2025)</small></label>
      <input type="text" name="nomor_surat" id="nomor_surat" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="tanggal_surat" class="form-label">Tanggal Surat</label>
      <input type="date" name="tanggal_surat" id="tanggal_surat" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="jenis" class="form-label">Jenis Surat</label>
      <select name="jenis" id="jenis" class="form-select" required>
        <option value="">-- Pilih Jenis --</option>
        <option value="masuk">Surat Masuk</option>
        <option value="keluar">Surat Keluar</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="asal_tujuan" class="form-label">Asal / Tujuan</label>
      <input type="text" name="asal_tujuan" id="asal_tujuan" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="perihal" class="form-label">Perihal</label>
      <input type="text" name="perihal" id="perihal" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="isi_ringkas" class="form-label">Isi Ringkas</label>
      <textarea name="isi_ringkas" id="isi_ringkas" rows="3" class="form-control"></textarea>
    </div>

    <div class="mb-3">
      <label for="lampiran_file" class="form-label">Lampiran (PDF/JPG/PNG)</label>
      <input type="file" name="lampiran_file" id="lampiran_file" class="form-control">
    </div>

    <div class="mb-3">
      <label for="status" class="form-label">Status</label>
      <select name="status" id="status" class="form-select">
        <option value="baru" selected>Baru</option>
        <option value="proses">Proses</option>
        <option value="selesai">Selesai</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="<?= base_url('surat') ?>" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?= $this->endSection() ?>