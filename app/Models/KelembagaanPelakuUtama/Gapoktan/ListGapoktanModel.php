<?php

namespace App\Models\KelembagaanPelakuUtama\Gapoktan;

use CodeIgniter\Model;
use \Config\Database;

class ListGapoktanModel extends Model
{
  

    protected $table      = 'tb_gapoktan';
    protected $primaryKey = 'id_gap';
    protected $allowedFields = ['id_gapber', 'no_reg', 'kode_prop', 'kode_kab','simluh_usaha_tani','simluh_usaha_olah',
    'simluh_sekretaris', 'simluh_usaha_saprodi','simluh_usaha_pemasaran','simluh_usaha_simpan_pinjam','simluh_usaha_jasa_lain','simluh_usaha_jasa_lain_desc',
    'simluh_alsin_traktor','simluh_alsin_hand_tractor','simluh_alsin_pompa_air','simluh_alsin_penggiling_padi','simluh_alsin_pengering','simluh_alsin_chooper','simluh_alsin_lain_desc','simluh_alsin_lain',
     'kode_kec', 'kode_desa', 'nama_gapoktan', 'ketua_gapoktan', 'simluh_sk_pengukuhan', 'simluh_tahun_bentuk', 'simluh_sekretaris', 'simluh_bendahara', 'alamat'];

    protected $useTimestamps = false;

    public function getListGapoktanTotal($kode_kec)
    {
        $db = Database::connect();
        $query = $db->query("select deskripsi as nama_kec from tbldaerah where id_daerah='$kode_kec'");
        $row   = $query->getRow();
        
        $query2 = $db->query("SELECT count(id_gap) as jum FROM tb_gapoktan where kode_kec ='$kode_kec'");
        $row2   = $query2->getRow();
        
        $query4   = $db->query("select  a.id_gap,a.kode_desa,a.kode_kec,a.nama_gapoktan,a.ketua_gapoktan,a.simluh_bendahara,a.alamat,b.id_desa, b.nm_desa,c.jumpok,d.id_dati2,e.id_daerah,a.simluh_sk_pengukuhan
                                from tb_gapoktan a
                                left join tbldesa b on a.kode_desa=b.id_desa 
                                left join (SELECT id_gap,kode_desa, COUNT(id_poktan) as jumpok from tb_poktan GROUP BY id_gap,kode_desa) c on a.id_gap=c.id_gap and b.id_desa=c.kode_desa and c.id_gap !=''
                                left join tbldati2 d on a.kode_kab=d.id_dati2 
                                left join tbldaerah e on a.kode_kec=e.id_daerah
                                where kode_kec='$kode_kec'
                                ORDER BY kode_desa");

        $results = $query4->getResultArray();

        

    //  $query3 = $db->query("SELECT count(id_poktan) as jumpok FROM tb_poktan where id_gap ='id_gap'  and id_gap !=''");
     //  $row3   = $query3->getRow();

        

        $data =  [
            'jum' => $row2->jum,
            'nama_kec' => $row->nama_kec,
            'table_data' => $results,
         //   'jumpok' => $row3->jumpok,
            
        ];

        return $data;
    }
    public function getDesa($kode_kec)
    {
        $query = $this->db->query("select * from tbldesa where id_daerah LIKE '" . $kode_kec . "%' ORDER BY nm_desa ASC");
        $row   = $query->getResultArray();
        return $row;
    }
    public function getDataById($id_gap)
    {
        $query = $this->db->query("select * , b.deskripsi
                                from tb_gapoktan a
                                left join tbldaerah b on a.kode_kec=b.id_daerah
                                where id_gap= '" . $id_gap . "' 
                                ORDER BY nama_gapoktan ");
                                $row = $query->getRow();
                                return json_encode($row);
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
