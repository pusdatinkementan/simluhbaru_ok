<?php

namespace App\Models\KelembagaanPelakuUtama\KelompokTani;

use CodeIgniter\Model;
use \Config\Database;

class ListPoktanModel extends Model
{
    protected $table      = 'tb_poktan';
    protected $primaryKey = 'id_poktan';
    protected $allowedFields = ['no_reg', 'kode_prop', 'kode_kab','id_gap',
     'kode_kec', 'kode_desa', 'nama_poktan', 'ketua_poktan', 'alamat', 'jum_anggota','simluh_tahun_bentuk','status','simluh_tahun_tap_kelas','simluh_kelas_kemampuan','simluh_jenis_kelompok_perempuan',
     'simluh_jenis_kelompok_domisili', 'simluh_jenis_kelompok_upja', 'simluh_jenis_kelompok_bun','simluh_jenis_kelompok_hor','simluh_jenis_kelompok_olah','simluh_jenis_kelompok_tp','simluh_jenis_kelompok_nak',
     'simluh_jenis_kelompok_p3a','simluh_jenis_kelompok_lmdh','simluh_jenis_kelompok_penangkar','simluh_jenis_kelompok_kmp','simluh_jenis_kelompok_umkm','simluh_komo_lain_tp','simluh_komo_lain_bun','simluh_komo_lain_hor',
     'simluh_komo_lain_nak','simluh_komo_lain_olah'];

    protected $useTimestamps = false;
    
    public function getKelompokTaniTotal($kode_kec)
    {
        $db = Database::connect();
        $query = $db->query("select deskripsi as nama_kec from tbldaerah where id_daerah='$kode_kec'");
        $row   = $query->getRow();
        
        $query2 = $db->query("SELECT count(id_poktan) as jum FROM tb_poktan where kode_kec ='$kode_kec'");
        $row2   = $query2->getRow();
        
        $query3   = $db->query("select *, a.id_poktan,a.alamat,a.id_gap,a.kode_desa,a.kode_kec,a.kode_kab,a.nama_poktan,a.ketua_poktan,b.nm_desa,c.id_daerah,d.id_dati2,a.status,a.simluh_tahun_bentuk
                                from tb_poktan a
                                left join tbldesa b on a.kode_desa=b.id_desa 
                                left join tbldaerah c on a.kode_kec=c.id_daerah
                                left join tbldati2 d on a.kode_kab=d.id_dati2
                                where kode_kec='$kode_kec' and simluh_jenis_kelompok !='P2L'
                                ORDER BY id_poktan desc");

        $results = $query3->getResultArray();

      

        $data =  [
            'jum' => $row2->jum,
            'nama_kec' => $row->nama_kec,
            'table_data' => $results,
          //  'jumangg' => $row3->jumangg,
          //  'jup' => $row4->jup
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
