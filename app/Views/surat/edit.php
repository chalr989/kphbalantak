<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
  <h2>Edit Surat</h2>

  <form action="<?= base_url('surat/update/' . $surat['id']) ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="mb-3">
      <label for="nomor_surat" class="form-label">Nomor Surat</label>
      <input type="text" name="nomor_surat" id="nomor_surat" class="form-control" value="<?= esc($surat['nomor_surat']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="tanggal_surat" class="form-label">Tanggal Surat</label>
      <input type="date" name="tanggal_surat" id="tanggal_surat" class="form-control" value="<?= esc($surat['tanggal_surat']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="jenis" class="form-label">Jenis Surat</label>
      <select name="jenis" id="jenis" class="form-select" required>
        <option value="masuk" <?= $surat['jenis'] == 'masuk' ? 'selected' : '' ?>>Surat Masuk</option>
        <option value="keluar" <?= $surat['jenis'] == 'keluar' ? 'selected' : '' ?>>Surat Keluar</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="asal_tujuan" class="form-label">Asal / Tujuan</label>
      <input type="text" name="asal_tujuan" id="asal_tujuan" class="form-control" value="<?= esc($surat['asal_tujuan']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="perihal" class="form-label">Perihal</label>
      <input type="text" name="perihal" id="perihal" class="form-control" value="<?= esc($surat['perihal']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="isi_ringkas" class="form-label">Isi Ringkas</label>
      <textarea name="isi_ringkas" id="isi_ringkas" rows="3" class="form-control"><?= esc($surat['isi_ringkas']) ?></textarea>
    </div>

    <div class="mb-3">
      <label for="lampiran_file" class="form-label">Lampiran (PDF/JPG/PNG)</label>
      <input type="file" name="lampiran_file" id="lampiran_file" class="form-control">
      <?php if ($surat['lampiran_file']): ?>
        <small>File lama: <?= esc($surat['lampiran_file']) ?></small>
      <?php endif; ?>
    </div>

    <div class="mb-3">
      <label for="status" class="form-label">Status</label>
      <select name="status" id="status" class="form-select">
        <option value="baru" <?= $surat['status'] == 'baru' ? 'selected' : '' ?>>Baru</option>
        <option value="proses" <?= $surat['status'] == 'proses' ? 'selected' : '' ?>>Proses</option>
        <option value="selesai" <?= $surat['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="<?= base_url('surat') ?>" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?= $this->endSection() ?>