<?php

namespace App\Controllers\master;

use App\Controllers\BaseController;
use App\Models\WilayahModel;

class Wilayah extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new WilayahModel();
    }

    public function showProv()
    {

        $data['q'] = $this->model->getProv();
        // dd($data['q']);
        return $data['q'];
    }

    public function showKab($id)
    {

        $data['q'] = $this->model->getKab($id);

        foreach ($data['q'] as $dtKab) {

            echo '<option value="' . $dtKab['id_dati2'] . '">' . $dtKab['nama_dati2'] . '</option>';
        }
    }

    public function showKec($id)
    {

        $data['q'] = $this->model->getKec($id);

        foreach ($data['q'] as $dtKec) {

            echo '<option value="' . $dtKec['id_daerah'] . '">' . $dtKec['deskripsi'] . '</option>';
        }
    }

    public function showDesa($id)
    {

        $data['q'] = $this->model->getDesa($id);

        foreach ($data['q'] as $dtDesa) {

            echo '<option value="' . $dtDesa['id_desa'] . '">' . $dtDesa['nm_desa'] . '</option>';
        }
    }
}
