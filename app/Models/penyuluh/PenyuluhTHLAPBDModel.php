<?php

namespace App\Models\penyuluh;

use CodeIgniter\Model;
use \Config\Database;

class PenyuluhTHLAPBDModel extends Model
{
    protected $table      = 'tbldasar_thl';
    protected $primaryKey = 'id_thl';
    protected $allowedFields = [
        'id', 'jenis_penyuluh', 'noktp', 'nama', 'gelar_dpn', 'gelar_blk', 'tgl_lahir', 'bln_lahir', 'thn_lahir', 'tempat_lahir', 'jenis_kelamin',
        'status_kel', 'agama', 'ahli_tp', 'detail_tp', 'ahli_nak', 'detail_nak', 'ahli_bun', 'detail_bun', 'ahli_hor', 'detail_hor',
        'ahli_lainnya', 'detail_lainnya', 'instansi_pembina', 'satminkal', 'prop_satminkal', 'unit_kerja', 'kode_kab', 'tempat_tugas',
        'wil_kerja', 'alamat', 'dati2', 'kodepos', 'kode_prop', 'telp', 'email', 'tgl_update', 'no_peserta', 'angkatan', 'penyuluh_di',
        'kecamatan_tugas', 'wil_kerja2', 'wil_kerja3', 'wil_kerja4', 'wil_kerja5', 'wil_kerja6', 'wil_kerja7', 'wil_kerja8', 'wil_kerja9',
        'wil_kerja10', 'mapping', 'sumber_dana', 'tingkat_pendidikan', 'bidang_pendidikan', 'kode_bp3k', 'jurusan', 'nama_sekolah'
    ];


    //protected $returnType     = 'array';
    //protected $useSoftDeletes = true;

    //protected $allowedFields = ['nama', 'alamat', 'telpon'];


    protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;


