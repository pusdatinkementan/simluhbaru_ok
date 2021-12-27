<?php

namespace App\Models\KelembagaanPenyuluhan\Provinsi;

use CodeIgniter\Model;
use \Config\Database;

class ProvModel extends Model
{
    protected $table      = 'tblbakor';
    protected $primaryKey = 'id_bakor';


    //protected $returnType     = 'array';
    //protected $useSoftDeletes = true;

    protected $allowedFields = [
        'id_bakor', 'nama_bapel', 'dasar_hukum', 'no_peraturan', 'tgl_berdiri', 'bln_berdiri', 'thn_berdiri', 'telp_kantor', 'alamat',  'email', 'website', 'ketua', 'telp_hp',
        'nama_bidang_luh', 'nama_kabid', 'hp_kabid', 'seksi_luh', 'nama_kasie', 'hp_kasie', 'eselon3_luh', 'nama_koord_penyuluh', 'deskripsi_lembaga_lain', 'koordinat'
    ];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;


    public function getProv($kode_prop)
    {
        $db = Database::connect();
        $query = $db->query("select nama_prop from tblpropinsi where id_prop='$kode_prop'");
        $row   = $query->getRow();
        $query2 = $db->query("SELECT count(id_bakor) as jum_prop FROM tblbakor where kode_prop ='$kode_prop'");
        $row2   = $query2->getRow();
        $query3  = $db->query("select *, a.alamat, a.ketua, a.tgl_update, a.kode_prop, a.nama_bapel, h.nama, h.nip, c.jumthl, d.jumswa, e.jumpok, f.jumgap, g.jumkep, i.nama_prop,
                                    case a.nama_bapel 
                                    when '10' then 'Sekretariat Badan Koordinasi Penyuluhan Pertanian, Perikanan dan Kehutanan'
                                    when '21' then deskripsi_lembaga_lain
                                    when '22' then deskripsi_lembaga_lain
                                    else '' end nama_bapel 
                                from tblbakor a
                                left join tbldasar h on a.nama_koord_penyuluh=h.nip 
                                left join (select satminkal, count(id_thl) as jumthl from tbldasar_thl GROUP BY satminkal) c on a.kode_prop=c.satminkal LIKE '%" . $kode_prop . "%'
                                left join (select satminkal, count(id_swa) as jumswa from tbldasar_swa GROUP BY satminkal) d on a.kode_prop=d.satminkal LIKE '%" . $kode_prop . "%'
                                left join (select kode_prop, count(id_poktan) as jumpok from tb_poktan GROUP BY kode_prop) e on a.kode_prop=e.kode_prop
                                left join (select kode_prop, count(id_gap) as jumgap from tb_gapoktan GROUP BY kode_prop) f on a.kode_prop=f.kode_prop
                                left join (select kode_prop, count(id_kep) as jumkep from tb_kep GROUP BY kode_prop) g on a.kode_prop=g.kode_prop
                                left join tblpropinsi i on a.kode_prop=i.id_prop
                                where a.kode_prop='$kode_prop' 
                                ");
        $results = $query3->getResultArray();

        $data =  [
            'jum_prop' => $row2->jum_prop,
            'nama_prop' => $row->nama_prop,
            'table_data' => $results,
        ];

        return $data;
    }

    public function getTotalPNS($kode_prop)
    {
        $db = Database::connect();
        $query = $db->query("select count(id) as jum_pns from tbldasar where satminkal like '$kode_prop' 
                            and kode_kab='2' and status !='1' and status !='2' and status !='3'");
        $row   = $query->getRow();
        $query2  = $db->query("select id,nama,nip from tbldasar where satminkal='$kode_prop' and kode_kab='2' 
                    and status !='1' and status !='2' and status !='3' order by nama");
        $results = $query2->getResultArray();

        $data =  [
            'jum_pns' => $row->jum_pns,
            'datapns' => $results,
        ];

        return $data;
    }

    public function getPenyuluhPNS($kode_prop)
    {

        $query = $this->db->query("select * from tbldasar where satminkal ='$kode_prop' and kode_kab='2' 
                                    and nip !='nama_koord_penyuluh'");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getDetailProv($id)
    {
        $query = $this->db->query("select *
                                from tblbakor 
                                where id_bakor='$id'
                                ");
        $row   = $query->getResultArray();
        return $row;
    }
}
