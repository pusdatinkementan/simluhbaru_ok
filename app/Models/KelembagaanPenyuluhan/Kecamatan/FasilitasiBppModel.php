<?php

namespace App\Models\KelembagaanPenyuluhan\Kecamatan;

use CodeIgniter\Model;
use \Config\Database;

class FasilitasiBppModel extends Model
{
    protected $table      = 'tblbpp_fasilitasi_kegiatan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'id_bpp', 'tahun', 'fasilitasi', 'kegiatan'];
}
