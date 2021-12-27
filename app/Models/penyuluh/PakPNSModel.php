<?php

namespace App\Models\penyuluh;

use CodeIgniter\Model;
use \Config\Database;

class PakPNSModel extends Model
{
    protected $table      = 'tblpak';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nip', 'kredit_utama', 'kredit_penunjang', 'gol', 'tgl_nilai', 'tgl_nilai2', 'tgl_spk', 'no_sk',
        'pejabat', 'satminkal', 'tgl_update'
    ];


    public function getPakPNSTotal($nip)
    {
        $db = Database::connect();

        $query   = $db->query("select a.id, a.nip, a.kredit_utama, a.kredit_penunjang, a.gol, a.tgl_nilai, a.tgl_nilai2, a.tgl_spk, a.no_sk,
                                a.pejabat, a.satminkal, a.tgl_update, b.nama, b.gol_ruang from tblpak a
                                left join tblpp b on a.gol=b.kode
                                where a.nip='$nip' order by nama");
        $results = $query->getResultArray();

        $data =  [
            'table_data' => $results
        ];

        return $data;
    }

    public function getDetailEdit($id)
    {
        $query = $this->db->query("select a.id, a.nip, a.kredit_utama, a.kredit_penunjang, a.gol, a.tgl_nilai, a.tgl_nilai2, a.tgl_spk, a.no_sk,
        a.pejabat, a.satminkal, a.tgl_update from tblpak a
        where id = '" . $id . "'");
        $row = $query->getRow();
        return json_encode($row);
    }

    public function getPP()
    {
        $query = $this->db->query("select * from tblpp");
        $row   = $query->getResultArray();
        return $row;
    }
}
