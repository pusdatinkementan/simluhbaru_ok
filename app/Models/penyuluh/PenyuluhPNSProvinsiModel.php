<?php

namespace App\Models\penyuluh;

use CodeIgniter\Model;
use \Config\Database;

ini_set("memory_limit", "912M");

class PenyuluhPNSProvinsiModel extends Model
{
    protected $table      = 'tbldasar';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nip', 'nama', 'gelar_dpn', 'gelar_blk', 'tgl_lahir', 'tempat_lahir', 'jenis_kelamin',
        'status_kel', 'agama', 'gol_darah', 'keahlian', 'satminkal', 'kode_kab', 'tgl_skcpns', 'peng_kerja_thn', 'peng_kerja_bln',
        'alamat', 'dati2', 'kodepos', 'kode_prop', 'telp', 'hp', 'email', 'status', 'gol', 'jabatan', 'tgltmtgol', 'batas_pensiun',
        'tgl_pensiun', 'bulan_pensiun', 'tahun_pensiun', 'tgl_update', 'unit_kerja', 'tempat_tugas', 'kabupaten_tugas', 'kabupaten_tugas2',
        'kabupaten_tugas3', 'tgl_sk_luh', 'bln_sk_luh', 'thn_sk_luh', 'tingkat_pendidikan', 'bidang_pendidikan',
        'mapping', 'jurusan', 'nama_sekolah', 'noktp'
    ];


    protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;
    public function getDetailPenyuluhPNSByNIK($nip)
    {
        $query = $this->db->query("select *, a.nama, a.agama, a.keahlian, a.email, a.jabatan, a.gol, d.nm_desa,
        case a.kode_kab 
                                when '3' then 
                                    case a.unit_kerja 
                                    when '10' then 'Badan Pelaksana Penyuluhan Pertanian, Perikanan dan Kehutanan'
                                    when '20' then 'Badan Pelaksana Penyuluhan'
                                    when '31' then i.deskripsi_lembaga_lain
                                    when '32' then i.deskripsi_lembaga_lain
                                    when '33' then i.deskripsi_lembaga_lain
                                    else '' end
                                when '4' then k.nama_bpp 
                                else '' end nama_bapel,
        case a.kode_kab when '3' then j.deskripsi when '4' then d.nm_desa else '' end as wilker,
        case a.kode_kab when '3' then l.deskripsi when '4' then e.nm_desa else '' end as wilker2,
        case a.kode_kab when '3' then m.deskripsi when '4' then f.nm_desa else '' end as wilker3,
        case a.kode_kab when '3' then n.deskripsi when '4' then g.nm_desa else '' end as wilker4,
        case a.kode_kab when '3' then o.deskripsi when '4' then h.nm_desa else '' end as wilker5,
        case a.kode_kab when '3' then p.deskripsi when '4' then u.nm_desa else '' end as wilker6,
        case a.kode_kab when '3' then q.deskripsi when '4' then v.nm_desa else '' end as wilker7,
        case a.kode_kab when '3' then r.deskripsi when '4' then w.nm_desa else '' end as wilker8,
        case a.kode_kab when '3' then s.deskripsi when '4' then x.nm_desa else '' end as wilker9,
        case a.kode_kab when '3' then t.deskripsi when '4' then y.nm_desa else '' end as wilker10,
        case a.agama 
        when '1' then 'Islam'
        when '2' then 'Protestan'
        when '3' then 'Khatolik'
        when '4' then 'Hindu'
        when '5' then 'Budha'
        else '' end as agama,
        case a.keahlian
        when '1' then 'Tanaman Pangan'
        when '2' then 'Peternakan'
        when '3' then 'Perkebunan'
        when '4' then 'Hortikultura'
        else '' end as keahlian,
        j.deskripsi as kabupaten_tugas,
        z.nama as namajab,
        z.gol_ruang from tbldasar a 
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
                                left join tblbapel i on a.kode_kab='3' and a.satminkal=i.kabupaten and a.unit_kerja=i.nama_bapel
                                left join tblbpp k on a.kode_kab='4' and a.unit_kerja=k.id
                                left join tbldaerah j on a.kabupaten_tugas=j.id_daerah
                                left join tbldaerah l on a.kabupaten_tugas2=l.id_daerah
                                left join tbldaerah m on a.kabupaten_tugas3=m.id_daerah
                                left join tbldaerah n on a.kabupaten_tugas4=n.id_daerah
                                left join tbldaerah o on a.kabupaten_tugas5=o.id_daerah
                                left join tbldaerah p on a.kabupaten_tugas6=p.id_daerah
                                left join tbldaerah q on a.kabupaten_tugas7=q.id_daerah
                                left join tbldaerah r on a.kabupaten_tugas8=r.id_daerah
                                left join tbldaerah s on a.kabupaten_tugas9=s.id_daerah
                                left join tbldaerah t on a.kabupaten_tugas10=t.id_daerah
                                left join tblpak zo on a.nip=zo.nip
                                left join tblpp z on zo.gol=z.kode
        WHERE a.nip = '$nip'");
        $row   = $query->getRowArray();
        return $row;
    }


    public function getPenyuluhPNSTotal($kode_prov)
    {
        //d($kode_kab);
        $db = Database::connect();
        $query = $db->query("select count(a.id) as jum, nama_prop as nama_prop 
									from tbldasar a 
									left join tblpropinsi b on b.id_prop=a.satminkal where satminkal='$kode_prov' and status !='1' and status !='2' and status !='3' and status !='7'");
        $row   = $query->getRow();

        $query   = $db->query("select a.id, a.nip, a.nama, a.gelar_dpn, a.gelar_blk, a.tgl_lahir, a.tempat_lahir, a.jenis_kelamin,
        status_kel, a.agama, a.gol_darah, a.keahlian, a.satminkal, a.kode_kab, a.tgl_skcpns, a.peng_kerja_thn, a.peng_kerja_bln,
        a.alamat, a.dati2, a.kodepos, a.kode_prop, a.telp, a.hp, a.email, a.status, a.gol, a.jabatan, a.tgltmtgol, a.batas_pensiun,
        a.tgl_pensiun, a.bulan_pensiun, a.tahun_pensiun, a.tgl_update, a.unit_kerja, a.tempat_tugas, a.kabupaten_tugas1, a.kabupaten_tugas2,
        a.kabupaten_tugas3, a.tgl_sk_luh, a.bln_sk_luh, a.thn_sk_luh, a.tingkat_pendidikan, a.bidang_pendidikan,
        a.mapping, a.jurusan, a.nama_sekolah, a.noktp,
        
                                i.deskripsi_lembaga_lain as nama_bakor, 
								
                                case a.status
                                when '0' then 'Aktif'
                                when '6' then 'Tugas Belajar'
                                else '' end status_kel,
                               
                                j.nama_dati2 as kabupaten_tugas,
                                go.bts_pensi,
                                i.deskripsi_lembaga_lain,
                                z.nama as namajab,
                                z.gol_ruang,
                                zo.nip as nippp
                                from tbldasar a
                                left join tblsatminkal b on a.satminkal=b.kode
                                left join tblstatus_penyuluh c on a.status='0' and a.status_kel=c.kode
                               
                                left join tblbakor i on a.kode_kab='2' and a.satminkal=i.kode_prop and a.unit_kerja=i.id_bakor
                                left join tbldati2 j on a.kabupaten_tugas1=j.id_dati2
                                left join tbldati2 l on a.kabupaten_tugas2=l.id_dati2
                                left join tbldati2 m on a.kabupaten_tugas3=m.id_dati2
                                
                                left join tblgolongan go on a.gol=go.kode
                                left join tblpak zo on a.id=zo.id
                                left join tblpp z on zo.gol=z.kode
                                where a.satminkal='".$kode_prov."' and status !='1' and status !='2' and status !='3' and status !='7' order by nama");
        $results = $query->getResultArray();

        $data =  [
            'jum' => $row->jum,
            'nama_prop' => $row->nama_prop,
            'table_data' => $results,
        ];

        return $data;
    }
	
	public function getPenyuluhNonaktifTotal($kode_prov)
    {
        //d($kode_kab);
        $db = Database::connect();
        $query = $db->query("select count(a.id) as jum, nama_prop as nama_prop 
									from tbldasar a 
									left join tblpropinsi b on b.id_prop=a.satminkal where satminkal='$kode_prov' and status IN ('1','2','3','7')");
        $row   = $query->getRow();

        $query   = $db->query("select a.id, a.nip, a.nama, a.gelar_dpn, a.gelar_blk, a.tgl_lahir, a.tempat_lahir, a.jenis_kelamin,
        status_kel, a.agama, a.gol_darah, a.keahlian, a.satminkal, a.kode_kab, a.tgl_skcpns, a.peng_kerja_thn, a.peng_kerja_bln,
        a.alamat, a.dati2, a.kodepos, a.kode_prop, a.telp, a.hp, a.email, a.status, a.gol, a.jabatan, a.tgltmtgol, a.batas_pensiun,
        a.tgl_pensiun, a.bulan_pensiun, a.tahun_pensiun, a.tgl_update, a.unit_kerja, a.tempat_tugas, a.kabupaten_tugas1, a.kabupaten_tugas2,
        a.kabupaten_tugas3, a.tgl_sk_luh, a.bln_sk_luh, a.thn_sk_luh, a.tingkat_pendidikan, a.bidang_pendidikan,
        a.mapping, a.jurusan, a.nama_sekolah, a.noktp,
        
                                i.deskripsi_lembaga_lain as nama_bakor, 
								
                                case a.status
                                when '1' then 'Pensiun'
                                when '2' then 'Meninggal Dunia'
								when '3' then 'Pindah Struktural'
								when '7' then 'CPNS'
                                else '' end status_kel,

                                j.nama_dati2 as kabupaten_tugas,
                                go.bts_pensi,
                                i.deskripsi_lembaga_lain,
                                z.nama as namajab,
                                z.gol_ruang,
                                zo.nip as nippp
                                from tbldasar a
                                left join tblsatminkal b on a.satminkal=b.kode
                                left join tblstatus_penyuluh c on a.status='0' and a.status_kel=c.kode
                               
                                left join tblbakor i on a.kode_kab='2' and a.satminkal=i.kode_prop and a.unit_kerja=i.id_bakor
                                left join tbldati2 j on a.kabupaten_tugas1=j.id_dati2
                                left join tbldati2 l on a.kabupaten_tugas2=l.id_dati2
                                left join tbldati2 m on a.kabupaten_tugas3=m.id_dati2
                                
                                left join tblgolongan go on a.gol=go.kode
                                left join tblpak zo on a.id=zo.id
                                left join tblpp z on zo.gol=z.kode
                                where a.satminkal='".$kode_prov."' and status IN ('1','2','3','7') order by nama");
        $results = $query->getResultArray();

        $data =  [
            'jum' => $row->jum,
            'nama_prop' => $row->nama_prop,
            'table_data' => $results,
        ];

        return $data;
    }

    public function getStatus()
    {
        $query = $this->db->query("select * from tblstatus_penyuluh a where kode !='4'");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getDetailEditStatus($id)
    {
        $query = $this->db->query("select a.id, a.noktp, a.nip, a.nip_lama, a.nama, a.gelar_dpn, a.gelar_blk, a.tgl_update, a.status, a.tgl_status, a.ket_status, a.jenis_kelamin,
        
                                i.deskripsi_lembaga_lain as nama_bakor, 
								
                                case a.status
                                when '0' then 'Aktif'
                                when '6' then 'Tugas Belajar'
                                else '' end status_kel,
                               
                                j.nama_dati2 as kabupaten_tugas,
								
                               case a.status
                               when '0' then 'Aktif'
                               when '6' then 'Tugas Belajar'
                               else '' end status_kel,
                              
                               j.nama_dati2 as kabupaten_tugas
                               from tbldasar a
                               left join tblsatminkal b on a.satminkal=b.kode
                               left join tblstatus_penyuluh c on a.status='0' and a.status_kel=c.kode
                        
                             left join tblbakor i on a.kode_kab='2' and a.satminkal=i.kode_prop and a.unit_kerja=i.id_bakor
                                left join tbldati2 j on a.kabupaten_tugas1=j.id_dati2
                                left join tbldati2 l on a.kabupaten_tugas2=l.id_dati2
                                left join tbldati2 m on a.kabupaten_tugas3=m.id_dati2
                              
        where a.id = '" . $id . "'");
        $row = $query->getRow();
        return json_encode($row);
    }

    public function getPropvinsi()
    {
        $query = $this->db->query("select * from tblpropinsi ORDER BY nama_prop ASC");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getTugas($kode_prop)
    {
        $query = $this->db->query("SELECT * FROM tbldati2 a LEFT JOIN tbldasar_p3k b ON b.dati2 = a.id_dati2 where id_prop=" . $kode_prop);
        $row   = $query->getResultArray();
        return $row;
    }

    public function getBpp($kode_kab)
    {
        $query = $this->db->query("select a.id, a.nama_bpp, a.satminkal, a.kecamatan, b.deskripsi from tblbpp a 
        left join tbldaerah b on b.id_daerah=a.kecamatan
        where a.satminkal ='" . $kode_kab . "' order by nama_bpp");
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
        $query = $this->db->query("select * from tblsekolah where urut !='14' and urut !='1' and urut !='2' order by urut");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getBapel($kode_kab)
    {
        $query = $this->db->query("select * from tblbapel a 
    left join tbldasar_p3k b on b.dati2=a.kabupaten where kabupaten='$kode_kab'");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getDetailEdit($id)
    {
        $query = $this->db->query("select a.id, a.nip, a.nama, a.gelar_dpn, a.gelar_blk, a.tgl_lahir, a.tempat_lahir, a.jenis_kelamin,
        status_kel, a.agama, a.gol_darah, a.keahlian, a.satminkal, a.kode_kab, a.tgl_skcpns, a.peng_kerja_thn, a.peng_kerja_bln,
        a.alamat, a.dati2, a.kodepos, a.kode_prop, a.telp, a.hp, a.email, a.status, a.gol, a.jabatan, a.tgltmtgol, a.batas_pensiun,
        a.tgl_pensiun, a.bulan_pensiun, a.tahun_pensiun, a.tgl_update, a.unit_kerja, a.tempat_tugas, a.kabupaten_tugas1, a.kabupaten_tugas2,
        a.kabupaten_tugas3,  a.tgl_sk_luh, a.bln_sk_luh, a.thn_sk_luh, a.tingkat_pendidikan, a.bidang_pendidikan,
        a.mapping, a.jurusan, a.nama_sekolah, a.noktp, 
       
                                 j.nama_dati2 as kabupaten_tugas,
                                case a.status
                                when '0' then 'Aktif'
                                when '6' then 'Tugas Belajar'
                                else '' end status_kel,
                                
                                j.nama_dati2 as kabupaten_tugas
                                from tbldasar a
                                left join tblsatminkal b on a.satminkal=b.kode
                                left join tblstatus_penyuluh c on a.status='0' and a.status_kel=c.kode
                                
                               left join tblbakor i on a.kode_kab='2' and a.satminkal=i.kode_prop and a.unit_kerja=i.id_bakor
                                left join tbldati2 j on a.kabupaten_tugas1=j.id_dati2
                                left join tbldati2 l on a.kabupaten_tugas2=l.id_dati2
                                left join tbldati2 m on a.kabupaten_tugas3=m.id_dati2
                               
        where a.id = '" . $id . "'");
		
        $row = $query->getRow();
        return json_encode($row);
    }
}
