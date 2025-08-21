<?php

namespace App\Controllers;

use App\Models\KwitansiModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class Kwitansi extends BaseController
{
    protected $kwitansiModel;

    public function __construct()
    {
        $this->kwitansiModel = new KwitansiModel();
    }

    public function index()
    {
        $data['kwitansi'] = $this->kwitansiModel
            ->orderBy('nomor_kwitansi', 'ASC')
            ->findAll();

        return view('kwitansi/index', $data);
    }

    public function create()
    {
        return view('kwitansi/create');
    }

    public function store()
    {
        $this->kwitansiModel->save([
            'nomor_kwitansi'   => $this->request->getPost('nomor_kwitansi'),
            'tanggal' => $this->request->getPost('tanggal'),
            'penerima'         => $this->request->getPost('penerima'),
            'jumlah'           => $this->request->getPost('jumlah'),
            'keterangan'       => $this->request->getPost('keterangan'),
        ]);

        return redirect()->to(base_url('kwitansi'))->with('success', 'Data kwitansi berhasil disimpan.');
    }

    public function edit($id)
    {
        $data['kwitansi'] = $this->kwitansiModel->find($id);
        return view('kwitansi/edit', $data);
    }

    public function update($id)
    {
        $this->kwitansiModel->update($id, [
            'nomor_kwitansi'   => $this->request->getPost('nomor_kwitansi'),
            'tanggal' => $this->request->getPost('tanggal'),
            'penerima'         => $this->request->getPost('penerima'),
            'jumlah'           => $this->request->getPost('jumlah'),
            'keterangan'       => $this->request->getPost('keterangan'),
        ]);

        return redirect()->to(base_url('kwitansi'))->with('success', 'Data kwitansi berhasil diupdate.');
    }

    public function delete($id)
    {
        $this->kwitansiModel->delete($id);
        return redirect()->to(base_url('kwitansi'))->with('success', 'Data kwitansi berhasil dihapus.');
    }


    public function cetak($id)
    {
        $kwitansi = $this->kwitansiModel->find($id);

        if (!$kwitansi) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Data kwitansi tidak ditemukan");
        }

        // Load view kwitansi cetak
        $html = view('kwitansi/cetak', ['kwitansi' => $kwitansi]);

        // Konfigurasi DomPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Nama file otomatis dengan nomor kwitansi
        $filename = 'kwitansi_' . $kwitansi['nomor_kwitansi'] . '.pdf';

        $dompdf->stream($filename, ["Attachment" => false]); // langsung tampil di browser
        exit();
    }
}
