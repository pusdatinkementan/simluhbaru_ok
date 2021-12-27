<?php

namespace App\Models\KelembagaanPenyuluhan\Kabupaten;

use CodeIgniter\Model;
use \Config\Database;

class KabupatenModel extends Model
{
    protected $table      = 'tblbapel';
    protected $primaryKey = 'id_gapoktan';


    //protected $returnType     = 'array';
    //protected $useSoftDeletes = true;

    protected $allowedFields = [
        'kode_prop', 'kabupaten', 'roda_4_apbn', 'roda_4_apbd', 'roda_2_apbn' . 'roda_2_apbd', 'pc_apbn', 'pc_apbd', 'laptop_apbn', 'laptop_apbd', 'printer_apbn', 'printer_apbd', 'lcd_apbn', 'lcd_apbd', 'soil_apbn', 'soil_apbd', 'modem_apbn', 'modem_apbd',
        'perda', 'pergub', 'id_gapoktan', 'nama_bapel', 'dasar_hukum', 'deskripsi_lembaga_lain', 'no_peraturan', 'tgl_berdiri', 'bln_berdiri', 'thn_berdiri', 'telp_kantor', 'alamat',  'email', 'website', 'ketua', 'telp_hp', 'telp_hp_koord', 'email_koord', 'jenis_pertanian', 'koord',
        'jenis_tp', 'jenis_hor', 'jenis_bun', 'jenis_nak', 'jenis_pkh', 'jenis_ketahanan_pangan', 'jenis_pangan', 'bidang_luh', 'nama_kabid', 'hp_kabid', 'seksi_luh', 'nama_kasie', 'hp_kasie', 'uptd_luh', 'nama_kauptd', 'hp_kauptd', 'nama_koord_penyuluh', 'nama_koord_penyuluh_thl', 'koord_lainya_nip', 'koord_lainya_nama', 'kode_koord_penyuluh'
    ];


    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;


