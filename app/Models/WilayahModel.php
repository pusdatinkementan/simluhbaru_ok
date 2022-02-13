<?php

namespace App\Models;

use CodeIgniter\Model;
use \Config\Database;

class WilayahModel extends Model
{

    /*
    Provinsi
    */
    public function saveProvinsi($data)
    {
        $db = db_connect();
        $builder = $db->table('tblpropinsi');
        $builder->insert($data);
    }

    public function updateProvinsi($id, $data)
    {
        $db = db_connect();
        $builder = $db->table('tblpropinsi');
        $builder->where('id_prop', $id)->update($data);
    }

    public function deleteProv($id)
    {
        $db = db_connect();
        $builder = $db->table('tblpropinsi');
        $builder->where('id_prop', $id)->delete();
    }

    public function getProv()
    {
        $query = $this->db->query("SELECT * FROM tblpropinsi ORDER BY id_prop");
        $row = $query->getResultArray();
        return $row;
    }

    public function getProvById($id)
    {
        $query = $this->db->query("SELECT * FROM tblpropinsi WHERE id_prop = " . $id);
        $row = $query->getRowArray();
        return json_encode($row);
    }

    /*
    Kabupaten
    */

    public function saveKab($data)
    {
        $db = db_connect();
        $builder = $db->table('tbldati2');
        $builder->insert($data);
    }

    public function updateKab($id, $data)
    {
        $db = db_connect();
        $builder = $db->table('tbldati2');
        $builder->where('id_dati2', $id)->update($data);
    }

    public function deleteKab($id)
    {
        $db = db_connect();
        $builder = $db->table('tbldati2');
        $builder->where('id_dati2', $id)->delete();
    }

    public function getKabByIdProv($id)
    {
        $query = $this->db->query("SELECT * FROM tbldati2 WHERE id_prop = '" . $id . "' and id_dati2 NOT IN ('" . $id . "') ORDER BY id_dati2");
        $row = $query->getResultArray();

        $queryprov =  $this->db->query("SELECT * FROM tblpropinsi WHERE id_prop = " . $id);
        $row2 = $queryprov->getResultArray();

        $data = [
            'kab' => $row,
            'nmprov' => $row2
        ];
        //dd($data);
        return $data;
    }

    /* Kecamatan */

    public function getKecByIdKab($id)
    {

        $query = $this->db->query("SELECT * FROM `tbldaerah` left join tbldati2 on tbldaerah.id_dati2 = tbldati2.id_dati2 LEFT JOIN tblpropinsi on tbldati2.id_prop = tblpropinsi.id_prop where tbldaerah.id_dati2 = '" . $id . "'");
        $row = $query->getResultArray();
        // dd($row);
        return $row;
    }

    public function saveKec($data)
    {
        $db = db_connect();
        $builder = $db->table('tbldaerah');
        $builder->insert($data);
    }

    public function getKecById($id)
    {
        $query = $this->db->query("SELECT * FROM tbldaerah WHERE id_daerah = '" . $id . "'");
        $row = $query->getRowArray();
        return json_encode($row);
    }

    public function updateKec($id, $data)
    {
        $db = db_connect();
        $builder = $db->table('tbldaerah');
        $builder->where('id', $id)->update($data);
    }

    public function deleteKec($id)
    {
        $db = db_connect();
        $builder = $db->table('tbldaerah');
        $builder->where('id_daerah', $id)->delete();
    }

    /* Desa */

    public function getDesaByIdKec($id)
    {

        $query = $this->db->query("SELECT tblpropinsi.nama_prop,tbldati2.nama_dati2,tbldaerah.deskripsi, tbldesa.* FROM `tbldesa` left join tblpropinsi on tbldesa.id_prop = tblpropinsi.id_prop left JOIN tbldaerah on tbldesa.id_daerah = tbldaerah.id_daerah LEFT join tbldati2 on tbldesa.id_dati2 = tbldati2.id_dati2 where tbldesa.id_daerah = '" . $id . "'");
        $row = $query->getResultArray();
        // dd($row);
        return $row;
    }

    public function saveDesa($data)
    {
        $db = db_connect();
        $builder = $db->table('tbldesa');
        $builder->insert($data);
    }

    public function getDesaById($id)
    {
        $query = $this->db->query("SELECT * FROM tbldesa WHERE id = '" . $id . "'");
        $row = $query->getRowArray();
        return json_encode($row);
    }

    public function updateDesa($id, $data)
    {
        $db = db_connect();
        $builder = $db->table('tbldesa');
        $builder->where('id', $id)->update($data);
    }

    public function deleteDesa($id)
    {
        $db = db_connect();
        $builder = $db->table('tbldesa');
        $builder->where('id', $id)->delete();
    }

    public function getKab($id)
    {

        $query = $this->db->query("SELECT * FROM tbldati2 WHERE id_dati2 LIKE '" . $id . "%' ORDER BY id_dati2");
        $row = $query->getResultArray();

        return $row;
    }

    public function getKec($id)
    {
        $query = $this->db->query("SELECT * FROM tbldaerah WHERE id_daerah LIKE '" . $id . "%' ORDER BY id_daerah");
        $row = $query->getResultArray();
        return $row;
    }

    public function getDesa($id)
    {
        $query = $this->db->query("SELECT * FROM tbldesa WHERE id_desa LIKE '" . $id . "%' ORDER BY id_desa");
        $row = $query->getResultArray();
        return $row;
    }
}
