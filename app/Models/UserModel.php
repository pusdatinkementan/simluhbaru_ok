<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

    // protected $table      = 'penyuluh';
    protected $table = 'tbluser';
    protected $column_order = ['id', 'username', 'password', 'name', 'status', 'lastlogin', 'idprop', 'kodebakor', 'kodebapel', 'kode_lembaga', 'kodebpp', 'p_oke'];
    protected $column_search = ['name', 'username'];
    protected $order = ['id' => 'ASC'];
    protected $request;
    protected $db;
    protected $dt;

    protected $returnType     = 'array';
    //protected $useSoftDeletes = true;

    protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function __construct()
    {
        parent::__construct();
        $this->db = db_connect();
        //$this->request = $request;
        $this->dt = $this->db->table($this->table);
    }

    private function getDatatablesQuery($request)
    {
        $this->request = $request;
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if ($this->request->getPost('order')) {
            $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }

    public function getDatatables($request)
    {
        $this->request = $request;
        $this->getDatatablesQuery($request);
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    public function countFiltered($request)
    {
        $this->request = $request;
        $this->getDatatablesQuery($request);
        return $this->dt->countAllResults();
    }

    public function countAll($request)
    {
        $this->request = $request;
        $tbl_storage = $this->db->table($this->table);
        return $tbl_storage->countAllResults();
    }
}
