<?php

namespace App\Controllers;

use App\Models\SuratModel;
use App\Models\KwitansiModel;
use App\Models\SppdModel;

class Home extends BaseController
{
    public function index()
    {
        $suratModel = new SuratModel();
        $kwitansiModel = new KwitansiModel();
        $sppdModel = new SppdModel();

        // Ambil tahun dari request, default tahun sekarang
        $tahun = $this->request->getGet('tahun') ?? date('Y');

        $data['tahun'] = $tahun;

        // Hitung total keseluruhan
        $data['suratMasuk']  = $suratModel->where('jenis', 'masuk')->where("YEAR(tanggal_surat)", $tahun)->countAllResults();
        $data['suratKeluar'] = $suratModel->where('jenis', 'keluar')->where("YEAR(tanggal_surat)", $tahun)->countAllResults();
        $data['totalKwitansi'] = $kwitansiModel->where("YEAR(tanggal)", $tahun)->countAllResults();
        $data['totalSppd'] = $sppdModel->where("YEAR(tanggal)", $tahun)->countAllResults();

        // Data bulanan
        $bulan = [];
        $suratMasukBulanan = [];
        $suratKeluarBulanan = [];
        $kwitansiBulanan = [];
        $sppdBulanan = [];

        for ($i = 1; $i <= 12; $i++) {
            $bulan[] = date("F", mktime(0, 0, 0, $i, 1));

            $suratMasukBulanan[] = $suratModel->where('jenis', 'masuk')
                ->where("MONTH(tanggal_surat)", $i)
                ->where("YEAR(tanggal_surat)", $tahun)
                ->countAllResults();

            $suratKeluarBulanan[] = $suratModel->where('jenis', 'keluar')
                ->where("MONTH(tanggal_surat)", $i)
                ->where("YEAR(tanggal_surat)", $tahun)
                ->countAllResults();

            $kwitansiBulanan[] = $kwitansiModel->where("MONTH(tanggal)", $i)
                ->where("YEAR(tanggal)", $tahun)
                ->countAllResults();

            $sppdBulanan[] = $sppdModel->where("MONTH(tanggal)", $i)
                ->where("YEAR(tanggal)", $tahun)
                ->countAllResults();
        }

        $data['bulan'] = $bulan;
        $data['suratMasukBulanan'] = $suratMasukBulanan;
        $data['suratKeluarBulanan'] = $suratKeluarBulanan;
        $data['kwitansiBulanan'] = $kwitansiBulanan;
        $data['sppdBulanan'] = $sppdBulanan;

        // Ambil daftar tahun unik dari surat & kwitansi
        $tahunSurat = $suratModel->select("YEAR(tanggal_surat) as tahun")->groupBy("tahun")->findAll();
        $tahunKwitansi = $kwitansiModel->select("YEAR(tanggal) as tahun")->groupBy("tahun")->findAll();
        $tahunSppd = $sppdModel->select("YEAR(tanggal) as tahun")->groupBy("tahun")->findAll();
        $tahunList = [];

        foreach ($tahunSurat as $ts) {
            $tahunList[] = $ts['tahun'];
        }
        foreach ($tahunKwitansi as $tk) {
            $tahunList[] = $tk['tahun'];
        }
        foreach ($tahunSppd as $tp) {
            $tahunList[] = $tp['tahun'];
        }
        $data['tahunList'] = array_unique($tahunList);

        return view('dashboard', $data);
    }
}
