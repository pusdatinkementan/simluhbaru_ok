<?php

namespace App\Models\KelembagaanPelakuUtama\KelembagaanEkonomiPetani;

use CodeIgniter\Model;
use \Config\Database;

class KegiatanBunModel extends Model
{
    protected $table      = 'tb_kep_usaha_bun';
    protected $primaryKey = 'id_usaha';
    protected $allowedFields = ['id_kep', 'kode_komoditas_bun', 'volume_bun'];


    protected $useTimestamps = false;

    public function getKegiatanBun($id_kep)
    {
        $db = Database::connect();


        $query   = $db->query("SELECT *, b.id_usaha, b.id_kep, b.volume_bun, b.kode_komoditas_bun
        FROM tb_komoditas a
        left join tb_kep_usaha_bun b on a.kode_komoditas = b.kode_komoditas_bun 
        left join tb_kep c on b.id_kep = c.id_kep
        where b.id_kep = '$id_kep'");
        $results = $query->getResultArray();
        $data =  [
            'kebun' => $results,

        ];

        return $data;
    }

    public function getBun()
    {
        $query = $this->db->query("select * from tb_komoditas where id_sub_sektor = '3' order by id_sub_sektor");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getDataById($id_usaha)
    {
        $query = $this->db->query("select * from tb_kep_usaha_bun where id_usaha = '" . $id_usaha . "' 
                                ");
        $row = $query->getRow();
        return json_encode($row);
    }
    public function getKomoditas()
    {
        $query = $this->db->query("select * from tb_komoditas where id_sub_sektor = '3'");
        $row2   = $query->getResultArray();
        return $row2;
    }
}