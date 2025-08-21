<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
  <h2>Edit SPPD</h2>

  <form action="<?= base_url('sppd/update/' . $sppd['id']) ?>" method="post">
    <?= csrf_field() ?>

    <div class="mb-3">
      <label for="nomor_spt" class="form-label">Nomor spt</label>
      <input type="text" name="nomor_spt" id="nomor_spt" class="form-control"
        value="<?= esc($sppd['nomor_spt']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="nomor_sppd" class="form-label">Nomor sppd</label>
      <input type="text" name="nomor_sppd" id="nomor_sppd" class="form-control"
        value="<?= esc($sppd['nomor_sppd']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="tanggal" class="form-label">Tanggal</label>
      <input type="date" name="tanggal" id="tanggal" class="form-control"
        value="<?= esc($sppd['tanggal']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="pelaksana" class="form-label">Pelaksana</label>
      <input type="text" name="pelaksana" id="pelaksana" class="form-control"
        value="<?= esc($sppd['pelaksana']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="perihal" class="form-label">Perihal</label>
      <textarea name="perihal" id="perihal" rows="3" class="form-control"><?= esc($sppd['perihal']) ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="<?= base_url('sppd') ?>" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?= $this->endSection() ?>