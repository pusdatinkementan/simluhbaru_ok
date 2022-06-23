<?php

namespace App\Models\KelembagaanPelakuUtama\KelompokTani;

use CodeIgniter\Model;
use \Config\Database;

class ListJnsKelModel extends Model
{
    protected $table      = 'tb_poktan_master_jns_kel';
    protected $primaryKey = 'id_kel';
    protected $allowedFields = ['jns_kel', 'created_at', 'updated_at'];


    protected $useTimestamps = false;


    public function getListJnsKel()
    {
        $db = Database::connect();
        $query = "SELECT * FROM tb_poktan_master_jns_kel ORDER BY id_kel ";
        $query = $db->query($query);
        $row   = $query->getResultArray();
        return $row;
    }

    public function getDataById($id)
    {
        $query = $this->db->query("SELECT * FROM tb_poktan_master_jns_kel WHERE id_kel = '" . $id . "' ORDER BY id_kel ");
        $row = $query->getRow();
        return json_encode($row);
    }

    public function getJnsKelByPoktan($id)
    {
        $db = Database::connect();
        $query = "SELECT a.*, b.jns_kel, c.nama_poktan FROM tb_list_poktan_jnskel a LEFT JOIN tb_poktan_master_jns_kel b on a.id_jns_kel = b.id_kel 
        LEFT JOIN tb_poktan c on a.id_poktan = c.id_poktan WHERE a.id_poktan = '" . $id . "'";
        $query = $db->query($query);
        $row   = $query->getResultArray();
        return $row;
    }

    public function getPoktanById($id)
    {
        $db = Database::connect();
        $query = "SELECT * FROM tb_poktan WHERE id_poktan = '" . $id . "'";
        $query = $db->query($query);
        $row   = $query->getRowArray();
        return $row;
    }

    public function saveJnskel($data)
    {
        $db = db_connect();
        $builder = $db->table('tb_list_poktan_jnskel');
        $builder->insert($data);
    }

    public function getDataByIdListKel($id)
    {
        $query = $this->db->query("SELECT * FROM tb_list_poktan_jnskel WHERE id_list = '" . $id . "'");
        $row = $query->getRow();
        return json_encode($row);
    }

    public function updateJnskel($id, $data)
    {
        $db = db_connect();
        $builder = $db->table('tb_list_poktan_jnskel');
        $builder->where('id_list', $id)->update($data);
    }

    public function deleteJnsKel($id)
    {
        $db = db_connect();
        $builder = $db->table('tb_list_poktan_jnskel');
        $builder->where('id_list', $id)->delete();
    }
}
