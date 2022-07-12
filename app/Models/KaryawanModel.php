<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table            = 'karyawan';
    protected $primaryKey       = 'id_karyawan';
    protected $useSoftDeletes   = true;
    protected $useTimestamps = true;
    protected $allowedFields    = ['nama_karyawan'];

    // Validation
    protected $validationRules      = [
        'nama_karyawan' => 'required|max_length[100]|is_unique[karyawan.nama_karyawan,id_karyawan,{id}]',
    ];
    protected $validationMessages   = [
        'nama_karyawan' => [
            'required'  => 'nama harus di isi',
            'is_unique' => 'nama karyawan sudah ada didatabase'
        ]
    ];
    protected $skipValidation       = false;
}
