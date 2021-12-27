<?php

namespace App\Models\KelembagaanPenyuluhan\Kecamatan;

use CodeIgniter\Model;
use \Config\Database;

class KecamatanKecModel extends Model
{
    protected $table      = 'tblbpp';
    //protected $primaryKey = 'id';


    //protected $returnType     = 'array';
    //protected $useSoftDeletes = true;

    //protected $allowedFields = ['nama', 'alamat', 'telpon'];


    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;


    public function getKecTotal($kode_kec)
    {
        $db = Database::connect();
        $query = $db->query("select deskripsi as nama_kec from tbldaerah where id_daerah='$kode_kec'");
        $row   = $query->getRow();
        $query2 = $db->query("SELECT count(idpos) as jum_kec FROM tb_posluhdes where kode_kec ='$kode_kec'");
        $row2   = $query2->getRow();
        $query3  = $db->query("select * , b.nama, c.deskripsi, a.tgl_update, a.alamat,f.jumgap,f.kode_bp3k,g.jumkep,d.jumpok,e.jumthl,h.jumpns,i.unit_kerja
                                from tblbpp a
                                left join tbldasar b on a.nama_koord_penyuluh=b.nip
                                left join tbldaerah c on a.kecamatan=c.id_daerah  
                                left join (select kode_kec, count(id_poktan) as jumpok from tb_poktan GROUP BY kode_kec)d on a.kecamatan=d.kode_kec
                                left join(select unit_kerja,count(id_thl) as jumthl from tbldasar_thl GROUP BY unit_kerja) e on a.id=e.unit_kerja
                                left join(select kode_bp3k, count(id_gap) as jumgap from tb_gapoktan GROUP BY kode_bp3k)f on a.kode_bp3k=f.kode_bp3k
                                left join(select kode_bp3k,count(id_kep) as jumkep from tb_kep GROUP BY kode_bp3k )g on a.kode_bp3k=g.kode_bp3k
                                left join(select tempat_tugas,count(id) as jumpns from tbldasar GROUP BY tempat_tugas) h on a.kecamatan=h.tempat_tugas and kode_kab='4' 
                                left join(select unit_kerja,count(id_swa) as jumswa from tbldasar_swa GROUP BY unit_kerja) i on a.id=i.unit_kerja
                                where a.kecamatan='$kode_kec'  
                                ");
        $results = $query3->getResultArray();

        $data =  [
            'jum_kec' => $row2->jum_kec,
            'nama_kec' => $row->nama_kec,
            'table_data' => $results,
        ];

        return $data;
    }
}
