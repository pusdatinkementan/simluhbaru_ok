<?php

namespace App\Models\KelembagaanPelakuUtama\KelompokTani;

use CodeIgniter\Model;
use \Config\Database;

class ListPoktanAnggotaModel extends Model
{
    protected $table      = 'tb_poktan_anggota';
    protected $primaryKey = 'id_anggota';
    protected $allowedFields = ['kode_prop', 'kode_kab','id_poktan',
     'kode_kec', 'kode_desa', 'nama_anggota', 'nama_ktp', 'no_ktp', 'tempat_lahir', 'tgl_lahir','bln_lahir', 'thn_lahir','no_hp',  'jenis_kelamin','alamat_ktp', 'status_anggota', 'kode_komoditas','kode_komoditas2','kode_komoditas3', 
     'volume', 'volume2', 'volume3', 'lainnya', 'luas_lahan_ternak_diusahakan','luas_lahan_ternak_dimiliki','titik_koordinat_lahan','kategori_petani_penggarap'];


    protected $useTimestamps = false;
 
    public function getListPoktanAnggotaTotal($id_poktan)
    {
        $db = Database::connect();
        $query = $db->query("select nama_poktan,kode_prop,kode_kab,kode_kec,kode_desa from tb_poktan where id_poktan='$id_poktan'");
        $row   = $query->getRow();
        
        
        
        $query3   = $db->query("select id_anggota,id_poktan,nama_ktp,nama_anggota,no_ktp,tempat_lahir,tgl_lahir,bln_lahir,thn_lahir,alamat_ktp,kode_prop,kode_kec,kode_desa,kode_kab,
                                jenis_kelamin,no_hp,luas_lahan_ternak_dimiliki,luas_lahan_ternak_diusahakan,
                                case status_anggota 
                                when '1' then 'Sebagai Anggota'
                                when '2' then 'Calon Anggota'
                                else '' end status_anggota,
                                b.nama_komoditas as kode_komoditas1,
                                c.nama_komoditas as kode_komoditas2 ,
                                d.nama_komoditas as kode_komoditas3,
                                volume,
                                volume2,
                                volume3,
                                lainnya,luas_lahan_ternak_diusahakan,luas_lahan_ternak_dimiliki,
                                case kategori_petani_penggarap
                                when '1' then 'Pemilik Lahan'
                                when '2' then 'Pemilik dan Penggarap'
                                when '3' then 'Penggarap'
                                when '4' then 'Buruh'
                                else '' end kategori_petani_penggarap,
                                titik_koordinat_lahan 
                                from tb_poktan_anggota a
                                left join(select * from tb_komoditas) b on a.kode_komoditas=b.kode_komoditas
                                left join(select * from tb_komoditas) c on a.kode_komoditas2=c.kode_komoditas
                                left join(select * from tb_komoditas) d on a.kode_komoditas3=d.kode_komoditas
                                where id_poktan='$id_poktan'
                                ORDER BY  nama_anggota  ");

        $results = $query3->getResultArray();


        $data =  [
            
            'nama_poktan' => $row->nama_poktan,
            'table_data' => $results,
           
          //  'jup' => $row4->jup
        ];

        return $data;
    }
    public function getDataById($id_poktan)
    {
        $query = $this->db->query("select * from tb_poktan_anggota where id_anggota= '" . $id_poktan . "' 
                                ORDER BY nama_anggota ");
                                $row = $query->getRow();
                                return json_encode($row);
    }
    public function getKomoditas()
    {
        $query = $this->db->query("select * from tb_komoditas order by id_sub_sektor,id_komoditas");
        $row2   = $query->getResultArray();
        return $row2;
    }
    public function getKomoditas2()
    {
        $query = $this->db->query("select * from tb_komoditas order by id_sub_sektor,id_komoditas");
        $row3   = $query->getResultArray();
        return $row3;
    }
    public function getKomoditas3()
    {
        $query = $this->db->query("select * from tb_komoditas order by id_sub_sektor,id_komoditas");
        $row4   = $query->getResultArray();
        return $row4;
    }
}
