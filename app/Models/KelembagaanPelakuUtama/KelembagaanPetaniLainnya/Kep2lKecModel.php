<?php

namespace App\Models\KelembagaanPelakuUtama\KelembagaanPetaniLainnya;

use CodeIgniter\Model;
use \Config\Database;

class Kep2lKecModel extends Model
{
 

    protected $useTimestamps = false;
   


    public function getKep2lKecTotal($kode_bpp)
    {
        $db = Database::connect();
        $query = $db->query("select nama_bpp as nama_bpp from tblbpp where kecamatan='$kode_bpp'");
        $row   = $query->getRow();
        $query2 = $db->query("SELECT count(id_poktan) as jum FROM tb_poktan where kode_kab ='$kode_bpp'");
        $row2   = $query2->getRow();
        $query3   = $db->query("select a.id_daerah,a.deskripsi, count(id_poktan) and simluh_jenis_kelompok='P2L' as jum  ,b.id_poktan 
                                 from tbldaerah  a
                                 left join tb_poktan b on a.id_daerah=b.kode_kec
                                 where id_daerah='$kode_bpp'");
       $results = $query3->getResultArray();

        $data =  [
            'nama_bpp' => $row->nama_bpp,
           'table_data' => $results,
           'jum' => $row2->jum
        ];

        return $data;
    }
}
