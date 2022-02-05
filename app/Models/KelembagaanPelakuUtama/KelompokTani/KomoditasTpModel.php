<?php

namespace App\Models\KelembagaanPelakuUtama\KelompokTani;

use CodeIgniter\Model;
use \Config\Database;

class KomoditasTpModel extends Model
{
    protected $table      = 'tb_poktan_usaha_tp';
    protected $primaryKey = 'id_usaha';
    protected $allowedFields = ['id_poktan', 'kode_komoditas_tp', 'sektor'];


    protected $useTimestamps = false;

    public function getKomoditasTp($ip)
    {

        $db = Database::connect();


        $query   = $db->query("SELECT *, b.id_usaha, b.id_poktan, b.sektor, b.kode_komoditas_tp
        FROM tb_komoditas a
        left join tb_poktan_usaha_tp b on a.kode_komoditas = b.kode_komoditas_tp 
        left join tb_poktan c on b.id_poktan = c.id_poktan
        where b.id_poktan = '$ip'");
        $results = $query->getResultArray();
        $data =  [
            'tapang' => $results,

        ];

        return $data;
    }

    public function getTp()
    {
        $query = $this->db->query("select * from tb_komoditas where id_sub_sektor = '1' order by id_sub_sektor");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getDataById($id_usaha)
    {
        $query = $this->db->query("select * from tb_poktan_usaha_tp where id_usaha= '" . $id_usaha . "' 
                                ORDER BY id_usaha");
        $row = $query->getRow();
        return json_encode($row);
    }
    public function getKomoditas()
    {
        $query = $this->db->query("select * from tb_komoditas where id_sub_sektor = '4'");
        $row2   = $query->getResultArray();
        return $row2;
    }
}
