<?php

namespace App\Models\KelembagaanPenyuluhan\Kecamatan;

use CodeIgniter\Model;
use \Config\Database;

class DAKModel extends Model
{
    protected $table      = 'tblbpp_dak';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_bpp', 'tahun_dak'];
}
