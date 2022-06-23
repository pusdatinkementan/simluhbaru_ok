<?php

namespace App\Models\KelembagaanPelakuUtama\Gapoktan;

use CodeIgniter\Model;
use \Config\Database;

class ListGapoktanDesaModel extends Model
{

    protected $table      = 'tb_poktan';
    protected $primaryKey = 'id_poktan';
    protected $allowedFields = [
        'kode_prop', 'kode_kab', 'id_gap', 'noreg', 'kode_kec', 'kode_desa', 'nama_poktan', 'ketua_poktan', 'alamat',
        'simluh_kelas_kemampuan', 'simluh_tahun_tap_kelas', 'simluh_tahun_bentuk', 'status', 'simluh_jenis_kelompok'
    ];

    protected $useTimestamps = false;

    public function getListGapoktanDesaTotal($kode_desa, $kode_gap)
    {
        $db = Database::connect();
        $query = $db->query("SELECT b.id_daerah as kodekec, b.nm_desa AS nama_desa, a.nama_gapoktan AS nama_gap FROM tb_gapoktan a 
        LEFT JOIN tbldesa b ON a.kode_desa = b.id_desa WHERE id_desa='" . $kode_desa . "'");
        $row   = $query->getRow();

        $query2   = $db->query("SELECT a.id_poktan,a.id_gap,d.nama_gapoktan,a.kode_desa,a.kode_kec,a.nama_poktan,a.ketua_poktan,a.jum_anggota,a.alamat, b.nm_desa, c.jum, a.simluh_jenis_kelompok
                                FROM tb_poktan a
                                LEFT JOIN tbldesa b ON a.kode_desa=b.id_desa 
                                LEFT JOIN(SELECT id_poktan, count(id_poktan) AS jum FROM tb_poktan_anggota GROUP BY id_poktan) c on a.id_poktan=c.id_poktan
                                LEFT JOIN tb_gapoktan d ON a.id_gap = d.id_gap
                                WHERE a.kode_desa='" . $kode_desa . "' AND a.id_gap = '" . $kode_gap . "'
                                AND a.status != '2'
                                ORDER BY a.kode_desa");

        $results = $query2->getResultArray();

        $data =  [
            'nama_desa' => $row->nama_desa,
            'nama_gap' => $row->nama_gap,
            'kode_kec' => $row->kodekec,
            'table_data' => $results
        ];

        return $data;
    }

    public function getCountJumPoktan($idpoktan)
    {
        $query = $this->db->query("select id_poktan, count(id_poktan) as jum from tb_poktan_anggota where `id_poktan` = '" . $idpoktan . "' GROUP BY id_poktan");
        $row = $query->getResultArray();
        return $row;
    }

    public function getPoktanByDesa($kode_desa)
    {
        $query = $this->db->query("SELECT * 
        FROM tb_poktan WHERE kode_desa = '" . $kode_desa . "'  and (id_gap = '' OR id_gap IS NULL)
        ORDER BY kode_desa ASC");
        $row   = $query->getResultArray();
        return $row;
    }

    public function getDesa($kode_kec)
    {
        $query = $this->db->query("select * from tbldesa where id_daerah LIKE '" . $kode_kec . "%' ORDER BY nm_desa ASC");
        $row   = $query->getResultArray();
        return $row;
    }
    public function getDataById($id_poktan)
    {
        $query = $this->db->query("select * , b.deskripsi
                                from tb_poktan a
                                left join tbldaerah b on a.kode_kec=b.id_daerah
                                where id_poktan= '" . $id_poktan . "' 
                                ORDER BY nama_poktan ");
        $row = $query->getRow();
        return json_encode($row);
    }

    public function updateStatusGapDesa($id, $data)
    {
        $db = db_connect();
        $builder = $db->table('tb_poktan');
        $builder->where('id_poktan', $id)->update($data);
    }
}
