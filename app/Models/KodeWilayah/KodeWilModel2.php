<?php

namespace App\Models\KodeWilayah;

use CodeIgniter\Model;
use \Config\Database;

class KodeWilModel2 extends Model
{
    public function getKodeWil($kode_kec)
    {
        $db = Database::connect();
        $query = $this->db->query("select id_prop as kode_prop from tbldesa where id_daerah='$kode_kec'");
        $row   = $query->getRow();
        $query2 = $this->db->query("select id_daerah as kode_kec from tbldesa where id_daerah='$kode_kec'");
        $row2   = $query2->getRow();
        $query3 = $this->db->query("select id_dati2 as kode_kab from tbldesa where id_daerah='$kode_kec'");
        $row3   = $query3->getRow();

        $data =  [
            'kode_prop' => $row->kode_prop,
            'kode_kab' => $row3->kode_kab,
            'kode_kec' => $row2->kode_kec
        ];

        return $data;
    }

    public function getKodeWil2($kode_kab)
    {
        $db = Database::connect();
        $query = $this->db->query("select id_prop as kode_prop from tbldesa where id_dati2='$kode_kab'");
        $row   = $query->getRow();
        $query2 = $this->db->query("select id_daerah as kode_kec from tbldesa where id_dati2='$kode_kab'");
        $row2   = $query2->getRow();
        $query3 = $this->db->query("select id_dati2 as kode_kab from tbldesa where id_dati2='$kode_kab'");
        $row3   = $query3->getRow();
        $query4 = $this->db->query("select id_desa as kode_desa from tbldesa where id_dati2='$kode_kab'");
        $row4   = $query4->getRow();

        $data =  [
            'kode_prop' => $row->kode_prop,
            'kode_kab' => $row3->kode_kab,
            'kode_kec' => $row2->kode_kec,
            'kode_desa' => $row4->kode_desa
        ];

        return $data;
    }
    public function getKodeWil3($kode_desa)
    {
        $db = Database::connect();
        $query = $this->db->query("select id_prop as kode_prop from tbldesa where id_dati2='$kode_desa'");
        $row   = $query->getRow();
        $query2 = $this->db->query("select id_daerah as kode_kec from tbldesa where id_dati2='$kode_desa'");
        $row2   = $query2->getRow();
        $query3 = $this->db->query("select id_dati2 as kode_kab from tbldesa where id_dati2='$kode_desa'");
        $row3   = $query3->getRow();
        $query4 = $this->db->query("select id_dati2 as kode_kab from tbldesa where id_dati2='$kode_desa'");
        $row4   = $query4->getRow();

        $data =  [
            'kode_prop' => $row->kode_prop,
            'kode_kab' => $row3->kode_kab,
            'kode_kec' => $row2->kode_kec
        ];

        return $data;
    }

    public function getNamaWil($kode)
    {

        if (session()->get('status_user') == '200') {
            $query = $this->db->query("select a.id_dati2, b.nama_prop as namaprov 
            from tbldesa a
            left join tblpropinsi b on a.id_prop=b.id_prop
            where id_dati2='$kode'");
            $row   = $query->getRow();

            $query2 = $this->db->query("select nama_dati2 as namakab 
            from tbldati2 
            where id_dati2='$kode'");
            $row2   = $query2->getRow();


            $data = [
                'namaprov' => $row->namaprov,
                'namakab' => $row2->namakab
            ];
        } elseif (session()->get('status_user') == '300') {

            // dd('test');
            $query = $this->db->query("select a.id_daerah, b.nama_prop as namaprov, c.nama_dati2 as namakab from tbldesa a left join tbldati2 c on a.id_dati2 = c.id_dati2
            left join tblpropinsi b on a.id_prop=b.id_prop
            where id_daerah=" . $kode);

            $row   = $query->getRow();


            $data = [
                'namaprov' => $row->namaprov,
                'namakab' => $row->namakab
            ];
        }



        return $data;
    }
}
