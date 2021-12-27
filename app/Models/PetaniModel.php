<?php

namespace App\Models;

use CodeIgniter\Model;
use \Config\Database;

class PetaniModel extends Model
{

    public function getAllNikUnmatch()
    {
        if (empty(session()->get('status_user')) || session()->get('status_user') == '99') {
            $session = session()->get('userid');
        } elseif (session()->get('status_user') == '1') {
            $query = $this->db->query("SELECT * FROM tbldasar WHERE LENGTH(TRIM(noktp)) <> 16 AND satminkal = '" . session()->get('kodebakor') . "' ");
        } elseif (session()->get('status_user') == '4') {
        } elseif (session()->get('status_user') == '200') {
            $queryCount = $this->db->query("SELECT count(*) as jmlnoktp FROM tbldasar WHERE LENGTH(TRIM(noktp)) <> 16 AND satminkal = '" . session()->get('kodebapel') . "' ");
            $query = $this->db->query("SELECT * FROM tbldasar WHERE LENGTH(TRIM(noktp)) <> 16 AND satminkal = '" . session()->get('kodebapel') . "' ");
        } elseif (session()->get('status_user') == '300') {
            $queryCount = $this->db->query("SELECT count(*) as jmlnoktp FROM tbldasar WHERE LENGTH(TRIM(noktp)) <> 16 AND satminkal = '" . session()->get('kodebapel') . "' ");
            $query = $this->db->query("SELECT * FROM tbldasar WHERE LENGTH(TRIM(noktp)) <> 16 AND kecamatan_tugas = '" .  session()->get('kodebpp') . "' ");
        }

        $result = $query->getResultArray();
        $row = $queryCount->getRowArray();

        $data = [
            'jmlnoktp' => $row['jmlnoktp'],
            'table_data' => $result
        ];
        return $data;
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
