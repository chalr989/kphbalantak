<?php

namespace App\Controllers;

use App\Models\SuratModel;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Surat extends BaseController
{
    protected $suratModel;

    public function __construct()
    {
        $this->suratModel = new SuratModel();
    }

    // 📑 Tampilkan daftar surat
    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        $jenis   = $this->request->getGet('jenis');

        $query = $this->suratModel->search($keyword, $jenis);

        $data['surat'] = $this->suratModel->paginate(10);
        $data['pager'] = $this->suratModel->pager;

        return view('surat/index', $data);
    }


    // ➕ Tambah Surat
    public function create()
    {
        return view('surat/create');
    }

    public function store()
    {
        $fileLampiran = $this->request->getFile('lampiran_file');
        $lampiranName = null;

        if ($fileLampiran && $fileLampiran->isValid() && !$fileLampiran->hasMoved()) {
            $lampiranName = $fileLampiran->getRandomName();
            $fileLampiran->move('uploads', $lampiranName);
        }

        $this->suratModel->save([
            'nomor_surat'   => $this->request->getPost('nomor_surat'),
            'tanggal_surat' => $this->request->getPost('tanggal_surat'),
            'jenis'         => $this->request->getPost('jenis'),
            'asal_tujuan'   => $this->request->getPost('asal_tujuan'),
            'perihal'       => $this->request->getPost('perihal'),
            'status'        => $this->request->getPost('status'),
            'lampiran_file' => $lampiranName
        ]);

        return redirect()->to('/surat')->with('success', 'Surat berhasil ditambahkan!');
    }

    // ✏️ Edit Surat
    public function edit($id)
    {
        $surat = $this->suratModel->find($id);

        if (!$surat) {
            return redirect()->to('/surat')->with('error', 'Data surat tidak ditemukan.');
        }

        return view('surat/edit', ['surat' => $surat]);
    }

    // 🔄 Update Surat
    public function update($id)
    {
        $surat = $this->suratModel->find($id);

        if (!$surat) {
            return redirect()->to('/surat')->with('error', 'Data surat tidak ditemukan.');
        }

        $fileLampiran = $this->request->getFile('lampiran_file');
        $lampiranName = $surat['lampiran_file']; // pakai file lama jika tidak diganti

        if ($fileLampiran && $fileLampiran->isValid() && !$fileLampiran->hasMoved()) {
            // hapus file lama kalau ada
            if ($lampiranName && file_exists('uploads/' . $lampiranName)) {
                unlink('uploads/' . $lampiranName);
            }
            $lampiranName = $fileLampiran->getRandomName();
            $fileLampiran->move('uploads', $lampiranName);
        }

        $this->suratModel->update($id, [
            'nomor_surat'   => $this->request->getPost('nomor_surat'),
            'tanggal_surat' => $this->request->getPost('tanggal_surat'),
            'jenis'         => $this->request->getPost('jenis'),
            'asal_tujuan'   => $this->request->getPost('asal_tujuan'),
            'perihal'       => $this->request->getPost('perihal'),
            'status'        => $this->request->getPost('status'),
            'lampiran_file' => $lampiranName
        ]);

        return redirect()->to('/surat')->with('success', 'Surat berhasil diperbarui!');
    }

    // 🗑️ Hapus Surat
    public function delete($id)
    {
        $surat = $this->suratModel->find($id);

        if ($surat) {
            // hapus file lampiran juga
            if ($surat['lampiran_file'] && file_exists('uploads/' . $surat['lampiran_file'])) {
                unlink('uploads/' . $surat['lampiran_file']);
            }
            $this->suratModel->delete($id);
        }

        return redirect()->to('/surat')->with('success', 'Surat berhasil dihapus!');
    }


    public function exportPdf()
    {
        $surat = $this->suratModel->findAll();

        // Load view sebagai HTML
        $html = view('surat/pdf', ['surat' => $surat]);

        // Inisialisasi DomPDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Download PDF
        $dompdf->stream('Daftar_Surat.pdf', ['Attachment' => true]);
    }

    public function exportExcel()
    {
        $surat = $this->suratModel->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nomor Surat');
        $sheet->setCellValue('C1', 'Tanggal');
        $sheet->setCellValue('D1', 'Jenis');
        $sheet->setCellValue('E1', 'Asal/Tujuan');
        $sheet->setCellValue('F1', 'Perihal');
        $sheet->setCellValue('G1', 'Status');

        $row = 2;
        $no = 1;
        foreach ($surat as $s) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $s['nomor_surat']);
            $sheet->setCellValue('C' . $row, $s['tanggal_surat']);
            $sheet->setCellValue('D' . $row, $s['jenis']);
            $sheet->setCellValue('E' . $row, $s['asal_tujuan']);
            $sheet->setCellValue('F' . $row, $s['perihal']);
            $sheet->setCellValue('G' . $row, $s['status']);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Daftar_Surat.xlsx"');
        $writer->save('php://output');
        exit;
    }
}
