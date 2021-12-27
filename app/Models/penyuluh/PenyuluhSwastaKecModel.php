<?php

namespace App\Models\penyuluh;

use CodeIgniter\Model;
use \Config\Database;

class PenyuluhSwastaKecModel extends Model
{
    protected $table      = 'tbldasar_swasta';
    protected $primaryKey = 'id_swa';
    protected $allowedFields = [
        'jenis_penyuluh', 'noktp', 'nama', 'tgl_lahir', 'bln_lahir', 'thn_lahir', 'tempat_lahir', 'jenis_kelamin',
        'satminkal', 'prop_satminkal', 'lokasi_kerja', 'alamat', 'dati2', 'kodepos', 'kode_prop', 'telp', 'email',
        'nama_perusahaan', 'jabatan_di_perush', 'tgl_update', 'alamat_perush', 'telp_perush', 'tempat_tugas'
    ];


    protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;


    public function getPenyuluhSwastaKecTotal($kode_kec)
    {
        $db = Database::connect();
        $query = $db->query("select count(a.id_swa) as jum, nama_dati2 as nama_kab, deskripsi as nama_kec from tbldasar_swasta a 
        left join tbldati2 b on b.id_dati2=a.satminkal
        left join tbldaerah c on c.id_daerah=a.tempat_tugas
        where a.tempat_tugas='$kode_kec'");
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
                                where a.tempat_tugas='$kode_kec' order by nama");
        $results = $query->getResultArray();

        $data =  [
            'jum' => $row->jum,
            'nama_kab' => $row->nama_kab,
            'nama_kec' => $row->nama_kec,
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
