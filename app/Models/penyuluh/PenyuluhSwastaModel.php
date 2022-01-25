<?php

namespace App\Models\penyuluh;

use CodeIgniter\Model;
use \Config\Database;

class PenyuluhSwastaModel extends Model
{
    protected $table      = 'tbldasar_swasta';
    protected $primaryKey = 'id_swa';
    protected $allowedFields = [
        'jenis_penyuluh', 'noktp', 'nama', 'tgl_lahir', 'bln_lahir', 'thn_lahir', 'tempat_lahir', 'jenis_kelamin',
        'satminkal', 'prop_satminkal', 'lokasi_kerja', 'alamat', 'dati2', 'kodepos', 'kode_prop', 'telp', 'email',
        'nama_perusahaan', 'jabatan_di_perush', 'tgl_update', 'alamat_perush', 'telp_perush', 'tempat_tugas'
    ];


    public function getDetailPenyuluhSwastaByNIK($nik)
    {
        $query = $this->db->query("select *, a.id_swa, a.jenis_penyuluh, a.noktp, a.nama, a.tgl_lahir, a.bln_lahir, a.thn_lahir, a.tempat_lahir, a.jenis_kelamin,
        a.satminkal, a.prop_satminkal, a.lokasi_kerja, a.alamat, a.dati2, a.kodepos, a.kode_prop, a.telp, a.email,
        a.nama_perusahaan, a.jabatan_di_perush, a.tgl_update, a.alamat_perush, a.telp_perush, a.tempat_tugas, b.kode, b.kelompok, b.nama as namasat, c.nama_prop,
                                        j.deskripsi,
                                        z.nama_prop,
                                        z.id_prop,
                                        j.id_daerah from tbldasar_swasta a
                                        left join tblsatminkal b on a.satminkal=b.kode
                                        left join tblpropinsi c on a.kode_prop=c.id_prop
                                        left join tbldaerah j on a.tempat_tugas=j.id_daerah
                                        left join tblpropinsi z on a.kode_prop=z.id_prop
        WHERE noktp = '$nik'");
        $row   = $query->getRowArray();
        return $row;
    }

    public function getPenyuluhSwastaTotal($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select count(a.id_swa) as jum, nama_dati2 as nama_kab from tbldasar_swasta a left join tbldati2 b on b.id_dati2=a.satminkal where satminkal='$kode_kab'");
        $row   = $query->getRow();

        $query   = $db->query("select a.id_swa, a.jenis_penyuluh, a.noktp, a.nama, a.tgl_lahir, a.bln_lahir, a.thn_lahir, a.tempat_lahir, a.jenis_kelamin,
a.satminkal, a.prop_satminkal, a.lokasi_kerja, a.alamat, a.dati2, a.kodepos, a.kode_prop, a.telp, a.email,
a.nama_perusahaan, a.jabatan_di_perush, a.tgl_update, a.alamat_perush, a.telp_perush, a.tempat_tugas, b.kode, b.kelompok, b.nama as namasat, c.nama_prop,
                                j.deskripsi,
                                z.nama_prop,
                                z.id_prop,
                                j.id_daerah from tbldasar_swasta a
                                left join tblsatminkal b on a.satminkal=b.kode
                                left join tblpropinsi c on a.kode_prop=c.id_prop
                                left join tbldaerah j on a.tempat_tugas=j.id_daerah
                                left join tblpropinsi z on a.kode_prop=z.id_prop
                                where a.satminkal='$kode_kab' order by nama");
        $results = $query->getResultArray();

        $data =  [
            'jum' => $row->jum,
            'nama_kab' => $row->nama_kab,
            'table_data' => $results,
        ];

        return $data;
    }


    public function getPropvinsi()
    {
        $query = $this->db->query("select * from tblpropinsi ORDER BY nama_prop ASC");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getTugas($kode_kab)
    {
        $query = $this->db->query("select * from tbldaerah a 
    left join tbldasar_swasta b on b.satminkal=a.id_dati2 where id_dati2='$kode_kab'");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getDetailEditStatus($id)
    {
        $query = $this->db->query("select a.id_swa as id, a.noktp, a.nama, a.tgl_update, a.status_kel, a.tgl_status, a.ket_status, c.nama_status
                              
                                from tbldasar_swasta a
                                left join tblsatminkal b on a.satminkal=b.kode
                                left join tblstatus_penyuluh c on a.status_kel=c.kode
                               
        where a.id_swa = '" . $id . "'");
        $row = $query->getRow();
        return json_encode($row);
    }

    public function getStatus()
    {
        $query = $this->db->query("select * from tblstatus_penyuluh a where kode ='0' OR kode = '8' OR kode = '2' OR kode = '1'");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getDetailEdit($id_swa)
    {
        $query = $this->db->query("select *, a.id_swa, a.jenis_penyuluh, a.noktp, a.nama, a.tgl_lahir, a.bln_lahir, a.thn_lahir, a.tempat_lahir, a.jenis_kelamin,
        a.satminkal, a.prop_satminkal, a.lokasi_kerja, a.alamat, a.dati2, a.kodepos, a.kode_prop, a.telp, a.email,
        a.nama_perusahaan, a.jabatan_di_perush, a.tgl_update, a.alamat_perush, a.telp_perush, a.tempat_tugas, b.kode, c.nama_prop,
                                        j.deskripsi,
                                        z.nama_prop,
                                        z.id_prop,
                                        j.id_daerah from tbldasar_swasta a
                                        left join tblsatminkal b on a.satminkal=b.kode
                                        left join tblpropinsi c on a.kode_prop=c.id_prop
                                        left join tbldaerah j on a.tempat_tugas=j.id_daerah
                                        left join tblpropinsi z on a.kode_prop=z.id_prop
        where id_swa = '" . $id_swa . "'");
        $row = $query->getRow();
        return json_encode($row);
    }
}
