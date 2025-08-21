<?php

namespace App\Models;

use CodeIgniter\Model;

class SppdModel extends Model
{
    protected $table            = 'sppd';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'nomor_spt',
        'nomor_sppd',
        'tanggal',
        'pelaksana',
        'perihal',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
