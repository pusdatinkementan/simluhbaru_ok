<?php

namespace App\Models\KelembagaanPenyuluhan\Kecamatan;

use CodeIgniter\Model;
use \Config\Database;

class PotensiWilayahModel extends Model
{
    protected $table      = 'tb_bpp_potensi';
    protected $primaryKey = 'id_potensi';
    protected $allowedFields = ['id_bpp', 'kode_komoditas', 'luas_lhn'];
}
