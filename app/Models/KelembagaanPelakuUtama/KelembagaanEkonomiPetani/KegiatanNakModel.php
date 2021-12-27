<?php

namespace App\Models\KelembagaanPelakuUtama\KelembagaanEkonomiPetani;

use CodeIgniter\Model;
use \Config\Database;

class KegiatanNakModel extends Model
{
    protected $table      = 'tb_kep_usaha_nak';
    protected $primaryKey = 'id_usaha';
    protected $allowedFields = ['id_kep', 'kode_komoditas_nak', 'volume_nak'];


    protected $useTimestamps = false;

    public function getKegiatanNak($id_kep)
    {
        $db = Database::connect();


        $query   = $db->query("SELECT *, b.id_usaha, b.id_kep, b.volume_nak, b.kode_komoditas_nak
        FROM tb_komoditas a
        left join tb_kep_usaha_nak b on a.kode_komoditas = b.kode_komoditas_nak 
        left join tb_kep c on b.id_kep = c.id_kep
        where b.id_kep = '$id_kep'");
        $results = $query->getResultArray();
        $data =  [
            'ternak' => $results,

        ];

        return $data;
    }

    public function getNak()
    {
        $query = $this->db->query("select * from tb_komoditas where id_sub_sektor = '4' order by id_sub_sektor");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getDataById($id_usaha)
    {
        $query = $this->db->query("select * from tb_kep_usaha_nak where id_usaha= '" . $id_usaha . "' 
                                ORDER BY id_usaha ");
        $row = $query->getRow();
        return json_encode($row);
    }
    public function getKomoditas()
    {
        $query = $this->db->query("select * from tb_komoditas where id_sub_sektor= '4'");
        $row2   = $query->getResultArray();
        return $row2;
    }
}