<?php

namespace App\Models\KelembagaanPelakuUtama\GapoktanBersama;

use CodeIgniter\Model;
use \Config\Database;

class AnggotaGapberModel extends Model
{

    protected $table      = 'tb_gapoktan_bersama_anggota';
    protected $primaryKey = 'id_anggota';

    protected $useTimestamps = false;
    protected $allowedFields = ['id_gapber', 'created_at', 'updated_at', 'status_anggota'];



    public function getGapoktanBersamaTotal($kode)
    {
        $db = Database::connect();
        $query = $db->query("select nama_dati2 as nama_kab from tbldati2 where id_dati2='" . $kode . "'");
        $row   = $query->getRow();

        $query2 = $db->query("SELECT count(id_gapber) as jum FROM tb_gapoktan_bersama where kode_kab ='" . $kode . "'");
        $row2   = $query2->getRow();

        $query3   = $db->query("select id_gapber,kode_desa,kode_kec,nama_gapoktan,ketua_gapoktan,simluh_bendahara,alamat, b.nm_desa ,c.id_daerah,d.id_dati2
                                from tb_gapoktan_bersama a
                                left join tbldesa b on a.kode_desa=b.id_desa 
                                left join tbldaerah c on a.kode_kec=c.id_daerah
                                left join tbldati2 d on a.kode_kab=d.id_dati2
                                where kode_kab='" . $kode . "'          
                                order by kode_desa");
        $results = $query3->getResultArray();

        $data =  [
            'jum' => $row2->jum,
            'nama_kab' => $row->nama_kab,
            'table_data' => $results,
        ];

        return $data;
    }


    public function getListAnggotaGapber($idgapber)
    {
        $db = Database::connect();

        $query = "SELECT tb_gapoktan_bersama_anggota.*, tb_gapoktan_bersama.nama_gapoktan as nama_gapoktan_bersama, tb_gapoktan.nama_gapoktan
        FROM `tb_gapoktan_bersama_anggota` join tb_gapoktan_bersama on 
        tb_gapoktan_bersama_anggota.id_gapber = tb_gapoktan_bersama.id_gapber JOIN tb_gapoktan on tb_gapoktan_bersama_anggota.id_gap = 
        tb_gapoktan.id_gap
        where tb_gapoktan_bersama_anggota.id_gapber = '" . $idgapber . "'";
        $query = $db->query($query);
        $row   = $query->getResultArray();

        $query2 = $db->query("SELECT * FROM tb_gapoktan_bersama WHERE id_gapber = '" . $idgapber . "'");
        $row2 = $query2->getRowArray();

        $data = [
            'listgapber' => $row,
            'datagapber' => $row2
        ];
        return $data;
    }

    public function saveGapber($data)
    {
        $db = db_connect();
        $builder = $db->table('tb_gapoktan_bersama_anggota');
        $builder->insert($data);
    }


    public function getUsahaOlah()
    {
        $query = $this->db->query("select * from tb_komoditas_general where id_kom_general !='1' and id_kom_general !='2' and id_kom_general !='3' and id_kom_general !='4'");
        $row   = $query->getResultArray();
        return $row;
    }
    public function getDataById($id_gapber)
    {
        $query = $this->db->query("select * , b.deskripsi
                                from tb_gapoktan_bersama a
                                left join tbldaerah b on a.kode_kec=b.id_daerah
                                where id_gapber= '" . $id_gapber . "' 
                                ORDER BY nama_gapoktan ");
        $row = $query->getRow();
        return json_encode($row);
    }
}
