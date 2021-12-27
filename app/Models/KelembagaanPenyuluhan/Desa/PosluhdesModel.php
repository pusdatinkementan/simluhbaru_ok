<?php

namespace App\Models\KelembagaanPenyuluhan\Desa;

use CodeIgniter\Model;
use \Config\Database;

class PosluhdesModel extends Model
{
    protected $table      = 'tb_posluhdes';

    protected $primaryKey = 'idpos';

    protected $allowedFields = ['idpos', 'kode_prop', 'kode_kab', 'kode_kec', 'kode_desa', 'nama', 'alamat', 'tahun_berdiri', 'jum_anggota', 'ketua', 'sekretaris', 'bendahara', 'hp_ketua', 'penyuluh_swadaya'];
    //protected $primaryKey = 'id';


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

    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table($this->table);
    }

    public function getPosluhdesTotal($kode_kec)
    {
        $db = Database::connect();
        $query = $db->query("select deskripsi as nama_kec from tbldaerah where id_daerah='$kode_kec'");
        $row   = $query->getRow();
        $query2 = $db->query("SELECT count(idpos) as jum_kec FROM tb_posluhdes where kode_kec ='$kode_kec'");
        $row2   = $query2->getRow();
        $query3  = $db->query("select * ,a.idpos, b.nm_desa, c.nama as penyuluh_swadaya, a.idpos, a.kode_kec, a.kode_kab, a.tahun_berdiri, a.nama, a.alamat, b.id_desa, c.id_swa, c.noktp, d.deskripsi, b.id_daerah, b.id_dati2, b.id_prop 
                                from tb_posluhdes a
                                left join tbldesa b on a.kode_desa=b.id_desa
                                left join tbldasar_swa c on a.penyuluh_swadaya=c.id_swa 
                                left join tbldaerah d on a.kode_kec=d.id_daerah
                                where kode_kec='$kode_kec'
                                order by a.idpos DESC");
        $results = $query3->getResultArray();


        $data =  [
            'jum_kec' => $row2->jum_kec,
            'nama_kec' => $row->nama_kec,
            'table_data' => $results,
        ];

        return $data;
    }

    public function getPenyuluhSwadaya($kode_kec)
    {
        $query = $this->db->query("select id_swa, nama from tbldasar_swa where tempat_tugas LIKE '" . $kode_kec . "%' ORDER BY nama ASC");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getPosluhdes($idpos)
    {
        $query = $this->db->query("select *, b.deskripsi from tb_posluhdes a left join tbldaerah b on a.kode_kec=b.id_daerah where idpos = '" . $idpos . "' ORDER BY nama ASC");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getDesa($kode_kec)
    {
        $query = $this->db->query("select * from tbldesa where id_daerah LIKE '" . $kode_kec . "%' ORDER BY nm_desa ASC");
        $row   = $query->getResultArray();
        return $row;
    }

    public function ubah($data, $idpos)
    {
        return $this->builder->update($data, ['idpos' => $idpos]);
    }

    public function hapus($idpos)
    {
        return $this->builder->delete(['idpos' => $idpos]);
    }
}