    public function getKabTotal($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select nama_dati2 as nama_kab from tbldati2 where id_dati2='$kode_kab'");
        $row   = $query->getRow();
        $query2 = $db->query("SELECT count(idpos) as jum_des FROM tb_posluhdes where kode_kab ='$kode_kab'");
        $row2   = $query2->getRow();
        $query3  = $db->query("select *,a.kabupaten, a.alamat, a.ketua, a.telp_hp, a.tgl_update, a.nama_bapel, c.jumthl, g.jumkep, h.nama_prop, i.nama_dati2, 
                                    case a.nama_bapel 
                                    when '10' then 'Badan Pelaksana Penyuluhan Pertanian, Perikanan dan Kehutanan'
                                    when '20' then 'Badan Pelaksana Penyuluhan'
                                    when '31' then deskripsi_lembaga_lain
                                    when '32' then deskripsi_lembaga_lain
                                    when '33' then deskripsi_lembaga_lain
                                    else '' end nama_bapel
                                from tblbapel a
                                left join (select satminkal, count(id_thl) as jumthl from tbldasar_thl GROUP BY satminkal) c on a.kabupaten=c.satminkal
                                left join (select kode_kab, count(id_kep) as jumkep from tb_kep GROUP BY kode_kab) g on a.kabupaten=g.kode_kab
                                left join tblpropinsi h on a.kode_prop=h.id_prop
                                left join tbldati2 i on a.kabupaten=i.id_dati2
                                where a.kabupaten='$kode_kab'
                                ");
        $results = $query3->getResultArray();

        $data =  [
            'jum_des' => $row2->jum_des,
            'nama_kab' => $row->nama_kab,
            'table_data' => $results,
        ];

        return $data;
    }

    public function getBapel($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select nama_dati2 as nama_kab from tbldati2 where id_dati2='$kode_kab'");
        $row   = $query->getRow();
        $query2 = $db->query("SELECT count(idpos) as jum_des FROM tb_posluhdes where kode_kab ='$kode_kab'");
        $row2   = $query2->getRow();
        $query3  = $db->query("select *, a.alamat, a.ketua, a.tgl_update, a.nama_bapel, a.no_peraturan, b.jenis_penyuluh, b.nama, b.nip, c.nama as namathl, c.noktp, c.jenis_penyuluh as jenis_pen_thl, d.fasilitasi, d.tahun, d.kegiatan, e.fasilitasi as nama_fasilitasi,
                                    case a.nama_bapel 
                                    when '31' then 'Badan'
                                    when '32' then 'Dinas'
                                    else '' end nama_bapel
                                from tblbapel a
                                left join tbldasar b on a.nama_koord_penyuluh=b.nip
                                left join tbldasar_thl c on a.nama_koord_penyuluh_thl=c.noktp
                                left join tblbapel_fasilitasi_kegiatan d on a.id_gapoktan=d.id_bapel
                                left join reff_fasilitasi_bpp e on d.fasilitasi=e.idfasilitasi
                                where kabupaten='$kode_kab'
                                ");
        $results = $query3->getResultArray();

        $data =  [
            'jum_des' => $row2->jum_des,
            'nama_kab' => $row->nama_kab,
            'bapel_data' => $results,
        ];

        return $data;
    }

    public function getFas($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select nama_dati2 as nama_kab from tbldati2 where id_dati2='$kode_kab'");
        $row   = $query->getRow();
        $query3  = $db->query("select *, a.fasilitasi, a.tahun, a.kegiatan, b.kabupaten, c.fasilitasi as nama_fasilitasi
                                from tblbapel_fasilitasi_kegiatan a
                                left join tblbapel b on a.id_bapel=b.id_gapoktan
                                left join reff_fasilitasi_bpp c on a.fasilitasi=c.idfasilitasi
                                where kabupaten='$kode_kab'
                                ");
        $results = $query3->getResultArray();

        $data =  [
            'nama_kab' => $row->nama_kab,
            'fasdata' => $results,
        ];

        return $data;
    }

    public function getDetailKab($id)
    {
        $query = $this->db->query("select *
                                from tblbapel 
                                where id_gapoktan='$id'
                                ");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getPenyuluhPNS($kode_kab)
    {

        $query = $this->db->query("select * from tbldasar where satminkal LIKE '" . $kode_kab . "' and kode_kab='4' and status='0' or 
                                    satminkal LIKE '" . $kode_kab . "' and kode_kab='3' and status='0'
                                    ORDER BY nama ASC ");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getPenyuluhTHL($kode_kab)
    {

        $query = $this->db->query("select * from tbldasar_thl where satminkal LIKE '" . $kode_kab . "' and penyuluh_di='kabupaten'
                                    ORDER BY nama ASC ");
        $row   = $query->getResultArray();
        return $row;
    }

    public function ubah($data, $id_gapoktan)
    {
        return $this->builder->update($data, ['id_gapoktan' => $id_gapoktan]);
    }

    public function getFasilitasi($id)
    {
        $query = $this->db->query("select *
                                from tblbapel_fasilitasi_kegiatan 
                                where id='$id'
                                ");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getIdGap($kode_kab)
    {
        $db = Database::connect();
        $query = $this->db->query("select id_gapoktan as idgap from tblbapel where kabupaten='$kode_kab'");
        $row   = $query->getRow();

        $data =  [
            'idgap' => $row->idgap
        ];

        return $data;
    }

    public function hapus($id)
    {
        return $this->builder->delete(['id' => $id]);
    }

    public function getTotalPNS($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select count(id) as jum_pns from tbldasar where satminkal='$kode_kab' 
                            and kode_kab='3' and status !='1' and status !='2' and status !='3'");
        $row   = $query->getRow();
        $query2  = $db->query("select id,nama,noktp,nip from tbldasar where satminkal='$kode_kab' 
                              and kode_kab='3' and status !='1' and status !='2' and status !='3' order by nama");
        $results = $query2->getResultArray();

        $data =  [
            'jum_pns' => $row->jum_pns,
            'datapns' => $results,
        ];

        return $data;
    }

    public function getTotalTHLAPBN($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select count(id_thl) as jum_thl from tbldasar_thl where satminkal='$kode_kab' 
                            and penyuluh_di='kabupaten' and sumber_dana='apbn'");
        $row   = $query->getRow();
        $query2  = $db->query("select * from tbldasar_thl where satminkal='$kode_kab' and 
                              penyuluh_di='kabupaten' and sumber_dana='apbn' order by nama");
        $results = $query2->getResultArray();

        $data =  [
            'jum_thl' => $row->jum_thl,
            'datathl' => $results,
        ];

        return $data;
    }

    public function getTotalTHLAPBD($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select count(id_thl) as jum_thl_apbd from tbldasar_thl where satminkal='$kode_kab' 
                            and penyuluh_di='kabupaten' and sumber_dana='apbd'");
        $row   = $query->getRow();
        $query2  = $db->query("select * from tbldasar_thl where satminkal='$kode_kab' 
                             and penyuluh_di='kabupaten' and sumber_dana='apbd' order by nama");
        $results = $query2->getResultArray();

        $data =  [
            'jum_thl_apbd' => $row->jum_thl_apbd,
            'datathl_apbd' => $results,
        ];

        return $data;
    }
}
