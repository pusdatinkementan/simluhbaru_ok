<?php

namespace App\Models\KelembagaanPelakuUtama\KelembagaanPetaniLainnya;

use CodeIgniter\Model;
use \Config\Database;

class ListKEP2LModel extends Model
{

    protected $table      = 'tb_poktan_p2l';
    protected $primaryKey = 'id_p2l';
    protected $allowedFields = ['kode_prop', 'kode_kab', 'alamat_sekretariat','tanggal_bentuk','kode_komoditas_hor',
     'kode_kec', 'kode_desa', 'nama_poktan', 'nama_ketua', 'no_sk_cpcl', 'no_urut_sk', 'nama_bendahara', 'nama_sekretaris', 'status'];

    protected $useTimestamps = false;
 
    public function getListKEP2LTotal($kode_kec)
    {
        $db = Database::connect();
        $query = $db->query("select deskripsi as nama_kec from tbldaerah where id_daerah='$kode_kec'");
        $row   = $query->getRow();
        
        $query2 = $db->query("SELECT count(id_p2l)  as jum FROM tb_poktan_p2l where kode_kec ='$kode_kec'");
        $row2   = $query2->getRow();
        
        $query3   = $db->query("select * , b.nm_desa
                                from tb_poktan_p2l a
                                left join tbldesa b on a.kode_desa=b.id_desa 
                              
                                where kode_kec='$kode_kec'
                               
                                order by kode_desa,nama_poktan");
        $results = $query3->getResultArray();

        $data =  [
            'jum' => $row2->jum,
            'nama_kec' => $row->nama_kec,
            'table_data' => $results,
        ];

        return $data;
    }
    public function getDesa($kode_kec)
    {
        $query = $this->db->query("select * from tbldesa where id_daerah LIKE '" . $kode_kec . "%' ORDER BY nm_desa ASC");
        $row   = $query->getResultArray();
        return $row;
    }
    public function getKomoditas()
    {
        $query = $this->db->query("select * from tb_komoditas where kode_komoditas='31'");
        $row2   = $query->getResultArray();
        return $row2;
    }
    public function getDataById($id_p2l)
    {
        $query = $this->db->query("select * ,  b.deskripsi
                                from tb_poktan_p2l a
                                left join tbldaerah b on a.kode_kec=b.id_daerah
                                where a.id_p2l= '" . $id_p2l . "' 
                                ORDER BY nama_poktan ");
                                $row = $query->getRow();
                                return json_encode($row);
    }
}
