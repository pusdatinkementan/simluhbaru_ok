<?php

namespace App\Models\KelembagaanPelakuUtama\KelembagaanEkonomiPetani;

use CodeIgniter\Model;
use \Config\Database;

class KelembagaanEkonomiPetaniModel extends Model
{
   
 
    protected $useTimestamps = false;
 


    public function getKelembagaanEkonomiPetaniTotal($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select nama_dati2 as nama_kab from tbldati2 where id_dati2='$kode_kab'");
        $row   = $query->getRow();

        $query2   = $db->query("select id_daerah, deskripsi, count(id_kep) as jum 
                                from tbldaerah a
                                left join tb_kep b on a.id_daerah=b.kode_kec and b.kode_kab='$kode_kab'
                                where id_dati2='$kode_kab'
                                group by id_daerah, deskripsi
                                order by deskripsi");
        $results = $query2->getResultArray();

        $data =  [
            
            'nama_kab' => $row->nama_kab,
            'table_data' => $results,
        ];

        return $data;
    }
}
