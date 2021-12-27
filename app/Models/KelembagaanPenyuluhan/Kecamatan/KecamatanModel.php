<?php

namespace App\Models\KelembagaanPenyuluhan\Kecamatan;

use CodeIgniter\Model;
use \Config\Database;

class KecamatanModel extends Model
{
    protected $table      = 'tblbpp';
    protected $primaryKey = 'id';


    //protected $returnType     = 'array';
    //protected $useSoftDeletes = true;

    protected $allowedFields = [
        'kode_prop', 'satminkal', 'bentuk_lembaga', 'nama_bpp', 'kecamatan', 'alamat', 'tgl_berdiri', 'bln_berdiri', 'foto', 'foto_depan', 'foto_belakang', 'foto_samping', 'foto_dalam', 'urut', 'kode_bp3k',
        'thn_berdiri', 'status_gedung', 'kondisi_bangunan', 'koordinat_lokasi_bpp', 'telp_bpp', 'telp_hp', 'email', 'website', 'ketua', 'soil_apbd', 'soil_apbn',
        'roda_4_apbn', 'roda_4_apbd', 'roda_2_apbn', 'roda_2_apbd', 'pc_apbn', 'pc_apbd', 'laptop_apbn', 'laptop_apbd', 'printer_apbn', 'printer_apbd',
        'modem_apbn', 'modem_apbd', 'lcd_apbn', 'lcd_apbd', 'kios_saprotan', 'pedagang_pengepul', 'gudang_pangan', 'perbankan', 'industri_penyuluhan',
        'luas_lahan_bp3k', 'luas_lahan_petani', 'kode_koord_penyuluh', 'nama_koord_penyuluh', 'nama_koord_penyuluh_thl', 'koord_lainya_nip', 'koord_lainya_nama'
    ];


    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;


