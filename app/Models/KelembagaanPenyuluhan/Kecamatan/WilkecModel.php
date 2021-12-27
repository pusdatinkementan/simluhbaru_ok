<?php

namespace App\Models\KelembagaanPenyuluhan\Kecamatan;

use CodeIgniter\Model;
use \Config\Database;

class WilkecModel extends Model
{
    protected $table      = 'tblbpp_wil_kec';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kode_bp3k', 'kode_prop', 'satminkal', 'kecamatan', 'jum_petani'];
}
