<?php

namespace App\Models;

use CodeIgniter\Model;
use \Config\Database;

class InfoModel extends Model
{
    protected $table      = 'tbl_info';

    protected $primaryKey = 'id';
    protected $returnType     = 'array';
    //protected $useSoftDeletes = true;

    protected $allowedFields = ['menu'];
    protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function getInfoAll()
    {
        $db = db_connect();
        $builder = $db->table('tbl_info');
        $builder = $builder->orderBy('tgl_info', 'DESC');
        $row = $builder->get();
        return $row->getResultArray();
    }
    public function getInfoByStatus()
    {
        $db = db_connect();
        $builder = $db->table('tbl_info');
        $builder = $builder->where('status_info', 1);
        $builder = $builder->orderBy('tgl_info', 'DESC');
        $builder = $builder->limit(5);
        $row = $builder->get();
        return $row->getResultArray();
    }

    public function getCountInfoToday()
    {
        $query = $this->db->query("select * from tbl_info where status_info = 1 and DATE(tgl_info) = CURDATE()");
        $row = $query->getNumRows();
        return $row;
    }

    public function updateInfo($id, $data)
    {
        $db = db_connect();
        $builder = $db->table('tbl_info');
        $builder->where('id_info', $id)->update($data);
    }

    public function saveInfo($data)
    {
        $db = db_connect();
        $builder = $db->table('tbl_info');
        $builder->insert($data);
    }

    public function deleteInfo($id)
    {
        $db = db_connect();
        $builder = $db->table('tbl_info');
        $builder->where('id_info', $id)->delete();
        // $builder->delete($id);
    }

    public function getInfoById($id)
    {
        $query = $this->db->query("SELECT * FROM user_menu WHERE id = '" . $id . "'");
        $row = $query->getRow();
        return json_encode($row);
    }
}
