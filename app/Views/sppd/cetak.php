<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>SPPD</title>
  <style>
    body {
      font-family: DejaVu Sans, sans-serif;
    }

    .header {
      text-align: center;
      margin-bottom: 20px;
    }

    .kwitansi-box {
      border: 2px solid #000;
      padding: 20px;
    }

    table {
      width: 100%;
      margin-top: 15px;
    }

    .ttd {
      margin-top: 50px;
      text-align: right;
    }
  </style>
</head>

<body>
  <div class="header">
    <h2>Surat Perintah Perjalanan Dinas (SPPD)</h2>
    <hr>
  </div>

  <div class="kwitansi-box">
    <p><strong>Nomor:</strong> <?= esc($sppd['nomor_spt']) ?></p>
    <p><strong>Nomor:</strong> <?= esc($sppd['nomor_sppd']) ?></p>
    <p><strong>Tanggal:</strong> <?= date('d-m-Y', strtotime($sppd['tanggal'])) ?></p>
    <p><strong>Telah diterima dari:</strong> <?= esc($sppd['pelaksana']) ?></p>
    <p><strong>Perihal:</strong> <?= esc($sppd['perihal']) ?></p>

    <div class="ttd">
      <p>..........................., <?= date('d-m-Y') ?></p>
      <br><br><br>
      <p>(_______________________)</p>
    </div>
  </div>
</body>

</html>