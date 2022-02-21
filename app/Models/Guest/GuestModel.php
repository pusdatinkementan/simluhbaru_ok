<?php

namespace App\Models\Guest;

use CodeIgniter\Model;
use \Config\Database;

class GuestModel extends Model
{
    // protected $table      = 'tbldesa';

    public function getDaftarKelembagaanProv()
    {
        $db = Database::connect();
        $query = $db->query("select *, a.kode_prop, a.alamat, b.nama as namapen, c.nama_prop as namaprov  
                            from tblbakor a
                            left join tbldasar b on a.nama_koord_penyuluh = b.nip and nip !=''
                            left join tblpropinsi c on a.kode_prop = c.id_prop 
                            ORDER BY c.nama_prop
                            ");
        $results   = $query->getResultArray();

        $data =  [
            'rlprov' => $results,
        ];

        return $data;
    }

    public function getDaftarKelembagaanKab($kode_prop)
    {
        $db = Database::connect();
        $sql = "select *,a.kode_prop, b.id_dati2 as kode_kab, b.nama_dati2, c.nama as namapns, d.nama as namathl
                from tblbapel a 
                left join tbldati2 b on a.kabupaten=b.id_dati2
                left join tbldasar c on a.nama_koord_penyuluh=c.nip and nip !=''
                left join tbldasar_thl d on a.nama_koord_penyuluh_thl=d.noktp
                where a.kode_prop='$kode_prop' ";
        // dd($sql);
        $query = $db->query($sql);
        $results   = $query->getResultArray();

        $data =  [
            'rlkab' => $results,
        ];

        return $data;
    }

    public function getDaftarKelembagaanKec($kode_kab)
    {
        $db = Database::connect();
        $sql = "select *,a.satminkal, c.deskripsi as namakec
         from tblbpp a
        left join tblbpp_wil_kec b on a.kode_bp3k=b.kode_bp3k
        left join tbldaerah c on b.kecamatan=c.id_daerah
        where a.satminkal='$kode_kab' ";
        // dd($sql);
        $query = $db->query($sql);
        $results   = $query->getResultArray();

        $data =  [
            'rlkec' => $results,
        ];

        return $data;
    }

    public function getProfilBPP($kode_kec, $kode_bpp)
    {
        $db = Database::connect();
        $query  = $db->query("select * , d.nama_dati2 as namakab, e.nama_prop as namaprov
                                from tblbpp a 
                                left join tbldasar b on a.nama_koord_penyuluh=b.nip
                                left join tbldaerah c on a.kecamatan=c.id_daerah 
                                left join tbldati2 d on a.satminkal=d.id_dati2
                                left join tblpropinsi e on a.kode_prop=e.id_prop 
                                left join tblbpp_wil_kec j on a.kode_bp3k = j.kode_bp3k
                                where a.kecamatan='" . $kode_kec . "' and a.kecamatan !='0' and a.id = '" . $kode_bpp . "' 
                                order by nama_bpp");
        $row   = $query->getRowArray();
        return $row;
    }

    public function getRekapKeluh()
    {
        $db = Database::connect();
        $query  = $db->query("
                                SELECT a.id_prop as kode_prop, a.nama_prop AS namaprov, b.nama_bapel, IFNULL(b.bakor,0) AS jum_bakor, c.dinas,
                                IFNULL(d.kab_bapeluh,0) AS jum_bapeluh, e.kab_dinas, f.kec_bp3k, IFNULL(g.posluhdes,0) AS posluhdes
                                FROM tblpropinsi a
                                LEFT JOIN                            
                                (SELECT id_bakor, COUNT(id_bakor) AS bakor,nama_bapel,kode_prop FROM  tblbakor WHERE nama_bapel='10' OR nama_bapel='21' GROUP BY kode_prop) b
                                ON a.id_prop=b.kode_prop LEFT JOIN
                                (SELECT id_bakor, COUNT(id_bakor) AS dinas,nama_bapel,kode_prop FROM tblbakor WHERE nama_bapel='22' GROUP BY kode_prop) c
                                ON a.id_prop=c.kode_prop
                                LEFT JOIN (SELECT kode_prop, COUNT(id_gapoktan) AS kab_bapeluh,nama_bapel FROM tblbapel WHERE nama_bapel='10' OR nama_bapel='20' OR
                                nama_bapel='31' GROUP BY kode_prop) d
                                ON a.id_prop=d.kode_prop
                                LEFT JOIN (SELECT kode_prop, COUNT(id_gapoktan) AS kab_dinas,nama_bapel FROM tblbapel WHERE nama_bapel='32' OR nama_bapel='33' 
                                GROUP BY kode_prop) e ON a.id_prop=e.kode_prop
                                LEFT JOIN (SELECT kode_prop, COUNT(id) AS kec_bp3k FROM tblbpp GROUP BY kode_prop) f
                                ON a.id_prop=f.kode_prop
                                LEFT JOIN (SELECT kode_prop, COUNT(idpos) AS posluhdes FROM tb_posluhdes GROUP BY kode_prop) g
                                ON a.id_prop=g.kode_prop
                                GROUP BY a.`nama_prop` ORDER BY a.nama_prop
                            ");
        $results = $query->getResultArray();

        $data =  [
            'rkeluh' => $results
        ];

        return $data;
    }

    public function getRekapKeluhKec($kode_prop)
    {
        $db = Database::connect();
        $query = $db->query("select nama_prop as namaprov from tblpropinsi where id_prop='$kode_prop'");
        $row   = $query->getRow();
        $query  = $db->query("select a.id_dati2,a.nama_dati2 as namakab, b.jumbpp FROM 
        (SELECT COUNT(id) as jumbpp,satminkal from tblbpp where kode_prop='$kode_prop' group by satminkal) b join 
        (SELECT * from tbldati2 where id_prop='$kode_prop') a on a.id_dati2=b.satminkal group by a.id_dati2");

        $results = $query->getResultArray();

        $data =  [
            'namaprov' => $row->namaprov,
            'rkeluhkec' => $results
        ];

        return $data;
    }

    public function getRekapKelembagaan()
    {
        $db = Database::connect();
        $query = $db->query("select a.kode_prop, a.alamat, a.deskripsi_lembaga_lain, a.dasar_hukum, a.no_peraturan, a.tgl_berdiri, a.bln_berdiri, a.thn_berdiri, a.alamat, b.nama_prop as namaprov  
                            from tblbakor a
                            left join tblpropinsi b on a.kode_prop = b.id_prop 
                            ORDER BY b.nama_prop
                            ");
        $results   = $query->getResultArray();

        $data =  [
            'rlprov' => $results,
        ];

        return $data;
    }

    public function getRekapBPP($kode_prop)
    {
        $db = Database::connect();
        $query = $db->query("select nama_prop as namaprov from tblpropinsi where id_prop='$kode_prop'");
        $row   = $query->getRow();
        $query = $db->query("select a.id_prop as kode_prop, a.id_dati2 as kode_kab, a.nama_dati2, b.nama_bapel, b.deskripsi_lembaga_lain, 
        c.jumkec, d.jumbpp, ifnull(e.klasprat,0) as klasprat, ifnull(f.klasmad,0) as klasmad, ifnull(g.klasut,0) as klasut, ifnull(h.klasad,0) as klasad, ifnull(i.klasno,0) as klasno,ifnull(j.milik,0) as milik, 
        ifnull(k.sewa,0) as sewa, ifnull(l.noket,0) as noket, ifnull(m.baik,0) as baik, ifnull(n.rusak,0) as rusak, ifnull(o.tk,0) as tk, ifnull(p.lahan_bp3k,0) as lahan_bp3k, ifnull(q.lahan_petani,0) as lahan_petani
        from tbldati2 a 
        left join tblbapel b on a.id_dati2=b.kabupaten
        left join (select id_dati2, count(id_daerah) as jumkec from tbldaerah group by id_dati2) c on a.id_dati2=c.id_dati2
        left join (select satminkal, count(satminkal) as jumbpp from tblbpp group by satminkal) d on a.id_dati2=d.satminkal
        left join (select satminkal, count(klasifikasi) as klasprat,klasifikasi from tblbpp where klasifikasi='pratama' group by satminkal) e on a.id_dati2=e.satminkal 
        left join (select satminkal, count(klasifikasi) as klasmad,klasifikasi from tblbpp where klasifikasi='madya' group by satminkal) f on a.id_dati2=f.satminkal 
        left join (select satminkal, count(klasifikasi) as klasut,klasifikasi from tblbpp where klasifikasi='utama' group by satminkal) g on a.id_dati2=g.satminkal 
        left join (select satminkal, count(klasifikasi) as klasad,klasifikasi from tblbpp where klasifikasi='aditama' group by satminkal) h on a.id_dati2=h.satminkal
        left join (select satminkal, count(klasifikasi) as klasno,klasifikasi from tblbpp where klasifikasi='' group by satminkal) i on a.id_dati2=i.satminkal 
        left join (select satminkal, count(status_gedung) as milik,status_gedung from tblbpp where status_gedung='milik sendiri' group by satminkal) j on a.id_dati2=j.satminkal
        left join (select satminkal, count(status_gedung) as sewa,status_gedung from tblbpp where status_gedung='sewa/pinjam' group by satminkal) k on a.id_dati2=k.satminkal
        left join (select satminkal, count(status_gedung) as noket,status_gedung from tblbpp where status_gedung='' group by satminkal) l on a.id_dati2=l.satminkal 
        left join (select satminkal, count(kondisi_bangunan) as baik,kondisi_bangunan from tblbpp where kondisi_bangunan='baik' group by satminkal) m on a.id_dati2=m.satminkal
        left join (select satminkal, count(kondisi_bangunan) as rusak,kondisi_bangunan from tblbpp where kondisi_bangunan='rusak' group by satminkal) n on a.id_dati2=n.satminkal
        left join (select satminkal, count(kondisi_bangunan) as tk,kondisi_bangunan from tblbpp where kondisi_bangunan='' group by satminkal) o on a.id_dati2=o.satminkal
        left join (select satminkal, sum(luas_lahan_bp3k) as lahan_bp3k,luas_lahan_bp3k from tblbpp group by satminkal) p on a.id_dati2=p.satminkal
        left join (select satminkal, sum(luas_lahan_petani) as lahan_petani,luas_lahan_petani from tblbpp group by satminkal) q on a.id_dati2=q.satminkal
        where a.id_prop = '$kode_prop'");
        $results   = $query->getResultArray();

        $data =  [
            'namaprov' => $row->namaprov,
            'rkbpp' => $results
        ];

        return $data;
    }

    public function getRekapProfBPP($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select b.nama_prop as namaprov from tblbpp a
        left join tblpropinsi b on a.kode_prop=b.id_prop where satminkal='$kode_kab'");
        $row   = $query->getRow();
        $query = $db->query("select nama_dati2 as namakab from tbldati2 where id_dati2='$kode_kab'");
        $row2   = $query->getRow();
        $query = $db->query("select a.satminkal as kode_kab, a.nama_bpp, c.deskripsi as namakec,  a.klasifikasi, a.status_gedung, a.kondisi_bangunan, a.luas_lahan_bp3k, a.luas_lahan_petani
        from tblbpp a
        left join tblbpp_wil_kec b on a.kode_bp3k = b.kode_bp3k
        left join tbldaerah c on b.kecamatan=c.id_daerah
        where a.satminkal='$kode_kab'");
        $results   = $query->getResultArray();

        $data =  [
            'namaprov' => $row->namaprov,
            'namakab' => $row2->namakab,
            'rpbpp' => $results
        ];

        return $data;
    }

    public function getProv()
    {
        $db = Database::connect();
        $query = $db->query("select * from tblpropinsi");
        $row   = $query->getResultArray();

        return $row;
    }

    public function getKab($idprop)
    {
        $db = Database::connect();
        $query = $db->query("SELECT * FROM tbldati2 WHERE id_prop LIKE '" . $idprop . "' ORDER BY nama_dati2");
        $row   = $query->getResultArray();

        return $row;
    }

    public function getBpp($idkab)
    {
        $db = Database::connect();
        $query = $db->query("SELECT * FROM tblbpp WHERE satminkal LIKE '" . $idkab . "' ORDER BY nama_bpp");
        $row   = $query->getResultArray();

        return $row;
    }

    public function getPotensiWilayah($idbpp)
    {
        $db = Database::connect();
        $query3  = $db->query("select *, a.id_potensi, a.id_bpp, a.luas_lhn, b.kecamatan, c.nama_subsektor, c.nama_komoditas
                                from tb_bpp_potensi a
                                left join tblbpp b on a.id_bpp=b.id
                                left join tb_komoditas c on a.kode_komoditas=c.kode_komoditas
                                where a.id_bpp = '" . $idbpp . "'");
        $results = $query3->getResultArray();

        return $results;
    }

    public function getDaftarKetenagaan()
    {
        $db = Database::connect();
        $query = $db->query("select count(id) as jum_pusat from tbldasar where satminkal='0109' and kode_kab='1' and status='0'");
        $row   = $query->getRow();
        $query2 = $db->query("select count(id) as jum_pusatTB from tbldasar where satminkal='0109' and kode_kab='1' and status='6'");
        $row2   = $query2->getRow();
        $query3 = $db->query("select count(id) as jum_bp2tp from tbldasar where satminkal='0200' and kode_kab='1' and status='0'");
        $row3   = $query3->getRow();
        $query4 = $db->query("select count(id) as jum_bp2tp_TB from tbldasar where satminkal='0200' and kode_kab='1' and status='6'");
        $row4   = $query4->getRow();
        $query5 = $db->query("select *, IFNULL(c.pns,0) AS pns,IFNULL(d.pnsTB,0) AS pnsTB,IFNULL(e.cpns,0) AS cpns,IFNULL(f.p3k,0) AS p3k,IFNULL(g.thl_apbn,0) AS thl_apbn,
        IFNULL(h.thl_apbd,0) AS thl_apbd,IFNULL(i.swa,0) AS swa,IFNULL(j.swasta,0) AS swasta
        FROM tblpropinsi a
        left join (select kode_prop, count(id) as jum_bptp_aktif from tbldasar where status='0'  and satminkal!='' group by kode_prop) b on a.id_prop=b.kode_prop
        left join (select kode_prop, count(id) as pns from tbldasar where status='0' and satminkal!='' group by kode_prop) c on a.id_prop=c.kode_prop
        left join (select kode_prop, count(id) as pnsTB from tbldasar where status='6' group by kode_prop) d on a.id_prop=d.kode_prop
        left join (select kode_prop, count(id) as cpns from tbldasar where status='7' and satminkal!='' group by kode_prop) e on a.id_prop=e.kode_prop
        left join (select kode_prop, count(id) as p3k from tbldasar_p3k where satminkal!='' and status='0' group by kode_prop) f on a.id_prop=f.kode_prop
        left join (select prop_satminkal, count(nama) as thl_apbn from tbldasar_thl where sumber_dana='apbn' or sumber_dana='APBN' group by prop_satminkal) g on a.id_prop=g.prop_satminkal
        left join (select prop_satminkal, count(nama) as thl_apbd from tbldasar_thl where sumber_dana='apbd' group by prop_satminkal) h on a.id_prop=h.prop_satminkal
        left join (select prop_satminkal,count(id_swa) as swa from tbldasar_swa group by prop_satminkal) i on a.id_prop=i.prop_satminkal
        left join (select prop_satminkal,count(id_swa) as swasta from tbldasar_swasta group by prop_satminkal) j on a.id_prop=j.prop_satminkal
        order by nama_prop");
        $results   = $query5->getResultArray();

        $data =  [
            'jum_pusat' => $row->jum_pusat,
            'jum_pusatTB' => $row2->jum_pusatTB,
            'jum_bp2tp' => $row3->jum_bp2tp,
            'jum_bp2tp_TB' => $row4->jum_bp2tp_TB,
            'dk' => $results
        ];

        return $data;
    }

    public function getBPPSDMP()
    {
        $db = Database::connect();
        $query = $db->query("select *, a.nama, a.nip, b.kredit_utama, c.nama as desgol, c.gol_ruang, b.gol, b.tgl_spk
        from tbldasar a
        left join (select nip,gol,tgl_spk,kredit_utama,min(gol),max(kredit_utama) from tblpak group by nip) b on a.nip=b.nip
        left join tblpp c on b.gol = c.kode
        where a.status='0' and a.satminkal='0109' order by a.nama asc");
        $results   = $query->getResultArray();

        $data =  [
            'bppsdmp' => $results
        ];

        return $data;
    }

    public function getBP2TP()
    {
        $db = Database::connect();
        $query = $db->query("select *, a.nama, a.nip, b.kredit_utama, c.nama as desgol, c.gol_ruang, b.gol, b.tgl_spk
        from tbldasar a
        left join (select nip,gol,tgl_spk,kredit_utama,min(gol),max(kredit_utama) from tblpak group by nip) b on a.nip=b.nip
        left join tblpp c on b.gol = c.kode
        where a.status='0' and a.satminkal='0200' order by a.nama asc");
        $results   = $query->getResultArray();

        $data =  [
            'bp2tp' => $results
        ];

        return $data;
    }

    public function getDaftarKetenagaanKab($kode_prop)
    {
        $db = Database::connect();
        $query = $db->query("select id_prop,nama_prop as namaprov from tblpropinsi where id_prop='$kode_prop'");
        $row   = $query->getRow();
        $query3 = $db->query("select count(id) as jum_bptp from tbldasar where satminkal='$kode_prop' and status='0' and satminkal!=''");
        $row3   = $query3->getRow();
        $query4 = $db->query("select count(id) as jum_bptp_TB from tbldasar where satminkal='$kode_prop' and status='6' and satminkal!=''");
        $row4   = $query4->getRow();
        $query5 = $db->query("select *, IFNULL(c.pns,0) AS pns,IFNULL(d.pnsTB,0) AS pnsTB,IFNULL(e.cpns,0) AS cpns,IFNULL(f.p3k,0) AS p3k,IFNULL(g.thl_apbn,0) AS thl_apbn,
        IFNULL(h.thl_apbd,0) AS thl_apbd,IFNULL(i.swa,0) AS swa,IFNULL(j.swasta,0) AS swasta
        FROM tbldati2 a
        left join (select satminkal, count(id) as jum_bptp_aktif from tbldasar where status='0' group by satminkal) b on a.id_dati2=b.satminkal
        left join (select satminkal, count(id) as pns from tbldasar where status='0' and satminkal!='' group by satminkal) c on a.id_dati2=c.satminkal
        left join (select satminkal, count(id) as pnsTB from tbldasar where status='6' group by satminkal) d on a.id_dati2=d.satminkal
        left join (select satminkal, count(id) as cpns from tbldasar where status='7' and satminkal!='' group by satminkal) e on a.id_dati2=e.satminkal
        left join (select satminkal, count(id) as p3k from tbldasar_p3k where satminkal!='' and status='0' group by satminkal) f on a.id_dati2=f.satminkal
        left join (select satminkal, count(nama) as thl_apbn from tbldasar_thl where sumber_dana='apbn' or sumber_dana='APBN' group by satminkal) g on a.id_dati2=g.satminkal
        left join (select satminkal, count(nama) as thl_apbd from tbldasar_thl where sumber_dana='apbd' group by satminkal) h on a.id_dati2=h.satminkal
        left join (select satminkal,count(id_swa) as swa from tbldasar_swa group by satminkal) i on a.id_dati2=i.satminkal
        left join (select satminkal,count(id_swa) as swasta from tbldasar_swasta group by satminkal) j on a.id_dati2=j.satminkal
        where id_prop='$kode_prop' order by nama_dati2");
        $results   = $query5->getResultArray();

        $data =  [
            'namaprov' => $row->namaprov,
            'id_prop' => $row->id_prop,
            'jum_bptp' => $row3->jum_bptp,
            'jum_bptp_TB' => $row4->jum_bptp_TB,
            'dk' => $results
        ];

        return $data;
    }

    public function getBPTP($kode_prop)
    {
        $db = Database::connect();
        $query = $db->query("select *, a.nama, a.nip, b.kredit_utama, c.nama as desgol, c.gol_ruang, b.gol, b.tgl_spk
        from tbldasar a
        left join (select nip,gol,tgl_spk,kredit_utama,min(gol),max(kredit_utama) from tblpak group by nip) b on a.nip=b.nip
        left join tblpp c on b.gol = c.kode
        where a.status='0' and a.satminkal='" . $kode_prop . "' order by a.nama asc");
        $results   = $query->getResultArray();

        $data =  [
            'bptp' => $results
        ];

        return $data;
    }

    public function getPNS($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select nama_dati2 as namakab from tbldati2 where id_dati2='$kode_kab'");
        $row   = $query->getRow();
        $query = $db->query("select *, a.nama, a.nip, b.kredit_utama, c.nama as desgol, c.gol_ruang, b.gol, b.tgl_spk
        from tbldasar a
        left join (select nip,gol,tgl_spk,kredit_utama,min(gol),max(kredit_utama) from tblpak group by nip) b on a.nip=b.nip
        left join tblpp c on b.gol = c.kode
        where a.status='0' and a.satminkal='$kode_kab' order by a.nama asc");
        $results   = $query->getResultArray();

        $data =  [
            'namakab' => $row->namakab,
            'pns' => $results
        ];

        return $data;
    }

    public function getTHLAPBN($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select nama_dati2 as namakab from tbldati2 where id_dati2='$kode_kab'");
        $row   = $query->getRow();
        $query = $db->query("select *, a.nama, a.telp, a.email, a.noktp, b.nama_bpp, c.nm_desa as wilker, d.nm_desa as wilker2, e.nm_desa as wilker3, f.nm_desa as wilker4, g.nm_desa as wilker5
        from tbldasar_thl a
        left join tblbpp b on a.kecamatan_tugas=b.kecamatan
        left join tbldesa c on a.wil_kerja=c.id_desa
        left join tbldesa d on a.wil_kerja2=d.id_desa
        left join tbldesa e on a.wil_kerja3=e.id_desa
        left join tbldesa f on a.wil_kerja4=f.id_desa
        left join tbldesa g on a.wil_kerja5=g.id_desa
        WHERE a.satminkal LIKE '" . $kode_kab . "' AND `sumber_dana` LIKE 'apbn' order by a.nama asc");
        $results   = $query->getResultArray();

        $data =  [
            'namakab' => $row->namakab,
            'thlapbn' => $results
        ];

        return $data;
    }

    public function getTHLAPBD($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select nama_dati2 as namakab from tbldati2 where id_dati2='$kode_kab'");
        $row   = $query->getRow();
        $query = $db->query("select *, a.nama, a.telp, a.email, a.noktp, b.nama_bpp, c.nm_desa as wilker, d.nm_desa as wilker2, e.nm_desa as wilker3, f.nm_desa as wilker4, g.nm_desa as wilker5
        from tbldasar_thl a
        left join tblbpp b on a.kecamatan_tugas=b.kecamatan
        left join tbldesa c on a.wil_kerja=c.id_desa
        left join tbldesa d on a.wil_kerja2=d.id_desa
        left join tbldesa e on a.wil_kerja3=e.id_desa
        left join tbldesa f on a.wil_kerja4=f.id_desa
        left join tbldesa g on a.wil_kerja5=g.id_desa
        WHERE a.satminkal LIKE '" . $kode_kab . "' AND `sumber_dana` LIKE 'apbd' order by a.nama asc");
        $results   = $query->getResultArray();

        $data =  [
            'namakab' => $row->namakab,
            'thlapbd' => $results
        ];

        return $data;
    }

    public function getSwadaya($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select nama_dati2 as namakab from tbldati2 where id_dati2='$kode_kab'");
        $row   = $query->getRow();
        $query = $db->query("select *, a.nama, a.telp, a.email, a.noktp, b.nama_bpp, c.nm_desa as wilker, d.nm_desa as wilker2, e.nm_desa as wilker3, f.nm_desa as wilker4, g.nm_desa as wilker5
        from tbldasar_swa a
        left join tblbpp b on a.kecamatan_tugas=b.kecamatan
        left join tbldesa c on a.wil_kerja=c.id_desa
        left join tbldesa d on a.wil_kerja2=d.id_desa
        left join tbldesa e on a.wil_kerja3=e.id_desa
        left join tbldesa f on a.wil_kerja4=f.id_desa
        left join tbldesa g on a.wil_kerja5=g.id_desa
        WHERE a.satminkal LIKE '" . $kode_kab . "' order by a.nama asc");
        $results   = $query->getResultArray();

        $data =  [
            'namakab' => $row->namakab,
            'swadaya' => $results
        ];

        return $data;
    }

    public function getDaftarKetenagaanKec($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select id_dati2,nama_dati2 as namakab from tbldati2 where id_dati2='$kode_kab'");
        $row   = $query->getRow();
        $query2 = $db->query("select count(nip) as pns from tbldasar where satminkal='$kode_kab' and status='0' and kode_kab='3'");
        $row2   = $query2->getRow();
        $query3 = $db->query("select count(nip) as p3k from tbldasar_p3k where satminkal='$kode_kab' and status='0' and kode_kab='3'");
        $row3   = $query3->getRow();
        $query4 = $db->query("select count(nip) as pnsTB from tbldasar where satminkal='$kode_kab' and status='6' and kecamatan_tugas=''");
        $row4   = $query4->getRow();
        $query5 = $db->query("select count(nama) as thl_apbn from tbldasar_thl where satminkal='$kode_kab' and sumber_dana='apbn' and kecamatan_tugas=''");
        $row5   = $query5->getRow();
        $query6 = $db->query("select count(nama) as thl_apbd from tbldasar_thl where satminkal='$kode_kab' and sumber_dana='apbd' and kecamatan_tugas=''");
        $row6   = $query6->getRow();
        $query7 = $db->query("select count(nama) as swa from tbldasar_swa where satminkal='$kode_kab' and kecamatan_tugas=''");
        $row7   = $query7->getRow();
        $query8 = $db->query("select count(nama) as swasta from tbldasar_swasta where satminkal='$kode_kab' and tempat_tugas=''");
        $row8   = $query8->getRow();
        $query9 = $db->query("select *, IFNULL(c.pns,0) AS pns,IFNULL(d.pnsTB,0) AS pnsTB,IFNULL(f.p3k,0) AS p3k,IFNULL(g.thl_apbn,0) AS thl_apbn,
        IFNULL(h.thl_apbd,0) AS thl_apbd,IFNULL(i.swa,0) AS swa,IFNULL(j.swasta,0) AS swasta, b.tempat_tugas
        FROM tblbpp a
        left join (select tempat_tugas, count(id) as jum_bptp_aktif from tbldasar where status='0' and kode_kab='4' group by tempat_tugas) b on a.kecamatan=b.tempat_tugas
        left join (select tempat_tugas, count(id) as pns from tbldasar where status='0' and kode_kab='4' group by tempat_tugas) c on a.kecamatan=c.tempat_tugas
        left join (select tempat_tugas, count(id) as pnsTB from tbldasar where kode_kab='4' and status='6' group by tempat_tugas) d on a.kecamatan=d.tempat_tugas
        left join (select tempat_tugas, count(id) as p3k from tbldasar_p3k where kode_kab='4' group by tempat_tugas) f on a.kecamatan=f.tempat_tugas
        left join (select tempat_tugas, count(id_thl) as thl_apbn from tbldasar_thl where sumber_dana='apbn' or sumber_dana='APBN' and penyuluh_di='kecamatan' group by tempat_tugas) g on a.kecamatan=g.tempat_tugas
        left join (select tempat_tugas, count(nama) as thl_apbd from tbldasar_thl where sumber_dana='apbd' and penyuluh_di='kecamatan'group by tempat_tugas) h on a.kecamatan=h.tempat_tugas
        left join (select tempat_tugas,count(nama) as swa from tbldasar_swa  where satminkal='$kode_kab' group by tempat_tugas) i on a.kecamatan=i.tempat_tugas
        left join (select tempat_tugas,count(nama) as swasta from tbldasar_swasta  where satminkal='$kode_kab' group by tempat_tugas) j on a.kecamatan=j.tempat_tugas
        where a.satminkal='$kode_kab' order by nama_bpp");
        $results   = $query9->getResultArray();

        $data =  [
            'namakab' => $row->namakab,
            'id_dati2' => $row->id_dati2,
            'pns' => $row2->pns,
            'p3k' => $row3->p3k,
            'pnsTB' => $row4->pnsTB,
            'thl_apbn' => $row5->thl_apbn,
            'thl_apbd' => $row6->thl_apbd,
            'swa' => $row7->swa,
            'swasta' => $row8->swasta,
            'dkkec' => $results
        ];

        return $data;
    }

    public function getPNSKab($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select nama_dati2 as namakab from tbldati2 where id_dati2='$kode_kab'");
        $row   = $query->getRow();
        $query = $db->query("SELECT *, a.nama, a.nip, b.kredit_utama, c.nama as desgol, c.gol_ruang, b.gol, b.tgl_spk
        FROM tbldasar a
        left join (select nip,gol,tgl_spk,kredit_utama,min(gol),max(kredit_utama) from tblpak group by nip) b on a.nip=b.nip
        left join tblpp c on b.gol = c.kode
        WHERE `satminkal` LIKE '$kode_kab' AND `kode_kab` LIKE '3' AND `status` = '0' order by a.nama asc");
        $results   = $query->getResultArray();

        $data =  [
            'namakab' => $row->namakab,
            'pns' => $results
        ];

        return $data;
    }

    public function getDaftPenyuluh($kode_kec)
    {
        $db = Database::connect();
        $query = $db->query("select nama_bpp from tblbpp where kecamatan='$kode_kec'");
        $row   = $query->getRow();
        $query2 = $db->query("select *, a.nama, a.telp, a.email, a.nip, c.nm_desa as wilker, d.nm_desa as wilker2, e.nm_desa as wilker3, f.nm_desa as wilker4, g.nm_desa as wilker5
        from tbldasar a
        left join tbldesa c on a.wil_kerja=c.id_desa
        left join tbldesa d on a.wil_kerja2=d.id_desa
        left join tbldesa e on a.wil_kerja3=e.id_desa
        left join tbldesa f on a.wil_kerja4=f.id_desa
        left join tbldesa g on a.wil_kerja5=g.id_desa
        WHERE a.kode_kab='4' and a.tempat_tugas LIKE '" . $kode_kec . "' and status='0' order by a.nama asc");
        $results   = $query2->getResultArray();

        $query3 = $db->query("select *, c.nm_desa as wilker, d.nm_desa as wilker2, e.nm_desa as wilker3, f.nm_desa as wilker4, g.nm_desa as wilker5
        from tbldasar_p3k a
        left join tbldesa c on a.wil_kerja=c.id_desa
        left join tbldesa d on a.wil_kerja2=d.id_desa
        left join tbldesa e on a.wil_kerja3=e.id_desa
        left join tbldesa f on a.wil_kerja4=f.id_desa
        left join tbldesa g on a.wil_kerja5=g.id_desa
        WHERE a.kode_kab='4' and a.tempat_tugas LIKE '" . $kode_kec . "' and status='0' order by a.nama asc");
        $results2   = $query3->getResultArray();

        $query4 = $db->query("select *, c.nm_desa as wilker, d.nm_desa as wilker2, e.nm_desa as wilker3, f.nm_desa as wilker4, g.nm_desa as wilker5
        from tbldasar_thl a
        left join tbldesa c on a.wil_kerja=c.id_desa
        left join tbldesa d on a.wil_kerja2=d.id_desa
        left join tbldesa e on a.wil_kerja3=e.id_desa
        left join tbldesa f on a.wil_kerja4=f.id_desa
        left join tbldesa g on a.wil_kerja5=g.id_desa
        WHERE a.tempat_tugas LIKE '" . $kode_kec . "' and penyuluh_di='kecamatan' and sumber_dana='apbn' order by a.nama asc");
        $results3   = $query4->getResultArray();

        $query5 = $db->query("select *, c.nm_desa as wilker, d.nm_desa as wilker2, e.nm_desa as wilker3, f.nm_desa as wilker4, g.nm_desa as wilker5
        from tbldasar_thl a
        left join tbldesa c on a.wil_kerja=c.id_desa
        left join tbldesa d on a.wil_kerja2=d.id_desa
        left join tbldesa e on a.wil_kerja3=e.id_desa
        left join tbldesa f on a.wil_kerja4=f.id_desa
        left join tbldesa g on a.wil_kerja5=g.id_desa
        WHERE a.tempat_tugas LIKE '" . $kode_kec . "' and penyuluh_di='kecamatan' and sumber_dana='apbd' order by a.nama asc");
        $results4   = $query5->getResultArray();

        $query6 = $db->query("select *, c.nm_desa as wilker, d.nm_desa as wilker2, e.nm_desa as wilker3, f.nm_desa as wilker4, g.nm_desa as wilker5
        from tbldasar_swa a
        left join tbldesa c on a.wil_kerja=c.id_desa
        left join tbldesa d on a.wil_kerja2=d.id_desa
        left join tbldesa e on a.wil_kerja3=e.id_desa
        left join tbldesa f on a.wil_kerja4=f.id_desa
        left join tbldesa g on a.wil_kerja5=g.id_desa
        WHERE a.tempat_tugas LIKE '" . $kode_kec . "' order by a.nama asc");
        $results5   = $query6->getResultArray();

        $data =  [
            'nama_bpp' => $row->nama_bpp,
            'pns' => $results,
            'p3k' => $results2,
            'thl_apbn' => $results3,
            'thl_apbd' => $results4,
            'swa' => $results5,
        ];

        return $data;
    }

    public function getRekapTngUmur53($tahun_today)
    {
        $db = Database::connect();
        $query = $db->query("select count(id) as pst_kurang_53 from tbldasar where 
        satminkal ='0109' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) > '$tahun_today' or
        satminkal ='0200' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) > '$tahun_today' or 
        satminkal ='0109' AND STATUS='6' and kode_kab='1' AND YEAR(tgl_lahir) > '$tahun_today' or
        satminkal ='0200' AND STATUS='6' and kode_kab='1' AND YEAR(tgl_lahir) > '$tahun_today'");
        $row   = $query->getRow();

        $query2 = $db->query("select count(id) as pst_pas_53 from tbldasar where 
        satminkal ='0109' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today' or
        satminkal ='0200' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today' or 
        satminkal ='0109' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today' or
        satminkal ='0200' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today'");
        $row2   = $query2->getRow();

        $query3 = $db->query("select count(id) as prov_kurang_53 from tbldasar where 
        satminkal like '%00' and kode_kab ='2' and status='0' and  YEAR(tgl_lahir) > '$tahun_today' or 
        satminkal like '%00' and kode_kab ='2' and status='6' and  YEAR(tgl_lahir) > '$tahun_today'");
        $row3   = $query3->getRow();

        $query4 = $db->query("select count(id) as prov_pas_53 from tbldasar where 
        satminkal like '%00' and kode_kab ='2' and status='0' and  YEAR(tgl_lahir) = '$tahun_today' or 
        satminkal like '%00' and kode_kab ='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today'");
        $row4   = $query4->getRow();

        $query5 = $db->query("select count(id) as kab_kurang_53 from tbldasar where 
        kode_kab ='3' and status='0' and  YEAR(tgl_lahir) > '$tahun_today' or 
        kode_kab ='3' and status='6' and  YEAR(tgl_lahir) > '$tahun_today' or 
        kode_kab ='4' and status='0' and  YEAR(tgl_lahir) > '$tahun_today' or 
        kode_kab ='4' and status='6' and  YEAR(tgl_lahir) > '$tahun_today'");
        $row5   = $query5->getRow();

        $query6 = $db->query("select count(id) as kab_pas_53 from tbldasar where 
        kode_kab ='3' and status='0' and  YEAR(tgl_lahir) = '$tahun_today' or 
        kode_kab ='3' and status='6' and  YEAR(tgl_lahir) = '$tahun_today' or 
        kode_kab ='4' and status='0' and  YEAR(tgl_lahir) = '$tahun_today' or 
        kode_kab ='4' and status='6' and  YEAR(tgl_lahir) = '$tahun_today'");
        $row6   = $query6->getRow();

        $query7 = $db->query("select count(id) as bptp_kurang_53 from tbldasar where 
        satminkal LIKE '02%' and kode_kab='2' and status='0' and  YEAR(tgl_lahir) > '$tahun_today' or 
        satminkal LIKE '02%' and kode_kab='2' and status='6' and  YEAR(tgl_lahir) > '$tahun_today'");
        $row7   = $query7->getRow();

        $query8 = $db->query("select count(id) as bptp_pas_53 from tbldasar where 
        satminkal LIKE '02%' and kode_kab='2' and status='0' and  YEAR(tgl_lahir) = '$tahun_today' or 
        satminkal LIKE '02%' and kode_kab='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today'");
        $row8   = $query8->getRow();

        $data =  [
            'pst_kurang_53' => $row->pst_kurang_53,
            'pst_pas_53' => $row2->pst_pas_53,
            'prov_kurang_53' => $row3->prov_kurang_53,
            'prov_pas_53' => $row4->prov_pas_53,
            'kab_kurang_53' => $row5->kab_kurang_53,
            'kab_pas_53' => $row6->kab_pas_53,
            'bptp_kurang_53' => $row7->bptp_kurang_53,
            'bptp_pas_53' => $row8->bptp_pas_53
        ];

        return $data;
    }

    public function getRekapTngUmur54($tahun_today54)
    {
        $db = Database::connect();
        $query = $db->query("select count(id) as pst_pas_54 from tbldasar where 
        satminkal ='0109' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today54' or
        satminkal ='0200' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today54' or 
        satminkal ='0109' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today54' or
        satminkal ='0200' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today54'");
        $row   = $query->getRow();

        $query2 = $db->query("select count(id) as prov_pas_54 from tbldasar where 
        satminkal like '%00' and kode_kab ='2' and status='0' and  YEAR(tgl_lahir) = '$tahun_today54' or 
        satminkal like '%00' and kode_kab ='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today54'");
        $row2   = $query2->getRow();

        $query3 = $db->query("select count(id) as kab_pas_54 from tbldasar where 
        kode_kab ='3' and status='0' and  YEAR(tgl_lahir) = '$tahun_today54' or 
        kode_kab ='3' and status='6' and  YEAR(tgl_lahir) = '$tahun_today54' or 
        kode_kab ='4' and status='0' and  YEAR(tgl_lahir) = '$tahun_today54' or 
        kode_kab ='4' and status='6' and  YEAR(tgl_lahir) = '$tahun_today54'");
        $row3   = $query3->getRow();

        $query4 = $db->query("select count(id) as bptp_pas_54 from tbldasar where 
        satminkal LIKE '02%' and kode_kab='2' and status='0' and  YEAR(tgl_lahir) = '$tahun_today54' or 
        satminkal LIKE '02%' and kode_kab='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today54'");
        $row4   = $query4->getRow();

        $data =  [
            'pst_pas_54' => $row->pst_pas_54,
            'prov_pas_54' => $row2->prov_pas_54,
            'kab_pas_54' => $row3->kab_pas_54,
            'bptp_pas_54' => $row4->bptp_pas_54
        ];

        return $data;
    }

    public function getRekapTngUmur55($tahun_today55)
    {
        $db = Database::connect();
        $query = $db->query("select count(id) as pst_pas_55 from tbldasar where 
        satminkal ='0109' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today55' or
        satminkal ='0200' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today55' or 
        satminkal ='0109' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today55' or
        satminkal ='0200' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today55'");
        $row   = $query->getRow();

        $query2 = $db->query("select count(id) as prov_pas_55 from tbldasar where 
        satminkal like '%00' and kode_kab ='2' and status='0' and  YEAR(tgl_lahir) = '$tahun_today55' or 
        satminkal like '%00' and kode_kab ='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today55'");
        $row2   = $query2->getRow();

        $query3 = $db->query("select count(id) as kab_pas_55 from tbldasar where 
        kode_kab ='3' and status='0' and  YEAR(tgl_lahir) = '$tahun_today55' or 
        kode_kab ='3' and status='6' and  YEAR(tgl_lahir) = '$tahun_today55' or 
        kode_kab ='4' and status='0' and  YEAR(tgl_lahir) = '$tahun_today55' or 
        kode_kab ='4' and status='6' and  YEAR(tgl_lahir) = '$tahun_today55'");
        $row3   = $query3->getRow();

        $query4 = $db->query("select count(id) as bptp_pas_55 from tbldasar where 
        satminkal LIKE '02%' and kode_kab='2' and status='0' and  YEAR(tgl_lahir) = '$tahun_today55' or 
        satminkal LIKE '02%' and kode_kab='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today55'");
        $row4   = $query4->getRow();

        $data =  [
            'pst_pas_55' => $row->pst_pas_55,
            'prov_pas_55' => $row2->prov_pas_55,
            'kab_pas_55' => $row3->kab_pas_55,
            'bptp_pas_55' => $row4->bptp_pas_55
        ];

        return $data;
    }

    public function getRekapTngUmur56($tahun_today56)
    {
        $db = Database::connect();
        $query = $db->query("select count(id) as pst_pas_56 from tbldasar where 
        satminkal ='0109' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today56' or
        satminkal ='0200' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today56' or 
        satminkal ='0109' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today56' or
        satminkal ='0200' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today56'");
        $row   = $query->getRow();

        $query2 = $db->query("select count(id) as prov_pas_56 from tbldasar where 
        satminkal like '%00' and kode_kab ='2' and status='0' and  YEAR(tgl_lahir) = '$tahun_today56' or 
        satminkal like '%00' and kode_kab ='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today56'");
        $row2   = $query2->getRow();

        $query3 = $db->query("select count(id) as kab_pas_56 from tbldasar where 
        kode_kab ='3' and status='0' and  YEAR(tgl_lahir) = '$tahun_today56' or 
        kode_kab ='3' and status='6' and  YEAR(tgl_lahir) = '$tahun_today56' or 
        kode_kab ='4' and status='0' and  YEAR(tgl_lahir) = '$tahun_today56' or 
        kode_kab ='4' and status='6' and  YEAR(tgl_lahir) = '$tahun_today56'");
        $row3   = $query3->getRow();

        $query4 = $db->query("select count(id) as bptp_pas_56 from tbldasar where 
        satminkal LIKE '02%' and kode_kab='2' and status='0' and  YEAR(tgl_lahir) = '$tahun_today56' or 
        satminkal LIKE '02%' and kode_kab='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today56'");
        $row4   = $query4->getRow();

        $data =  [
            'pst_pas_56' => $row->pst_pas_56,
            'prov_pas_56' => $row2->prov_pas_56,
            'kab_pas_56' => $row3->kab_pas_56,
            'bptp_pas_56' => $row4->bptp_pas_56
        ];

        return $data;
    }

    public function getRekapTngUmur57($tahun_today57)
    {
        $db = Database::connect();
        $query = $db->query("select count(id) as pst_pas_57 from tbldasar where 
        satminkal ='0109' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today57' or
        satminkal ='0200' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today57' or 
        satminkal ='0109' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today57' or
        satminkal ='0200' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today57'");
        $row   = $query->getRow();

        $query2 = $db->query("select count(id) as prov_pas_57 from tbldasar where 
        satminkal like '%00' and kode_kab ='2' and status='0' and  YEAR(tgl_lahir) = '$tahun_today57' or 
        satminkal like '%00' and kode_kab ='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today57'");
        $row2   = $query2->getRow();

        $query3 = $db->query("select count(id) as kab_pas_57 from tbldasar where 
        kode_kab ='3' and status='0' and  YEAR(tgl_lahir) = '$tahun_today57' or 
        kode_kab ='3' and status='6' and  YEAR(tgl_lahir) = '$tahun_today57' or 
        kode_kab ='4' and status='0' and  YEAR(tgl_lahir) = '$tahun_today57' or 
        kode_kab ='4' and status='6' and  YEAR(tgl_lahir) = '$tahun_today57'");
        $row3   = $query3->getRow();

        $query4 = $db->query("select count(id) as bptp_pas_57 from tbldasar where 
        satminkal LIKE '02%' and kode_kab='2' and status='0' and  YEAR(tgl_lahir) = '$tahun_today57' or 
        satminkal LIKE '02%' and kode_kab='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today57'");
        $row4   = $query4->getRow();

        $data =  [
            'pst_pas_57' => $row->pst_pas_57,
            'prov_pas_57' => $row2->prov_pas_57,
            'kab_pas_57' => $row3->kab_pas_57,
            'bptp_pas_57' => $row4->bptp_pas_57
        ];

        return $data;
    }

    public function getRekapTngUmur58($tahun_today58)
    {
        $db = Database::connect();
        $query = $db->query("select count(id) as pst_pas_58 from tbldasar where 
        satminkal ='0109' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today58' or
        satminkal ='0200' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today58' or 
        satminkal ='0109' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today58' or
        satminkal ='0200' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today58'");
        $row   = $query->getRow();

        $query2 = $db->query("select count(id) as prov_pas_58 from tbldasar where 
        satminkal like '%00' and kode_kab ='2' and status='0' and  YEAR(tgl_lahir) = '$tahun_today58' or 
        satminkal like '%00' and kode_kab ='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today58'");
        $row2   = $query2->getRow();

        $query3 = $db->query("select count(id) as kab_pas_58 from tbldasar where 
        kode_kab ='3' and status='0' and  YEAR(tgl_lahir) = '$tahun_today58' or 
        kode_kab ='3' and status='6' and  YEAR(tgl_lahir) = '$tahun_today58' or 
        kode_kab ='4' and status='0' and  YEAR(tgl_lahir) = '$tahun_today58' or 
        kode_kab ='4' and status='6' and  YEAR(tgl_lahir) = '$tahun_today58'");
        $row3   = $query3->getRow();

        $query4 = $db->query("select count(id) as bptp_pas_58 from tbldasar where 
        satminkal LIKE '02%' and kode_kab='2' and status='0' and  YEAR(tgl_lahir) = '$tahun_today58' or 
        satminkal LIKE '02%' and kode_kab='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today58'");
        $row4   = $query4->getRow();

        $data =  [
            'pst_pas_58' => $row->pst_pas_58,
            'prov_pas_58' => $row2->prov_pas_58,
            'kab_pas_58' => $row3->kab_pas_58,
            'bptp_pas_58' => $row4->bptp_pas_58
        ];

        return $data;
    }

    public function getRekapTngUmur59($tahun_today59)
    {
        $db = Database::connect();
        $query = $db->query("select count(id) as pst_pas_59 from tbldasar where 
        satminkal ='0109' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today59' or
        satminkal ='0200' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today59' or 
        satminkal ='0109' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today59' or
        satminkal ='0200' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today59'");
        $row   = $query->getRow();

        $query2 = $db->query("select count(id) as prov_pas_59 from tbldasar where 
        satminkal like '%00' and kode_kab ='2' and status='0' and  YEAR(tgl_lahir) = '$tahun_today59' or 
        satminkal like '%00' and kode_kab ='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today59'");
        $row2   = $query2->getRow();

        $query3 = $db->query("select count(id) as kab_pas_59 from tbldasar where 
        kode_kab ='3' and status='0' and  YEAR(tgl_lahir) = '$tahun_today59' or 
        kode_kab ='3' and status='6' and  YEAR(tgl_lahir) = '$tahun_today59' or 
        kode_kab ='4' and status='0' and  YEAR(tgl_lahir) = '$tahun_today59' or 
        kode_kab ='4' and status='6' and  YEAR(tgl_lahir) = '$tahun_today59'");
        $row3   = $query3->getRow();

        $query4 = $db->query("select count(id) as bptp_pas_59 from tbldasar where 
        satminkal LIKE '02%' and kode_kab='2' and status='0' and  YEAR(tgl_lahir) = '$tahun_today59' or 
        satminkal LIKE '02%' and kode_kab='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today59'");
        $row4   = $query4->getRow();

        $data =  [
            'pst_pas_59' => $row->pst_pas_59,
            'prov_pas_59' => $row2->prov_pas_59,
            'kab_pas_59' => $row3->kab_pas_59,
            'bptp_pas_59' => $row4->bptp_pas_59
        ];

        return $data;
    }

    public function getRekapTngUmur60($tahun_today60)
    {
        $db = Database::connect();
        $query = $db->query("select count(id) as pst_lebih_60 from tbldasar where 
        satminkal ='0109' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) < '$tahun_today60' or
        satminkal ='0200' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) < '$tahun_today60' or 
        satminkal ='0109' AND STATUS='6' and kode_kab='1' AND YEAR(tgl_lahir) < '$tahun_today60' or
        satminkal ='0200' AND STATUS='6' and kode_kab='1' AND YEAR(tgl_lahir) < '$tahun_today60'");
        $row   = $query->getRow();

        $query2 = $db->query("select count(id) as pst_pas_60 from tbldasar where 
        satminkal ='0109' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today60' or
        satminkal ='0200' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today60' or 
        satminkal ='0109' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today60' or
        satminkal ='0200' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today60'");
        $row2   = $query2->getRow();

        $query3 = $db->query("select count(id) as prov_lebih_60 from tbldasar where 
        satminkal like '%00' and kode_kab ='2' and status='0' and  YEAR(tgl_lahir) < '$tahun_today60' or 
        satminkal like '%00' and kode_kab ='2' and status='6' and  YEAR(tgl_lahir) < '$tahun_today60'");
        $row3   = $query3->getRow();

        $query4 = $db->query("select count(id) as prov_pas_60 from tbldasar where 
        satminkal like '%00' and kode_kab ='2' and status='0' and  YEAR(tgl_lahir) = '$tahun_today60' or 
        satminkal like '%00' and kode_kab ='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today60'");
        $row4   = $query4->getRow();

        $query5 = $db->query("select count(id) as kab_lebih_60 from tbldasar where 
        kode_kab ='3' and status='0' and  YEAR(tgl_lahir) < '$tahun_today60' or 
        kode_kab ='3' and status='6' and  YEAR(tgl_lahir) < '$tahun_today60' or 
        kode_kab ='4' and status='0' and  YEAR(tgl_lahir) < '$tahun_today60' or 
        kode_kab ='4' and status='6' and  YEAR(tgl_lahir) < '$tahun_today60'");
        $row5   = $query5->getRow();

        $query6 = $db->query("select count(id) as kab_pas_60 from tbldasar where 
        kode_kab ='3' and status='0' and  YEAR(tgl_lahir) = '$tahun_today60' or 
        kode_kab ='3' and status='6' and  YEAR(tgl_lahir) = '$tahun_today60' or 
        kode_kab ='4' and status='0' and  YEAR(tgl_lahir) = '$tahun_today60' or 
        kode_kab ='4' and status='6' and  YEAR(tgl_lahir) = '$tahun_today60'");
        $row6   = $query6->getRow();

        $query7 = $db->query("select count(id) as bptp_lebih_60 from tbldasar where 
        satminkal LIKE '02%' and kode_kab='2' and status='0' and  YEAR(tgl_lahir) < '$tahun_today60' or 
        satminkal LIKE '02%' and kode_kab='2' and status='6' and  YEAR(tgl_lahir) < '$tahun_today60'");
        $row7   = $query7->getRow();

        $query8 = $db->query("select count(id) as bptp_pas_60 from tbldasar where 
        satminkal LIKE '02%' and kode_kab='2' and status='0' and  YEAR(tgl_lahir) = '$tahun_today60' or 
        satminkal LIKE '02%' and kode_kab='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today60'");
        $row8   = $query8->getRow();

        $data =  [
            'pst_lebih_60' => $row->pst_lebih_60,
            'pst_pas_60' => $row2->pst_pas_60,
            'prov_lebih_60' => $row3->prov_lebih_60,
            'prov_pas_60' => $row4->prov_pas_60,
            'kab_lebih_60' => $row5->kab_lebih_60,
            'kab_pas_60' => $row6->kab_pas_60,
            'bptp_lebih_60' => $row7->bptp_lebih_60,
            'bptp_pas_60' => $row8->bptp_pas_60
        ];

        return $data;
    }

    public function getRekapTngUmur0($tahun_today0)
    {
        $db = Database::connect();
        $query = $db->query("select count(id) as pst_tidak_diisi from tbldasar where 
        satminkal ='0109' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today0' or
        satminkal ='0200' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today0' or 
        satminkal ='0109' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today0' or
        satminkal ='0200' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today0'");
        $row   = $query->getRow();

        $query2 = $db->query("select count(id) as prov_tidak_diisi from tbldasar where 
        satminkal like '%00' and kode_kab ='2' and status='0' and  YEAR(tgl_lahir) = '$tahun_today0' or 
        satminkal like '%00' and kode_kab ='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today0'");
        $row2   = $query2->getRow();

        $query3 = $db->query("select count(id) as kab_tidak_diisi from tbldasar where 
        kode_kab ='3' and status='0' and  YEAR(tgl_lahir) = '$tahun_today0' or 
        kode_kab ='3' and status='6' and  YEAR(tgl_lahir) = '$tahun_today0' or 
        kode_kab ='4' and status='0' and  YEAR(tgl_lahir) = '$tahun_today0' or 
        kode_kab ='4' and status='6' and  YEAR(tgl_lahir) = '$tahun_today0'");
        $row3   = $query3->getRow();

        $query4 = $db->query("select count(id) as bptp_tidak_diisi from tbldasar where 
        satminkal LIKE '02%' and kode_kab='2' and status='0' and  YEAR(tgl_lahir) = '$tahun_today0' or 
        satminkal LIKE '02%' and kode_kab='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today0'");
        $row4   = $query4->getRow();

        $data =  [
            'pst_tidak_diisi' => $row->pst_tidak_diisi,
            'prov_tidak_diisi' => $row2->prov_tidak_diisi,
            'kab_tidak_diisi' => $row3->kab_tidak_diisi,
            'bptp_tidak_diisi' => $row4->bptp_tidak_diisi
        ];

        return $data;
    }

    public function getRekapTngUmurPst($tahun_today, $tahun_today54, $tahun_today55, $tahun_today56, $tahun_today57, $tahun_today58, $tahun_today59, $tahun_today60, $tahun_today0)
    {
        $db = Database::connect();
        $query = $db->query("select *, a.nama, ifnull(b.kurang_53,0) as kurang_53, ifnull(c.pas_53,0) as pas_53, ifnull(d.pas_54,0) as pas_54,ifnull(e.pas_55,0) as pas_55 ,ifnull(f.pas_56,0) as pas_56,ifnull(g.pas_57,0) as pas_57,ifnull(h.pas_58,0) as pas_58,ifnull(i.pas_59,0) as pas_59,ifnull(j.pas_60,0) as pas_60,ifnull(k.lebih_60,0) as lebih_60,ifnull(l.tidak_diisi,0) as tidak_diisi        
        from tblsatminkal a 
        left join (select satminkal, count(id) as kurang_53 from tbldasar where  satminkal='0200' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) > '$tahun_today' or 
        satminkal='0200' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) > '$tahun_today' group by satminkal) b on a.kode=b.satminkal
        left join (select satminkal, count(id) as pas_53 from tbldasar where  satminkal='0200' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today' or 
        satminkal='0200' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today' group by satminkal) c on a.kode=c.satminkal
        left join (select satminkal, count(id) as pas_54 from tbldasar where  satminkal='0200' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today54' or 
        satminkal='0200' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today54' group by satminkal) d on a.kode=d.satminkal
        left join (select satminkal, count(id) as pas_55 from tbldasar where  satminkal='0200' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today55' or 
        satminkal='0200' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today55' group by satminkal) e on a.kode=e.satminkal
        left join (select satminkal, count(id) as pas_56 from tbldasar where  satminkal='0200' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today56' or 
        satminkal='0200' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today56' group by satminkal) f on a.kode=f.satminkal
        left join (select satminkal, count(id) as pas_57 from tbldasar where  satminkal='0200' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today57' or 
        satminkal='0200' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today57' group by satminkal) g on a.kode=g.satminkal
        left join (select satminkal, count(id) as pas_58 from tbldasar where  satminkal='0200' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today58' or 
        satminkal='0200' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today58' group by satminkal) h on a.kode=h.satminkal
        left join (select satminkal, count(id) as pas_59 from tbldasar where  satminkal='0200' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today59' or 
        satminkal='0200' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today59' group by satminkal) i on a.kode=i.satminkal
        left join (select satminkal, count(id) as pas_60 from tbldasar where  satminkal='0200' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today60' or 
        satminkal='0200' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today60' group by satminkal) j on a.kode=j.satminkal
        left join (select satminkal, count(id) as lebih_60 from tbldasar where  satminkal='0200' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) < '$tahun_today60' or 
        satminkal='0200' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) < '$tahun_today60' group by satminkal) k on a.kode=k.satminkal
        left join (select satminkal, count(id) as tidak_diisi from tbldasar where  satminkal='0200' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today0' or 
        satminkal='0200' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today0' group by satminkal) l on a.kode=l.satminkal
        where kode='0200'");
        $row   = $query->getRow();

        $query2 = $db->query("select *, a.nama as nama2, ifnull(b.krg_53,0) as krg_53, ifnull(c.ps_53,0) as ps_53, ifnull(d.ps_54,0) as ps_54,ifnull(e.ps_55,0) as ps_55 ,ifnull(f.ps_56,0) as ps_56,ifnull(g.ps_57,0) as ps_57,ifnull(h.ps_58,0) as ps_58,ifnull(i.ps_59,0) as ps_59,ifnull(j.ps_60,0) as ps_60,ifnull(k.lbh_60,0) as lbh_60,ifnull(l.tdk_diisi,0) as tdk_diisi        
        from tblsatminkal a 
        left join (select satminkal, count(id) as krg_53 from tbldasar where  satminkal='0109' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) > '$tahun_today' or 
        satminkal='0109' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) > '$tahun_today' group by satminkal) b on a.kode=b.satminkal
        left join (select satminkal, count(id) as ps_53 from tbldasar where  satminkal='0109' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today' or 
        satminkal='0109' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today' group by satminkal) c on a.kode=c.satminkal
        left join (select satminkal, count(id) as ps_54 from tbldasar where  satminkal='0109' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today54' or 
        satminkal='0109' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today54' group by satminkal) d on a.kode=d.satminkal
        left join (select satminkal, count(id) as ps_55 from tbldasar where  satminkal='0109' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today55' or 
        satminkal='0109' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today55' group by satminkal) e on a.kode=e.satminkal
        left join (select satminkal, count(id) as ps_56 from tbldasar where  satminkal='0109' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today56' or 
        satminkal='0109' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today56' group by satminkal) f on a.kode=f.satminkal
        left join (select satminkal, count(id) as ps_57 from tbldasar where  satminkal='0109' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today57' or 
        satminkal='0109' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today57' group by satminkal) g on a.kode=g.satminkal
        left join (select satminkal, count(id) as ps_58 from tbldasar where  satminkal='0109' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today58' or 
        satminkal='0109' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today58' group by satminkal) h on a.kode=h.satminkal
        left join (select satminkal, count(id) as ps_59 from tbldasar where  satminkal='0109' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today59' or 
        satminkal='0109' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today59' group by satminkal) i on a.kode=i.satminkal
        left join (select satminkal, count(id) as ps_60 from tbldasar where  satminkal='0109' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today60' or 
        satminkal='0109' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today60' group by satminkal) j on a.kode=j.satminkal
        left join (select satminkal, count(id) as lbh_60 from tbldasar where  satminkal='0109' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) < '$tahun_today60' or 
        satminkal='0109' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) < '$tahun_today60' group by satminkal) k on a.kode=k.satminkal
        left join (select satminkal, count(id) as tdk_diisi from tbldasar where  satminkal='0109' and status='0' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today0' or 
        satminkal='0109' and status='6' and kode_kab='1' and  YEAR(tgl_lahir) = '$tahun_today0' group by satminkal) l on a.kode=l.satminkal
        where kode='0109'");
        $row2   = $query2->getRow();

        $data =  [
            'nama' => $row->nama,
            'kurang_53' => $row->kurang_53,
            'pas_53' => $row->pas_53,
            'pas_54' => $row->pas_54,
            'pas_55' => $row->pas_55,
            'pas_56' => $row->pas_56,
            'pas_57' => $row->pas_57,
            'pas_58' => $row->pas_58,
            'pas_59' => $row->pas_59,
            'pas_60' => $row->pas_60,
            'lebih_60' => $row->lebih_60,
            'tidak_diisi' => $row->tidak_diisi,
            'nama2' => $row2->nama2,
            'krg_53' => $row2->krg_53,
            'ps_53' => $row2->ps_53,
            'ps_54' => $row2->ps_54,
            'ps_55' => $row2->ps_55,
            'ps_56' => $row2->ps_56,
            'ps_57' => $row2->ps_57,
            'ps_58' => $row2->ps_58,
            'ps_59' => $row2->ps_59,
            'ps_60' => $row2->ps_60,
            'lbh_60' => $row2->lbh_60,
            'tdk_diisi' => $row2->tdk_diisi
        ];
        return $data;
    }

    public function getRekapTngUmurPr($tahun_today, $tahun_today54, $tahun_today55, $tahun_today56, $tahun_today57, $tahun_today58, $tahun_today59, $tahun_today60, $tahun_today0)
    {
        $db = Database::connect();
        $query = $db->query("select *, a.nama_prop, ifnull(b.kurang_53,0) as kurang_53, ifnull(c.pas_53,0) as pas_53, ifnull(d.pas_54,0) as pas_54,ifnull(e.pas_55,0) as pas_55 ,ifnull(f.pas_56,0) as pas_56,ifnull(g.pas_57,0) as pas_57,ifnull(h.pas_58,0) as pas_58,ifnull(i.pas_59,0) as pas_59,ifnull(j.pas_60,0) as pas_60,ifnull(k.lebih_60,0) as lebih_60,ifnull(l.tidak_diisi,0) as tidak_diisi        
        from tblpropinsi a 
        left join (select kode_prop, count(id) as kurang_53 from tbldasar where kode_kab ='2' and status='0' and YEAR(tgl_lahir) > '$tahun_today' or 
         kode_kab ='2' and status='6' and  YEAR(tgl_lahir) > '$tahun_today' group by kode_prop) b on a.id_prop=b.kode_prop
        left join (select kode_prop, count(id) as pas_53 from tbldasar where kode_kab ='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today' or 
         kode_kab ='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today' group by kode_prop) c on a.id_prop=c.kode_prop
        left join (select kode_prop, count(id) as pas_54 from tbldasar where kode_kab ='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today54' or 
         kode_kab ='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today54' group by kode_prop) d on a.id_prop=d.kode_prop
        left join (select kode_prop, count(id) as pas_55 from tbldasar where kode_kab ='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today55' or 
         kode_kab ='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today55' group by kode_prop) e on a.id_prop=e.kode_prop
        left join (select kode_prop, count(id) as pas_56 from tbldasar where kode_kab ='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today56' or 
        kode_kab ='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today56' group by kode_prop) f on a.id_prop=f.kode_prop
        left join (select kode_prop, count(id) as pas_57 from tbldasar where kode_kab ='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today57' or 
        kode_kab ='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today57' group by kode_prop) g on a.id_prop=g.kode_prop
        left join (select kode_prop, count(id) as pas_58 from tbldasar where kode_kab ='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today58' or 
        kode_kab ='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today58' group by kode_prop) h on a.id_prop=h.kode_prop
        left join (select kode_prop, count(id) as pas_59 from tbldasar where kode_kab ='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today59' or 
        kode_kab ='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today59' group by kode_prop) i on a.id_prop=i.kode_prop
        left join (select kode_prop, count(id) as pas_60 from tbldasar where kode_kab ='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today60' or 
        kode_kab ='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today60' group by kode_prop) j on a.id_prop=j.kode_prop
        left join (select kode_prop, count(id) as lebih_60 from tbldasar where kode_kab ='2' and status='6' and  YEAR(tgl_lahir) < '$tahun_today60' or 
        kode_kab ='2' and status='6' and  YEAR(tgl_lahir) < '$tahun_today60' group by kode_prop) k on a.id_prop=k.kode_prop
        left join (select kode_prop, count(id) as tidak_diisi from tbldasar where kode_kab ='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today0' or 
        kode_kab ='2' and status='6' and  YEAR(tgl_lahir) = '$tahun_today0' group by kode_prop) l on a.id_prop=l.kode_prop
        order by a.nama_prop asc");
        $results   = $query->getResultArray();

        $data =  [
            'rtprov' => $results
        ];
        return $data;
    }

    public function getTHLPend()
    {
        $db = Database::connect();
        $query5 = $db->query("select *, IFNULL(b.slta_apbn,0) AS slta_apbn, IFNULL(c.d3_apbn,0) AS d3_apbn, IFNULL(d.d4_apbn,0) AS d4_apbn, IFNULL(e.s1_apbn,0) AS s1_apbn, IFNULL(f.s2_apbn,0) AS s2_apbn, IFNULL(g.kosong_apbn,0) AS kosong_apbn, IFNULL(h.slta_apbd,0) AS slta_apbd, IFNULL(i.d3_apbd,0) AS d3_apbd, IFNULL(j.d4_apbd,0) AS d4_apbd, IFNULL(k.s1_apbd,0) AS s1_apbd, IFNULL(l.s2_apbd,0) AS s2_apbd, IFNULL(m.kosong_apbd,0) AS kosong_apbd

        FROM tblpropinsi a
        
        left join (select prop_satminkal, count(id_thl) as slta_apbn from tbldasar_thl where tingkat_pendidikan='09' and sumber_dana='apbn' or tingkat_pendidikan='09' and sumber_dana='APBN' group by prop_satminkal) b on a.id_prop=b.prop_satminkal
        left join (select prop_satminkal, count(id_thl) as d3_apbn from tbldasar_thl where tingkat_pendidikan='06' and sumber_dana='apbn' or tingkat_pendidikan='06' and sumber_dana='APBN' group by prop_satminkal) c on a.id_prop=c.prop_satminkal
        left join (select prop_satminkal, count(id_thl) as d4_apbn from tbldasar_thl where tingkat_pendidikan='04' and sumber_dana='apbn' or tingkat_pendidikan='04' and sumber_dana='APBN' group by prop_satminkal) d on a.id_prop=d.prop_satminkal
        left join (select prop_satminkal, count(id_thl) as s1_apbn from tbldasar_thl where tingkat_pendidikan='03' and sumber_dana='apbn' or tingkat_pendidikan='03' and sumber_dana='APBN' group by prop_satminkal) e on a.id_prop=e.prop_satminkal
        left join (select prop_satminkal, count(id_thl) as s2_apbn from tbldasar_thl where tingkat_pendidikan='02' and sumber_dana='apbn' or tingkat_pendidikan='02' and sumber_dana='APBN' group by prop_satminkal) f on a.id_prop=f.prop_satminkal
        left join (select prop_satminkal, count(id_thl) as kosong_apbn from tbldasar_thl where tingkat_pendidikan='' and sumber_dana='apbn' or tingkat_pendidikan='' and sumber_dana='APBN' group by prop_satminkal) g on a.id_prop=g.prop_satminkal
        
        left join (select prop_satminkal, count(id_thl) as slta_apbd from tbldasar_thl where tingkat_pendidikan='09' and sumber_dana='apbd' or tingkat_pendidikan='09' and sumber_dana='APBD' group by prop_satminkal) h on a.id_prop=h.prop_satminkal
        left join (select prop_satminkal, count(id_thl) as d3_apbd from tbldasar_thl where tingkat_pendidikan='06' and sumber_dana='apbd' or tingkat_pendidikan='06' and sumber_dana='APBD' group by prop_satminkal) i on a.id_prop=i.prop_satminkal
        left join (select prop_satminkal, count(id_thl) as d4_apbd from tbldasar_thl where tingkat_pendidikan='04' and sumber_dana='apbd' or tingkat_pendidikan='04' and sumber_dana='APBD' group by prop_satminkal) j on a.id_prop=j.prop_satminkal
        left join (select prop_satminkal, count(id_thl) as s1_apbd from tbldasar_thl where tingkat_pendidikan='03' and sumber_dana='apbd' or tingkat_pendidikan='03' and sumber_dana='APBD' group by prop_satminkal) k on a.id_prop=k.prop_satminkal
        left join (select prop_satminkal, count(id_thl) as s2_apbd from tbldasar_thl where tingkat_pendidikan='02' and sumber_dana='apbd' or tingkat_pendidikan='02' and sumber_dana='APBD' group by prop_satminkal) l on a.id_prop=l.prop_satminkal
        left join (select prop_satminkal, count(id_thl) as kosong_apbd from tbldasar_thl where tingkat_pendidikan='' and sumber_dana='apbd' or tingkat_pendidikan='' and sumber_dana='APBD' group by prop_satminkal) m on a.id_prop=m.prop_satminkal
        
        order by nama_prop asc
        ");
        $results   = $query5->getResultArray();

        $data =  [
            'thlpend' => $results
        ];
        return $data;
    }

    public function getTHLAng($tahun_today)
    {
        $db = Database::connect();
        $query5 = $db->query("select *, IFNULL(b.slta_apbn,0) AS slta_apbn, IFNULL(c.d3_apbn,0) AS d3_apbn, IFNULL(d.d4_apbn,0) AS d4_apbn, IFNULL(e.s1_apbn,0) AS s1_apbn, IFNULL(f.s2_apbn,0) AS s2_apbn, IFNULL(g.kosong_apbn,0) AS kosong_apbn, IFNULL(h.apbn_1,0) AS apbn_1, IFNULL(i.apbn_2,0) AS apbn_2, IFNULL(j.apbn_3,0) AS apbn_3, IFNULL(k.apbn_na,0) AS apbn_na, IFNULL(l.kurang35,0) AS kurang35, IFNULL(m.lebih35,0) AS lebih35, IFNULL(n.umur_na,0) AS umur_na

        FROM tblpropinsi a
        
        left join (select prop_satminkal, count(id_thl) as slta_apbn from tbldasar_thl where tingkat_pendidikan='09' and sumber_dana='apbn' and angkatan BETWEEN 'I' and 'III' or tingkat_pendidikan='09' and sumber_dana='APBN' and angkatan BETWEEN 'I' and 'III' group by prop_satminkal) b on a.id_prop=b.prop_satminkal
        left join (select prop_satminkal, count(id_thl) as d3_apbn from tbldasar_thl where tingkat_pendidikan='06' and sumber_dana='apbn' and angkatan BETWEEN 'I' and 'III' or tingkat_pendidikan='06' and sumber_dana='APBN' and angkatan BETWEEN 'I' and 'III' group by prop_satminkal) c on a.id_prop=c.prop_satminkal
        left join (select prop_satminkal, count(id_thl) as d4_apbn from tbldasar_thl where tingkat_pendidikan='04' and sumber_dana='apbn' and angkatan BETWEEN 'I' and 'III' or tingkat_pendidikan='04' and sumber_dana='APBN' and angkatan BETWEEN 'I' and 'III' group by prop_satminkal) d on a.id_prop=d.prop_satminkal
        left join (select prop_satminkal, count(id_thl) as s1_apbn from tbldasar_thl where tingkat_pendidikan='03' and sumber_dana='apbn' and angkatan BETWEEN 'I' and 'III' or tingkat_pendidikan='03' and sumber_dana='APBN' and angkatan BETWEEN 'I' and 'III' group by prop_satminkal) e on a.id_prop=e.prop_satminkal
        left join (select prop_satminkal, count(id_thl) as s2_apbn from tbldasar_thl where tingkat_pendidikan='02' and sumber_dana='apbn' and angkatan BETWEEN 'I' and 'III' or tingkat_pendidikan='02' and sumber_dana='APBN' and angkatan BETWEEN 'I' and 'III' group by prop_satminkal) f on a.id_prop=f.prop_satminkal
        left join (select prop_satminkal, count(id_thl) as kosong_apbn from tbldasar_thl where tingkat_pendidikan='' and sumber_dana='apbn' and angkatan BETWEEN 'I' and 'III' or tingkat_pendidikan='' and sumber_dana='APBN' and angkatan BETWEEN 'I' and 'III' group by prop_satminkal) g on a.id_prop=g.prop_satminkal
        
        left join (select prop_satminkal, count(id_thl) as apbn_1 from tbldasar_thl where angkatan='I' and sumber_dana='apbn' or angkatan='I' and sumber_dana='APBN' group by prop_satminkal) h on a.id_prop=h.prop_satminkal
        left join (select prop_satminkal, count(id_thl) as apbn_2 from tbldasar_thl where angkatan='II' and sumber_dana='apbn' and angkatan BETWEEN 'I' and 'III' or angkatan='II' and sumber_dana='APBN' and angkatan BETWEEN 'I' and 'III' group by prop_satminkal) i on a.id_prop=i.prop_satminkal
        left join (select prop_satminkal, count(id_thl) as apbn_3 from tbldasar_thl where angkatan='III' and sumber_dana='apbn' and angkatan BETWEEN 'I' and 'III' or angkatan='II' and sumber_dana='APBN' and angkatan BETWEEN 'I' and 'III' group by prop_satminkal) j on a.id_prop=j.prop_satminkal
        left join (select prop_satminkal, count(id_thl) as apbn_na from tbldasar_thl where angkatan='' and sumber_dana='apbn' and angkatan BETWEEN 'I' and 'III' or angkatan='' and sumber_dana='APBN' and angkatan BETWEEN 'I' and 'III' group by prop_satminkal) k on a.id_prop=k.prop_satminkal
        left join (select prop_satminkal, count(id_thl) as kurang35 from tbldasar_thl where sumber_dana='apbn' and  thn_lahir >= '$tahun_today' and angkatan BETWEEN 'I' and 'III' or sumber_dana='APBN' and  thn_lahir >= '$tahun_today' and angkatan BETWEEN 'I' and 'III' group by prop_satminkal) l on a.id_prop=l.prop_satminkal
        left join (select prop_satminkal, count(id_thl) as lebih35 from tbldasar_thl where thn_lahir < '$tahun_today' and thn_lahir !='0' and sumber_dana='apbn' and angkatan BETWEEN 'I' and 'III' or thn_lahir < '$tahun_today' and thn_lahir !='0' and sumber_dana='APBN' and angkatan BETWEEN 'I' and 'III' group by prop_satminkal) m on a.id_prop=m.prop_satminkal
        left join (select prop_satminkal, count(id_thl) as umur_na from tbldasar_thl where thn_lahir ='0' and sumber_dana='apbn' and angkatan BETWEEN 'I' and 'III' or thn_lahir ='0' and sumber_dana='APBN' and angkatan BETWEEN 'I' and 'III' or thn_lahir IS NULL and sumber_dana='apbn' and angkatan BETWEEN 'I' and 'III' or thn_lahir IS NULL and sumber_dana='APBN' and angkatan BETWEEN 'I' and 'III' group by prop_satminkal) n on a.id_prop=n.prop_satminkal
        
        order by nama_prop asc
        ");
        $results   = $query5->getResultArray();

        $data =  [
            'thlang' => $results
        ];
        return $data;
    }

    public function getTHLAngKab($kode_prop, $tahun_today)
    {
        $db = Database::connect();
        $query = $db->query("select id_prop,nama_prop as namaprov from tblpropinsi where id_prop='$kode_prop'");
        $row   = $query->getRow();
        $query5 = $db->query("select *, IFNULL(b.slta_apbn,0) AS slta_apbn, IFNULL(c.d3_apbn,0) AS d3_apbn, IFNULL(d.d4_apbn,0) AS d4_apbn, IFNULL(e.s1_apbn,0) AS s1_apbn, IFNULL(f.s2_apbn,0) AS s2_apbn, IFNULL(g.kosong_apbn,0) AS kosong_apbn, IFNULL(h.apbn_1,0) AS apbn_1, IFNULL(i.apbn_2,0) AS apbn_2, IFNULL(j.apbn_3,0) AS apbn_3, IFNULL(k.apbn_na,0) AS apbn_na, IFNULL(l.kurang35,0) AS kurang35, IFNULL(m.lebih35,0) AS lebih35, IFNULL(n.umur_na,0) AS umur_na

        FROM tbldati2 a
        
        left join (select satminkal, count(id_thl) as slta_apbn from tbldasar_thl where tingkat_pendidikan='09' and sumber_dana='apbn' and angkatan BETWEEN 'I' and 'III' or tingkat_pendidikan='09' and sumber_dana='APBN' and angkatan BETWEEN 'I' and 'III' group by satminkal) b on a.id_dati2=b.satminkal
        left join (select satminkal, count(id_thl) as d3_apbn from tbldasar_thl where tingkat_pendidikan='06' and sumber_dana='apbn' and angkatan BETWEEN 'I' and 'III' or tingkat_pendidikan='06' and sumber_dana='APBN' and angkatan BETWEEN 'I' and 'III' group by satminkal) c on a.id_dati2=c.satminkal
        left join (select satminkal, count(id_thl) as d4_apbn from tbldasar_thl where tingkat_pendidikan='04' and sumber_dana='apbn' and angkatan BETWEEN 'I' and 'III' or tingkat_pendidikan='04' and sumber_dana='APBN' and angkatan BETWEEN 'I' and 'III' group by satminkal) d on a.id_dati2=d.satminkal
        left join (select satminkal, count(id_thl) as s1_apbn from tbldasar_thl where tingkat_pendidikan='03' and sumber_dana='apbn' and angkatan BETWEEN 'I' and 'III' or tingkat_pendidikan='03' and sumber_dana='APBN' and angkatan BETWEEN 'I' and 'III' group by satminkal) e on a.id_dati2=e.satminkal
        left join (select satminkal, count(id_thl) as s2_apbn from tbldasar_thl where tingkat_pendidikan='02' and sumber_dana='apbn' and angkatan BETWEEN 'I' and 'III' or tingkat_pendidikan='02' and sumber_dana='APBN' and angkatan BETWEEN 'I' and 'III' group by satminkal) f on a.id_dati2=f.satminkal
        left join (select satminkal, count(id_thl) as kosong_apbn from tbldasar_thl where tingkat_pendidikan='' and sumber_dana='apbn' and angkatan BETWEEN 'I' and 'III' or tingkat_pendidikan='' and sumber_dana='APBN' and angkatan BETWEEN 'I' and 'III' group by satminkal) g on a.id_dati2=g.satminkal
        
        left join (select satminkal, count(id_thl) as apbn_1 from tbldasar_thl where angkatan='I' and sumber_dana='apbn' or angkatan='I' and sumber_dana='APBN' group by satminkal) h on a.id_dati2=h.satminkal
        left join (select satminkal, count(id_thl) as apbn_2 from tbldasar_thl where angkatan='II' and sumber_dana='apbn' and angkatan BETWEEN 'I' and 'III' or angkatan='II' and sumber_dana='APBN' and angkatan BETWEEN 'I' and 'III' group by satminkal) i on a.id_dati2=i.satminkal
        left join (select satminkal, count(id_thl) as apbn_3 from tbldasar_thl where angkatan='III' and sumber_dana='apbn' and angkatan BETWEEN 'I' and 'III' or angkatan='III' and sumber_dana='APBN' and angkatan BETWEEN 'I' and 'III' group by satminkal) j on a.id_dati2=j.satminkal
        left join (select satminkal, count(id_thl) as apbn_na from tbldasar_thl where angkatan='' and sumber_dana='apbn' and angkatan BETWEEN 'I' and 'III' or angkatan='' and sumber_dana='APBN' and angkatan BETWEEN 'I' and 'III' group by satminkal) k on a.id_dati2=k.satminkal
        left join (select satminkal, count(id_thl) as kurang35 from tbldasar_thl where sumber_dana='apbn' and  thn_lahir >= '$tahun_today' and angkatan BETWEEN 'I' and 'III' or sumber_dana='APBN' and  thn_lahir >= '$tahun_today' and angkatan BETWEEN 'I' and 'III' group by satminkal) l on a.id_dati2=l.satminkal
        left join (select satminkal, count(id_thl) as lebih35 from tbldasar_thl where thn_lahir < '$tahun_today' and thn_lahir !='0' and sumber_dana='apbn' and angkatan BETWEEN 'I' and 'III' or thn_lahir < '$tahun_today' and thn_lahir !='0' and sumber_dana='APBN' and angkatan BETWEEN 'I' and 'III' group by satminkal) m on a.id_dati2=m.satminkal
        left join (select satminkal, count(id_thl) as umur_na from tbldasar_thl where thn_lahir ='0' and sumber_dana='apbn' and angkatan BETWEEN 'I' and 'III' or thn_lahir ='0' and sumber_dana='APBN' and angkatan BETWEEN 'I' and 'III' or thn_lahir IS NULL and sumber_dana='apbn' and angkatan BETWEEN 'I' and 'III' or thn_lahir IS NULL and sumber_dana='APBN' and angkatan BETWEEN 'I' and 'III' group by satminkal) n on a.id_dati2=n.satminkal
        where id_prop='$kode_prop'
        order by nama_dati2 asc
        ");
        $results   = $query5->getResultArray();

        $data =  [
            'namaprov' => $row->namaprov,
            'thlangkab' => $results
        ];
        return $data;
    }

    public function getTHLAPBN1($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select nama_dati2 as namakab from tbldati2 where id_dati2='$kode_kab'");
        $row   = $query->getRow();
        $query = $db->query("select *, a.nama, a.telp, a.email, a.noktp, b.nama_bpp, c.nm_desa as wilker, d.nm_desa as wilker2, e.nm_desa as wilker3, f.nm_desa as wilker4, g.nm_desa as wilker5
        from tbldasar_thl a
        left join tblbpp b on a.kecamatan_tugas=b.kecamatan
        left join tbldesa c on a.wil_kerja=c.id_desa
        left join tbldesa d on a.wil_kerja2=d.id_desa
        left join tbldesa e on a.wil_kerja3=e.id_desa
        left join tbldesa f on a.wil_kerja4=f.id_desa
        left join tbldesa g on a.wil_kerja5=g.id_desa
        WHERE a.satminkal LIKE '" . $kode_kab . "' AND `sumber_dana` LIKE 'apbn' AND angkatan='I' order by a.nama asc");
        $results   = $query->getResultArray();

        $data =  [
            'namakab' => $row->namakab,
            'thlapbn' => $results
        ];

        return $data;
    }

    public function getTHLAPBN2($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select nama_dati2 as namakab from tbldati2 where id_dati2='$kode_kab'");
        $row   = $query->getRow();
        $query = $db->query("select *, a.nama, a.telp, a.email, a.noktp, b.nama_bpp, c.nm_desa as wilker, d.nm_desa as wilker2, e.nm_desa as wilker3, f.nm_desa as wilker4, g.nm_desa as wilker5
        from tbldasar_thl a
        left join tblbpp b on a.kecamatan_tugas=b.kecamatan
        left join tbldesa c on a.wil_kerja=c.id_desa
        left join tbldesa d on a.wil_kerja2=d.id_desa
        left join tbldesa e on a.wil_kerja3=e.id_desa
        left join tbldesa f on a.wil_kerja4=f.id_desa
        left join tbldesa g on a.wil_kerja5=g.id_desa
        WHERE a.satminkal LIKE '" . $kode_kab . "' AND `sumber_dana` LIKE 'apbn' AND angkatan='II' and angkatan BETWEEN 'I' and 'III' order by a.nama asc");
        $results   = $query->getResultArray();

        $data =  [
            'namakab' => $row->namakab,
            'thlapbn' => $results
        ];

        return $data;
    }

    public function getTHLAPBN3($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select nama_dati2 as namakab from tbldati2 where id_dati2='$kode_kab'");
        $row   = $query->getRow();
        $query = $db->query("select *, a.nama, a.telp, a.email, a.noktp, b.nama_bpp, c.nm_desa as wilker, d.nm_desa as wilker2, e.nm_desa as wilker3, f.nm_desa as wilker4, g.nm_desa as wilker5
        from tbldasar_thl a
        left join tblbpp b on a.kecamatan_tugas=b.kecamatan
        left join tbldesa c on a.wil_kerja=c.id_desa
        left join tbldesa d on a.wil_kerja2=d.id_desa
        left join tbldesa e on a.wil_kerja3=e.id_desa
        left join tbldesa f on a.wil_kerja4=f.id_desa
        left join tbldesa g on a.wil_kerja5=g.id_desa
        WHERE a.satminkal LIKE '" . $kode_kab . "' AND `sumber_dana` LIKE 'apbn' AND angkatan='III' and angkatan BETWEEN 'I' and 'III' order by a.nama asc");
        $results   = $query->getResultArray();

        $data =  [
            'namakab' => $row->namakab,
            'thlapbn' => $results
        ];

        return $data;
    }

    public function getTHLAPBNslta($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select nama_dati2 as namakab from tbldati2 where id_dati2='$kode_kab'");
        $row   = $query->getRow();
        $query = $db->query("select *, a.nama, a.telp, a.email, a.noktp, b.nama_bpp, c.nm_desa as wilker, d.nm_desa as wilker2, e.nm_desa as wilker3, f.nm_desa as wilker4, g.nm_desa as wilker5
        from tbldasar_thl a
        left join tblbpp b on a.kecamatan_tugas=b.kecamatan
        left join tbldesa c on a.wil_kerja=c.id_desa
        left join tbldesa d on a.wil_kerja2=d.id_desa
        left join tbldesa e on a.wil_kerja3=e.id_desa
        left join tbldesa f on a.wil_kerja4=f.id_desa
        left join tbldesa g on a.wil_kerja5=g.id_desa
        WHERE a.satminkal LIKE '" . $kode_kab . "' AND `sumber_dana` LIKE 'apbn' and tingkat_pendidikan='09' and angkatan BETWEEN 'I' and 'III' order by a.nama asc");
        $results   = $query->getResultArray();

        $data =  [
            'namakab' => $row->namakab,
            'thlapbn' => $results
        ];

        return $data;
    }

    public function getTHLAPBNd3($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select nama_dati2 as namakab from tbldati2 where id_dati2='$kode_kab'");
        $row   = $query->getRow();
        $query = $db->query("select *, a.nama, a.telp, a.email, a.noktp, b.nama_bpp, c.nm_desa as wilker, d.nm_desa as wilker2, e.nm_desa as wilker3, f.nm_desa as wilker4, g.nm_desa as wilker5
        from tbldasar_thl a
        left join tblbpp b on a.kecamatan_tugas=b.kecamatan
        left join tbldesa c on a.wil_kerja=c.id_desa
        left join tbldesa d on a.wil_kerja2=d.id_desa
        left join tbldesa e on a.wil_kerja3=e.id_desa
        left join tbldesa f on a.wil_kerja4=f.id_desa
        left join tbldesa g on a.wil_kerja5=g.id_desa
        WHERE a.satminkal LIKE '" . $kode_kab . "' AND `sumber_dana` LIKE 'apbn' and tingkat_pendidikan='06' and angkatan BETWEEN 'I' and 'III' order by a.nama asc");
        $results   = $query->getResultArray();

        $data =  [
            'namakab' => $row->namakab,
            'thlapbn' => $results
        ];

        return $data;
    }

    public function getTHLAPBNd4($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select nama_dati2 as namakab from tbldati2 where id_dati2='$kode_kab'");
        $row   = $query->getRow();
        $query = $db->query("select *, a.nama, a.telp, a.email, a.noktp, b.nama_bpp, c.nm_desa as wilker, d.nm_desa as wilker2, e.nm_desa as wilker3, f.nm_desa as wilker4, g.nm_desa as wilker5
        from tbldasar_thl a
        left join tblbpp b on a.kecamatan_tugas=b.kecamatan
        left join tbldesa c on a.wil_kerja=c.id_desa
        left join tbldesa d on a.wil_kerja2=d.id_desa
        left join tbldesa e on a.wil_kerja3=e.id_desa
        left join tbldesa f on a.wil_kerja4=f.id_desa
        left join tbldesa g on a.wil_kerja5=g.id_desa
        WHERE a.satminkal LIKE '" . $kode_kab . "' AND `sumber_dana` LIKE 'apbn' and tingkat_pendidikan='04' and angkatan BETWEEN 'I' and 'III' order by a.nama asc");
        $results   = $query->getResultArray();

        $data =  [
            'namakab' => $row->namakab,
            'thlapbn' => $results
        ];

        return $data;
    }

    public function getTHLAPBNs1($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select nama_dati2 as namakab from tbldati2 where id_dati2='$kode_kab'");
        $row   = $query->getRow();
        $query = $db->query("select *, a.nama, a.telp, a.email, a.noktp, b.nama_bpp, c.nm_desa as wilker, d.nm_desa as wilker2, e.nm_desa as wilker3, f.nm_desa as wilker4, g.nm_desa as wilker5
        from tbldasar_thl a
        left join tblbpp b on a.kecamatan_tugas=b.kecamatan
        left join tbldesa c on a.wil_kerja=c.id_desa
        left join tbldesa d on a.wil_kerja2=d.id_desa
        left join tbldesa e on a.wil_kerja3=e.id_desa
        left join tbldesa f on a.wil_kerja4=f.id_desa
        left join tbldesa g on a.wil_kerja5=g.id_desa
        WHERE a.satminkal LIKE '" . $kode_kab . "' AND `sumber_dana` LIKE 'apbn' and tingkat_pendidikan='03' and angkatan BETWEEN 'I' and 'III' order by a.nama asc");
        $results   = $query->getResultArray();

        $data =  [
            'namakab' => $row->namakab,
            'thlapbn' => $results
        ];

        return $data;
    }

    public function getTHLAPBNs2($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select nama_dati2 as namakab from tbldati2 where id_dati2='$kode_kab'");
        $row   = $query->getRow();
        $query = $db->query("select *, a.nama, a.telp, a.email, a.noktp, b.nama_bpp, c.nm_desa as wilker, d.nm_desa as wilker2, e.nm_desa as wilker3, f.nm_desa as wilker4, g.nm_desa as wilker5
        from tbldasar_thl a
        left join tblbpp b on a.kecamatan_tugas=b.kecamatan
        left join tbldesa c on a.wil_kerja=c.id_desa
        left join tbldesa d on a.wil_kerja2=d.id_desa
        left join tbldesa e on a.wil_kerja3=e.id_desa
        left join tbldesa f on a.wil_kerja4=f.id_desa
        left join tbldesa g on a.wil_kerja5=g.id_desa
        WHERE a.satminkal LIKE '" . $kode_kab . "' AND `sumber_dana` LIKE 'apbn' and tingkat_pendidikan='02' and angkatan BETWEEN 'I' and 'III' order by a.nama asc");
        $results   = $query->getResultArray();

        $data =  [
            'namakab' => $row->namakab,
            'thlapbn' => $results
        ];

        return $data;
    }

    public function getTHLAPBNk35($kode_kab, $tahun_today)
    {
        $db = Database::connect();
        $query = $db->query("select nama_dati2 as namakab from tbldati2 where id_dati2='$kode_kab'");
        $row   = $query->getRow();
        $query = $db->query("select *, a.nama, a.telp, a.email, a.noktp, b.nama_bpp, c.nm_desa as wilker, d.nm_desa as wilker2, e.nm_desa as wilker3, f.nm_desa as wilker4, g.nm_desa as wilker5
        from tbldasar_thl a
        left join tblbpp b on a.kecamatan_tugas=b.kecamatan
        left join tbldesa c on a.wil_kerja=c.id_desa
        left join tbldesa d on a.wil_kerja2=d.id_desa
        left join tbldesa e on a.wil_kerja3=e.id_desa
        left join tbldesa f on a.wil_kerja4=f.id_desa
        left join tbldesa g on a.wil_kerja5=g.id_desa
        WHERE a.satminkal LIKE '" . $kode_kab . "' AND `sumber_dana` LIKE 'apbn' and thn_lahir >= '$tahun_today' and angkatan BETWEEN 'I' and 'III' order by a.nama asc");
        $results   = $query->getResultArray();

        $data =  [
            'namakab' => $row->namakab,
            'thlapbn' => $results
        ];

        return $data;
    }

    public function getTHLAPBNl35($kode_kab, $tahun_today)
    {
        $db = Database::connect();
        $query = $db->query("select nama_dati2 as namakab from tbldati2 where id_dati2='$kode_kab'");
        $row   = $query->getRow();
        $query = $db->query("select *, a.nama, a.telp, a.email, a.noktp, b.nama_bpp, c.nm_desa as wilker, d.nm_desa as wilker2, e.nm_desa as wilker3, f.nm_desa as wilker4, g.nm_desa as wilker5
        from tbldasar_thl a
        left join tblbpp b on a.kecamatan_tugas=b.kecamatan
        left join tbldesa c on a.wil_kerja=c.id_desa
        left join tbldesa d on a.wil_kerja2=d.id_desa
        left join tbldesa e on a.wil_kerja3=e.id_desa
        left join tbldesa f on a.wil_kerja4=f.id_desa
        left join tbldesa g on a.wil_kerja5=g.id_desa
        WHERE a.satminkal LIKE '" . $kode_kab . "' AND `sumber_dana` LIKE 'apbn' and thn_lahir < '$tahun_today' and angkatan BETWEEN 'I' and 'III' order by a.nama asc");
        $results   = $query->getResultArray();

        $data =  [
            'namakab' => $row->namakab,
            'thlapbn' => $results
        ];

        return $data;
    }

    public function getSarpras()
    {
        $db = Database::connect();
        $query5 = $db->query("select *, IFNULL(b.r4_apbnp,0) AS r4_apbnp, IFNULL(c.r4_apbnk,0) AS r4_apbnk, IFNULL(d.r4_apbnb,0) AS r4_apbnb, 
        IFNULL(e.r4_apbdp,0) AS r4_apbdp, IFNULL(f.r4_apbdk,0) AS r4_apbdk, IFNULL(g.r4_apbdb,0) AS r4_apbdb, 
        IFNULL(h.r2_apbnp,0) AS r2_apbnp, IFNULL(i.r2_apbnk,0) AS r2_apbnk, IFNULL(j.r2_apbnb,0) AS r2_apbnb, 
        IFNULL(k.r2_apbdp,0) AS r2_apbdp, IFNULL(l.r2_apbdk,0) AS r2_apbdk, IFNULL(m.r2_apbdb,0) AS r2_apbdb, 
        IFNULL(n.pc_apbnp,0) AS pc_apbnp, IFNULL(o.pc_apbnk,0) AS pc_apbnk, IFNULL(p.pc_apbnb,0) AS pc_apbnb,
        IFNULL(q.pc_apbdp,0) AS pc_apbdp, IFNULL(r.pc_apbdk,0) AS pc_apbdk, IFNULL(s.pc_apbdb,0) AS pc_apbdb,
        IFNULL(t.laptop_apbnp,0) AS laptop_apbnp, IFNULL(u.laptop_apbnk,0) AS laptop_apbnk, IFNULL(v.laptop_apbnb,0) AS laptop_apbnb,
        IFNULL(w.laptop_apbdp,0) AS laptop_apbdp, IFNULL(x.laptop_apbdk,0) AS laptop_apbdk, IFNULL(y.laptop_apbdb,0) AS laptop_apbdb,
        IFNULL(z.printer_apbnp,0) AS printer_apbnp, IFNULL(aa.printer_apbnk,0) AS printer_apbnk, IFNULL(bb.printer_apbnb,0) AS printer_apbnb,
        IFNULL(cc.printer_apbdp,0) AS printer_apbdp, IFNULL(dd.printer_apbdk,0) AS printer_apbdk, IFNULL(ee.printer_apbdb,0) AS printer_apbdb,
        IFNULL(ff.modem_apbnp,0) AS modem_apbnp, IFNULL(gg.modem_apbnk,0) AS modem_apbnk, IFNULL(hh.modem_apbnb,0) AS modem_apbnb,
        IFNULL(ii.modem_apbdp,0) AS modem_apbdp, IFNULL(jj.modem_apbdk,0) AS modem_apbdk, IFNULL(kk.modem_apbdb,0) AS modem_apbdb,
        IFNULL(ll.lcd_apbnp,0) AS lcd_apbnp, IFNULL(mm.lcd_apbnk,0) AS lcd_apbnk, IFNULL(nn.lcd_apbnb,0) AS lcd_apbnb,
        IFNULL(oo.lcd_apbdp,0) AS lcd_apbdp, IFNULL(pp.lcd_apbdk,0) AS lcd_apbdk, IFNULL(qq.lcd_apbdb,0) AS lcd_apbdb,
        IFNULL(rr.soil_apbnp,0) AS soil_apbnp, IFNULL(ss.soil_apbnk,0) AS soil_apbnk, IFNULL(tt.soil_apbnb,0) AS soil_apbnb,
        IFNULL(uu.soil_apbdp,0) AS soil_apbdp, IFNULL(vv.soil_apbdk,0) AS soil_apbdk, IFNULL(ww.soil_apbdb,0) AS soil_apbdb

        FROM tblpropinsi a
        
        left join (select kode_prop, sum(roda_4_apbn) as r4_apbnp from tblbakor group by kode_prop) b on a.id_prop=b.kode_prop
        left join (select kode_prop, sum(roda_4_apbn) as r4_apbnk from tblbapel group by kode_prop) c on a.id_prop=c.kode_prop
        left join (select kode_prop, sum(roda_4_apbn) as r4_apbnb from tblbpp group by kode_prop) d on a.id_prop=d.kode_prop
        left join (select kode_prop, sum(roda_4_apbd) as r4_apbdp from tblbakor group by kode_prop) e on a.id_prop=e.kode_prop
        left join (select kode_prop, sum(roda_4_apbd) as r4_apbdk from tblbapel group by kode_prop) f on a.id_prop=f.kode_prop
        left join (select kode_prop, sum(roda_4_apbd) as r4_apbdb from tblbpp group by kode_prop) g on a.id_prop=g.kode_prop
        
        left join (select kode_prop, sum(roda_2_apbn) as r2_apbnp from tblbakor group by kode_prop) h on a.id_prop=h.kode_prop
        left join (select kode_prop, sum(roda_2_apbn) as r2_apbnk from tblbapel group by kode_prop) i on a.id_prop=i.kode_prop
        left join (select kode_prop, sum(roda_2_apbn) as r2_apbnb from tblbpp group by kode_prop) j on a.id_prop=j.kode_prop
        left join (select kode_prop, sum(roda_2_apbd) as r2_apbdp from tblbakor group by kode_prop) k on a.id_prop=k.kode_prop
        left join (select kode_prop, sum(roda_2_apbd) as r2_apbdk from tblbapel group by kode_prop) l on a.id_prop=l.kode_prop
        left join (select kode_prop, sum(roda_2_apbd) as r2_apbdb from tblbpp group by kode_prop) m on a.id_prop=m.kode_prop
        
        left join (select kode_prop, sum(pc_apbn) as pc_apbnp from tblbakor group by kode_prop) n on a.id_prop=n.kode_prop
        left join (select kode_prop, sum(pc_apbn) as pc_apbnk from tblbapel group by kode_prop) o on a.id_prop=o.kode_prop
        left join (select kode_prop, sum(pc_apbn) as pc_apbnb from tblbpp group by kode_prop) p on a.id_prop=p.kode_prop
        left join (select kode_prop, sum(pc_apbd) as pc_apbdp from tblbakor group by kode_prop) q on a.id_prop=q.kode_prop
        left join (select kode_prop, sum(pc_apbd) as pc_apbdk from tblbapel group by kode_prop) r on a.id_prop=r.kode_prop
        left join (select kode_prop, sum(pc_apbd) as pc_apbdb from tblbpp group by kode_prop) s on a.id_prop=s.kode_prop

        left join (select kode_prop, sum(laptop_apbn) as laptop_apbnp from tblbakor group by kode_prop) t on a.id_prop=t.kode_prop
        left join (select kode_prop, sum(laptop_apbn) as laptop_apbnk from tblbapel group by kode_prop) u on a.id_prop=u.kode_prop
        left join (select kode_prop, sum(laptop_apbn) as laptop_apbnb from tblbpp group by kode_prop) v on a.id_prop=v.kode_prop
        left join (select kode_prop, sum(laptop_apbd) as laptop_apbdp from tblbakor group by kode_prop) w on a.id_prop=w.kode_prop
        left join (select kode_prop, sum(laptop_apbd) as laptop_apbdk from tblbapel group by kode_prop) x on a.id_prop=x.kode_prop
        left join (select kode_prop, sum(laptop_apbd) as laptop_apbdb from tblbpp group by kode_prop) y on a.id_prop=y.kode_prop

        left join (select kode_prop, sum(printer_apbn) as printer_apbnp from tblbakor group by kode_prop) z on a.id_prop=z.kode_prop
        left join (select kode_prop, sum(printer_apbn) as printer_apbnk from tblbapel group by kode_prop) aa on a.id_prop=aa.kode_prop
        left join (select kode_prop, sum(printer_apbn) as printer_apbnb from tblbpp group by kode_prop) bb on a.id_prop=bb.kode_prop
        left join (select kode_prop, sum(printer_apbd) as printer_apbdp from tblbakor group by kode_prop) cc on a.id_prop=cc.kode_prop
        left join (select kode_prop, sum(printer_apbd) as printer_apbdk from tblbapel group by kode_prop) dd on a.id_prop=dd.kode_prop
        left join (select kode_prop, sum(printer_apbd) as printer_apbdb from tblbpp group by kode_prop) ee on a.id_prop=ee.kode_prop

        left join (select kode_prop, sum(modem_apbn) as modem_apbnp from tblbakor group by kode_prop) ff on a.id_prop=ff.kode_prop
        left join (select kode_prop, sum(modem_apbn) as modem_apbnk from tblbapel group by kode_prop) gg on a.id_prop=gg.kode_prop
        left join (select kode_prop, sum(modem_apbn) as modem_apbnb from tblbpp group by kode_prop) hh on a.id_prop=hh.kode_prop
        left join (select kode_prop, sum(modem_apbd) as modem_apbdp from tblbakor group by kode_prop) ii on a.id_prop=ii.kode_prop
        left join (select kode_prop, sum(modem_apbd) as modem_apbdk from tblbapel group by kode_prop) jj on a.id_prop=jj.kode_prop
        left join (select kode_prop, sum(modem_apbd) as modem_apbdb from tblbpp group by kode_prop) kk on a.id_prop=kk.kode_prop

        left join (select kode_prop, sum(lcd_apbn) as lcd_apbnp from tblbakor group by kode_prop) ll on a.id_prop=ll.kode_prop
        left join (select kode_prop, sum(lcd_apbn) as lcd_apbnk from tblbapel group by kode_prop) mm on a.id_prop=mm.kode_prop
        left join (select kode_prop, sum(lcd_apbn) as lcd_apbnb from tblbpp group by kode_prop) nn on a.id_prop=nn.kode_prop
        left join (select kode_prop, sum(lcd_apbd) as lcd_apbdp from tblbakor group by kode_prop) oo on a.id_prop=oo.kode_prop
        left join (select kode_prop, sum(lcd_apbd) as lcd_apbdk from tblbapel group by kode_prop) pp on a.id_prop=pp.kode_prop
        left join (select kode_prop, sum(lcd_apbd) as lcd_apbdb from tblbpp group by kode_prop) qq on a.id_prop=qq.kode_prop
        
        left join (select kode_prop, sum(soil_apbn) as soil_apbnp from tblbakor group by kode_prop) rr on a.id_prop=rr.kode_prop
        left join (select kode_prop, sum(soil_apbn) as soil_apbnk from tblbapel group by kode_prop) ss on a.id_prop=ss.kode_prop
        left join (select kode_prop, sum(soil_apbn) as soil_apbnb from tblbpp group by kode_prop) tt on a.id_prop=tt.kode_prop
        left join (select kode_prop, sum(soil_apbd) as soil_apbdp from tblbakor group by kode_prop) uu on a.id_prop=uu.kode_prop
        left join (select kode_prop, sum(soil_apbd) as soil_apbdk from tblbapel group by kode_prop) vv on a.id_prop=vv.kode_prop
        left join (select kode_prop, sum(soil_apbd) as soil_apbdb from tblbpp group by kode_prop) ww on a.id_prop=ww.kode_prop

        order by nama_prop asc
        ");
        $results   = $query5->getResultArray();

        $data =  [
            'sarpras' => $results
        ];
        return $data;
    }

    public function getSarprasKab($kode_prop)
    {
        $db = Database::connect();
        $query = $db->query("select nama_prop as namaprov from tblpropinsi where id_prop='$kode_prop'");
        $row   = $query->getRow();
        $query5 = $db->query("select *, IFNULL(c.r4_apbnk,0) AS r4_apbnk, IFNULL(d.r4_apbnb,0) AS r4_apbnb, 
        IFNULL(f.r4_apbdk,0) AS r4_apbdk, IFNULL(g.r4_apbdb,0) AS r4_apbdb, 
        IFNULL(i.r2_apbnk,0) AS r2_apbnk, IFNULL(j.r2_apbnb,0) AS r2_apbnb, 
        IFNULL(l.r2_apbdk,0) AS r2_apbdk, IFNULL(m.r2_apbdb,0) AS r2_apbdb, 
        IFNULL(o.pc_apbnk,0) AS pc_apbnk, IFNULL(p.pc_apbnb,0) AS pc_apbnb,
        IFNULL(r.pc_apbdk,0) AS pc_apbdk, IFNULL(s.pc_apbdb,0) AS pc_apbdb,
        IFNULL(u.laptop_apbnk,0) AS laptop_apbnk, IFNULL(v.laptop_apbnb,0) AS laptop_apbnb,
        IFNULL(x.laptop_apbdk,0) AS laptop_apbdk, IFNULL(y.laptop_apbdb,0) AS laptop_apbdb,
        IFNULL(aa.printer_apbnk,0) AS printer_apbnk, IFNULL(bb.printer_apbnb,0) AS printer_apbnb,
        IFNULL(dd.printer_apbdk,0) AS printer_apbdk, IFNULL(ee.printer_apbdb,0) AS printer_apbdb,
        IFNULL(gg.modem_apbnk,0) AS modem_apbnk, IFNULL(hh.modem_apbnb,0) AS modem_apbnb,
        IFNULL(jj.modem_apbdk,0) AS modem_apbdk, IFNULL(kk.modem_apbdb,0) AS modem_apbdb,
        IFNULL(mm.lcd_apbnk,0) AS lcd_apbnk, IFNULL(nn.lcd_apbnb,0) AS lcd_apbnb,
        IFNULL(pp.lcd_apbdk,0) AS lcd_apbdk, IFNULL(qq.lcd_apbdb,0) AS lcd_apbdb,
        IFNULL(ss.soil_apbnk,0) AS soil_apbnk, IFNULL(tt.soil_apbnb,0) AS soil_apbnb,
        IFNULL(vv.soil_apbdk,0) AS soil_apbdk, IFNULL(ww.soil_apbdb,0) AS soil_apbdb

        FROM tbldati2 a
        
        left join (select kabupaten, sum(roda_4_apbn) as r4_apbnk from tblbapel group by kabupaten) c on a.id_dati2=c.kabupaten
        left join (select satminkal, sum(roda_4_apbn) as r4_apbnb from tblbpp group by satminkal) d on a.id_dati2=d.satminkal
        left join (select kabupaten, sum(roda_4_apbd) as r4_apbdk from tblbapel group by kabupaten) f on a.id_dati2=f.kabupaten
        left join (select satminkal, sum(roda_4_apbd) as r4_apbdb from tblbpp group by satminkal) g on a.id_dati2=g.satminkal
        
        left join (select kabupaten, sum(roda_2_apbn) as r2_apbnk from tblbapel group by kabupaten) i on a.id_dati2=i.kabupaten
        left join (select satminkal, sum(roda_2_apbn) as r2_apbnb from tblbpp group by satminkal) j on a.id_dati2=j.satminkal
        left join (select kabupaten, sum(roda_2_apbd) as r2_apbdk from tblbapel group by kabupaten) l on a.id_dati2=l.kabupaten
        left join (select satminkal, sum(roda_2_apbd) as r2_apbdb from tblbpp group by satminkal) m on a.id_dati2=m.satminkal
        
        left join (select kabupaten, sum(pc_apbn) as pc_apbnk from tblbapel group by kabupaten) o on a.id_dati2=o.kabupaten
        left join (select satminkal, sum(pc_apbn) as pc_apbnb from tblbpp group by satminkal) p on a.id_dati2=p.satminkal
        left join (select kabupaten, sum(pc_apbd) as pc_apbdk from tblbapel group by kabupaten) r on a.id_dati2=r.kabupaten
        left join (select satminkal, sum(pc_apbd) as pc_apbdb from tblbpp group by satminkal) s on a.id_dati2=s.satminkal

        left join (select kabupaten, sum(laptop_apbn) as laptop_apbnk from tblbapel group by kabupaten) u on a.id_dati2=u.kabupaten
        left join (select satminkal, sum(laptop_apbn) as laptop_apbnb from tblbpp group by satminkal) v on a.id_dati2=v.satminkal
        left join (select kabupaten, sum(laptop_apbd) as laptop_apbdk from tblbapel group by kabupaten) x on a.id_dati2=x.kabupaten
        left join (select satminkal, sum(laptop_apbd) as laptop_apbdb from tblbpp group by satminkal) y on a.id_dati2=y.satminkal

        left join (select kabupaten, sum(printer_apbn) as printer_apbnk from tblbapel group by kabupaten) aa on a.id_dati2=aa.kabupaten
        left join (select satminkal, sum(printer_apbn) as printer_apbnb from tblbpp group by satminkal) bb on a.id_dati2=bb.satminkal
        left join (select kabupaten, sum(printer_apbd) as printer_apbdk from tblbapel group by kabupaten) dd on a.id_dati2=dd.kabupaten
        left join (select satminkal, sum(printer_apbd) as printer_apbdb from tblbpp group by satminkal) ee on a.id_dati2=ee.satminkal

        left join (select kabupaten, sum(modem_apbn) as modem_apbnk from tblbapel group by kabupaten) gg on a.id_dati2=gg.kabupaten
        left join (select satminkal, sum(modem_apbn) as modem_apbnb from tblbpp group by satminkal) hh on a.id_dati2=hh.satminkal
        left join (select kabupaten, sum(modem_apbd) as modem_apbdk from tblbapel group by kabupaten) jj on a.id_dati2=jj.kabupaten
        left join (select satminkal, sum(modem_apbd) as modem_apbdb from tblbpp group by satminkal) kk on a.id_dati2=kk.satminkal

        left join (select kabupaten, sum(lcd_apbn) as lcd_apbnk from tblbapel group by kabupaten) mm on a.id_dati2=mm.kabupaten
        left join (select satminkal, sum(lcd_apbn) as lcd_apbnb from tblbpp group by satminkal) nn on a.id_dati2=nn.satminkal
        left join (select kabupaten, sum(lcd_apbd) as lcd_apbdk from tblbapel group by kabupaten) pp on a.id_dati2=pp.kabupaten
        left join (select satminkal, sum(lcd_apbd) as lcd_apbdb from tblbpp group by satminkal) qq on a.id_dati2=qq.satminkal
        
        left join (select kabupaten, sum(soil_apbn) as soil_apbnk from tblbapel group by kabupaten) ss on a.id_dati2=ss.kabupaten
        left join (select satminkal, sum(soil_apbn) as soil_apbnb from tblbpp group by satminkal) tt on a.id_dati2=tt.satminkal
        left join (select kabupaten, sum(soil_apbd) as soil_apbdk from tblbapel group by kabupaten) vv on a.id_dati2=vv.kabupaten
        left join (select satminkal, sum(soil_apbd) as soil_apbdb from tblbpp group by satminkal) ww on a.id_dati2=ww.satminkal
        where a.id_prop='$kode_prop'
        order by nama_dati2 asc
        ");
        $results   = $query5->getResultArray();

        $data =  [
            'namaprov' => $row->namaprov,
            'sarpras' => $results
        ];
        return $data;
    }

    public function getSarprasKec($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select nama_dati2 as namakab from tbldati2 where id_dati2='$kode_kab'");
        $row   = $query->getRow();
        $query5 = $db->query("select *, IFNULL(d.r4_apbnb,0) AS r4_apbnb, 
        IFNULL(g.r4_apbdb,0) AS r4_apbdb, 
        IFNULL(j.r2_apbnb,0) AS r2_apbnb, 
        IFNULL(m.r2_apbdb,0) AS r2_apbdb, 
        IFNULL(p.pc_apbnb,0) AS pc_apbnb,
        IFNULL(s.pc_apbdb,0) AS pc_apbdb,
        IFNULL(v.laptop_apbnb,0) AS laptop_apbnb,
        IFNULL(y.laptop_apbdb,0) AS laptop_apbdb,
        IFNULL(bb.printer_apbnb,0) AS printer_apbnb,
        IFNULL(ee.printer_apbdb,0) AS printer_apbdb,
        IFNULL(hh.modem_apbnb,0) AS modem_apbnb,
        IFNULL(kk.modem_apbdb,0) AS modem_apbdb,
        IFNULL(nn.lcd_apbnb,0) AS lcd_apbnb,
        IFNULL(qq.lcd_apbdb,0) AS lcd_apbdb,
        IFNULL(tt.soil_apbnb,0) AS soil_apbnb,
        IFNULL(ww.soil_apbdb,0) AS soil_apbdb

        FROM tbldaerah a
        
        left join (select kecamatan, sum(roda_4_apbn) as r4_apbnb from tblbpp group by kecamatan) d on a.id_daerah=d.kecamatan
        left join (select kecamatan, sum(roda_4_apbd) as r4_apbdb from tblbpp group by kecamatan) g on a.id_daerah=g.kecamatan
        
        left join (select kecamatan, sum(roda_2_apbn) as r2_apbnb from tblbpp group by kecamatan) j on a.id_daerah=j.kecamatan
        left join (select kecamatan, sum(roda_2_apbd) as r2_apbdb from tblbpp group by kecamatan) m on a.id_daerah=m.kecamatan
        
        left join (select kecamatan, sum(pc_apbn) as pc_apbnb from tblbpp group by kecamatan) p on a.id_daerah=p.kecamatan
        left join (select kecamatan, sum(pc_apbd) as pc_apbdb from tblbpp group by kecamatan) s on a.id_daerah=s.kecamatan

        left join (select kecamatan, sum(laptop_apbn) as laptop_apbnb from tblbpp group by kecamatan) v on a.id_daerah=v.kecamatan
        left join (select kecamatan, sum(laptop_apbd) as laptop_apbdb from tblbpp group by kecamatan) y on a.id_daerah=y.kecamatan

        left join (select kecamatan, sum(printer_apbn) as printer_apbnb from tblbpp group by kecamatan) bb on a.id_daerah=bb.kecamatan
        left join (select kecamatan, sum(printer_apbd) as printer_apbdb from tblbpp group by kecamatan) ee on a.id_daerah=ee.kecamatan

        left join (select kecamatan, sum(modem_apbn) as modem_apbnb from tblbpp group by kecamatan) hh on a.id_daerah=hh.kecamatan
        left join (select kecamatan, sum(modem_apbd) as modem_apbdb from tblbpp group by kecamatan) kk on a.id_daerah=kk.kecamatan

        left join (select kecamatan, sum(lcd_apbn) as lcd_apbnb from tblbpp group by kecamatan) nn on a.id_daerah=nn.kecamatan
        left join (select kecamatan, sum(lcd_apbd) as lcd_apbdb from tblbpp group by kecamatan) qq on a.id_daerah=qq.kecamatan
        
        left join (select kecamatan, sum(soil_apbn) as soil_apbnb from tblbpp group by kecamatan) tt on a.id_daerah=tt.kecamatan
        left join (select kecamatan, sum(soil_apbd) as soil_apbdb from tblbpp group by kecamatan) ww on a.id_daerah=ww.kecamatan
        where a.id_dati2='$kode_kab'
        order by deskripsi asc
        ");
        $results   = $query5->getResultArray();

        $data =  [
            'namakab' => $row->namakab,
            'sarpras' => $results
        ];
        return $data;
    }

    public function getDataAuditLahan()
    {
        $db = Database::connect();
        $query = $db->query("SELECT a.`nama_prop`,a.`id_prop`,d.kodeprop,d.irigasi, d.tadah_hujan, d.pasang_surut, d.lebak FROM
        (SELECT SUM(irigasi) AS irigasi, SUM(tadah_hujan) AS tadah_hujan,
        SUM(pasang_surut) AS pasang_surut, SUM(lebak) AS lebak,SUBSTR(kecamatan,1,2) AS kodeprop
        FROM `tb_potensi_lahan` GROUP BY kodeprop)d
        RIGHT JOIN(SELECT nama_prop,id_prop,SUBSTR(id_prop,1,2)AS kode FROM `tblpropinsi`)a 
        ON a.kode=d.kodeprop GROUP BY a.kode ORDER BY a.kode ASC");
        $results   = $query->getResultArray();

        $data =  [
            'audlhn' => $results
        ];

        return $data;
    }

    public function getDataAuditLahanKab($kode_prop)
    {
        $db = Database::connect();
        $query = $db->query("select nama_prop as namaprov from tblpropinsi where id_prop='$kode_prop'");
        $row   = $query->getRow();
        $query2 = $db->query("SELECT a.`nama_dati2`,a.`id_prop`,a.`id_dati2`, d.kodekab,d.irigasi, d.tadah_hujan, d.pasang_surut, d.lebak FROM
        (SELECT SUM(irigasi) AS irigasi, SUM(tadah_hujan) AS tadah_hujan,
        SUM(pasang_surut) AS pasang_surut, SUM(lebak) AS lebak,SUBSTR(kecamatan,1,4) AS kodekab
        FROM `tb_potensi_lahan` GROUP BY kodekab)d
        RIGHT JOIN(SELECT id_prop,nama_dati2,id_dati2,SUBSTR(id_dati2,1,4)AS kode FROM `tbldati2`)a 
        ON a.kode=d.kodekab where a.id_prop='$kode_prop' GROUP BY a.kode ORDER BY a.kode ASC ");
        $results   = $query2->getResultArray();

        $data =  [
            'namaprov' => $row->namaprov,
            'audlhn' => $results
        ];

        return $data;
    }

    public function getDataAuditLahanKec($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select nama_dati2 as namakab from tbldati2 where id_dati2='$kode_kab'");
        $row   = $query->getRow();
        $query = $db->query("SELECT a.`deskripsi`,a.`id_prop`,a.`id_dati2`, d.kodekec,d.irigasi, d.tadah_hujan, d.pasang_surut, d.lebak FROM
        (SELECT SUM(irigasi) AS irigasi, SUM(tadah_hujan) AS tadah_hujan,
        SUM(pasang_surut) AS pasang_surut, SUM(lebak) AS lebak, kecamatan AS kodekec
        FROM `tb_potensi_lahan` GROUP BY kodekec)d
        RIGHT JOIN(SELECT id_prop,deskripsi,id_dati2,id_daerah AS kode FROM `tbldaerah`)a 
        ON a.kode=d.kodekec where a.id_dati2='$kode_kab' GROUP BY a.kode ORDER BY a.kode ASC ");
        $results   = $query->getResultArray();

        $data =  [
            'namakab' => $row->namakab,
            'audlhn' => $results
        ];

        return $data;
    }

    public function getDataDukung()
    {
        $db = Database::connect();
        $query = $db->query("select *, ifnull(b.saprotan,0) as saprotan, ifnull(c.pengepul,0) as pengepul,ifnull(d.gpangan,0) as gpangan,ifnull(e.bank,0) as bank,ifnull(f.industri,0) as industri
        from tblpropinsi a
        left join (select kode_prop, SUM(kios_saprotan) as saprotan from tblbpp group by kode_prop) b on a.id_prop=b.kode_prop
        left join (select kode_prop, SUM(pedagang_pengepul) as pengepul from tblbpp group by kode_prop) c on a.id_prop=c.kode_prop
        left join (select kode_prop, SUM(gudang_pangan) as gpangan from tblbpp group by kode_prop) d on a.id_prop=d.kode_prop
        left join (select kode_prop, SUM(perbankan) as bank from tblbpp group by kode_prop) e on a.id_prop=e.kode_prop
        left join (select kode_prop, SUM(industri_penyuluhan) as industri from tblbpp group by kode_prop) f on a.id_prop=f.kode_prop
        order by nama_prop asc
        ");
        $results   = $query->getResultArray();

        $data =  [
            'daduk' => $results
        ];

        return $data;
    }

    public function getDataDukungKab($kode_prop)
    {
        $db = Database::connect();
        $query = $db->query("select nama_prop as namaprov from tblpropinsi where id_prop='$kode_prop'");
        $row   = $query->getRow();
        $query = $db->query("select *, ifnull(b.saprotan,0) as saprotan, ifnull(c.pengepul,0) as pengepul,ifnull(d.gpangan,0) as gpangan,ifnull(e.bank,0) as bank,ifnull(f.industri,0) as industri
        from tbldati2 a
        left join (select satminkal, SUM(kios_saprotan) as saprotan from tblbpp group by satminkal) b on a.id_dati2=b.satminkal
        left join (select satminkal, SUM(pedagang_pengepul) as pengepul from tblbpp group by satminkal) c on a.id_dati2=c.satminkal
        left join (select satminkal, SUM(gudang_pangan) as gpangan from tblbpp group by satminkal) d on a.id_dati2=d.satminkal
        left join (select satminkal, SUM(perbankan) as bank from tblbpp group by satminkal) e on a.id_dati2=e.satminkal
        left join (select satminkal, SUM(industri_penyuluhan) as industri from tblbpp group by satminkal) f on a.id_dati2=f.satminkal
        where id_prop='$kode_prop' order by nama_dati2 asc
        ");
        $results   = $query->getResultArray();

        $data =  [
            'namaprov' => $row->namaprov,
            'daduk' => $results
        ];

        return $data;
    }

    public function getDataDukungKec($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select nama_dati2 as namakab from tbldati2 where id_dati2='$kode_kab'");
        $row   = $query->getRow();
        $query = $db->query("select *, ifnull(b.saprotan,0) as saprotan, ifnull(c.pengepul,0) as pengepul,ifnull(d.gpangan,0) as gpangan,ifnull(e.bank,0) as bank,ifnull(f.industri,0) as industri
        from tblbpp a
        left join (select kecamatan, SUM(kios_saprotan) as saprotan from tblbpp group by kecamatan) b on a.kecamatan=b.kecamatan
        left join (select kecamatan, SUM(pedagang_pengepul) as pengepul from tblbpp group by kecamatan) c on a.kecamatan=c.kecamatan
        left join (select kecamatan, SUM(gudang_pangan) as gpangan from tblbpp group by kecamatan) d on a.kecamatan=d.kecamatan
        left join (select kecamatan, SUM(perbankan) as bank from tblbpp group by kecamatan) e on a.kecamatan=e.kecamatan
        left join (select kecamatan, SUM(industri_penyuluhan) as industri from tblbpp group by kecamatan) f on a.kecamatan=f.kecamatan
        where a.satminkal='$kode_kab' order by nama_bpp asc
        ");
        $results   = $query->getResultArray();

        $data =  [
            'namakab' => $row->namakab,
            'daduk' => $results
        ];

        return $data;
    }

    public function getRekapBPPExcView($kode_prop)
    {
        $db = Database::connect();
        $query = $db->query("select * , a.id, a.email, a.roda_4_apbn, a.soil_apbn, a.soil_apbd, a.tgl_update, a.alamat, a.kode_bp3k, b.nama, c.deskripsi, f.jumgap,f.kode_bp3k,g.jumkep,d.jumpok,e.jumthl,h.jumpns,i.jumswa,k.nama_dati2,j.kecamatan,l.jumswas
        from tblbpp a
        left join tbldasar b on a.nama_koord_penyuluh=b.nip
        left join tbldaerah c on a.kecamatan=c.id_daerah  
        left join (select kode_bp3k, count(id_poktan) as jumpok from tb_poktan GROUP BY kode_bp3k)d on a.kode_bp3k=d.kode_bp3k
        left join(select unit_kerja,count(id_thl) as jumthl from tbldasar_thl GROUP BY unit_kerja) e on  a.id=e.unit_kerja
        left join(select kode_bp3k, count(id_gap) as jumgap from tb_gapoktan GROUP BY kode_bp3k)f on a.kode_bp3k=f.kode_bp3k
        left join(select kode_kec,count(id_kep) as jumkep from tb_kep GROUP BY kode_kec )g on a.kecamatan=g.kode_kec
        left join (select unit_kerja,count(id) as jumpns from tbldasar GROUP BY unit_kerja) h on a.id=h.unit_kerja and kode_kab='4' and status !='1' and status !='2' and status !='3'
        left join(select unit_kerja,count(id_swa) as jumswa from tbldasar_swa GROUP BY unit_kerja) i on a.id=i.unit_kerja
        left join(select tempat_tugas,count(id_swa) as jumswas from tbldasar_swasta GROUP BY tempat_tugas) l on a.kecamatan=l.tempat_tugas
        left join tblbpp_wil_kec j on a.kode_bp3k = j.kode_bp3k
        left join tbldati2 k on a.satminkal=k.id_dati2
        where a.kode_prop='$kode_prop' and a.kecamatan !='0'
        group by a.kecamatan
        ");
        $results   = $query->getResultArray();

        $data =  [
            'bpp' => $results
        ];

        return $data;
    }

    public function getRekapBPPExc($kode_prop)
    {
        $db = Database::connect();
        $query = $db->query("select * , a.id, a.email, a.roda_4_apbn, a.soil_apbn, a.soil_apbd, a.tgl_update, a.alamat, a.kode_bp3k, b.nama, c.deskripsi, f.jumgap,f.kode_bp3k,g.jumkep,d.jumpok,e.jumthl,h.jumpns,i.jumswa,k.nama_dati2,j.kecamatan,l.jumswas
        from tblbpp a
        left join tbldasar b on a.nama_koord_penyuluh=b.nip
        left join tbldaerah c on a.kecamatan=c.id_daerah  
        left join (select kode_bp3k, count(id_poktan) as jumpok from tb_poktan GROUP BY kode_bp3k)d on a.kode_bp3k=d.kode_bp3k
        left join(select unit_kerja,count(id_thl) as jumthl from tbldasar_thl GROUP BY unit_kerja) e on  a.id=e.unit_kerja
        left join(select kode_bp3k, count(id_gap) as jumgap from tb_gapoktan GROUP BY kode_bp3k)f on a.kode_bp3k=f.kode_bp3k
        left join(select kode_kec,count(id_kep) as jumkep from tb_kep GROUP BY kode_kec )g on a.kecamatan=g.kode_kec
        left join (select unit_kerja,count(id) as jumpns from tbldasar GROUP BY unit_kerja) h on a.id=h.unit_kerja and kode_kab='4' and status !='1' and status !='2' and status !='3'
        left join(select unit_kerja,count(id_swa) as jumswa from tbldasar_swa GROUP BY unit_kerja) i on a.id=i.unit_kerja
        left join(select tempat_tugas,count(id_swa) as jumswas from tbldasar_swasta GROUP BY tempat_tugas) l on a.kecamatan=l.tempat_tugas
        left join tblbpp_wil_kec j on a.kode_bp3k = j.kode_bp3k
        left join tbldati2 k on a.satminkal=k.id_dati2
        where a.kode_prop='$kode_prop' and a.kecamatan !='0'
        group by a.kecamatan
        ");
        $results   = $query->getResultArray();

        return $results;
    }
    // REKAP KELEMBAGAAN PELAKU UTAMA

    public function getKelPenerimaBantuanProv()
    {
        $db = Database::connect();
        $query  = $db->query("SELECT *,id_prop as kode_prop FROM tblpropinsi");
        $results = $query->getResultArray();
        $data =  [
            'rkpbprov' => $results,

        ];

        return $data;
    }
    public function getKelPenerimaBantuanKab($kode_prop)
    {
        $db = Database::connect();
        $query2 = $db->query("select nama_prop as nama_prop from tblpropinsi where id_prop= $kode_prop");
        $row  = $query2->getRow();

        $query  = $db->query("SELECT id_dati2, nama_dati2 FROM tbldati2  where id_prop = $kode_prop");
        $results = $query->getResultArray();
        $data =  [
            'rkpbkab' => $results,
            'nama_prop' => $row->nama_prop
        ];
        return $data;
    }
    public function getKelPenerimaBantuanKec($kode_kab)
    {
        $db = Database::connect();
        $query  = $db->query("select e.deskripsi, d.nm_desa, b.volume, b.id_poktan, b.kegiatan,b.tahun, c.desckeg, c.subitem, a.kode_kab, a.kode_kec, a.kode_desa, a.nama_poktan, a.ketua_poktan, a.alamat, a.kode_bp3k
        from tb_poktan a
        left join tb_bantuan b on a.id_poktan=b.id_poktan
        left join mast_kegiatan c on b.kegiatan=c.kegiatan
        left join tbldesa d on a.kode_desa=d.id_desa
        left join tbldaerah e on a.kode_kec=e.id_daerah
        where a.kode_kab LIKE '$kode_kab' and b.kegiatan !='' group by b.id_poktan");
        $results = $query->getResultArray();
        $data =  [
            'rkpbkec' => $results,

        ];
        return $data;
    }
    public function getKelPenerimaBantuanKegiatanProv()
    {
        $db = Database::connect();
        $query = $db->query("SELECT *,
        SUM(CASE WHEN kegiatan =11 THEN poke1 ELSE 0 END) AS   rjit,
        SUM(CASE WHEN kegiatan =12 THEN poke1 ELSE 0 END) AS rjitapbn,
        SUM(CASE WHEN kegiatan =13 THEN poke1 ELSE 0 END) AS jitut,
        SUM(CASE WHEN kegiatan =14 THEN poke1 ELSE 0 END) AS jides,
        SUM(CASE WHEN kegiatan =15 THEN poke1 ELSE 0 END) AS pji,
        SUM(CASE WHEN kegiatan =16 THEN poke1 ELSE 0 END) AS pji_baru,
        SUM(CASE WHEN kegiatan =17 THEN poke1 ELSE 0 END) AS psa,
        SUM(CASE WHEN kegiatan =18 THEN poke1 ELSE 0 END) AS embung,
        SUM(CASE WHEN kegiatan =21 THEN poke1 ELSE 0 END) AS opla,
        SUM(CASE WHEN kegiatan =22 THEN poke1 ELSE 0 END) AS cetak_sawah,
        SUM(CASE WHEN kegiatan =23 THEN poke1 ELSE 0 END) AS sri,
        SUM(CASE WHEN kegiatan =31 THEN poke1 ELSE 0 END) AS tr2,
        SUM(CASE WHEN kegiatan =32 THEN poke1 ELSE 0 END) AS tr4_hp,
        SUM(CASE WHEN kegiatan =33 THEN poke1 ELSE 0 END) AS tr4_90,
        SUM(CASE WHEN kegiatan =34 THEN poke1 ELSE 0 END) AS rice,
        SUM(CASE WHEN kegiatan =35 THEN poke1 ELSE 0 END) AS coper,
        SUM(CASE WHEN kegiatan =36 THEN poke1 ELSE 0 END) AS cultiv,
        SUM(CASE WHEN kegiatan =37 THEN poke1 ELSE 0 END) AS pompa,
        SUM(CASE WHEN kegiatan =61 THEN poke1 ELSE 0 END) AS puap,
        SUM(CASE WHEN kegiatan =71 THEN poke1 ELSE 0 END) AS slptt,
        SUM(CASE WHEN kegiatan =72 THEN poke1 ELSE 0 END) AS gpptt
        FROM (SELECT
           COUNT(tb_bantuan.id_poktan) AS poke1, `tb_bantuan`.`kegiatan`, `tblpropinsi`.`id_prop`
            , `tblpropinsi`.`nama_prop`, `tb_poktan`.`kode_prop`
        FROM
            `tb_bantuan`
            INNER JOIN `tb_poktan`  ON (`tb_bantuan`.`id_poktan` = `tb_poktan`.`id_poktan`)
            INNER JOIN `tblpropinsi` 
                ON (`tblpropinsi`.`id_prop` = `tb_poktan`.`kode_prop`)WHERE kegiatan>0 GROUP BY kegiatan,kode_prop
                ) t GROUP BY t.kode_prop;");
        $results  = $query->getResultArray();
        $data =  [
            'rkpbkprov' => $results,

        ];
        return $data;
    }

    public function getKelPenerimaBantuanKegiatanKab($kode_prop)
    {
        $db = Database::connect();
        $query = $db->query("SELECT *,
    SUM(CASE WHEN kegiatan =11 THEN poke1 ELSE 0 END) AS   rjit,
    SUM(CASE WHEN kegiatan =12 THEN poke1 ELSE 0 END) AS rjitapbn,
    SUM(CASE WHEN kegiatan =13 THEN poke1 ELSE 0 END) AS jitut,
    SUM(CASE WHEN kegiatan =14 THEN poke1 ELSE 0 END) AS jides,
    SUM(CASE WHEN kegiatan =15 THEN poke1 ELSE 0 END) AS pji,
    SUM(CASE WHEN kegiatan =16 THEN poke1 ELSE 0 END) AS pji_baru,
    SUM(CASE WHEN kegiatan =17 THEN poke1 ELSE 0 END) AS psa,
    SUM(CASE WHEN kegiatan =18 THEN poke1 ELSE 0 END) AS embung,
    SUM(CASE WHEN kegiatan =21 THEN poke1 ELSE 0 END) AS opla,
    SUM(CASE WHEN kegiatan =22 THEN poke1 ELSE 0 END) AS cetak_sawah,
    SUM(CASE WHEN kegiatan =23 THEN poke1 ELSE 0 END) AS sri,
    SUM(CASE WHEN kegiatan =31 THEN poke1 ELSE 0 END) AS tr2,
    SUM(CASE WHEN kegiatan =32 THEN poke1 ELSE 0 END) AS tr4_hp,
    SUM(CASE WHEN kegiatan =33 THEN poke1 ELSE 0 END) AS tr4_90,
    SUM(CASE WHEN kegiatan =34 THEN poke1 ELSE 0 END) AS rice,
    SUM(CASE WHEN kegiatan =35 THEN poke1 ELSE 0 END) AS coper,
    SUM(CASE WHEN kegiatan =36 THEN poke1 ELSE 0 END) AS cultiv,
    SUM(CASE WHEN kegiatan =37 THEN poke1 ELSE 0 END) AS pompa,
    SUM(CASE WHEN kegiatan =61 THEN poke1 ELSE 0 END) AS puap,
    SUM(CASE WHEN kegiatan =71 THEN poke1 ELSE 0 END) AS slptt,
    SUM(CASE WHEN kegiatan =72 THEN poke1 ELSE 0 END) AS gpptt
    FROM (SELECT
       COUNT(tb_bantuan.id_poktan) AS poke1, `tb_bantuan`.`kegiatan`, `tbldati2`.`id_dati2`
        , `tbldati2`.`nama_dati2`, `tb_poktan`.`kode_kab`
    FROM
        `tb_bantuan`
        INNER JOIN `tb_poktan`  ON (`tb_bantuan`.`id_poktan` = `tb_poktan`.`id_poktan`)
        INNER JOIN `tbldati2` 
            ON (`tbldati2`.`id_dati2` = `tb_poktan`.`kode_kab`)WHERE kegiatan>0 and kode_prop = $kode_prop GROUP BY kegiatan,kode_kab
            ) t GROUP BY t.kode_kab;");
        $results  = $query->getResultArray();
        $data =  [
            'rkpbkkab' => $results,

        ];
        return $data;
    }
    public function getKelPenerimaBantuanKegiatan11($kode_kab)
    {
        $db = Database::connect();
        $query  = $db->query("select e.deskripsi, d.nm_desa, b.volume, b.id_poktan, b.kegiatan,b.tahun, c.desckeg, c.subitem, a.kode_kab, a.kode_kec, a.kode_desa, a.nama_poktan, a.ketua_poktan, a.alamat, a.kode_bp3k
    from tb_poktan a
    left join tb_bantuan b on a.id_poktan=b.id_poktan
    left join mast_kegiatan c on b.kegiatan=c.kegiatan
    left join tbldesa d on a.kode_desa=d.id_desa
    left join tbldaerah e on a.kode_kec=e.id_daerah
    where a.kode_kab LIKE '$kode_kab' and b.kegiatan ='11' group by b.id_poktan");
        $results = $query->getResultArray();
        $data =  [
            'rkpbk11' => $results,

        ];
        return $data;
    }
    public function getKelPenerimaBantuanKegiatan12($kode_kab)
    {
        $db = Database::connect();
        $query  = $db->query("select e.deskripsi, d.nm_desa, b.volume, b.id_poktan, b.kegiatan,b.tahun, c.desckeg, c.subitem, a.kode_kab, a.kode_kec, a.kode_desa, a.nama_poktan, a.ketua_poktan, a.alamat, a.kode_bp3k
    from tb_poktan a
    left join tb_bantuan b on a.id_poktan=b.id_poktan
    left join mast_kegiatan c on b.kegiatan=c.kegiatan
    left join tbldesa d on a.kode_desa=d.id_desa
    left join tbldaerah e on a.kode_kec=e.id_daerah
    where a.kode_kab LIKE '$kode_kab' and b.kegiatan ='12' group by b.id_poktan");
        $results = $query->getResultArray();
        $data =  [
            'rkpbk12' => $results,

        ];
        return $data;
    }
    public function getKelPenerimaBantuanKegiatan13($kode_kab)
    {
        $db = Database::connect();
        $query  = $db->query("select e.deskripsi, d.nm_desa, b.volume, b.id_poktan, b.kegiatan,b.tahun, c.desckeg, c.subitem, a.kode_kab, a.kode_kec, a.kode_desa, a.nama_poktan, a.ketua_poktan, a.alamat, a.kode_bp3k
    from tb_poktan a
    left join tb_bantuan b on a.id_poktan=b.id_poktan
    left join mast_kegiatan c on b.kegiatan=c.kegiatan
    left join tbldesa d on a.kode_desa=d.id_desa
    left join tbldaerah e on a.kode_kec=e.id_daerah
    where a.kode_kab LIKE '$kode_kab' and b.kegiatan ='13' group by b.id_poktan");
        $results = $query->getResultArray();
        $data =  [
            'rkpbk13' => $results,

        ];
        return $data;
    }
    public function getKelPenerimaBantuanKegiatan14($kode_kab)
    {
        $db = Database::connect();
        $query  = $db->query("select e.deskripsi, d.nm_desa, b.volume, b.id_poktan, b.kegiatan,b.tahun, c.desckeg, c.subitem, a.kode_kab, a.kode_kec, a.kode_desa, a.nama_poktan, a.ketua_poktan, a.alamat, a.kode_bp3k
    from tb_poktan a
    left join tb_bantuan b on a.id_poktan=b.id_poktan
    left join mast_kegiatan c on b.kegiatan=c.kegiatan
    left join tbldesa d on a.kode_desa=d.id_desa
    left join tbldaerah e on a.kode_kec=e.id_daerah
    where a.kode_kab LIKE '$kode_kab' and b.kegiatan ='14' group by b.id_poktan");
        $results = $query->getResultArray();
        $data =  [
            'rkpbk14' => $results,

        ];
        return $data;
    }
    public function getKelPenerimaBantuanKegiatan15($kode_kab)
    {
        $db = Database::connect();
        $query  = $db->query("select e.deskripsi, d.nm_desa, b.volume, b.id_poktan, b.kegiatan,b.tahun, c.desckeg, c.subitem, a.kode_kab, a.kode_kec, a.kode_desa, a.nama_poktan, a.ketua_poktan, a.alamat, a.kode_bp3k
    from tb_poktan a
    left join tb_bantuan b on a.id_poktan=b.id_poktan
    left join mast_kegiatan c on b.kegiatan=c.kegiatan
    left join tbldesa d on a.kode_desa=d.id_desa
    left join tbldaerah e on a.kode_kec=e.id_daerah
    where a.kode_kab LIKE '$kode_kab' and b.kegiatan ='15' group by b.id_poktan");
        $results = $query->getResultArray();
        $data =  [
            'rkpbk15' => $results,

        ];
        return $data;
    }
    public function getKelPenerimaBantuanKegiatan16($kode_kab)
    {
        $db = Database::connect();
        $query  = $db->query("select e.deskripsi, d.nm_desa, b.volume, b.id_poktan, b.kegiatan,b.tahun, c.desckeg, c.subitem, a.kode_kab, a.kode_kec, a.kode_desa, a.nama_poktan, a.ketua_poktan, a.alamat, a.kode_bp3k
    from tb_poktan a
    left join tb_bantuan b on a.id_poktan=b.id_poktan
    left join mast_kegiatan c on b.kegiatan=c.kegiatan
    left join tbldesa d on a.kode_desa=d.id_desa
    left join tbldaerah e on a.kode_kec=e.id_daerah
    where a.kode_kab LIKE '$kode_kab' and b.kegiatan ='16' group by b.id_poktan");
        $results = $query->getResultArray();
        $data =  [
            'rkpbk16' => $results,

        ];
        return $data;
    }
    public function getKelPenerimaBantuanKegiatan17($kode_kab)
    {
        $db = Database::connect();
        $query  = $db->query("select e.deskripsi, d.nm_desa, b.volume, b.id_poktan, b.kegiatan,b.tahun, c.desckeg, c.subitem, a.kode_kab, a.kode_kec, a.kode_desa, a.nama_poktan, a.ketua_poktan, a.alamat, a.kode_bp3k
    from tb_poktan a
    left join tb_bantuan b on a.id_poktan=b.id_poktan
    left join mast_kegiatan c on b.kegiatan=c.kegiatan
    left join tbldesa d on a.kode_desa=d.id_desa
    left join tbldaerah e on a.kode_kec=e.id_daerah
    where a.kode_kab LIKE '$kode_kab' and b.kegiatan ='17' group by b.id_poktan");
        $results = $query->getResultArray();
        $data =  [
            'rkpbk17' => $results,

        ];
        return $data;
    }
    public function getKelPenerimaBantuanKegiatan18($kode_kab)
    {
        $db = Database::connect();
        $query  = $db->query("select e.deskripsi, d.nm_desa, b.volume, b.id_poktan, b.kegiatan,b.tahun, c.desckeg, c.subitem, a.kode_kab, a.kode_kec, a.kode_desa, a.nama_poktan, a.ketua_poktan, a.alamat, a.kode_bp3k
    from tb_poktan a
    left join tb_bantuan b on a.id_poktan=b.id_poktan
    left join mast_kegiatan c on b.kegiatan=c.kegiatan
    left join tbldesa d on a.kode_desa=d.id_desa
    left join tbldaerah e on a.kode_kec=e.id_daerah
    where a.kode_kab LIKE '$kode_kab' and b.kegiatan ='18' group by b.id_poktan");
        $results = $query->getResultArray();
        $data =  [
            'rkpbk18' => $results,

        ];
        return $data;
    }
    public function getKelPenerimaBantuanKegiatan21($kode_kab)
    {
        $db = Database::connect();
        $query  = $db->query("select e.deskripsi, d.nm_desa, b.volume, b.id_poktan, b.kegiatan,b.tahun, c.desckeg, c.subitem, a.kode_kab, a.kode_kec, a.kode_desa, a.nama_poktan, a.ketua_poktan, a.alamat, a.kode_bp3k
    from tb_poktan a
    left join tb_bantuan b on a.id_poktan=b.id_poktan
    left join mast_kegiatan c on b.kegiatan=c.kegiatan
    left join tbldesa d on a.kode_desa=d.id_desa
    left join tbldaerah e on a.kode_kec=e.id_daerah
    where a.kode_kab LIKE '$kode_kab' and b.kegiatan ='21' group by b.id_poktan");
        $results = $query->getResultArray();
        $data =  [
            'rkpbk21' => $results,

        ];
        return $data;
    }
    public function getKelPenerimaBantuanKegiatan22($kode_kab)
    {
        $db = Database::connect();
        $query  = $db->query("select e.deskripsi, d.nm_desa, b.volume, b.id_poktan, b.kegiatan,b.tahun, c.desckeg, c.subitem, a.kode_kab, a.kode_kec, a.kode_desa, a.nama_poktan, a.ketua_poktan, a.alamat, a.kode_bp3k
    from tb_poktan a
    left join tb_bantuan b on a.id_poktan=b.id_poktan
    left join mast_kegiatan c on b.kegiatan=c.kegiatan
    left join tbldesa d on a.kode_desa=d.id_desa
    left join tbldaerah e on a.kode_kec=e.id_daerah
    where a.kode_kab LIKE '$kode_kab' and b.kegiatan ='22' group by b.id_poktan");
        $results = $query->getResultArray();
        $data =  [
            'rkpbk22' => $results,

        ];
        return $data;
    }
    public function getKelPenerimaBantuanKegiatan23($kode_kab)
    {
        $db = Database::connect();
        $query  = $db->query("select e.deskripsi, d.nm_desa, b.volume, b.id_poktan, b.kegiatan,b.tahun, c.desckeg, c.subitem, a.kode_kab, a.kode_kec, a.kode_desa, a.nama_poktan, a.ketua_poktan, a.alamat, a.kode_bp3k
    from tb_poktan a
    left join tb_bantuan b on a.id_poktan=b.id_poktan
    left join mast_kegiatan c on b.kegiatan=c.kegiatan
    left join tbldesa d on a.kode_desa=d.id_desa
    left join tbldaerah e on a.kode_kec=e.id_daerah
    where a.kode_kab LIKE '$kode_kab' and b.kegiatan ='23' group by b.id_poktan");
        $results = $query->getResultArray();
        $data =  [
            'rkpbk23' => $results,

        ];
        return $data;
    }
    public function getKelPenerimaBantuanKegiatan31($kode_kab)
    {
        $db = Database::connect();
        $query  = $db->query("select e.deskripsi, d.nm_desa, b.volume, b.id_poktan, b.kegiatan,b.tahun, c.desckeg, c.subitem, a.kode_kab, a.kode_kec, a.kode_desa, a.nama_poktan, a.ketua_poktan, a.alamat, a.kode_bp3k
    from tb_poktan a
    left join tb_bantuan b on a.id_poktan=b.id_poktan
    left join mast_kegiatan c on b.kegiatan=c.kegiatan
    left join tbldesa d on a.kode_desa=d.id_desa
    left join tbldaerah e on a.kode_kec=e.id_daerah
    where a.kode_kab LIKE '$kode_kab' and b.kegiatan ='31' group by b.id_poktan");
        $results = $query->getResultArray();
        $data =  [
            'rkpbk31' => $results,

        ];
        return $data;
    }
    public function getKelPenerimaBantuanKegiatan32($kode_kab)
    {
        $db = Database::connect();
        $query  = $db->query("select e.deskripsi, d.nm_desa, b.volume, b.id_poktan, b.kegiatan,b.tahun, c.desckeg, c.subitem, a.kode_kab, a.kode_kec, a.kode_desa, a.nama_poktan, a.ketua_poktan, a.alamat, a.kode_bp3k
    from tb_poktan a
    left join tb_bantuan b on a.id_poktan=b.id_poktan
    left join mast_kegiatan c on b.kegiatan=c.kegiatan
    left join tbldesa d on a.kode_desa=d.id_desa
    left join tbldaerah e on a.kode_kec=e.id_daerah
    where a.kode_kab LIKE '$kode_kab' and b.kegiatan ='32' group by b.id_poktan");
        $results = $query->getResultArray();
        $data =  [
            'rkpbk32' => $results,

        ];
        return $data;
    }
    public function getKelPenerimaBantuanKegiatan33($kode_kab)
    {
        $db = Database::connect();
        $query  = $db->query("select e.deskripsi, d.nm_desa, b.volume, b.id_poktan, b.kegiatan,b.tahun, c.desckeg, c.subitem, a.kode_kab, a.kode_kec, a.kode_desa, a.nama_poktan, a.ketua_poktan, a.alamat, a.kode_bp3k
    from tb_poktan a
    left join tb_bantuan b on a.id_poktan=b.id_poktan
    left join mast_kegiatan c on b.kegiatan=c.kegiatan
    left join tbldesa d on a.kode_desa=d.id_desa
    left join tbldaerah e on a.kode_kec=e.id_daerah
    where a.kode_kab LIKE '$kode_kab' and b.kegiatan ='33' group by b.id_poktan");
        $results = $query->getResultArray();
        $data =  [
            'rkpbk33' => $results,

        ];
        return $data;
    }
    public function getKelPenerimaBantuanKegiatan34($kode_kab)
    {
        $db = Database::connect();
        $query  = $db->query("select e.deskripsi, d.nm_desa, b.volume, b.id_poktan, b.kegiatan,b.tahun, c.desckeg, c.subitem, a.kode_kab, a.kode_kec, a.kode_desa, a.nama_poktan, a.ketua_poktan, a.alamat, a.kode_bp3k
    from tb_poktan a
    left join tb_bantuan b on a.id_poktan=b.id_poktan
    left join mast_kegiatan c on b.kegiatan=c.kegiatan
    left join tbldesa d on a.kode_desa=d.id_desa
    left join tbldaerah e on a.kode_kec=e.id_daerah
    where a.kode_kab LIKE '$kode_kab' and b.kegiatan ='34' group by b.id_poktan");
        $results = $query->getResultArray();
        $data =  [
            'rkpbk34' => $results,

        ];
        return $data;
    }
    public function getKelPenerimaBantuanKegiatan35($kode_kab)
    {
        $db = Database::connect();
        $query  = $db->query("select e.deskripsi, d.nm_desa, b.volume, b.id_poktan, b.kegiatan,b.tahun, c.desckeg, c.subitem, a.kode_kab, a.kode_kec, a.kode_desa, a.nama_poktan, a.ketua_poktan, a.alamat, a.kode_bp3k
    from tb_poktan a
    left join tb_bantuan b on a.id_poktan=b.id_poktan
    left join mast_kegiatan c on b.kegiatan=c.kegiatan
    left join tbldesa d on a.kode_desa=d.id_desa
    left join tbldaerah e on a.kode_kec=e.id_daerah
    where a.kode_kab LIKE '$kode_kab' and b.kegiatan ='35' group by b.id_poktan");
        $results = $query->getResultArray();
        $data =  [
            'rkpbk35' => $results,

        ];
        return $data;
    }
    public function getKelPenerimaBantuanKegiatan36($kode_kab)
    {
        $db = Database::connect();
        $query  = $db->query("select e.deskripsi, d.nm_desa, b.volume, b.id_poktan, b.kegiatan,b.tahun, c.desckeg, c.subitem, a.kode_kab, a.kode_kec, a.kode_desa, a.nama_poktan, a.ketua_poktan, a.alamat, a.kode_bp3k
    from tb_poktan a
    left join tb_bantuan b on a.id_poktan=b.id_poktan
    left join mast_kegiatan c on b.kegiatan=c.kegiatan
    left join tbldesa d on a.kode_desa=d.id_desa
    left join tbldaerah e on a.kode_kec=e.id_daerah
    where a.kode_kab LIKE '$kode_kab' and b.kegiatan ='36' group by b.id_poktan");
        $results = $query->getResultArray();
        $data =  [
            'rkpbk36' => $results,

        ];
        return $data;
    }
    public function getKelPenerimaBantuanKegiatan37($kode_kab)
    {
        $db = Database::connect();
        $query  = $db->query("select e.deskripsi, d.nm_desa, b.volume, b.id_poktan, b.kegiatan,b.tahun, c.desckeg, c.subitem, a.kode_kab, a.kode_kec, a.kode_desa, a.nama_poktan, a.ketua_poktan, a.alamat, a.kode_bp3k
    from tb_poktan a
    left join tb_bantuan b on a.id_poktan=b.id_poktan
    left join mast_kegiatan c on b.kegiatan=c.kegiatan
    left join tbldesa d on a.kode_desa=d.id_desa
    left join tbldaerah e on a.kode_kec=e.id_daerah
    where a.kode_kab LIKE '$kode_kab' and b.kegiatan ='37' group by b.id_poktan");
        $results = $query->getResultArray();
        $data =  [
            'rkpbk37' => $results,

        ];
        return $data;
    }
    public function getKelPenerimaBantuanKegiatan61($kode_kab)
    {
        $db = Database::connect();
        $query  = $db->query("select e.deskripsi, d.nm_desa, b.volume, b.id_poktan, b.kegiatan,b.tahun, c.desckeg, c.subitem, a.kode_kab, a.kode_kec, a.kode_desa, a.nama_poktan, a.ketua_poktan, a.alamat, a.kode_bp3k
    from tb_poktan a
    left join tb_bantuan b on a.id_poktan=b.id_poktan
    left join mast_kegiatan c on b.kegiatan=c.kegiatan
    left join tbldesa d on a.kode_desa=d.id_desa
    left join tbldaerah e on a.kode_kec=e.id_daerah
    where a.kode_kab LIKE '$kode_kab' and b.kegiatan ='61' group by b.id_poktan");
        $results = $query->getResultArray();
        $data =  [
            'rkpbk61' => $results,

        ];
        return $data;
    }
    public function getKelPenerimaBantuanKegiatan71($kode_kab)
    {
        $db = Database::connect();
        $query  = $db->query("select e.deskripsi, d.nm_desa, b.volume, b.id_poktan, b.kegiatan,b.tahun, c.desckeg, c.subitem, a.kode_kab, a.kode_kec, a.kode_desa, a.nama_poktan, a.ketua_poktan, a.alamat, a.kode_bp3k
    from tb_poktan a
    left join tb_bantuan b on a.id_poktan=b.id_poktan
    left join mast_kegiatan c on b.kegiatan=c.kegiatan
    left join tbldesa d on a.kode_desa=d.id_desa
    left join tbldaerah e on a.kode_kec=e.id_daerah
    where a.kode_kab LIKE '$kode_kab' and b.kegiatan ='71' group by b.id_poktan");
        $results = $query->getResultArray();
        $data =  [
            'rkpbk71' => $results,

        ];
        return $data;
    }
    public function getKelPenerimaBantuanKegiatan72($kode_kab)
    {
        $db = Database::connect();
        $query  = $db->query("select e.deskripsi, d.nm_desa, b.volume, b.id_poktan, b.kegiatan,b.tahun, c.desckeg, c.subitem, a.kode_kab, a.kode_kec, a.kode_desa, a.nama_poktan, a.ketua_poktan, a.alamat, a.kode_bp3k
    from tb_poktan a
    left join tb_bantuan b on a.id_poktan=b.id_poktan
    left join mast_kegiatan c on b.kegiatan=c.kegiatan
    left join tbldesa d on a.kode_desa=d.id_desa
    left join tbldaerah e on a.kode_kec=e.id_daerah
    where a.kode_kab LIKE '$kode_kab' and b.kegiatan ='72' group by b.id_poktan");
        $results = $query->getResultArray();
        $data =  [
            'rkpbk72' => $results,

        ];
        return $data;
    }

    public function getRekKelembagaanPelakuUtamaProv()
    {
        $db = Database::connect();
        $query  = $db->query("select a.id_prop, a.nama_prop as nama_prop , b.kode_prop, b.pns, c.pnsTB, d.thl_apbn 
    from tblpropinsi a 
    left join (select kode_prop, count(id_poktan) as pns from tb_poktan group by kode_prop) b on a.id_prop = b.kode_prop 
    left join (select kode_prop, count(id_gap) as pnsTB from tb_gapoktan group by kode_prop) c on a.id_prop = c.kode_prop 
    left join (select kode_prop, count(id_kep) as thl_apbn from tb_kep group by kode_prop) d on a.id_prop = d.kode_prop 
    order by nama_prop asc");
        $results = $query->getResultArray();
        $data =  [
            'rkpuprov' => $results,

        ];

        return $data;
    }

    public function getRekKelembagaanPelakuUtamaKab($kode_prop)
    {
        $db = Database::connect();
        $query = $db->query("select a.id_dati2, a.nama_dati2 as nama_kab , b.kode_kab, b.pns, c.pnsTB, d.thl_apbn 
        from tbldati2 a 
        left join (select kode_kab, count(id_poktan) as pns from tb_poktan group by kode_kab) b on a.id_dati2 = b.kode_kab 
        left join (select kode_kab, count(id_gap) as pnsTB from tb_gapoktan group by kode_kab) c on a.id_dati2 = c.kode_kab 
        left join (select kode_kab, count(id_kep) as thl_apbn from tb_kep group by kode_kab) d on a.id_dati2 = d.kode_kab 
        where id_prop = $kode_prop
        order by nama_kab asc");
        $results  = $query->getResultArray();
        $data =  [
            'rkpukab' => $results,

        ];
        return $data;
    }
    public function getRekKelembagaanPelakuUtamaKec($kode_kab)
    {
        $db = Database::connect();
        $query2 = $db->query("select count(id_poktan) as nomap from tb_poktan where kode_kab='kode_prop' and kode_bp3k='' or kode_kab='kode_prop' and kode_bp3k IS NULL");
        $row2  = $query2->getRow();
        $query3 = $db->query("select count(id_gap) as nomap_gap from tb_gapoktan where kode_kab='kode_prop' and kode_bp3k='' or kode_kab='kode_prop' and kode_bp3k IS NULL");
        $row3  = $query3->getRow();
        $query4 = $db->query("select count(id_kep) as nomap_kep from tb_kep where kode_kab='kode_prop' and kode_bp3k='' or kode_kab='kode_prop' and kode_bp3k IS NULL");
        $row4  = $query4->getRow();
        $query = $db->query("select a.id, a.nama_bpp as nama_bpp , b.kode_kec, b.pns, c.pnsTB, d.thl_apbn 
        from tblbpp a 
        left join (select kode_kec, count(id_poktan) as pns from tb_poktan group by kode_kec) b on a.kecamatan = b.kode_kec 
        left join (select kode_kec, count(id_gap) as pnsTB from tb_gapoktan group by kode_kec) c on a.kecamatan = c.kode_kec 
        left join (select kode_kec, count(id_kep) as thl_apbn from tb_kep group by kode_kec) d on a.kecamatan = d.kode_kec 
        where satminkal = $kode_kab
        order by nama_bpp asc");
        $results  = $query->getResultArray();
        $data =  [
            'rkpukec' => $results,
            'nomap' => $row2->nomap,
            'nomap_gap' => $row3->nomap_gap,
            'nomap_kep' => $row4->nomap_kep,
        ];
        return $data;
    }
    public function getRekKelembagaanEkonomiPetaniProv()
    {
        $db = Database::connect();
        $query  = $db->query("select *, ifnull(b.thl_apbn,0) as thl_apbn, ifnull(c.kop,0) as kop,ifnull(d.pt,0) as pt,ifnull(e.cv,0) as cv,ifnull(f.kub,0) as kub,ifnull(g.lkma,0) as lkma,ifnull(h.lain,0) as lain,ifnull(i.map,0) as map
        from tblpropinsi a 
        left join (select kode_prop, count(id_kep) as thl_apbn from tb_kep group by kode_prop) b on a.id_prop=b.kode_prop
        left join (select kode_prop, count(id_kep) as kop from tb_kep where jenis_kep='kop' group by kode_prop) c on a.id_prop=c.kode_prop
        left join (select kode_prop, count(id_kep) as pt from tb_kep where jenis_kep='pt' group by kode_prop) d on a.id_prop=d.kode_prop
        left join (select kode_prop, count(id_kep) as cv from tb_kep where jenis_kep='cv' group by kode_prop) e on a.id_prop=e.kode_prop
        left join (select kode_prop, count(id_kep) as kub from tb_kep where jenis_kep='kub' group by kode_prop) f on a.id_prop=f.kode_prop
        left join (select kode_prop, count(id_kep) as lkma from tb_kep where jenis_kep='lkma' group by kode_prop) g on a.id_prop=g.kode_prop
        left join (select kode_prop, count(id_kep) as lain from tb_kep where jenis_kep='lain' group by kode_prop) h on a.id_prop=h.kode_prop
        left join (select kode_prop, count(id_kep) as map from tb_kep where jenis_kep='' group by kode_prop) i on a.id_prop=i.kode_prop
        order by nama_prop asc");
        $results = $query->getResultArray();
        $data =  [
            'rkepprov' => $results,

        ];

        return $data;
    }
    public function getRekKelembagaanEkonomiPetaniKab($kode_prop)
    {
        $db = Database::connect();
        $query  = $db->query("select *, ifnull(b.thl_apbn,0) as thl_apbn, ifnull(c.kop,0) as kop,ifnull(d.pt,0) as pt,ifnull(e.cv,0) as cv,ifnull(f.kub,0) as kub,ifnull(g.lkma,0) as lkma,ifnull(h.lain,0) as lain,ifnull(i.map,0) as map
        from tbldati2 a 
        left join (select kode_kab, count(id_kep) as thl_apbn from tb_kep group by kode_kab) b on a.id_dati2=b.kode_kab
        left join (select kode_kab, count(id_kep) as kop from tb_kep where jenis_kep='kop' group by kode_kab) c on a.id_dati2=c.kode_kab
        left join (select kode_kab, count(id_kep) as pt from tb_kep where jenis_kep='pt' group by kode_kab) d on a.id_dati2=d.kode_kab
        left join (select kode_kab, count(id_kep) as cv from tb_kep where jenis_kep='cv' group by kode_kab) e on a.id_dati2=e.kode_kab
        left join (select kode_kab, count(id_kep) as kub from tb_kep where jenis_kep='kub' group by kode_kab) f on a.id_dati2=f.kode_kab
        left join (select kode_kab, count(id_kep) as lkma from tb_kep where jenis_kep='lkma' group by kode_kab) g on a.id_dati2=g.kode_kab
        left join (select kode_kab, count(id_kep) as lain from tb_kep where jenis_kep='lain' group by kode_kab) h on a.id_dati2=h.kode_kab
        left join (select kode_kab, count(id_kep) as map from tb_kep where jenis_kep='' group by kode_kab) i on a.id_dati2=i.kode_kab
        where id_prop = $kode_prop
        order by nama_dati2 asc");
        $results = $query->getResultArray();
        $data =  [
            'rkepkab' => $results,

        ];

        return $data;
    }
    public function getRekKelembagaanEkonomiPetaniKec($kode_kab)
    {
        $db = Database::connect();
        $query  = $db->query("select *, ifnull(b.thl_apbn,0) as thl_apbn, ifnull(c.kop,0) as kop,ifnull(d.pt,0) as pt,ifnull(e.cv,0) as cv,ifnull(f.kub,0) as kub,ifnull(g.lkma,0) as lkma,ifnull(h.lain,0) as lain,ifnull(i.map,0) as map
        from tbldaerah a 
        left join (select kode_kec, count(id_kep) as thl_apbn from tb_kep group by kode_kec) b on a.id_daerah=b.kode_kec
        left join (select kode_kec, count(id_kep) as kop from tb_kep where jenis_kep='kop' group by kode_kec) c on a.id_daerah=c.kode_kec
        left join (select kode_kec, count(id_kep) as pt from tb_kep where jenis_kep='pt' group by kode_kec) d on a.id_daerah=d.kode_kec
        left join (select kode_kec, count(id_kep) as cv from tb_kep where jenis_kep='cv' group by kode_kec) e on a.id_daerah=e.kode_kec
        left join (select kode_kec, count(id_kep) as kub from tb_kep where jenis_kep='kub' group by kode_kec) f on a.id_daerah=f.kode_kec
        left join (select kode_kec, count(id_kep) as lkma from tb_kep where jenis_kep='lkma' group by kode_kec) g on a.id_daerah=g.kode_kec
        left join (select kode_kec, count(id_kep) as lain from tb_kep where jenis_kep='lain' group by kode_kec) h on a.id_daerah=h.kode_kec
        left join (select kode_kec, count(id_kep) as map from tb_kep where jenis_kep='' group by kode_kec) i on a.id_daerah=i.kode_kec
        where id_dati2 = $kode_kab
        order by deskripsi asc");
        $results = $query->getResultArray();
        $data =  [
            'rkepkec' => $results,

        ];

        return $data;
    }

    public function getRekapPoktanPenerimaBantuanProv()
    {
        $db = Database::connect();
        $query  = $db->query("SELECT a.*,a.id_prop as kode_prop,b.jumpoktan,c.jum_menerima
        FROM `tblpropinsi` AS a
        LEFT JOIN
            (SELECT kode_prop,id_poktan,COUNT(id_poktan) AS jumpoktan FROM `tb_poktan` 
            GROUP BY kode_prop) AS b
            ON a.id_prop = b.kode_prop
                
        LEFT JOIN
            (SELECT kode_prop,COUNT( `tb_poktan`.`id_poktan`) AS jum_menerima
        FROM   `tb_poktan` INNER JOIN `tb_bantuan` 
         ON (`tb_poktan`.`id_poktan` = `tb_bantuan`.`id_poktan`) GROUP BY tb_poktan.`kode_prop`
            ) AS c
            ON b.kode_prop = c.kode_prop GROUP BY id_prop");
        $results = $query->getResultArray();
        $data =  [
            'rkpbprov' => $results,

        ];

        return $data;
    }
    public function getRekapPoktanPenerimaBantuanKab($kode_prop)
    {
        $db = Database::connect();
        $query  = $db->query("SELECT a.*,a.id_dati2 as kode_kab,b.jumpoktan,c.jum_menerima
        FROM `tbldati2` AS a
        LEFT JOIN (SELECT kode_kab,id_poktan,COUNT(id_poktan) AS jumpoktan FROM `tb_poktan` GROUP BY kode_kab) AS b ON a.id_dati2 = b.kode_kab
        LEFT JOIN (SELECT kode_kab,COUNT( `tb_poktan`.`id_poktan`) AS jum_menerima FROM   `tb_poktan` INNER JOIN `tb_bantuan` ON (`tb_poktan`.`id_poktan` = `tb_bantuan`.`id_poktan`) GROUP BY tb_poktan.`kode_kab` ) AS c ON b.kode_kab = c.kode_kab 
        where a.id_prop = $kode_prop ORDER BY nama_dati2 ");
        $results = $query->getResultArray();
        $data =  [
            'rkpbkab' => $results,
        ];
        return $data;
    }
    public function getRekapPoktanPenerimaBantuanKec($kode_kab)
    {
        $db = Database::connect();
        $query  = $db->query("SELECT a.*,b.jumpoktan,c.jum_menerima
        FROM `tbldaerah` AS a
        LEFT JOIN (SELECT kode_kec,id_poktan,COUNT(id_poktan) AS jumpoktan FROM `tb_poktan` GROUP BY kode_kec) AS b ON a.id_dati2 = b.kode_kec
        LEFT JOIN (SELECT kode_kec,COUNT( `tb_poktan`.`id_poktan`) AS jum_menerima FROM   `tb_poktan` INNER JOIN `tb_bantuan` ON (`tb_poktan`.`id_poktan` = `tb_bantuan`.`id_poktan`) GROUP BY tb_poktan.`kode_kec` ) AS c ON b.kode_kec = c.kode_kec 
        where a.id_dati2 = $kode_kab ORDER BY deskripsi ");
        $results = $query->getResultArray();
        $data =  [
            'rkpbkec' => $results,
        ];
        return $data;
    }




    public function getRekapPoktanGenLuh()
    {
        $db = Database::connect();
        $sql = "select *, a.jumlah_poktan as jumpoktan, a.anggota_laki as jum_laki, a.anggota_perempuan as jum_pr, 
        a.anggota_xjenkel as jum_kosong, a.total_jum_anggota as jum_total, a.jum_anggota_nik as jum_nik, a.updated, b.nama_prop
                from rekap_anggota_poktan a 
                left join tblpropinsi b on a.propinsi=b.id_prop
                order by b.nama_prop";
        // dd($sql);
        $query = $db->query($sql);
        $results   = $query->getResultArray();

        $data =  [
            'rgluh' => $results,
        ];

        return $data;
    }

    public function getPoktanGenProv()
    {
        $db = Database::connect();
        $sql = "select *, id_prop as kode_prop from tblpropinsi where id_prop";
        // dd($sql);
        $query = $db->query($sql);
        $results   = $query->getResultArray();

        $data =  [
            'rgprov' => $results,
        ];

        return $data;
    }

    public function getPoktanGenProvDetail($kode_prop)
    {
        $db = Database::connect();
        $query  = $db->query("SELECT a.id_dati2, a.nama_dati2 as nama_kab, b.kode_kab, j.jumpoktan, b.jum_laki, c.jum_pr, d.jum_kosong, e.jum_total,
        f.jum_nik, g.jum_nik_kurang, h.jum_nik_diantara, i.jum_nik_lebih
        FROM tbldati2 a
        LEFT JOIN (SELECT kode_kab, COUNT(id_poktan) AS jumpoktan FROM tb_poktan group by kode_kab) j
        ON a.id_dati2=j.kode_kab 
        LEFT JOIN (SELECT kode_kab, COUNT(id_anggota) AS jum_laki FROM tb_poktan_anggota WHERE jenis_kelamin='laki' group by kode_kab) b
        ON a.id_dati2=b.kode_kab 
        LEFT JOIN (SELECT kode_kab, COUNT(id_anggota) AS jum_pr FROM tb_poktan_anggota WHERE jenis_kelamin='perempuan' group by kode_kab) c
        ON a.id_dati2=c.kode_kab
        LEFT JOIN (SELECT kode_kab, COUNT(id_anggota) AS jum_kosong FROM tb_poktan_anggota WHERE jenis_kelamin='' group by kode_kab) d
        ON a.id_dati2=d.kode_kab
        LEFT JOIN (SELECT kode_kab, COUNT(id_anggota) AS jum_total FROM tb_poktan_anggota group by kode_kab) e
        ON a.id_dati2=e.kode_kab
        LEFT JOIN (SELECT kode_kab, COUNT(id_anggota) AS jum_nik FROM tb_poktan_anggota WHERE no_ktp !='' group by kode_kab) f
        ON a.id_dati2=f.kode_kab
        LEFT JOIN (SELECT kode_kab, COUNT(id_anggota) AS jum_nik_kurang FROM tb_poktan_anggota WHERE luas_lahan_ternak_dimiliki <'1.00' group by kode_kab) g
        ON a.id_dati2=g.kode_kab
        LEFT JOIN (SELECT kode_kab, COUNT(id_anggota) AS jum_nik_diantara FROM tb_poktan_anggota WHERE luas_lahan_ternak_dimiliki between '1.00'  and '2.00' group by kode_kab) h
        ON a.id_dati2=h.kode_kab
        LEFT JOIN (SELECT kode_kab, COUNT(id_anggota) AS jum_nik_lebih FROM tb_poktan_anggota  WHERE luas_lahan_ternak_dimiliki >'2.00' group by kode_kab) i
        ON a.id_dati2=i.kode_kab
        where a.id_prop=$kode_prop order by nama_kab asc");
        $results = $query->getResultArray();

        $data =  [
            'rgprovdetail' => $results
        ];

        return $data;
    }

    public function getPoktanGenProvDetailKec($kode_kab)
    {
        $db = Database::connect();
        $query  = $db->query("SELECT a.id_daerah, a.deskripsi, b.kode_kec, j.thl_apbd, b.jum_laki, c.jum_pr, d.jum_kosong, e.jum_total,
        f.jum_nik, g.jum_nik_kurang, h.jum_nik_diantara, i.jum_nik_lebih
        FROM tbldaerah a
        LEFT JOIN (SELECT kode_kec, COUNT(id_poktan) AS thl_apbd FROM tb_poktan group by kode_kec) j
        ON a.id_daerah=j.kode_kec 
        LEFT JOIN (SELECT kode_kec, COUNT(id_anggota) AS jum_laki FROM tb_poktan_anggota WHERE jenis_kelamin='laki' group by kode_kec) b
        ON a.id_daerah=b.kode_kec 
        LEFT JOIN (SELECT kode_kec, COUNT(id_anggota) AS jum_pr FROM tb_poktan_anggota WHERE jenis_kelamin='perempuan' group by kode_kec) c
        ON a.id_daerah=c.kode_kec
        LEFT JOIN (SELECT kode_kec, COUNT(id_anggota) AS jum_kosong FROM tb_poktan_anggota WHERE jenis_kelamin='' group by kode_kec) d
        ON a.id_daerah=d.kode_kec
        LEFT JOIN (SELECT kode_kec, COUNT(id_anggota) AS jum_total FROM tb_poktan_anggota group by kode_kec) e
        ON a.id_daerah=e.kode_kec
        LEFT JOIN (SELECT kode_kec, COUNT(id_anggota) AS jum_nik FROM tb_poktan_anggota WHERE no_ktp !='' group by kode_kec) f
        ON a.id_daerah=f.kode_kec
        LEFT JOIN (SELECT kode_kec, COUNT(id_anggota) AS jum_nik_kurang FROM tb_poktan_anggota WHERE luas_lahan_ternak_dimiliki <'1.00' group by kode_kec) g
        ON a.id_daerah=g.kode_kec
        LEFT JOIN (SELECT kode_kec, COUNT(id_anggota) AS jum_nik_diantara FROM tb_poktan_anggota WHERE luas_lahan_ternak_dimiliki between '1.00'  and '2.00' group by kode_kec) h
        ON a.id_daerah=h.kode_kec
        LEFT JOIN (SELECT kode_kec, COUNT(id_anggota) AS jum_nik_lebih FROM tb_poktan_anggota  WHERE luas_lahan_ternak_dimiliki >'2.00' group by kode_kec) i
        ON a.id_daerah=i.kode_kec
        where id_dati2 = $kode_kab
        order by deskripsi asc");
        $results = $query->getResultArray();

        $data =  [
            'rgprovdetailkec' => $results
        ];

        return $data;
    }

    public function getPoktanGenProvDetailDesa($kode_kec)
    {
        $db = Database::connect();
        $query  = $db->query("SELECT a.id_desa, a.nm_desa, b.kode_desa, j.thl_apbd, b.jum_laki, c.jum_pr, d.jum_kosong, e.jum_total,
        f.jum_nik, g.jum_nik_kurang, h.jum_nik_diantara, i.jum_nik_lebih
        FROM tbldesa a
        LEFT JOIN (SELECT kode_desa, COUNT(id_poktan) AS thl_apbd FROM tb_poktan group by kode_desa) j
        ON a.id_desa=j.kode_desa 
        LEFT JOIN (SELECT kode_desa, COUNT(id_anggota) AS jum_laki FROM tb_poktan_anggota WHERE jenis_kelamin='laki' group by kode_desa) b
        ON a.id_desa=b.kode_desa 
        LEFT JOIN (SELECT kode_desa, COUNT(id_anggota) AS jum_pr FROM tb_poktan_anggota WHERE jenis_kelamin='perempuan' group by kode_desa) c
        ON a.id_desa=c.kode_desa
        LEFT JOIN (SELECT kode_desa, COUNT(id_anggota) AS jum_kosong FROM tb_poktan_anggota WHERE jenis_kelamin='' group by kode_desa) d
        ON a.id_desa=d.kode_desa
        LEFT JOIN (SELECT kode_desa, COUNT(id_anggota) AS jum_total FROM tb_poktan_anggota group by kode_desa) e
        ON a.id_desa=e.kode_desa
        LEFT JOIN (SELECT kode_desa, COUNT(id_anggota) AS jum_nik FROM tb_poktan_anggota WHERE no_ktp !='' group by kode_desa) f
        ON a.id_desa=f.kode_desa
        LEFT JOIN (SELECT kode_desa, COUNT(id_anggota) AS jum_nik_kurang FROM tb_poktan_anggota WHERE luas_lahan_ternak_dimiliki <'1.00' group by kode_desa) g
        ON a.id_desa=g.kode_desa
        LEFT JOIN (SELECT kode_desa, COUNT(id_anggota) AS jum_nik_diantara FROM tb_poktan_anggota WHERE luas_lahan_ternak_dimiliki between '1.00'  and '2.00' group by kode_desa) h
        ON a.id_desa=h.kode_desa
        LEFT JOIN (SELECT kode_desa, COUNT(id_anggota) AS jum_nik_lebih FROM tb_poktan_anggota  WHERE luas_lahan_ternak_dimiliki >'2.00' group by kode_desa) i
        ON a.id_desa=i.kode_desa
        where id_daerah = $kode_kec
        order by nm_desa asc");
        $results = $query->getResultArray();

        $data =  [
            'rgprovdetaildesa' => $results
        ];

        return $data;
    }

    public function getPoktanGenProvDetailDesalist($kode_desa)
    {
        $db = Database::connect();
        $query  = $db->query("SELECT a.id_poktan, a.nama_poktan, b.id_poktan, b.jum_laki, c.jum_pr, d.jum_kosong, e.jum_total,
        f.jum_nik, g.jum_nik_kurang, h.jum_nik_diantara, i.jum_nik_lebih
        FROM tb_poktan a
        LEFT JOIN (SELECT id_poktan, COUNT(id_anggota) AS jum_laki FROM tb_poktan_anggota WHERE jenis_kelamin='laki' group by id_poktan) b
        ON a.id_poktan=b.id_poktan 
        LEFT JOIN (SELECT id_poktan, COUNT(id_anggota) AS jum_pr FROM tb_poktan_anggota WHERE jenis_kelamin='perempuan' group by id_poktan) c
        ON a.id_poktan=c.id_poktan
        LEFT JOIN (SELECT id_poktan, COUNT(id_anggota) AS jum_kosong FROM tb_poktan_anggota WHERE jenis_kelamin='' group by id_poktan) d
        ON a.id_poktan=d.id_poktan
        LEFT JOIN (SELECT id_poktan, COUNT(id_anggota) AS jum_total FROM tb_poktan_anggota group by id_poktan) e
        ON a.id_poktan=e.id_poktan
        LEFT JOIN (SELECT id_poktan, COUNT(id_anggota) AS jum_nik FROM tb_poktan_anggota WHERE no_ktp !='' group by id_poktan) f
        ON a.id_poktan=f.id_poktan
        LEFT JOIN (SELECT id_poktan, COUNT(id_anggota) AS jum_nik_kurang FROM tb_poktan_anggota WHERE luas_lahan_ternak_dimiliki <'1.00' group by id_poktan) g
        ON a.id_poktan=g.id_poktan
        LEFT JOIN (SELECT id_poktan, COUNT(id_anggota) AS jum_nik_diantara FROM tb_poktan_anggota WHERE luas_lahan_ternak_dimiliki between '1.00'  and '2.00' group by id_poktan) h
        ON a.id_poktan=h.id_poktan
        LEFT JOIN (SELECT id_poktan, COUNT(id_anggota) AS jum_nik_lebih FROM tb_poktan_anggota  WHERE luas_lahan_ternak_dimiliki >'2.00' group by id_poktan) i
        ON a.id_poktan=i.id_poktan
        where kode_desa = $kode_desa
        order by nama_poktan asc");
        $results = $query->getResultArray();

        $data =  [
            'rgprovdetaildesalist' => $results
        ];

        return $data;
    }

    public function getPoktanGenProvAnggota($id_poktan)
    {
        $db = Database::connect();
        $query  = $db->query("SELECT a.id_poktan, a.nama_anggota, a.jenis_kelamin, a.no_ktp, a.volume, b.nama_subsektor, b.nama_komoditas,
        case a.jenis_kelamin 
        when 'laki' then 'Laki-Laki'
        when 'perempuan' then 'Perempuan'
        else '' end as jenis_kelamin
        FROM tb_poktan_anggota a
        left join tb_komoditas b on a.kode_komoditas = b.kode_komoditas
        where a.id_poktan = $id_poktan
        order by nama_anggota asc");
        $results = $query->getResultArray();

        $data =  [
            'rgprovanggota' => $results
        ];

        return $data;
    }

    public function getAnggotaPoktan($kode_prop)
    {
        $db = Database::connect();
        $query = $db->query("select nama_prop as namaprov from tblpropinsi where id_prop='$kode_prop'");
        $row   = $query->getRow();
        $sql = "select count(id_poktan) as jumpoktan from tb_poktan a
        LEFT JOIN (SELECT kode_prop, COUNT(id_poktan) AS jum_pemula FROM tb_gapoktan group by simluh_kelas_kemampuan='pemula') b
        ON a.id_gap=b.id_gap
        where kode_prop='$kode_prop'";
        // dd($sql);
        $query = $db->query($sql);
        $results   = $query->getResultArray();

        $data =  [
            'rgprov' => $results,
        ];

        return $data;
    }

    public function getKelasPoktan()
    {
        $db = Database::connect();
        $sql = "select a.id_prop as kode_prop, nama_prop as namaprov, b.jum_pemula, c.jum_lanjut, d.jum_madya, e.jum_utama, f.jum_know, g.jumpoktan from tblpropinsi a
        LEFT JOIN (SELECT kode_prop, COUNT(id_poktan) AS jumpoktan FROM tb_poktan group by kode_prop) g
        ON a.id_prop=g.kode_prop
        LEFT JOIN (SELECT kode_prop, COUNT(id_poktan) AS jum_pemula FROM tb_poktan WHERE simluh_kelas_kemampuan='pemula' group by kode_prop) b
        ON a.id_prop=b.kode_prop
        LEFT JOIN (SELECT kode_prop, COUNT(id_poktan) AS jum_lanjut FROM tb_poktan WHERE simluh_kelas_kemampuan='lanjut' group by kode_prop) c
        ON a.id_prop=c.kode_prop
        LEFT JOIN (SELECT kode_prop, COUNT(id_poktan) AS jum_madya FROM tb_poktan WHERE simluh_kelas_kemampuan='madya' group by kode_prop) d
        ON a.id_prop=d.kode_prop
        LEFT JOIN (SELECT kode_prop, COUNT(id_poktan) AS jum_utama FROM tb_poktan WHERE simluh_kelas_kemampuan='utama' group by kode_prop) e
        ON a.id_prop=e.kode_prop
        LEFT JOIN (SELECT kode_prop, COUNT(id_poktan) AS jum_know FROM tb_poktan WHERE simluh_kelas_kemampuan='' group by kode_prop) f
        ON a.id_prop=f.kode_prop
        ORDER by nama_prop";
        // dd($sql);
        $query = $db->query($sql);
        $results   = $query->getResultArray();

        $data =  [
            'rgkelaspok' => $results
        ];

        return $data;
    }

    public function getKelasPoktanKab($kode_prop)
    {
        $db = Database::connect();
        $sql = "select a.id_dati2 as kode_kab, a.nama_dati2 as nama_kab , b.kode_kab, b.jum_pemula, c.jum_lanjut, d.jum_madya, e.jum_utama, f.jum_know, g.jumpoktan from tbldati2 a
        LEFT JOIN (SELECT kode_kab, COUNT(id_poktan) AS jumpoktan FROM tb_poktan group by kode_kab) g
        ON a.id_dati2=g.kode_kab
        LEFT JOIN (SELECT kode_kab, COUNT(id_poktan) AS jum_pemula FROM tb_poktan WHERE simluh_kelas_kemampuan='pemula' group by kode_kab) b
        ON a.id_dati2=b.kode_kab
        LEFT JOIN (SELECT kode_kab, COUNT(id_poktan) AS jum_lanjut FROM tb_poktan WHERE simluh_kelas_kemampuan='lanjut' group by kode_kab) c
        ON a.id_dati2=c.kode_kab
        LEFT JOIN (SELECT kode_kab, COUNT(id_poktan) AS jum_madya FROM tb_poktan WHERE simluh_kelas_kemampuan='madya' group by kode_kab) d
        ON a.id_dati2=d.kode_kab
        LEFT JOIN (SELECT kode_kab, COUNT(id_poktan) AS jum_utama FROM tb_poktan WHERE simluh_kelas_kemampuan='utama' group by kode_kab) e
        ON a.id_dati2=e.kode_kab
        LEFT JOIN (SELECT kode_kab, COUNT(id_poktan) AS jum_know FROM tb_poktan WHERE simluh_kelas_kemampuan='' group by kode_kab) f
        ON a.id_dati2=f.kode_kab
        where id_prop = $kode_prop
        order by nama_kab asc";
        // dd($sql);
        $query = $db->query($sql);
        $results   = $query->getResultArray();

        $data =  [
            'rgkelaspokkab' => $results
        ];

        return $data;
    }

    public function getKelasPoktanKec($kode_kab)
    {
        $db = Database::connect();
        $sql = "select a.id_daerah, a.deskripsi, b.kode_kec, b.jum_pemula, c.jum_lanjut, d.jum_madya, e.jum_utama, f.jum_know, g.thl_apbd from tbldaerah a
        LEFT JOIN (SELECT kode_kec, COUNT(id_poktan) AS thl_apbd FROM tb_poktan group by kode_kec) g
        ON a.id_daerah=g.kode_kec
        LEFT JOIN (SELECT kode_kec, COUNT(id_poktan) AS jum_pemula FROM tb_poktan WHERE simluh_kelas_kemampuan='pemula' group by kode_kec) b
        ON a.id_daerah=b.kode_kec
        LEFT JOIN (SELECT kode_kec, COUNT(id_poktan) AS jum_lanjut FROM tb_poktan WHERE simluh_kelas_kemampuan='lanjut' group by kode_kec) c
        ON a.id_daerah=c.kode_kec
        LEFT JOIN (SELECT kode_kec, COUNT(id_poktan) AS jum_madya FROM tb_poktan WHERE simluh_kelas_kemampuan='madya' group by kode_kec) d
        ON a.id_daerah=d.kode_kec
        LEFT JOIN (SELECT kode_kec, COUNT(id_poktan) AS jum_utama FROM tb_poktan WHERE simluh_kelas_kemampuan='utama' group by kode_kec) e
        ON a.id_daerah=e.kode_kec
        LEFT JOIN (SELECT kode_kec, COUNT(id_poktan) AS jum_know FROM tb_poktan WHERE simluh_kelas_kemampuan='' group by kode_kec) f
        ON a.id_daerah=f.kode_kec
        where id_dati2 = $kode_kab
        order by deskripsi asc";
        // dd($sql);
        $query = $db->query($sql);
        $results   = $query->getResultArray();

        $data =  [
            'rgkelaspokkec' => $results
        ];

        return $data;
    }

    public function getKelasPoktanDesa($kode_kec)
    {
        $db = Database::connect();
        $sql = "select a.id_desa, a.nm_desa, b.kode_desa, b.jum_pemula, c.jum_lanjut, d.jum_madya, e.jum_utama, f.jum_know, g.thl_apbd from tbldesa a
        LEFT JOIN (SELECT kode_desa, COUNT(id_poktan) AS thl_apbd FROM tb_poktan group by kode_desa) g
        ON a.id_desa=g.kode_desa
        LEFT JOIN (SELECT kode_desa, COUNT(id_poktan) AS jum_pemula FROM tb_poktan WHERE simluh_kelas_kemampuan='pemula' group by kode_desa) b
        ON a.id_desa=b.kode_desa
        LEFT JOIN (SELECT kode_desa, COUNT(id_poktan) AS jum_lanjut FROM tb_poktan WHERE simluh_kelas_kemampuan='lanjut' group by kode_desa) c
        ON a.id_desa=c.kode_desa
        LEFT JOIN (SELECT kode_desa, COUNT(id_poktan) AS jum_madya FROM tb_poktan WHERE simluh_kelas_kemampuan='madya' group by kode_desa) d
        ON a.id_desa=d.kode_desa
        LEFT JOIN (SELECT kode_desa, COUNT(id_poktan) AS jum_utama FROM tb_poktan WHERE simluh_kelas_kemampuan='utama' group by kode_desa) e
        ON a.id_desa=e.kode_desa
        LEFT JOIN (SELECT kode_desa, COUNT(id_poktan) AS jum_know FROM tb_poktan WHERE simluh_kelas_kemampuan='' group by kode_desa) f
        ON a.id_desa=f.kode_desa
        where id_daerah = $kode_kec
        order by nm_desa asc";
        // dd($sql);
        $query = $db->query($sql);
        $results   = $query->getResultArray();

        $data =  [
            'rgkelaspokdesa' => $results
        ];

        return $data;
    }

    public function getJenisPoktan()
    {
        $db = Database::connect();
        $sql = "select a.id_prop as kode_prop, nama_prop as namaprov, b.jum_domisili, c.jum_perempuan, d.jum_tp, e.jum_hor, f.jum_bun, g.jumpoktan,
        h.jum_nak, i.jum_olah, j.jum_upja, k.jum_p3a, l.jum_lmdh, m.jum_penangkar_benih, n.jum_kmp, o.jum_umkm, p.jum_know from tblpropinsi a
        LEFT JOIN (SELECT kode_prop, COUNT(id_poktan) AS jumpoktan FROM tb_poktan group by kode_prop) g
        ON a.id_prop=g.kode_prop
        LEFT JOIN (SELECT kode_prop, COUNT(id_poktan) AS jum_domisili FROM tb_poktan WHERE simluh_jenis_kelompok='domisili' or simluh_jenis_kelompok_domisili='domisili' group by kode_prop) b
        ON a.id_prop=b.kode_prop
        LEFT JOIN (SELECT kode_prop, COUNT(id_poktan) AS jum_perempuan FROM tb_poktan WHERE simluh_jenis_kelompok='perempuan' or simluh_jenis_kelompok_perempuan='perempuan' group by kode_prop) c
        ON a.id_prop=c.kode_prop
        LEFT JOIN (SELECT kode_prop, COUNT(id_poktan) AS jum_tp FROM tb_poktan WHERE simluh_jenis_kelompok='tp' or simluh_jenis_kelompok_tp='tp' group by kode_prop) d
        ON a.id_prop=d.kode_prop
        LEFT JOIN (SELECT kode_prop, COUNT(id_poktan) AS jum_hor FROM tb_poktan WHERE simluh_jenis_kelompok='hor' or simluh_jenis_kelompok_hor='hor' group by kode_prop) e
        ON a.id_prop=e.kode_prop
        LEFT JOIN (SELECT kode_prop, COUNT(id_poktan) AS jum_bun FROM tb_poktan WHERE simluh_jenis_kelompok='bun' or simluh_jenis_kelompok_bun='bun' group by kode_prop) f
        ON a.id_prop=f.kode_prop
        LEFT JOIN (SELECT kode_prop, COUNT(id_poktan) AS jum_nak FROM tb_poktan WHERE simluh_jenis_kelompok='nak' or simluh_jenis_kelompok_nak='nak' group by kode_prop) h
        ON a.id_prop=h.kode_prop
        LEFT JOIN (SELECT kode_prop, COUNT(id_poktan) AS jum_olah FROM tb_poktan WHERE simluh_jenis_kelompok='olah' or simluh_jenis_kelompok_olah='olah' group by kode_prop) i
        ON a.id_prop=i.kode_prop
        LEFT JOIN (SELECT kode_prop, COUNT(id_poktan) AS jum_upja FROM tb_poktan WHERE simluh_jenis_kelompok_upja='upja' group by kode_prop) j
        ON a.id_prop=j.kode_prop
        LEFT JOIN (SELECT kode_prop, COUNT(id_poktan) AS jum_p3a FROM tb_poktan WHERE simluh_jenis_kelompok_p3a='p3a' group by kode_prop) k
        ON a.id_prop=k.kode_prop
        LEFT JOIN (SELECT kode_prop, COUNT(id_poktan) AS jum_lmdh FROM tb_poktan WHERE simluh_jenis_kelompok_lmdh='lmdh' group by kode_prop) l
        ON a.id_prop=l.kode_prop
        LEFT JOIN (SELECT kode_prop, COUNT(id_poktan) AS jum_penangkar_benih FROM tb_poktan WHERE simluh_jenis_kelompok_penangkar='penangkar_benih' group by kode_prop) m
        ON a.id_prop=m.kode_prop
        LEFT JOIN (SELECT kode_prop, COUNT(id_poktan) AS jum_kmp FROM tb_poktan WHERE simluh_jenis_kelompok_kmp='kmp' group by kode_prop) n
        ON a.id_prop=n.kode_prop
        LEFT JOIN (SELECT kode_prop, COUNT(id_poktan) AS jum_umkm FROM tb_poktan WHERE simluh_jenis_kelompok_umkm='umkm' group by kode_prop) o
        ON a.id_prop=o.kode_prop
        LEFT JOIN (SELECT kode_prop, COUNT(id_poktan) AS jum_know FROM tb_poktan WHERE simluh_jenis_kelompok='' and simluh_jenis_kelompok_tp='' and 
        simluh_jenis_kelompok_hor='' and 
        simluh_jenis_kelompok_bun='' and 
        simluh_jenis_kelompok_nak='' and
        simluh_jenis_kelompok_olah='' and 
        simluh_jenis_kelompok_domisili='' and
        simluh_jenis_kelompok_perempuan='' and
        simluh_jenis_kelompok_upja='' and
        simluh_jenis_kelompok_p3a='' and
        simluh_jenis_kelompok_lmdh='' and
        simluh_jenis_kelompok_penangkar='' and
        simluh_jenis_kelompok_kmp='' and
        simluh_jenis_kelompok_umkm='' group by kode_prop) p
        ON a.id_prop=p.kode_prop
        ORDER by nama_prop";
        // dd($sql);
        $query = $db->query($sql);
        $results   = $query->getResultArray();

        $data =  [
            'rgjenispok' => $results
        ];

        return $data;
    }

    public function getJenisPoktanKab($kode_prop)
    {
        $db = Database::connect();
        $sql = "select a.id_dati2 as kode_kab, a.nama_dati2 as nama_kab, b.kode_kab, b.jum_domisili, c.jum_perempuan, d.jum_tp, e.jum_hor, f.jum_bun, g.jumpoktan,
        h.jum_nak, i.jum_olah, j.jum_upja, k.jum_p3a, l.jum_lmdh, m.jum_penangkar_benih, n.jum_kmp, o.jum_umkm, p.jum_know from tbldati2 a
        LEFT JOIN (SELECT kode_kab, COUNT(id_poktan) AS jumpoktan FROM tb_poktan group by kode_kab) g
        ON a.id_dati2=g.kode_kab
        LEFT JOIN (SELECT kode_kab, COUNT(id_poktan) AS jum_domisili FROM tb_poktan WHERE simluh_jenis_kelompok='domisili' or simluh_jenis_kelompok_domisili='domisili' group by kode_kab) b
        ON a.id_dati2=b.kode_kab
        LEFT JOIN (SELECT kode_kab, COUNT(id_poktan) AS jum_perempuan FROM tb_poktan WHERE simluh_jenis_kelompok='perempuan' or simluh_jenis_kelompok_perempuan='perempuan' group by kode_kab) c
        ON a.id_dati2=c.kode_kab
        LEFT JOIN (SELECT kode_kab, COUNT(id_poktan) AS jum_tp FROM tb_poktan WHERE simluh_jenis_kelompok='tp' or simluh_jenis_kelompok_tp='tp' group by kode_kab) d
        ON a.id_dati2=d.kode_kab
        LEFT JOIN (SELECT kode_kab, COUNT(id_poktan) AS jum_hor FROM tb_poktan WHERE simluh_jenis_kelompok='hor' or simluh_jenis_kelompok_hor='hor' group by kode_kab) e
        ON a.id_dati2=e.kode_kab
        LEFT JOIN (SELECT kode_kab, COUNT(id_poktan) AS jum_bun FROM tb_poktan WHERE simluh_jenis_kelompok='bun' or simluh_jenis_kelompok_bun='bun' group by kode_kab) f
        ON a.id_dati2=f.kode_kab
        LEFT JOIN (SELECT kode_kab, COUNT(id_poktan) AS jum_nak FROM tb_poktan WHERE simluh_jenis_kelompok='nak' or simluh_jenis_kelompok_nak='nak' group by kode_kab) h
        ON a.id_dati2=h.kode_kab
        LEFT JOIN (SELECT kode_kab, COUNT(id_poktan) AS jum_olah FROM tb_poktan WHERE simluh_jenis_kelompok='olah' or simluh_jenis_kelompok_olah='olah' group by kode_kab) i
        ON a.id_dati2=i.kode_kab
        LEFT JOIN (SELECT kode_kab, COUNT(id_poktan) AS jum_upja FROM tb_poktan WHERE simluh_jenis_kelompok_upja='upja' group by kode_kab) j
        ON a.id_dati2=j.kode_kab
        LEFT JOIN (SELECT kode_kab, COUNT(id_poktan) AS jum_p3a FROM tb_poktan WHERE simluh_jenis_kelompok_p3a='p3a' group by kode_kab) k
        ON a.id_dati2=k.kode_kab
        LEFT JOIN (SELECT kode_kab, COUNT(id_poktan) AS jum_lmdh FROM tb_poktan WHERE simluh_jenis_kelompok_lmdh='lmdh' group by kode_kab) l
        ON a.id_dati2=l.kode_kab
        LEFT JOIN (SELECT kode_kab, COUNT(id_poktan) AS jum_penangkar_benih FROM tb_poktan WHERE simluh_jenis_kelompok_penangkar='penangkar_benih' group by kode_kab) m
        ON a.id_dati2=m.kode_kab
        LEFT JOIN (SELECT kode_kab, COUNT(id_poktan) AS jum_kmp FROM tb_poktan WHERE simluh_jenis_kelompok_kmp='kmp' group by kode_kab) n
        ON a.id_dati2=n.kode_kab
        LEFT JOIN (SELECT kode_kab, COUNT(id_poktan) AS jum_umkm FROM tb_poktan WHERE simluh_jenis_kelompok_umkm='umkm' group by kode_kab) o
        ON a.id_dati2=o.kode_kab
        LEFT JOIN (SELECT kode_kab, COUNT(id_poktan) AS jum_know FROM tb_poktan WHERE simluh_jenis_kelompok='' and simluh_jenis_kelompok_tp='' and 
        simluh_jenis_kelompok_hor='' and 
        simluh_jenis_kelompok_bun='' and 
        simluh_jenis_kelompok_nak='' and
        simluh_jenis_kelompok_olah='' and 
        simluh_jenis_kelompok_domisili='' and
        simluh_jenis_kelompok_perempuan='' and
        simluh_jenis_kelompok_upja='' and
        simluh_jenis_kelompok_p3a='' and
        simluh_jenis_kelompok_lmdh='' and
        simluh_jenis_kelompok_penangkar='' and
        simluh_jenis_kelompok_kmp='' and
        simluh_jenis_kelompok_umkm='' group by kode_kab) p
        ON a.id_dati2=p.kode_kab
        where id_prop = $kode_prop
        order by nama_kab asc";
        // dd($sql);
        $query = $db->query($sql);
        $results   = $query->getResultArray();

        $data =  [
            'rgjenispokkab' => $results
        ];

        return $data;
    }

    public function getJenisPoktanKec($kode_kab)
    {
        $db = Database::connect();
        $sql = "select a.id_daerah, a.deskripsi, b.kode_kec, b.jum_domisili, c.jum_perempuan, d.jum_tp, e.jum_hor, f.jum_bun, g.thl_apbd,
        h.jum_nak, i.jum_olah, j.jum_upja, k.jum_p3a, l.jum_lmdh, m.jum_penangkar_benih, n.jum_kmp, o.jum_umkm, p.jum_know from tbldaerah a
        LEFT JOIN (SELECT kode_kec, COUNT(id_poktan) AS thl_apbd FROM tb_poktan group by kode_kec) g
        ON a.id_daerah=g.kode_kec
        LEFT JOIN (SELECT kode_kec, COUNT(id_poktan) AS jum_domisili FROM tb_poktan WHERE simluh_jenis_kelompok='domisili' or simluh_jenis_kelompok_domisili='domisili' group by kode_kec) b
        ON a.id_daerah=b.kode_kec
        LEFT JOIN (SELECT kode_kec, COUNT(id_poktan) AS jum_perempuan FROM tb_poktan WHERE simluh_jenis_kelompok='perempuan' or simluh_jenis_kelompok_perempuan='perempuan' group by kode_kec) c
        ON a.id_daerah=c.kode_kec
        LEFT JOIN (SELECT kode_kec, COUNT(id_poktan) AS jum_tp FROM tb_poktan WHERE simluh_jenis_kelompok='tp' or simluh_jenis_kelompok_tp='tp' group by kode_kec) d
        ON a.id_daerah=d.kode_kec
        LEFT JOIN (SELECT kode_kec, COUNT(id_poktan) AS jum_hor FROM tb_poktan WHERE simluh_jenis_kelompok='hor' or simluh_jenis_kelompok_hor='hor' group by kode_kec) e
        ON a.id_daerah=e.kode_kec
        LEFT JOIN (SELECT kode_kec, COUNT(id_poktan) AS jum_bun FROM tb_poktan WHERE simluh_jenis_kelompok='bun' or simluh_jenis_kelompok_bun='bun' group by kode_kec) f
        ON a.id_daerah=f.kode_kec
        LEFT JOIN (SELECT kode_kec, COUNT(id_poktan) AS jum_nak FROM tb_poktan WHERE simluh_jenis_kelompok='nak' or simluh_jenis_kelompok_nak='nak' group by kode_kec) h
        ON a.id_daerah=h.kode_kec
        LEFT JOIN (SELECT kode_kec, COUNT(id_poktan) AS jum_olah FROM tb_poktan WHERE simluh_jenis_kelompok='olah' or simluh_jenis_kelompok_olah='olah' group by kode_kec) i
        ON a.id_daerah=i.kode_kec
        LEFT JOIN (SELECT kode_kec, COUNT(id_poktan) AS jum_upja FROM tb_poktan WHERE simluh_jenis_kelompok_upja='upja' group by kode_kec) j
        ON a.id_daerah=j.kode_kec
        LEFT JOIN (SELECT kode_kec, COUNT(id_poktan) AS jum_p3a FROM tb_poktan WHERE simluh_jenis_kelompok_p3a='p3a' group by kode_kec) k
        ON a.id_daerah=k.kode_kec
        LEFT JOIN (SELECT kode_kec, COUNT(id_poktan) AS jum_lmdh FROM tb_poktan WHERE simluh_jenis_kelompok_lmdh='lmdh' group by kode_kec) l
        ON a.id_daerah=l.kode_kec
        LEFT JOIN (SELECT kode_kec, COUNT(id_poktan) AS jum_penangkar_benih FROM tb_poktan WHERE simluh_jenis_kelompok_penangkar='penangkar_benih' group by kode_kec) m
        ON a.id_daerah=m.kode_kec
        LEFT JOIN (SELECT kode_kec, COUNT(id_poktan) AS jum_kmp FROM tb_poktan WHERE simluh_jenis_kelompok_kmp='kmp' group by kode_kec) n
        ON a.id_daerah=n.kode_kec
        LEFT JOIN (SELECT kode_kec, COUNT(id_poktan) AS jum_umkm FROM tb_poktan WHERE simluh_jenis_kelompok_umkm='umkm' group by kode_kec) o
        ON a.id_daerah=o.kode_kec
        LEFT JOIN (SELECT kode_kec, COUNT(id_poktan) AS jum_know FROM tb_poktan WHERE simluh_jenis_kelompok='' and simluh_jenis_kelompok_tp='' and 
        simluh_jenis_kelompok_hor='' and 
        simluh_jenis_kelompok_bun='' and 
        simluh_jenis_kelompok_nak='' and
        simluh_jenis_kelompok_olah='' and 
        simluh_jenis_kelompok_domisili='' and
        simluh_jenis_kelompok_perempuan='' and
        simluh_jenis_kelompok_upja='' and
        simluh_jenis_kelompok_p3a='' and
        simluh_jenis_kelompok_lmdh='' and
        simluh_jenis_kelompok_penangkar='' and
        simluh_jenis_kelompok_kmp='' and
        simluh_jenis_kelompok_umkm='' group by kode_kec) p
        ON a.id_daerah=p.kode_kec
        where id_dati2 = $kode_kab
        order by deskripsi asc";
        // dd($sql);
        $query = $db->query($sql);
        $results   = $query->getResultArray();

        $data =  [
            'rgjenispokkec' => $results
        ];

        return $data;
    }

    public function getJenisPoktanDesa($kode_kec)
    {
        $db = Database::connect();
        $sql = "select a.id_desa, a.nm_desa, b.kode_desa, b.jum_domisili, c.jum_perempuan, d.jum_tp, e.jum_hor, f.jum_bun, g.thl_apbd,
        h.jum_nak, i.jum_olah, j.jum_upja, k.jum_p3a, l.jum_lmdh, m.jum_penangkar_benih, n.jum_kmp, o.jum_umkm, p.jum_know from tbldesa a
        LEFT JOIN (SELECT kode_desa, COUNT(id_poktan) AS thl_apbd FROM tb_poktan group by kode_desa) g
        ON a.id_desa=g.kode_desa
        LEFT JOIN (SELECT kode_desa, COUNT(id_poktan) AS jum_domisili FROM tb_poktan WHERE simluh_jenis_kelompok='domisili' or simluh_jenis_kelompok_domisili='domisili' group by kode_desa) b
        ON a.id_desa=b.kode_desa
        LEFT JOIN (SELECT kode_desa, COUNT(id_poktan) AS jum_perempuan FROM tb_poktan WHERE simluh_jenis_kelompok='perempuan' or simluh_jenis_kelompok_perempuan='perempuan' group by kode_desa) c
        ON a.id_desa=c.kode_desa
        LEFT JOIN (SELECT kode_desa, COUNT(id_poktan) AS jum_tp FROM tb_poktan WHERE simluh_jenis_kelompok='tp' or simluh_jenis_kelompok_tp='tp' group by kode_desa) d
        ON a.id_desa=d.kode_desa
        LEFT JOIN (SELECT kode_desa, COUNT(id_poktan) AS jum_hor FROM tb_poktan WHERE simluh_jenis_kelompok='hor' or simluh_jenis_kelompok_hor='hor' group by kode_desa) e
        ON a.id_desa=e.kode_desa
        LEFT JOIN (SELECT kode_desa, COUNT(id_poktan) AS jum_bun FROM tb_poktan WHERE simluh_jenis_kelompok='bun' or simluh_jenis_kelompok_bun='bun' group by kode_desa) f
        ON a.id_desa=f.kode_desa
        LEFT JOIN (SELECT kode_desa, COUNT(id_poktan) AS jum_nak FROM tb_poktan WHERE simluh_jenis_kelompok='nak' or simluh_jenis_kelompok_nak='nak' group by kode_desa) h
        ON a.id_desa=h.kode_desa
        LEFT JOIN (SELECT kode_desa, COUNT(id_poktan) AS jum_olah FROM tb_poktan WHERE simluh_jenis_kelompok='olah' or simluh_jenis_kelompok_olah='olah' group by kode_desa) i
        ON a.id_desa=i.kode_desa
        LEFT JOIN (SELECT kode_desa, COUNT(id_poktan) AS jum_upja FROM tb_poktan WHERE simluh_jenis_kelompok_upja='upja' group by kode_desa) j
        ON a.id_desa=j.kode_desa
        LEFT JOIN (SELECT kode_desa, COUNT(id_poktan) AS jum_p3a FROM tb_poktan WHERE simluh_jenis_kelompok_p3a='p3a' group by kode_desa) k
        ON a.id_desa=k.kode_desa
        LEFT JOIN (SELECT kode_desa, COUNT(id_poktan) AS jum_lmdh FROM tb_poktan WHERE simluh_jenis_kelompok_lmdh='lmdh' group by kode_desa) l
        ON a.id_desa=l.kode_desa
        LEFT JOIN (SELECT kode_desa, COUNT(id_poktan) AS jum_penangkar_benih FROM tb_poktan WHERE simluh_jenis_kelompok_penangkar='penangkar_benih' group by kode_desa) m
        ON a.id_desa=m.kode_desa
        LEFT JOIN (SELECT kode_desa, COUNT(id_poktan) AS jum_kmp FROM tb_poktan WHERE simluh_jenis_kelompok_kmp='kmp' group by kode_desa) n
        ON a.id_desa=n.kode_desa
        LEFT JOIN (SELECT kode_desa, COUNT(id_poktan) AS jum_umkm FROM tb_poktan WHERE simluh_jenis_kelompok_umkm='umkm' group by kode_desa) o
        ON a.id_desa=o.kode_desa
        LEFT JOIN (SELECT kode_desa, COUNT(id_poktan) AS jum_know FROM tb_poktan WHERE simluh_jenis_kelompok='' and simluh_jenis_kelompok_tp='' and 
        simluh_jenis_kelompok_hor='' and 
        simluh_jenis_kelompok_bun='' and 
        simluh_jenis_kelompok_nak='' and
        simluh_jenis_kelompok_olah='' and 
        simluh_jenis_kelompok_domisili='' and
        simluh_jenis_kelompok_perempuan='' and
        simluh_jenis_kelompok_upja='' and
        simluh_jenis_kelompok_p3a='' and
        simluh_jenis_kelompok_lmdh='' and
        simluh_jenis_kelompok_penangkar='' and
        simluh_jenis_kelompok_kmp='' and
        simluh_jenis_kelompok_umkm='' group by kode_desa) p
        ON a.id_desa=p.kode_desa
        where id_daerah = $kode_kec
        order by nm_desa asc";
        // dd($sql);
        $query = $db->query($sql);
        $results   = $query->getResultArray();

        $data =  [
            'rgjenispokdesa' => $results
        ];

        return $data;
    }

    public function getJenisPoktanExcel($kode_prop)
    {
        $db = Database::connect();
        $sql = "select a.id_dati2 as kode_kab, a.nama_dati2 as nama_kab, b.deskripsi, c.nama_prop, d.nm_desa, g.nama_poktan, g.ketua_poktan, g.alamat, g.simluh_tahun_bentuk from tbldati2 a
        LEFT JOIN (SELECT * FROM tb_poktan WHERE simluh_jenis_kelompok='tp' or simluh_jenis_kelompok_tp='tp' group by kode_kab,kode_kec,kode_desa) g
        ON a.id_dati2=g.kode_kab
        left join tbldaerah b on g.kode_kec=b.id_daerah
        left join tblpropinsi c on g.kode_prop=c.id_prop
        left join tbldesa d on g.kode_desa=d.id_desa
        where a.id_prop = $kode_prop
        order by nama_kab asc";
        // dd($sql);
        $query = $db->query($sql);
        $results   = $query->getResultArray();

        $data =  [
            'rgjenispokexcel' => $results
        ];

        return $data;
    }

    public function getJenisPoktanExcelNak($kode_prop)
    {
        $db = Database::connect();
        $sql = "select a.id_dati2 as kode_kab, a.nama_dati2 as nama_kab, b.deskripsi, c.nama_prop, d.nm_desa, g.nama_poktan, g.ketua_poktan, g.alamat, g.simluh_tahun_bentuk from tbldati2 a
        LEFT JOIN (SELECT * FROM tb_poktan WHERE simluh_jenis_kelompok='nak' or simluh_jenis_kelompok_nak='nak' group by kode_kab,kode_kec,kode_desa) g
        ON a.id_dati2=g.kode_kab
        left join tbldaerah b on g.kode_kec=b.id_daerah
        left join tblpropinsi c on g.kode_prop=c.id_prop
        left join tbldesa d on g.kode_desa=d.id_desa
        where a.id_prop = $kode_prop
        order by nama_kab asc";
        // dd($sql);
        $query = $db->query($sql);
        $results   = $query->getResultArray();

        $data =  [
            'rgjenispokexcelnak' => $results
        ];

        return $data;
    }

    public function getJumlahAnggotaPoktan()
    {
        $db = Database::connect();
        $sql = "SELECT
        `tblpropinsi`.`nama_prop`
       , `tb_poktan`.`kode_prop`
       , COUNT(`tb_poktan`.`id_poktan`) AS jumpoktan
       , COUNT(`tb_gapoktan`.`id_gap`) AS jum_pemula
   FROM
       `tblpropinsi`
       LEFT JOIN `tb_poktan` 
           ON (`tblpropinsi`.`id_prop` = `tb_poktan`.`kode_prop`)
       LEFT JOIN `tb_gapoktan` 
           ON (`tb_poktan`.`id_gap` = `tb_gapoktan`.`id_gap`)GROUP BY tblpropinsi.`id_prop`
           order by nama_prop";
        // dd($sql);
        $query = $db->query($sql);
        $results   = $query->getResultArray();

        $data =  [
            'rgjumlahanggota' => $results
        ];

        return $data;
    }

    public function getJumlahAnggotaPoktanKab($kode_prop)
    {
        $db = Database::connect();
        $sql = "SELECT
        `tbldati2`.`nama_dati2`
       , `tb_poktan`.`kode_kab`
       , COUNT(`tb_poktan`.`id_poktan`) AS jumpoktan
       , COUNT(`tb_gapoktan`.`id_gap`) AS jum_pemula
   FROM
       `tbldati2`
       LEFT JOIN `tb_poktan` 
           ON (`tbldati2`.`id_dati2` = `tb_poktan`.`kode_kab`)
       LEFT JOIN `tb_gapoktan` 
           ON (`tb_poktan`.`id_gap` = `tb_gapoktan`.`id_gap`)
           WHERE tbldati2.id_prop = '$kode_prop' GROUP BY tbldati2.`id_dati2` order by nama_dati2";
        // dd($sql);
        $query = $db->query($sql);
        $results   = $query->getResultArray();

        $data =  [
            'rgjumlahanggotakab' => $results
        ];

        return $data;
    }

    public function getJumlahAnggotaPoktanKec($kode_kab)
    {
        $db = Database::connect();
        $sql = "SELECT
        `tbldaerah`.`deskripsi`
       , `tb_poktan`.`kode_kec`
       , COUNT(`tb_poktan`.`id_poktan`) AS thl_apbd
       , COUNT(`tb_gapoktan`.`id_gap`) AS jum_pemula
   FROM
       `tbldaerah`
       LEFT JOIN `tb_poktan` 
           ON (`tbldaerah`.`id_daerah` = `tb_poktan`.`kode_kec`)
       LEFT JOIN `tb_gapoktan` 
           ON (`tb_poktan`.`id_gap` = `tb_gapoktan`.`id_gap`)
           WHERE tbldaerah.id_dati2 = '$kode_kab' GROUP BY tbldaerah.`id_daerah` order by deskripsi";
        // dd($sql);
        $query = $db->query($sql);
        $results   = $query->getResultArray();

        $data =  [
            'rgjumlahanggotakec' => $results
        ];

        return $data;
    }

    public function getJumlahAnggotaPoktanDesa($kode_kec)
    {
        $db = Database::connect();
        $sql = "SELECT
        `tbldesa`.`nm_desa`
       , `tb_poktan`.`kode_desa`
       , COUNT(`tb_poktan`.`id_poktan`) AS thl_apbd
       , COUNT(`tb_gapoktan`.`id_gap`) AS jum_pemula
   FROM
       `tbldesa`
       LEFT JOIN `tb_poktan` 
           ON (`tbldesa`.`id_desa` = `tb_poktan`.`kode_desa`)
       LEFT JOIN `tb_gapoktan` 
           ON (`tb_poktan`.`id_gap` = `tb_gapoktan`.`id_gap`)
           WHERE tbldesa.id_daerah = '$kode_kec' GROUP BY tbldesa.`id_desa` order by nm_desa";
        // dd($sql);
        $query = $db->query($sql);
        $results   = $query->getResultArray();

        $data =  [
            'rgjumlahanggotadesa' => $results
        ];

        return $data;
    }

    public function getJumlahAnggotaPoktanDesaList($kode_desa)
    {
        $db = Database::connect();
        $sql = "SELECT
        `tb_poktan`.`nama_poktan`
       , `tb_gapoktan`.`nama_gapoktan`
   FROM
       `tb_poktan`
       LEFT JOIN `tb_gapoktan` 
           ON (`tb_poktan`.`id_gap` = `tb_gapoktan`.`id_gap`)
           WHERE tb_poktan.kode_desa = '$kode_desa' GROUP BY tb_poktan.`id_poktan` order by nama_poktan";
        // dd($sql);
        $query = $db->query($sql);
        $results   = $query->getResultArray();

        $data =  [
            'rgjumlahanggotadesalist' => $results
        ];

        return $data;
    }
}
