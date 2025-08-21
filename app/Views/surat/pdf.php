<!DOCTYPE html>
<html>

<head>
  <title>Daftar Surat</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      border: 1px solid #000;
      padding: 5px;
      text-align: center;
    }
  </style>
</head>

<body>
  <h3>Daftar Surat Masuk & Keluar</h3>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nomor Surat</th>
        <th>Tanggal</th>
        <th>Jenis</th>
        <th>Asal/Tujuan</th>
        <th>Perihal</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1;
      foreach ($surat as $s): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= esc($s['nomor_surat']) ?></td>
          <td><?= esc($s['tanggal_surat']) ?></td>
          <td><?= esc($s['jenis']) ?></td>
          <td><?= esc($s['asal_tujuan']) ?></td>
          <td><?= esc($s['perihal']) ?></td>
          <td><?= esc($s['status']) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>

</html>