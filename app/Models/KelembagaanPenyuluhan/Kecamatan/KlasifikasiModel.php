<?php

namespace App\Models\KelembagaanPenyuluhan\Kecamatan;

use CodeIgniter\Model;
use \Config\Database;

class KlasifikasiModel extends Model
{
    protected $table      = 'tblbpp_klasifikasi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_bpp', 'tahun', 'klasifikasi', 'skor'];
}
