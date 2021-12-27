<?php

namespace App\Models\penyuluh;

use CodeIgniter\Model;
use \Config\Database;

class PendInFormalPnsModel extends Model
{
    protected $table      = 'tblinformal';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nip', 'nama', 'kelompok', 'lokasi', 'tgl_mulai', 'tgl_selesai', 'penyelenggara', 'jml_jam',
        'satminkal', 'tgl_update'
    ];

    public function getPendInFormalPnsTotalDetail($nip)
    {
        $db = Database::connect();

        $query   = $db->query("select a.id, a.nip, a.nama, a.kelompok, a.lokasi, a.tgl_mulai, a.tgl_selesai, a.penyelenggara, a.jml_jam,
a.satminkal, a.tgl_update from tblinformal a
                                WHERE a.nip = '$nip'");
        $row   = $query->getRowArray();
        return $row;
    }

    public function getPendInFormalPnsTotal($nip)
    {
        $db = Database::connect();

        $query   = $db->query("select a.id, a.nip, a.nama, a.kelompok, a.lokasi, a.tgl_mulai, a.tgl_selesai, a.penyelenggara, a.jml_jam,
a.satminkal, a.tgl_update from tblinformal a
                                where a.nip='$nip' order by nama");
        $results = $query->getResultArray();

        $data =  [
            'table_data' => $results
        ];

        return $data;
    }

    public function getDetailEdit($id)
    {
        $query = $this->db->query("select a.id, a.nip, a.nama, a.kelompok, a.lokasi, a.tgl_mulai, a.tgl_selesai, a.penyelenggara, a.jml_jam,
        a.satminkal, a.tgl_update from tblinformal a
        where id = '" . $id . "'");
        $row = $query->getRow();
        return json_encode($row);
    }

    public function getDiklat()
    {
        $query = $this->db->query("select * from tbldiklat_item");
        $row   = $query->getResultArray();
        return $row;
    }
}
