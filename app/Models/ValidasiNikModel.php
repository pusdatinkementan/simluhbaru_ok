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

    public function saveNIK($data, $id)
    {
        // $nik = $data['no_ktp'];

        $db = db_connect();
        $builder = $db->table('tbl_log');
        $builder->where('NO_KTP', $id)->update($data);

        // if (isset($nik)) {

        // } else {
        //     $db = db_connect();
        //     $builder = $db->table('tbl_log');
        //     $builder->insert($data);
        // }
    }
}
