<?php

namespace App\Models\KelembagaanPelakuUtama\Gapoktan;

use CodeIgniter\Model;
use \Config\Database;

class ListGapoktanDesaModel extends Model
{
  
    protected $table      = 'tb_poktan';
    protected $primaryKey = 'id_poktan';
    protected $allowedFields = [ 'kode_prop', 'kode_kab', 'id_gap','kode_kec', 'kode_desa', 'nama_poktan', 'ketua_poktan', 'alamat',
     'simluh_kelas_kemampuan','simluh_tahun_tap_kelas','simluh_tahun_bentuk','status', 'simluh_jenis_kelompok'];

    protected $useTimestamps = false;

    public function getListGapoktanDesaTotal($kode_desa)
    {
        $db = Database::connect();
        $query = $db->query("select nm_desa as nama_desa from tbldesa where id_desa='$kode_desa'");
        $row   = $query->getRow();
        
        $query2   = $db->query("select a.id_poktan,a.id_gap,a.kode_desa,a.kode_kec,a.nama_poktan,a.ketua_poktan,a.jum_anggota,a.alamat, b.nm_desa,c.jum,c.id_poktan,a.simluh_jenis_kelompok
                                from tb_poktan a
                                left join tbldesa b on a.kode_desa=b.id_desa 
                                left join(select id_poktan, count(id_poktan) as jum from tb_poktan_anggota GROUP BY id_poktan) c on a.id_poktan=c.id_poktan
                                where kode_desa='$kode_desa'
                                ORDER BY kode_desa");

        $results = $query2->getResultArray();

        

        $data =  [
           
            'nama_desa' => $row->nama_desa,
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
    public function getDataById($id_poktan)
    {
        $query = $this->db->query("select * , b.deskripsi
                                from tb_poktan a
                                left join tbldaerah b on a.kode_kec=b.id_daerah
                                where id_poktan= '" . $id_poktan . "' 
                                ORDER BY nama_poktan ");
                                $row = $query->getRow();
                                return json_encode($row);
    }
}
