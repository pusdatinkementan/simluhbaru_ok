<?php

namespace App\Models\KelembagaanPenyuluhan\Kabupaten;

use CodeIgniter\Model;
use \Config\Database;

class FasilitasiBapelModel extends Model
{
    protected $table      = 'tblbapel_fasilitasi_kegiatan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'id_bapel', 'tahun', 'fasilitasi', 'kegiatan'];
}
