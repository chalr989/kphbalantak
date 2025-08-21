<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KwitansiLsModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class KwitansiLs extends BaseController
{
    protected $kwitansiLsModel;

    public function __construct()
    {
        $this->kwitansiLsModel = new KwitansiLsModel();
    }

    public function index()
    {
        $data['kwitansi_ls'] = $this->kwitansiLsModel
            ->orderBy('nomor_kwitansi', 'ASC')
            ->findAll();

        return view('kwitansi_ls/index', $data);
    }

    public function create()
    {
        return view('kwitansi_ls/create');
    }

    public function store()
    {
        $this->kwitansiLsModel->save([
            'nomor_kwitansi'    => $this->request->getPost('nomor_kwitansi'),
            'tanggal'           => $this->request->getPost('tanggal'),
            'penerima'          => $this->request->getPost('penerima'),
            'jumlah'            => $this->request->getPost('jumlah'),
            'keterangan'        => $this->request->getPost('keterangan'),
        ]);

        return redirect()->to(base_url('kwitansi_ls'))->with('success', 'Data Kwitansi berhasil disimpan.');
    }

    public function edit($id)
    {
        $data['kwitansi_ls'] = $this->kwitansiLsModel->find($id);
        return view('kwitansi_ls/edit', $data);
    }

    public function update($id)
    {
        $this->kwitansiLsModel->update($id, [
            'nomor_kwitansi'    => $this->request->getPost('nomor_kwitansi'),
            'tanggal'           => $this->request->getPost('tanggal'),
            'penerima'          => $this->request->getPost('penerima'),
            'jumlah'            => $this->request->getPost('jumlah'),
            'keterangan'        => $this->request->getPost('keterangan'),
        ]);

        return redirect()->to(base_url('kwitansi_ls'))->with('success', 'Data kwitansi berhasil diupdate.');
    }

    public function delete($id)
    {
        $this->kwitansiLsModel->delete($id);
        return redirect()->to(base_url('kwitansi_ls'))->with('success', 'Data kwitansi berhasil dihapus.');
    }


    public function cetak($id)
    {
        $kwitansils = $this->kwitansiLsModel->find($id);

        if (!$kwitansils) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Data kwitansi tidak ditemukan");
        }

        // Load view kwitansi cetak
        $html = view('kwitansi_ls/cetak', ['kwitansi_ls' => $kwitansils]);

        // Konfigurasi DomPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Nama file otomatis dengan nomor kwitansi
        $filename = 'kwitansi_ls' . $kwitansils['nomor_kwitansi'] . '.pdf';

        $dompdf->stream($filename, ["Attachment" => false]); // langsung tampil di browser
        exit();
    }
}