    public function getDetailPenyuluhTHLAPBDByNIK($nik)
    {
        $query = $this->db->query("select *, a.no_peserta, a.noktp, a.nama, a.tgl_update, a.agama, d.nm_desa as wil_kerja, e.nm_desa as wil_kerja2,
        f.nm_desa as wil_kerja3, g.nm_desa as wil_kerja4, h.nm_desa as wil_kerja5, u.nm_desa as wil_kerja6, v.nm_desa as wil_kerja7,
        w.nm_desa as wil_kerja8, x.nm_desa as wil_kerja9, y.nm_desa as wil_kerja10, 
        j.deskripsi as kecamatan_tugas, sk.nama as namapen,
        case a.agama 
        when '1' then 'Islam'
        when '2' then 'Protestan'
        when '3' then 'Khatolik'
        when '4' then 'Hindu'
        when '5' then 'Budha'
        else '' end as agama,
                                        case a.penyuluh_di 
                                        when 'kabupaten' then 
                                            case a.unit_kerja 
                                            when '10' then 'Badan Pelaksana Penyuluhan Pertanian, Perikanan dan Kehutanan'
                                            when '20' then 'Badan Pelaksana Penyuluhan'
                                            when '31' then ''
                                            when '32' then ''
                                            when '33' then ''
                                            else 'i.deskripsi_lembaga_lain' end
                                        when 'kecamatan' then k.nama_bpp 
                                        else '' end nama_bapel 
                                        from tbldasar_thl a
                                        left join tblsatminkal b on a.satminkal=b.kode
                                        left join tblstatus_penyuluh c on a.status_kel=c.kode
                                        left join tbldesa d on a.wil_kerja=d.id_desa
                                        left join tbldesa e on a.wil_kerja2=e.id_desa
                                        left join tbldesa f on a.wil_kerja3=f.id_desa
                                        left join tbldesa g on a.wil_kerja4=g.id_desa
                                        left join tbldesa h on a.wil_kerja5=h.id_desa
                                        left join tbldesa u on a.wil_kerja6=u.id_desa
                                        left join tbldesa v on a.wil_kerja7=v.id_desa
                                        left join tbldesa w on a.wil_kerja8=w.id_desa
                                        left join tbldesa x on a.wil_kerja9=x.id_desa
                                        left join tbldesa y on a.wil_kerja10=y.id_desa
                                        left join tblbapel i on a.penyuluh_di='kabupaten' and a.satminkal=i.kabupaten and a.unit_kerja=i.nama_bapel
                                        left join tblbpp k on a.penyuluh_di='kecamatan' and a.unit_kerja=k.id
                                        left join tbldaerah j on a.kecamatan_tugas=j.id_daerah
                                        left join tblsekolah sk on a.tingkat_pendidikan=sk.urut
        WHERE noktp = '$nik'");
        $row   = $query->getRowArray();
        return $row;
    }

    public function getPenyuluhTHLAPBDTotal($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select count(a.id) as jum, nama_dati2 as nama_kab from tbldasar_thl a left join tbldati2 b on b.id_dati2=a.satminkal where satminkal='$kode_kab' and sumber_dana='apbd'");
        $row   = $query->getRow();

        $query   = $db->query("select a.id_thl, a.id, a.jenis_penyuluh, a.noktp, a.nama, a.gelar_dpn, a.gelar_blk, a.tgl_lahir, a.bln_lahir, a.thn_lahir, a.tempat_lahir, a.jenis_kelamin,
        a.status_kel, a.agama, a.ahli_tp, a.detail_tp, a.ahli_nak, a.detail_nak, a.ahli_bun, a.detail_bun, a.ahli_hor, a.detail_hor,
        a.ahli_lainnya, a.detail_lainnya, a.instansi_pembina, a.satminkal, a.prop_satminkal, a.unit_kerja, a.kode_kab, a.tempat_tugas,
        a.wil_kerja, a.alamat, a.dati2, a.kodepos, a.kode_prop, a.telp, a.email, a.tgl_update, a.no_peserta, a.angkatan, a.penyuluh_di,
        a.kecamatan_tugas, a.wil_kerja2, a.wil_kerja3, a.wil_kerja4, a.wil_kerja5, a.wil_kerja6, a.wil_kerja7, a.wil_kerja8, a.wil_kerja9, 
        a.wil_kerja10, a.mapping, a.sumber_dana, a.tingkat_pendidikan, a.bidang_pendidikan, a.kode_bp3k, a.jurusan, a.nama_sekolah, 
        d.nm_desa as wil_kerja, e.nm_desa as wil_kerja2,
        f.nm_desa as wil_kerja3, g.nm_desa as wil_kerja4, h.nm_desa as wil_kerja5, u.nm_desa as wil_kerja6, v.nm_desa as wil_kerja7,
        w.nm_desa as wil_kerja8, x.nm_desa as wil_kerja9, y.nm_desa as wil_kerja10, 
        j.deskripsi as kecamatan_tugas,
                                case a.penyuluh_di 
                                when 'kabupaten' then 
                                    case a.unit_kerja 
                                    when '10' then 'Badan Pelaksana Penyuluhan Pertanian, Perikanan dan Kehutanan'
                                    when '20' then 'Badan Pelaksana Penyuluhan'
                                    when '31' then ''
                                    when '32' then ''
                                    when '33' then ''
                                    else 'i.deskripsi_lembaga_lain' end
                                when 'kecamatan' then k.nama_bpp 
                                else '' end nama_bapel 
                                from tbldasar_thl a
                                left join tblsatminkal b on a.satminkal=b.kode
                                left join tblstatus_penyuluh c on a.status_kel=c.kode
                                left join tbldesa d on a.wil_kerja=d.id_desa
                                left join tbldesa e on a.wil_kerja2=e.id_desa
                                left join tbldesa f on a.wil_kerja3=f.id_desa
                                left join tbldesa g on a.wil_kerja4=g.id_desa
                                left join tbldesa h on a.wil_kerja5=h.id_desa
                                left join tbldesa u on a.wil_kerja6=u.id_desa
                                left join tbldesa v on a.wil_kerja7=v.id_desa
                                left join tbldesa w on a.wil_kerja8=w.id_desa
                                left join tbldesa x on a.wil_kerja9=x.id_desa
                                left join tbldesa y on a.wil_kerja10=y.id_desa
                                left join tblbapel i on a.penyuluh_di='kabupaten' and a.satminkal=i.kabupaten and a.unit_kerja=i.nama_bapel
                                left join tblbpp k on a.penyuluh_di='kecamatan' and a.unit_kerja=k.id
                                left join tbldaerah j on a.kecamatan_tugas=j.id_daerah
                                where a.satminkal='$kode_kab' and sumber_dana='apbd' order by nama");
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
    left join tbldasar_thl b on b.dati2=a.id_dati2 where id_dati2='$kode_kab'");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getBpp($kode_kab)
    {
        $query = $this->db->query("select a.id, a.nama_bpp, a.satminkal, a.kecamatan, b.deskripsi from tblbpp a 
        left join tbldaerah b on b.id_daerah=a.kecamatan
        where a.satminkal ='$kode_kab' order by nama_bpp");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getUnitKerja($kode_kab)
    {
        $query = $this->db->query("select a.id, a.nama_bpp, a.satminkal, a.kecamatan, a.wil_kec1 
        from tblbpp a where satminkal ='$kode_kab' order by nama_bpp");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getDesa($id_swa)
    {
        $query = $this->db->query("SELECT * FROM tbldesa WHERE id_desa LIKE '" . $id_swa . "%' ORDER BY id_desa");
        $row = $query->getResultArray();
        return $row;
    }

    public function getTingkat()
    {
        $query = $this->db->query("select * from tblsekolah_thl ORDER BY urut");
        $row   = $query->getResultArray();
        return $row;
    }


    public function getDetailEdit($id_thl)
    {
        $query = $this->db->query("select a.id_thl, a.id, a.jenis_penyuluh, a.noktp, a.nama, a.gelar_dpn, a.gelar_blk, a.tgl_lahir, a.bln_lahir, a.thn_lahir, a.tempat_lahir, a.jenis_kelamin,
        a.status_kel, a.agama, a.ahli_tp, a.detail_tp, a.ahli_nak, a.detail_nak, a.ahli_bun, a.detail_bun, a.ahli_hor, a.detail_hor,
        a.ahli_lainnya, a.detail_lainnya, a.instansi_pembina, a.satminkal, a.prop_satminkal, a.unit_kerja, a.kode_kab, a.tempat_tugas,
        a.wil_kerja, a.alamat, a.dati2, a.kodepos, a.kode_prop, a.telp, a.email, a.tgl_update, a.no_peserta, a.angkatan, a.penyuluh_di,
        a.kecamatan_tugas, a.wil_kerja2, a.wil_kerja3, a.wil_kerja4, a.wil_kerja5, a.wil_kerja6, a.wil_kerja7, a.wil_kerja8, a.wil_kerja9, 
        a.wil_kerja10, a.mapping, a.sumber_dana, a.tingkat_pendidikan, a.bidang_pendidikan, a.kode_bp3k, a.jurusan, a.nama_sekolah,
                                case a.penyuluh_di 
                                when 'kabupaten' then 
                                    case a.unit_kerja 
                                    when '10' then 'Badan Pelaksana Penyuluhan Pertanian, Perikanan dan Kehutanan'
                                    when '20' then 'Badan Pelaksana Penyuluhan'
                                    when '31' then ''
                                    when '32' then ''
                                    when '33' then ''
                                    else 'i.deskripsi_lembaga_lain' end
                                when 'kecamatan' then k.nama_bpp 
                                else '' end nama_bapel 
                                from tbldasar_thl a
                                left join tblsatminkal b on a.satminkal=b.kode
                                left join tblstatus_penyuluh c on a.status_kel=c.kode
                                left join tbldesa d on a.wil_kerja=d.id_desa
                                left join tbldesa e on a.wil_kerja2=e.id_desa
                                left join tbldesa f on a.wil_kerja3=f.id_desa
                                left join tbldesa g on a.wil_kerja4=g.id_desa
                                left join tbldesa h on a.wil_kerja5=h.id_desa
                                left join tbldesa u on a.wil_kerja6=u.id_desa
                                left join tbldesa v on a.wil_kerja7=v.id_desa
                                left join tbldesa w on a.wil_kerja8=w.id_desa
                                left join tbldesa x on a.wil_kerja9=x.id_desa
                                left join tbldesa y on a.wil_kerja10=y.id_desa
                                left join tblbapel i on a.penyuluh_di='kabupaten' and a.satminkal=i.kabupaten and a.unit_kerja=i.nama_bapel
                                left join tblbpp k on a.penyuluh_di='kecamatan' and a.unit_kerja=k.id
                                left join tbldaerah j on a.kecamatan_tugas=j.id_daerah
        where id_thl = '" . $id_thl . "'");
        $row = $query->getRow();
        return json_encode($row);
    }
}
