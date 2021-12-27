<?php

namespace App\Models\KelembagaanPenyuluhan\Kecamatan;

use CodeIgniter\Model;
use \Config\Database;

class PenghargaanModel extends Model
{
    protected $table      = 'tblbpp_penghargaan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kode_bp3k', 'kode_prop', 'satminkal', 'nama_penghargaan', 'peringkat', 'tingkat', 'tahun'];
}
