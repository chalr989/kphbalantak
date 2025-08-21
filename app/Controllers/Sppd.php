<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SppdModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class Sppd extends BaseController
{
    protected $sppdModel;

    public function __construct()
    {
        $this->sppdModel = new SppdModel();
    }

    public function index()
    {
        $data['sppd'] = $this->sppdModel
            ->orderBy('nomor_sppd', 'ASC')
            ->findAll();

        return view('sppd/index', $data);
    }

    public function create()
    {
        return view('sppd/create');
    }

    public function store()
    {
        $this->sppdModel->save([
            'nomor_spt'   => $this->request->getPost('nomor_spt'),
            'nomor_sppd'   => $this->request->getPost('nomor_sppd'),
            'tanggal' => $this->request->getPost('tanggal'),
            'pelaksana'         => $this->request->getPost('pelaksana'),
            'perihal'       => $this->request->getPost('perihal'),
        ]);

        return redirect()->to(base_url('sppd'))->with('success', 'Data sppd berhasil disimpan.');
    }

    public function edit($id)
    {
        $data['sppd'] = $this->sppdModel->find($id);
        return view('sppd/edit', $data);
    }

    public function update($id)
    {
        $this->sppdModel->update($id, [
            'nomor_spt'   => $this->request->getPost('nomor_spt'),
            'nomor_sppd'   => $this->request->getPost('nomor_sppd'),
            'tanggal' => $this->request->getPost('tanggal'),
            'pelaksana'         => $this->request->getPost('pelaksana'),
            'perihal'       => $this->request->getPost('perihal'),
        ]);

        return redirect()->to(base_url('sppd'))->with('success', 'Data sppd berhasil diupdate.');
    }

    public function delete($id)
    {
        $this->sppdModel->delete($id);
        return redirect()->to(base_url('sppd'))->with('success', 'Data SPPD berhasil dihapus.');
    }


    public function cetak($id)
    {
        $sppd = $this->sppdModel->find($id);

        if (!$sppd) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Data SPPD tidak ditemukan");
        }

        // Load view sppd cetak
        $html = view('sppd/cetak', ['sppd' => $sppd]);

        // Konfigurasi DomPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Nama file otomatis dengan nomor sppd
        $filename = 'sppd_' . $sppd['nomor_sppd'] . '.pdf';

        $dompdf->stream($filename, ["Attachment" => false]); // langsung tampil di browser
        exit();
    }
}
