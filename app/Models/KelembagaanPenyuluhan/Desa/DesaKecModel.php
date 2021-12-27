<?php

namespace App\Models\KelembagaanPenyuluhan\Desa;

use CodeIgniter\Model;
use \Config\Database;

class DesaKecModel extends Model
{
    protected $table      = 'simluhtan';
    //protected $primaryKey = 'id';


    //protected $returnType     = 'array';
    //protected $useSoftDeletes = true;

    //protected $allowedFields = ['nama', 'alamat', 'telpon'];


    protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;


    public function getDesaTotal($kode_bpp)
    {
        $db = Database::connect();
        $query = $db->query("select nama_bpp as nama_kec from tblbpp where kecamatan='$kode_bpp'");
        $row   = $query->getRow();
        $query2 = $db->query("SELECT count(idpos) as jum_des FROM tb_posluhdes where kode_kec ='$kode_bpp'");
        $row2   = $query2->getRow();
        $query3  = $db->query(" select id_daerah, deskripsi, count(idpos) as jum  
                                from tbldaerah a
                                left join tb_posluhdes b on a.id_daerah=b.kode_kec
                                where id_daerah='$kode_bpp'
                                group by id_daerah, deskripsi
                                order by deskripsi");
        $results = $query3->getResultArray();

        $data =  [
            'jum_des' => $row2->jum_des,
            'nama_kec' => $row->nama_kec,
            'table_data' => $results,
        ];

        return $data;
    }
}
