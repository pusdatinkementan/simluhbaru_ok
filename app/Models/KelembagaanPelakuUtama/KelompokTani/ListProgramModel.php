<?php

namespace App\Models\KelembagaanPelakuUtama\KelompokTani;

use CodeIgniter\Model;
use \Config\Database;

class ListProgramModel extends Model
{
    protected $table      = 'tb_bantuan';
    protected $primaryKey = 'idban';
    protected $allowedFields = ['id_poktan', 'volume', 'tahun', 'kegiatan', 'sk_cpl   '];


    protected $useTimestamps = false;


    public function getListProgram($id_poktan)
    {
        $db = Database::connect();
        $query = "SELECT * FROM tb_poktan_jns_kel WHERE id_poktan = '" . $id_poktan . "'";
        $query = $db->query($query);
        $row   = $query->getResultArray();
        return $row;
    }
    public function getDataById($id_poktan)
    {
        $query = $this->db->query("select * from tb_bantuan where idban= '" . $id_poktan . "' 
                                ORDER BY tahun ");
        $row = $query->getRow();
        return json_encode($row);
    }
    public function getKegiatan()
    {
        $query = $this->db->query("select * from mast_kegiatan");
        $row2 = $query->getResultArray();
        return ($row2);
    }
}
