<?php

namespace App\Models;

use \Config\Database;
use CodeIgniter\Model;

class LembagaModel extends Model
{

    // protected $table = 'tblbapel';

    //  protected $db = \Config\Database::connect();

    public function getProfil($id)
    {


        if (session()->get('status_user') == '1') {

            $query = $this->db->query("select *, a.alamat, a.email, a.ketua, a.tgl_update, a.kode_prop, a.nama_bapel, b.nama as namakoord  
                                        from tblbakor a
                                        left join tbldasar b on a.nama_koord_penyuluh=b.nip 
                                        where a.kode_prop='$id' 
                                        ");
        } elseif (session()->get('status_user') == '4') {
            $query = $this->db->query("SELECT * FROM tblbapel where kabupaten = " . $id);
        } elseif (session()->get('status_user') == '200') {
            $query = $this->db->query("select *, a.id_gapoktan, a.alamat, a.ketua, a.tgl_update, a.nama_bapel, a.email, b.nama as namapns, c.nama as namathl
            from tblbapel a
            left join tbldasar b on a.nama_koord_penyuluh=b.nip and nip !=''
            left join tbldasar_thl c on a.nama_koord_penyuluh_thl=c.noktp and penyuluh_di='kabupaten' and sumber_dana='apbn'
            where kabupaten='$id'
            ");
        } elseif (session()->get('status_user') == '300') {
            $query = $this->db->query("select * , a.id, a.email, a.roda_4_apbn, a.tgl_update, a.alamat,  b.nama, c.deskripsi, f.jumgap,f.kode_bp3k,g.jumkep,d.jumpok,e.jumthl,h.jumpns,i.unit_kerja, k.nama_prop as namaprov, k.id_prop, l.nama_dati2 as namakab, l.id_dati2
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
                                    left join tblpropinsi k on a.kode_prop = k.id_prop
                                    left join tbldati2 l on a.satminkal = l.id_dati2
                                    where a.kecamatan='$id' and a.kecamatan !='0'  
                                    order by nama_bpp");
        }

        $row   = $query->getRowArray();
        return $row;
    }

    public function saveProfil($data)
    {
        $db = db_connect();

        if (session()->get('status_user') == '200') {
            $builder = $db->table('tblbapel');
            $builder->where('kabupaten', session()->get('kodebapel'))->update($data);
        } elseif (session()->get('status_user') == '300') {
            $builder = $db->table('tblbpp');
            $builder->where('kecamatan', session()->get('kodebpp'))->update($data);
        }
    }

    public function getKoordinatBpp()
    {

        $query = $this->db->query("SELECT id, kecamatan, nama_bpp, alamat, ketua, email, koordinat_lokasi_bpp FROM tblbpp WHERE koordinat_lokasi_bpp <> '' ORDER BY id");

        $row   = $query->getResultArray();
        return $row;
    }

    public function getProfilKec($kode)
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
                                where a.kecamatan='" . $kode . "' and a.kecamatan !='0' 
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

    public function getBP3K($kode)
    {

        $query = $this->db->query("SELECT kode_bp3k FROM tblbpp where kecamatan='$kode'");
        $row   = $query->getRowArray();
        return $row;
    }

    public function getWIlkec($kode)
    {
        $db = Database::connect();
        $query3  = $db->query("select *, a.kecamatan, a.id, a.jum_petani, c.deskripsi as nama_kec, b.kode_bp3k
                                from tblbpp_wil_kec a
                                left join tblbpp b on a.kode_bp3k=b.kode_bp3k
                                left join tbldaerah c on a.kecamatan=c.id_daerah
                                where b.kecamatan='" . $kode . "' ");
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

    public function getKlasifikasi($kode)
    {
        $db = Database::connect();
        $query3  = $db->query("select *, a.id, a.id_bpp, a.tahun, a.skor, a.klasifikasi, b.kecamatan
                                from tblbpp_klasifikasi a
                                left join tblbpp b on a.id_bpp=b.id
                                where b.kecamatan='" . $kode . "'");
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

    public function getFas($kode)
    {
        $db = Database::connect();
        $query3  = $db->query("select *, a.id, a.fasilitasi, a.tahun, a.kegiatan, b.kecamatan, c.fasilitasi as nama_fasilitasi
                                from tblbpp_fasilitasi_kegiatan a
                                left join tblbpp b on a.id_bpp=b.id
                                left join reff_fasilitasi_bpp c on a.fasilitasi=c.idfasilitasi
                                where b.kecamatan='" . $kode . "'");

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

    public function getAward($kode)
    {
        $db = Database::connect();
        $query3  = $db->query("select *, a.id, a.nama_penghargaan, a.tahun, a.peringkat, a.tingkat, b.kecamatan, b.kode_bp3k
                                from tblbpp_penghargaan a
                                left join tblbpp b on a.kode_bp3k=b.kode_bp3k
                                where b.kecamatan='" . $kode . "' ");

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

    public function getDana($kode)
    {
        $db = Database::connect();
        $query3  = $db->query("select *, a.id, a.id_bpp, a.tahun_dak, b.kecamatan
                                from tblbpp_dak a
                                left join tblbpp b on a.id_bpp=b.id
                                where b.kecamatan='" . $kode . "'");
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

    public function getPotensiWilayah($kode)
    {
        $db = Database::connect();
        $query3  = $db->query("select *, a.id_potensi, a.id_bpp, a.luas_lhn, b.kecamatan, c.nama_subsektor, c.nama_komoditas
                                from tb_bpp_potensi a
                                left join tblbpp b on a.id_bpp=b.id
                                left join tb_komoditas c on a.kode_komoditas=c.kode_komoditas
                                where b.kecamatan='" . $kode . "'");
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

    public function getPenyuluh($kode)
    {
        $db = Database::connect();
        $query = $db->query("select * from tbldasar where tempat_tugas='$kode' and kode_kab='4' 
                            and status !='1' and status !='2' and status !='3'");
        $results   = $query->getResultArray();
        $query2  = $db->query("select * from tbldasar_thl where tempat_tugas='$kode'");
        $results2 = $query2->getResultArray();
        $query3  = $db->query("select * from tbldasar_swa where tempat_tugas='$kode'");
        $results3 = $query3->getResultArray();
        $query4  = $db->query("select * from tbldasar_swasta where tempat_tugas='$kode'");
        $results4 = $query4->getResultArray();
        $query5  = $db->query("select * from tbldasar_p3k where tempat_tugas='$kode' 
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
