<?php

namespace App\Models\KelembagaanPelakuUtama\KelompokTani;

use CodeIgniter\Model;
use \Config\Database;

class ListBantuModel extends Model
{
    protected $table      = 'tb_bantuan';
    protected $primaryKey = 'idban';
    protected $allowedFields = ['id_poktan','volume','tahun','kegiatan','sk_cpl   '];


    protected $useTimestamps = false;
 
    public function getListBantu($id_poktan)
    {
        $db = Database::connect();
        $query = $db->query("select nama_poktan,kode_prop,kode_kab,kode_kec,kode_desa from tb_poktan where id_poktan='$id_poktan'");
        $row   = $query->getRow();
        
        
        
        $query3   = $db->query(" select * , b.idmast,b.idkeg,b.desckeg,b.iditem,b.subitem,b.kegiatan
                                from tb_bantuan a
                                left join mast_kegiatan b on a.kegiatan=b.kegiatan 
                                where id_poktan= $id_poktan
                                ORDER BY tahun");

        $results = $query3->getResultArray();


        $data =  [
            
            'nama_poktan' => $row->nama_poktan,
            'table_data' => $results,
           
          //  'jup' => $row4->jup
        ];

        return $data;
    }
    public function getDataById($id_poktan)
    {
        $query = $this->db->query("select * from tb_bantuan where idban= '" . $id_poktan . "' 
                                ORDER BY tahun ");
                                $row = $query->getRow();
                                return json_encode($row);
    }
   public function getKegiatan()
   {
        $query = $this->db->query("select * from mast_kegiatan");
                                $row2= $query->getResultArray();
                                return($row2);
    }
   }

