<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratModel extends Model
{
    protected $table            = 'surat';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'nomor_surat',
        'tanggal_surat',
        'jenis',
        'asal_tujuan',
        'perihal',
        'isi_ringkas',
        'lampiran_file',
        'status'
    ];
    protected $useTimestamps    = true; // otomatis isi created_at & updated_at
    protected $returnType       = 'array';

    // 🔍 Fungsi pencarian
    public function search($keyword = null, $jenis = null)
    {
        $builder = $this->builder();
        if ($keyword) {
            $builder->groupStart()
                ->like('nomor_surat', $keyword)
                ->orLike('asal_tujuan', $keyword)
                ->orLike('perihal', $keyword)
                ->groupEnd();
        }
        if ($jenis) {
            $builder->where('jenis', $jenis);
        }
        return $builder;
    }

    // 🔢 Auto nomor surat keluar
    public function generateNomorSuratKeluar()
    {
        $last = $this->where('jenis', 'keluar')->orderBy('id', 'DESC')->first();
        $next = $last ? intval(preg_replace('/[^0-9]/', '', $last['nomor_surat'])) + 1 : 1;

        $bulan = date('m');
        $tahun = date('Y');
        return sprintf("OUT/%03d/%s/%s", $next, $bulan, $tahun);
    }
}
