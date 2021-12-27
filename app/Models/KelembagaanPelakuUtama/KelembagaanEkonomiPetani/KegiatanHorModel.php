<?php

namespace App\Models\KelembagaanPelakuUtama\KelembagaanEkonomiPetani;

use CodeIgniter\Model;
use \Config\Database;

class KegiatanHorModel extends Model
{
    protected $table      = 'tb_kep_usaha_hor';
    protected $primaryKey = 'id_usaha';
    protected $allowedFields = ['id_kep', 'kode_komoditas_hor', 'volume_hor'];


    protected $useTimestamps = false;

    public function getKegiatanHor($id_kep)
    {
        $db = Database::connect();


        $query   = $db->query("SELECT * ,b.id_usaha, b.id_kep, b.volume_hor, b.kode_komoditas_hor
        FROM tb_komoditas a
        left join tb_kep_usaha_hor b on a.kode_komoditas = b.kode_komoditas_hor 
        left join tb_kep c on b.id_kep = c.id_kep
        where b.id_kep = '$id_kep'");
        $results = $query->getResultArray();
        $data =  [
            'horti' => $results,

        ];

        return $data;
    }

    public function getHor()
    {
        $query = $this->db->query("select * from tb_komoditas where id_sub_sektor = '2' order by id_sub_sektor");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getDataById($id_usaha)
    {
        $query = $this->db->query("select * from tb_kep_usaha_hor where id_usaha= '" . $id_usaha . "' 
                                ORDER BY id_usaha ");
        $row = $query->getRow();
        return json_encode($row);
    }
    public function getKomoditas()
    {
        $query = $this->db->query("select * from tb_komoditas where id_sub_sektor='2'");
        $row2   = $query->getResultArray();
        return $row2;
    }
}