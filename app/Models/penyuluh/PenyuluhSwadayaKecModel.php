<?php

namespace App\Models\penyuluh;

use CodeIgniter\Model;
use \Config\Database;

class PenyuluhSwadayaKecModel extends Model
{
    protected $table      = 'tbldasar_swa';
    protected $primaryKey = 'id_swa';
    protected $allowedFields = [
        'id', 'jenis_penyuluh', 'noktp', 'nama', 'tgl_lahir', 'bln_lahir', 'thn_lahir', 'tempat_lahir', 'jenis_kelamin',
        'status_kel', 'agama', 'ahli_tp', 'detail_tp', 'ahli_nak', 'detail_nak', 'ahli_bun', 'detail_bun', 'ahli_hor', 'detail_hor',
        'ahli_lainnya', 'detail_lainnya', 'instansi_pembina', 'satminkal', 'prop_satminkal', 'unit_kerja', 'kode_kab', 'tempat_tugas',
        'wil_kerja', 'alamat', 'dati2', 'kodepos', 'kode_prop', 'telp', 'email',
        'no_sk_penetapan', 'pejabat_menetapkan', 'tingkat', 'tahun_pelatihan1', 'nm_pelatihan1', 'tahun_pelatihan2', 'nm_pelatihan2',
        'tahun_pelatihan3', 'nm_pelatihan3', 'tahun_pelatihan4', 'nm_pelatihan4', 'tahun_pelatihan5', 'nm_pelatihan5', 'tahun_pelatihan6',
        'nm_pelatihan6', 'tgl_update', 'wil_kerja2', 'wil_kerja3', 'wil_kerja4', 'wil_kerja5', 'kecamatan_tugas', 'mapping', 'kode_bp3k'
    ];


    protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;


