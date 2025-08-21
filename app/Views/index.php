<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
  <h2>Daftar Surat</h2>
  <a href="<?= base_url('surat/create') ?>" class="btn btn-primary mb-3">Tambah Surat</a>

  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
  <?php endif; ?>

  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Nomor Surat</th>
        <th>Tanggal</th>
        <th>Jenis</th>
        <th>Asal/Tujuan</th>
        <th>Perihal</th>
        <th>Lampiran</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1;
      foreach ($surat as $s): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $s['nomor_surat'] ?></td>
          <td><?= $s['tanggal_surat'] ?></td>
          <td><span class="badge bg-<?= $s['jenis'] == 'masuk' ? 'info' : 'success' ?>"><?= ucfirst($s['jenis']) ?></span></td>
          <td><?= $s['asal_tujuan'] ?></td>
          <td><?= $s['perihal'] ?></td>
          <td>
            <?php if ($s['lampiran_file']): ?>
              <a href="<?= base_url('uploads/' . $s['lampiran_file']) ?>" target="_blank">Lihat</a>
            <?php endif; ?>
          </td>
          <td>
            <a href="<?= base_url('surat/' . $s['id'] . '/edit') ?>" class="btn btn-sm btn-warning">Edit</a>
            <form action="<?= base_url('surat/' . $s['id']) ?>" method="post" style="display:inline-block">
              <?= csrf_field() ?>
              <input type="hidden" name="_method" value="DELETE">
              <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?= $this->endSection() ?>