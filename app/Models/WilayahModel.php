<?php

namespace App\Models;

use CodeIgniter\Model;
use \Config\Database;

class WilayahModel extends Model
{

    public function getProv()
    {
        $query = $this->db->query("SELECT * FROM tblpropinsi ORDER BY id_prop");
        $row = $query->getResultArray();
        return $row;
    }

    public function getKab($id)
    {
        $query = $this->db->query("SELECT * FROM tbldati2 WHERE id_dati2 LIKE '" . $id . "%' ORDER BY id_dati2");
        $row = $query->getResultArray();
        //d($row);
        return $row;
    }

    public function getKec($id)
    {
        $query = $this->db->query("SELECT * FROM tbldaerah WHERE id_daerah LIKE '" . $id . "%' ORDER BY id_daerah");
        $row = $query->getResultArray();
        return $row;
    }

    public function getDesa($id)
    {
        $query = $this->db->query("SELECT * FROM tbldesa WHERE id_desa LIKE '" . $id . "%' ORDER BY id_desa");
        $row = $query->getResultArray();
        return $row;
    }
}
