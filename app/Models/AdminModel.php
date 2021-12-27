<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{

    //protected $table = 'tblbapel';

    //  protected $db = \Config\Database::connect();

    public function getProfil($id)
    {
        $query = $this->db->query("SELECT * FROM tbluser where `status` = $id");
        $row   = $query->getRowArray();
        return $row;
    }

    public function saveProfil($data)
    {
        $db = db_connect();
        $builder = $db->table('tbluser');
        $builder->where('id', session()->get('userid'))->update($data);
    }
}
