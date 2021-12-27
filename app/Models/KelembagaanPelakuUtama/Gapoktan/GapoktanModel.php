<?php

namespace App\Models\KelembagaanPelakuUtama\Gapoktan;

use CodeIgniter\Model;
use \Config\Database;

class GapoktanModel extends Model
{
    

    protected $table      = 'tb_gap';
    protected $primaryKey = 'id_gap';
    protected $allowedFields = [ 'kode_prop', 'kode_kab', 'id_gapber',
     'kode_kec', 'kode_desa', 'nama_gapoktan', 'ketua_gapoktan', 'alamat', 'simluh_sk_pengukuhan','simluh_tahun_bentuk','status', 'simluh_bendahara', 'simluh_sekretaris'];

    protected $useTimestamps = false;
  


    public function getGapoktanTotal($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select nama_dati2 as nama_kab from tbldati2 where id_dati2='$kode_kab'");
        $row   = $query->getRow();
        
        $query2 = $db->query("SELECT count(id_gap) as jum_gapoktan FROM tb_gapoktan where kode_kab ='$kode_kab'");
        $row2   = $query2->getRow();
        
        $query3   = $db->query("select id_daerah, deskripsi, count(id_gap) as jum 
                                from tbldaerah a
                                left join tb_gapoktan b on a.id_daerah=b.kode_kec and b.kode_kab='$kode_kab'
                                where id_dati2='$kode_kab'
                                group by id_daerah, deskripsi
                                order by deskripsi");
        $results = $query3->getResultArray();

        $data =  [
            'jum_gapoktan' => $row2->jum_gapoktan,
            'nama_kab' => $row->nama_kab,
            'table_data' => $results,
        ];

        return $data;
    }
    public function getUsahaTani()
    {
        $query = $this->db->query("select * from tb_komoditas_general where id_kom_general !='5' and id_kom_general !='6'");
        $row   = $query->getResultArray();
        return $row;
    }
    public function getUsahaOlah()
    {
        $query = $this->db->query("select * from tb_komoditas_general where id_kom_general !='1' and id_kom_general !='2' and id_kom_general !='3' and id_kom_general !='4'");
        $row   = $query->getResultArray();
        return $row;
    }
}