    public function getDetailPenyuluhSwadayaKecByNIK($nik)
    {
        $query = $this->db->query("select *, a.nm_pelatihan1, a.tahun_pelatihan1, d.nm_desa as wil_ker, e.nm_desa as wil_ker2, 
        f.nm_desa as wil_ker3, g.nm_desa as wil_ker4, h.nm_desa as wil_ker5, i.nama_bpp, 
        j.deskripsi,
        case a.agama 
        when '1' then 'Islam'
        when '2' then 'Protestan'
        when '3' then 'Khatolik'
        when '4' then 'Hindu'
        when '5' then 'Budha'
        else '' end as agama,
        case a.tingkat
        when '01' then 'S3 (Setara)'
        when '02' then 'S2 (Setara)'
        when '03' then 'S1 (Setara)'
        when '04' then 'D4'
        when '05' then 'SM'
        when '06' then 'D3'
        when '07' then 'D2'
        when '08' then 'D1'
        when '09' then 'SLTA'
        when '10' then 'SLTP'
        when '11' then 'SD'
        else '' end as tingkat
        from tbldasar_swa a
        left join tbldesa d on a.wil_kerja=d.id_desa
        left join tbldesa e on a.wil_kerja2=e.id_desa
        left join tbldesa f on a.wil_kerja3=f.id_desa
        left join tbldesa g on a.wil_kerja4=g.id_desa
        left join tbldesa h on a.wil_kerja5=h.id_desa
        left join tblbpp i on a.unit_kerja=i.id
        left join tbldaerah j on a.kecamatan_tugas=j.id_daerah
        WHERE noktp = '$nik'");
        $row   = $query->getRowArray();
        return $row;
    }

    public function getPenyuluhSwadayaKecTotal($kode_kec)
    {
        $db = Database::connect();
        $query = $db->query("select count(a.id_swa) as jum, nama_dati2 as nama_kab, deskripsi as nama_kec from tbldasar_swa a 
        left join tbldati2 b on b.id_dati2=a.satminkal
        left join tbldaerah c on c.id_daerah=a.tempat_tugas
        where a.tempat_tugas='$kode_kec'");
        $row   = $query->getRow();

        $query   = $db->query("select a.id_swa, a.id, a.jenis_penyuluh, a.noktp, a.nama, a.tgl_lahir, a.bln_lahir, a.thn_lahir, a.tempat_lahir, a.jenis_kelamin,
        a.status_kel, a.agama, a.ahli_tp, a.detail_tp, a.ahli_nak, a.detail_nak, a.ahli_bun, a.detail_bun, a.ahli_hor, a.detail_hor,
        a.ahli_lainnya, a.detail_lainnya, a.instansi_pembina, a.satminkal, a.prop_satminkal, a.unit_kerja, a.kode_kab, a.tempat_tugas,
        a.wil_kerja, a.alamat, a.dati2, a.kodepos, a.kode_prop, a.telp, a.email,
        a.no_sk_penetapan, a.pejabat_menetapkan, a.tingkat, a.tahun_pelatihan1, a.nm_pelatihan1, a.tahun_pelatihan2, a.nm_pelatihan2,
        a.tahun_pelatihan3, a.nm_pelatihan3, a.tahun_pelatihan4, a.nm_pelatihan4, a.tahun_pelatihan5, a.nm_pelatihan5, a.tahun_pelatihan6,
        a.nm_pelatihan6, a.tgl_update, a.wil_kerja2, a.wil_kerja3, a.wil_kerja4, a.wil_kerja5, a.kecamatan_tugas, a.mapping, a.kode_bp3k, 
        d.nm_desa as wil_ker, e.nm_desa as wil_ker2, 
                                f.nm_desa as wil_ker3, g.nm_desa as wil_ker4, h.nm_desa as wil_ker5, i.nama_bpp, 
                                j.deskripsi from tbldasar_swa a
                                left join tblsatminkal b on a.satminkal=b.kode
                                left join tblstatus_penyuluh c on a.status_kel=c.kode
                                left join tbldesa d on a.wil_kerja=d.id_desa
                                left join tbldesa e on a.wil_kerja2=e.id_desa
                                left join tbldesa f on a.wil_kerja3=f.id_desa
                                left join tbldesa g on a.wil_kerja4=g.id_desa
                                left join tbldesa h on a.wil_kerja5=h.id_desa
                                left join tblbpp i on a.unit_kerja=i.id
                                left join tbldaerah j on a.kecamatan_tugas=j.id_daerah
                                where a.tempat_tugas='$kode_kec' order by nama");
        $results = $query->getResultArray();

        $data =  [
            'jum' => $row->jum,
            'nama_kec' => $row->nama_kec,
            // 'nama_kab' => $row->nama_kab,
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
        $query = $this->db->query("select id_daerah,deskripsi from tbldaerah where id_dati2 ='$kode_kab' order by deskripsi");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getUnitKerja($kode_kec)
    {
        $query = $this->db->query("select a.id, a.nama_bpp, a.satminkal, a.kecamatan, a.wil_kec1 
        from tblbpp a where kecamatan ='$kode_kec' order by nama_bpp");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getDesa($id_swa)
    {
        $query = $this->db->query("SELECT * FROM tbldesa WHERE id_desa LIKE '" . $id_swa . "%' ORDER BY id_desa");
        $row = $query->getResultArray();
        return $row;
    }

    public function getDetailEdit($id_swa)
    {
        $query = $this->db->query("select a.id_swa, a.id, a.jenis_penyuluh, a.noktp, a.nama, a.tgl_lahir, a.bln_lahir, a.thn_lahir, a.tempat_lahir, a.jenis_kelamin,
        a.status_kel, a.agama, a.ahli_tp, a.detail_tp, a.ahli_nak, a.detail_nak, a.ahli_bun, a.detail_bun, a.ahli_hor, a.detail_hor,
        a.ahli_lainnya, a.detail_lainnya, a.instansi_pembina, a.satminkal, a.prop_satminkal, a.unit_kerja, a.kode_kab, a.tempat_tugas,
        a.wil_kerja, a.alamat, a.dati2, a.kodepos, a.kode_prop, a.telp, a.email,
        a.no_sk_penetapan, a.pejabat_menetapkan, a.tingkat, a.tahun_pelatihan1, a.nm_pelatihan1, a.tahun_pelatihan2, a.nm_pelatihan2,
        a.tahun_pelatihan3, a.nm_pelatihan3, a.tahun_pelatihan4, a.nm_pelatihan4, a.tahun_pelatihan5, a.nm_pelatihan5, a.tahun_pelatihan6,
        a.nm_pelatihan6, a.tgl_update, a.wil_kerja2, a.wil_kerja3, a.wil_kerja4, a.wil_kerja5, a.kecamatan_tugas, a.mapping, a.kode_bp3k,
         b.kode, d.nm_desa as wil_ker, e.nm_desa as wil_ker2, 
                                        f.nm_desa as wil_ker3, g.nm_desa as wil_ker4, h.nm_desa as wil_ker5, i.nama_bpp, 
                                        j.deskripsi from tbldasar_swa a
                                        left join tblsatminkal b on a.satminkal=b.kode
                                        left join tblstatus_penyuluh c on a.status_kel=c.kode
                                        left join tbldesa d on a.wil_kerja=d.id_desa
                                        left join tbldesa e on a.wil_kerja2=e.id_desa
                                        left join tbldesa f on a.wil_kerja3=f.id_desa
                                        left join tbldesa g on a.wil_kerja4=g.id_desa
                                        left join tbldesa h on a.wil_kerja5=h.id_desa
                                        left join tblbpp i on a.unit_kerja=i.id
                                        left join tbldaerah j on a.kecamatan_tugas=j.id_daerah
        where id_swa = '" . $id_swa . "'");
        $row = $query->getRow();
        return json_encode($row);
    }
}