    public function getKecTotal($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select nama_dati2 as nama_kab from tbldati2 where id_dati2='$kode_kab'");
        $row   = $query->getRow();
        $query2 = $db->query("SELECT count(idpos) as jum_des FROM tb_posluhdes where kode_kab ='$kode_kab'");
        $row2   = $query2->getRow();
        $query3  = $db->query("select * , a.id, b.nama, c.deskripsi, a.tgl_update, a.bentuk_lembaga, a.alamat,f.jumgap,f.kode_bp3k,g.jumkep,d.jumpok,e.jumthl,h.jumpns,i.unit_kerja
                                from tblbpp a
                                left join tbldasar b on a.nama_koord_penyuluh=b.nip
                                left join tbldaerah c on a.kecamatan=c.id_daerah  
                                left join (select kode_bp3k, count(id_poktan) as jumpok from tb_poktan GROUP BY kode_bp3k)d on a.kode_bp3k=d.kode_bp3k
                                left join(select unit_kerja,count(id_thl) as jumthl from tbldasar_thl GROUP BY unit_kerja) e on  a.id=e.unit_kerja
                                left join(select kode_bp3k, count(id_gap) as jumgap from tb_gapoktan GROUP BY kode_bp3k)f on a.kode_bp3k=f.kode_bp3k
                                left join(select kode_kec,count(id_kep) as jumkep from tb_kep GROUP BY kode_kec )g on a.kecamatan=g.kode_kec
                                left join (select unit_kerja,count(id) as jumpns from tbldasar GROUP BY unit_kerja) h on a.id=h.unit_kerja and kode_kab='4' and status !='1' and status !='2' and status !='3'
                                left join(select unit_kerja,count(id_swa) as jumswa from tbldasar_swa GROUP BY unit_kerja) i on a.id=i.unit_kerja
                                where a.satminkal='$kode_kab' and a.kecamatan !='0'  
                                order by nama_bpp");
        $results = $query3->getResultArray();

        $data =  [
            'jum_des' => $row2->jum_des,
            'nama_kab' => $row->nama_kab,
            'table_data' => $results,
        ];

        return $data;
    }

    public function getProfilKec($kode_kec,  $kode_bpp)
    {
        $db = Database::connect();
        $query  = $db->query("select * , a.id, a.email, a.roda_4_apbn, a.soil_apbn, a.soil_apbd, a.tgl_update, a.alamat, a.kode_bp3k, b.nama, c.deskripsi, f.jumgap,f.kode_bp3k,g.jumkep,d.jumpok,e.jumthl,h.jumpns,i.unit_kerja
                                from tblbpp a
                                left join tbldasar b on a.nama_koord_penyuluh=b.nip
                                left join tbldaerah c on a.kecamatan=c.id_daerah  
                                left join (select kode_bp3k, count(id_poktan) as jumpok from tb_poktan GROUP BY kode_bp3k)d on a.kode_bp3k=d.kode_bp3k
                                left join(select unit_kerja,count(id_thl) as jumthl from tbldasar_thl GROUP BY unit_kerja) e on  a.id=e.unit_kerja
                                left join(select kode_bp3k, count(id_gap) as jumgap from tb_gapoktan GROUP BY kode_bp3k)f on a.kode_bp3k=f.kode_bp3k
                                left join(select kode_kec,count(id_kep) as jumkep from tb_kep GROUP BY kode_kec )g on a.kecamatan=g.kode_kec
                                left join (select unit_kerja,count(id) as jumpns from tbldasar GROUP BY unit_kerja) h on a.id=h.unit_kerja and kode_kab='4' and status !='1' and status !='2' and status !='3'
                                left join(select unit_kerja,count(id_swa) as jumswa from tbldasar_swa GROUP BY unit_kerja) i on a.id=i.unit_kerja
                                left join tblbpp_wil_kec j on a.kode_bp3k = j.kode_bp3k
                                where a.kecamatan='" . $kode_kec . "' and a.kecamatan !='0' and a.id = '" . $kode_bpp . "' 
                                order by nama_bpp");
        $row   = $query->getRowArray();
        //dd($row);
        return $row;
    }

    public function getKec($kode_kab)
    {
        $query = $this->db->query("select * from tbldaerah where id_dati2 LIKE '" . $kode_kab . "%' ORDER BY deskripsi ASC");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getPenyuluhPNS($kode_kab)
    {

        $query = $this->db->query("select * from tbldasar where satminkal LIKE '" . $kode_kab . "%' and kode_kab='4'
                                    ORDER BY nama ASC ");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getPenyuluhTHL($kode_kab)
    {

        $query = $this->db->query("select * from tbldasar_thl where satminkal LIKE '" . $kode_kab . "%' and penyuluh_di='kecamatan'
                                    ORDER BY nama ASC ");
        $row   = $query->getResultArray();
        return $row;
    }

    public function hapus($id)
    {
        return $this->builder->delete(['id' => $id]);
    }

    public function getNoUrut($kode_kab)
    {

        $query = $this->db->query("SELECT max(urut)+1 as no_urut FROM tblbpp where satminkal='$kode_kab'");
        $row   = $query->getRowArray();
        return $row;
    }

    public function getBP3K($kode_kec)
    {

        $query = $this->db->query("SELECT kode_bp3k FROM tblbpp where kecamatan='$kode_kec'");
        $row   = $query->getRowArray();
        return $row;
    }

    public function getWIlkec($kode_kec, $kode_bp3k)
    {
        $db = Database::connect();
        $query3  = $db->query("select *, a.kecamatan, a.id, a.jum_petani, c.deskripsi as nama_kec, b.kode_bp3k
                                from tblbpp_wil_kec a
                                left join tblbpp b on a.kode_bp3k=b.kode_bp3k
                                left join tbldaerah c on a.kecamatan=c.id_daerah
                                where b.kecamatan='" . $kode_kec . "' and b.kode_bp3k = '" . $kode_bp3k . "'");
        $results = $query3->getResultArray();

        $data =  [
            'wilkec' => $results,
        ];

        return $data;
    }

    public function getWK($id)
    {
        $query = $this->db->query("select *
                                from tblbpp_wil_kec 
                                where id='$id'
                                ");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getKlasifikasi($kode_kec, $kode_bpp)
    {
        $db = Database::connect();
        $query3  = $db->query("select *, a.id, a.id_bpp, a.tahun, a.skor, a.klasifikasi, b.kecamatan
                                from tblbpp_klasifikasi a
                                left join tblbpp b on a.id_bpp=b.id
                                where b.kecamatan='" . $kode_kec . "' and a.id_bpp = '" . $kode_bpp . "'");
        $results = $query3->getResultArray();

        $data =  [
            'klas' => $results,
        ];

        return $data;
    }

    public function getIdBpp($kode_kab)
    {
        $db = Database::connect();
        $query = $this->db->query("select id as idbpp from tblbpp where satminkal='$kode_kab'");
        $row   = $query->getRow();

        $data =  [
            'idbpp' => $row->idbpp
        ];

        return $data;
    }

    public function getKlas($id)
    {
        $query = $this->db->query("select * from tblbpp_klasifikasi where id='$id'");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getFas($kode_kec, $kode_bpp)
    {
        $db = Database::connect();
        $query3  = $db->query("select *, a.id, a.fasilitasi, a.tahun, a.kegiatan, b.kecamatan, c.fasilitasi as nama_fasilitasi
                                from tblbpp_fasilitasi_kegiatan a
                                left join tblbpp b on a.id_bpp=b.id
                                left join reff_fasilitasi_bpp c on a.fasilitasi=c.idfasilitasi
                                where b.kecamatan='" . $kode_kec . "' and a.id_bpp = '" . $kode_bpp . "'");

        $results = $query3->getResultArray();
        //dd($results);
        $data =  [
            'fasdata' => $results,
        ];

        return $data;
    }


    public function getFasilitasi($id)
    {
        $query = $this->db->query("select *
                                from tblbpp_fasilitasi_kegiatan 
                                where id='$id'
                                ");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getAward($kode_kec, $kode_bp3k)
    {
        $db = Database::connect();
        $query3  = $db->query("select *, a.id, a.nama_penghargaan, a.tahun, a.peringkat, a.tingkat, b.kecamatan, b.kode_bp3k
                                from tblbpp_penghargaan a
                                left join tblbpp b on a.kode_bp3k=b.kode_bp3k
                                where b.kecamatan='" . $kode_kec . "' and b.kode_bp3k = '" . $kode_bp3k . "'");

        $results = $query3->getResultArray();

        $data =  [
            'penghargaan' => $results,
        ];

        return $data;
    }

    public function getPenghargaan($id)
    {
        $query = $this->db->query("select *
                                from tblbpp_penghargaan 
                                where id='$id'
                                ");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getDana($kode_kec, $kode_bpp)
    {
        $db = Database::connect();
        $query3  = $db->query("select *, a.id, a.id_bpp, a.tahun_dak, b.kecamatan
                                from tblbpp_dak a
                                left join tblbpp b on a.id_bpp=b.id
                                where b.kecamatan='" . $kode_kec . "' and a.id_bpp = '" . $kode_bpp . "'");
        $results = $query3->getResultArray();

        $data =  [
            'dana' => $results,
        ];

        return $data;
    }

    public function getDak($id)
    {
        $query = $this->db->query("select *
                                from tblbpp_dak 
                                where id='$id'
                                ");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getJenisKomoditas()
    {

        $query = $this->db->query("select * from tb_komoditas order by id_sub_sektor,id_komoditas");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getPotensiWilayah($kode_kec, $kode_bpp)
    {
        $db = Database::connect();
        $query3  = $db->query("select *, a.id_potensi, a.id_bpp, a.luas_lhn, b.kecamatan, c.nama_subsektor, c.nama_komoditas
                                from tb_bpp_potensi a
                                left join tblbpp b on a.id_bpp=b.id
                                left join tb_komoditas c on a.kode_komoditas=c.kode_komoditas
                                where b.kecamatan='" . $kode_kec . "' and a.id_bpp = '" . $kode_bpp . "'");
        $results = $query3->getResultArray();

        $data =  [
            'potensi' => $results,
        ];

        return $data;
    }

    public function getPowil($id_potensi)
    {
        $query = $this->db->query("select *
                                from tb_bpp_potensi 
                                where id_potensi='$id_potensi'
                                ");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getPenyuluh($kode_kec)
    {
        $db = Database::connect();
        $query = $db->query("select * from tbldasar where tempat_tugas='$kode_kec' and kode_kab='4' 
                            and status !='1' and status !='2' and status !='3'");
        $results   = $query->getResultArray();
        $query2  = $db->query("select * from tbldasar_thl where tempat_tugas='$kode_kec'");
        $results2 = $query2->getResultArray();
        $query3  = $db->query("select * from tbldasar_swa where tempat_tugas='$kode_kec'");
        $results3 = $query3->getResultArray();
        $query4  = $db->query("select * from tbldasar_swasta where tempat_tugas='$kode_kec'");
        $results4 = $query4->getResultArray();
        $query5  = $db->query("select * from tbldasar_p3k where tempat_tugas='$kode_kec' 
                                and kode_kab='4' and status !='1' and status !='2' and status !='3' order by nama");
        $results5 = $query5->getResultArray();

        $data =  [
            'pns_kec' => $results,
            'thl_kec' => $results2,
            'swa_kec' => $results3,
            'swasta_kec' => $results4,
            'p3k_kec' => $results5,
        ];

        return $data;
    }
}