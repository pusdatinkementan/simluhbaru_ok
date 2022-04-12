<?php

namespace App\Models;

use CodeIgniter\Model;
use \Config\Database;

class ValidasiNikModel extends Model
{

    public function getNikPetani($nik)
    {
        $db = db_connect();
        $builder = $db->table('sim_padan');
        $builder = $builder->where('NO_KTP', $nik);
        $row = $builder->get();
        $json = $row->getRowArray();
        return json_encode($json);
    }

    public function getAllNoHpEmpty()
    {
        if (empty(session()->get('status_user')) || session()->get('status_user') == '99') {
            // $session = session()->get('userid');
        } elseif (session()->get('status_user') == '1') {
            $query = $this->db->query("SELECT * FROM tbldasar WHERE hp = '' AND satminkal = '" . session()->get('kodebakor') . "' and status not IN('1','2') ");
        } elseif (session()->get('status_user') == '4') {
        } elseif (session()->get('status_user') == '200') {
            $queryCount = $this->db->query("SELECT count(*) as jmlnohp FROM tbldasar WHERE hp = '' AND satminkal = '" . session()->get('kodebapel') . "' and status not IN('1','2') ");
            $query = $this->db->query("SELECT * FROM tbldasar WHERE hp = '' AND satminkal = '" . session()->get('kodebapel') . "' and status not IN('1','2') ");
        } elseif (session()->get('status_user') == '300') {
            $queryCount = $this->db->query("SELECT count(*) as jmlnohp FROM tbldasar WHERE hp = '' AND satminkal = '" . session()->get('kodebapel') . "' and status not IN('1','2') ");
            $query = $this->db->query("SELECT * FROM tbldasar WHERE hp = '' AND kecamatan_tugas = '" .  session()->get('kodebpp') . "' and status not IN('1','2') ");
        }

        $result = $query->getResultArray();
        $row = $queryCount->getRowArray();

        $data = [
            'jmlnohp' => $row['jmlnohp'],
            'table_data' => $result
        ];
        return $data;
    }

    public function getAllNipUnmatch()
    {
        if (empty(session()->get('status_user')) || session()->get('status_user') == '99') {
            // $session = session()->get('userid');
        } elseif (session()->get('status_user') == '1') {
            $query = $this->db->query("SELECT * FROM tbldasar WHERE hp LENGTH(TRIM(nip)) <> 18 AND satminkal = '" . session()->get('kodebakor') . "' and status not IN('1','2') ");
        } elseif (session()->get('status_user') == '4') {
        } elseif (session()->get('status_user') == '200') {
            $queryCount = $this->db->query("SELECT count(*) as jmlnip FROM tbldasar WHERE LENGTH(TRIM(nip)) <> 18 AND satminkal = '" . session()->get('kodebapel') . "' ");
            $query = $this->db->query("SELECT * FROM tbldasar WHERE LENGTH(TRIM(nip)) <> 18 AND satminkal = '" . session()->get('kodebapel') . "' ");
        } elseif (session()->get('status_user') == '300') {
            $queryCount = $this->db->query("SELECT count(*) as jmlnip FROM tbldasar WHERE LENGTH(TRIM(nip)) <> 18 AND satminkal = '" . session()->get('kodebapel') . "' ");
            $query = $this->db->query("SELECT * FROM tbldasar WHERE LENGTH(TRIM(nip)) <> 18 AND kecamatan_tugas = '" .  session()->get('kodebpp') . "' ");
        }

        $result = $query->getResultArray();
        $row = $queryCount->getRowArray();

        $data = [
            'jmlnip' => $row['jmlnip'],
            'table_data' => $result
        ];
        return $data;
    }
}
