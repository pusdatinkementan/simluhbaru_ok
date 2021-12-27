<?php

namespace App\Models\KelembagaanPelakuUtama\KelembagaanEkonomiPetani;

use CodeIgniter\Model;
use \Config\Database;

class ListKEPModel extends Model
{
    protected $table      = 'tb_kep';
    protected $primaryKey = 'id_kep';
    protected $allowedFields = ['kode_prop', 'kode_kab', 'email',  'kode_kec', 'kode_desa', 'nama_kep', 'jenis_kep', 'alamat', 'jum_anggota','tahun_bentuk',
    'nama_direktur','jum_poktan','jum_gapoktan','no_telp','badan_hukum','total_aset','jenis_mitra_internasional','jenis_mitra_nasional','jenis_mitra_lokal','jenis_mitra_koperasi',
    'jenis_mitra_perorangan','jenis_mitra_pemasaran','bentuk_mitra_pemasaran','bentuk_mitra_saprodi','bnetuk_mitra_pendampingan','total_aset','sertifikasi',
'luas_lahan_usaha_tp','luas_lahan_usaha_bun','luas_lahan_usaha_hor','luas_lahan_usaha_nak','luas_lahan_usaha_olah','pemasaran_regional_tp','pemasaran_regional_bun',
'pemasaran_regional_hor','pemasaran_regional_nak','pemasaran_regional_olah','pemasaran_ekspor_tp','pemasaran_ekspor_bun','pemasaran_ekspor_hor','pemasaran_ekspor_nak','pemasaran_ekspor_olah',
'pemasaran_tti'];

    protected $useTimestamps = false;
   


    public function getListKEPTotal($kode_kec)
    {
        $db = Database::connect();
        $query = $db->query("select deskripsi as nama_kec from tbldaerah where id_daerah='$kode_kec'");
        $row   = $query->getRow();

        $query2   = $db->query("select * , a.jum_gapoktan,a.email,b.id_daerah, c.id_dati2
                                from tb_kep  a
                                left join tbldaerah b on a.kode_kec=b.id_daerah
                                left join tbldati2 c on a.kode_kab=c.id_dati2
                                left join tbldesa d on a.kode_desa=d.id_desa
                                where kode_kec='$kode_kec'
                                order by id_kep");
        $results = $query2->getResultArray();

        $data =  [
            
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
    public function getDataById($id_kep)
    {
        $query = $this->db->query("select * , b.deskripsi
                                from tb_kep a
                                left join tbldaerah b on a.kode_kec=b.id_daerah
                                where id_kep= '" . $id_kep . "' 
                                ORDER BY nama_KEP ");
                                $row = $query->getRow();
                                return json_encode($row);
    }
}
