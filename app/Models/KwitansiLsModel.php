<?php

namespace App\Models;

use CodeIgniter\Model;

class KwitansiLsModel extends Model
{
    protected $table            = 'kwitansi_ls';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'nomor_kwitansi',
        'tanggal',
        'penerima',
        'jumlah',
        'keterangan',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
