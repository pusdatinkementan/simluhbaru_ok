<?php

namespace App\Controllers\master;

use App\Controllers\BaseController;
use App\Models\WilayahModel;

class Provinsi extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new WilayahModel();
    }

    public function index()
    {
        if (session()->get('username') == "") {
            return redirect()->to('login');
        }
        //$penyuluhModel = new MasterModel();
        $prov = $this->model->getProv();

        //dd($jabatan);

        $data = [
            'title' => 'Provinsi',
            'dt' => $prov
        ];

        return view('master/provinsi', $data);
    }

    public function save()
    {
        try {
            $this->model->saveProvinsi([
                'id_prop' => $this->request->getPost('idprov'),
                'nama_prop' => $this->request->getPost('prov'),
            ]);
            return 'success';
        } catch (\Exception $e) {
            return 'error';
        }
    }

    public function edit($id)
    {
        $res = $this->model->getProvById($id);
        echo $res;
    }

    public function update($id)
    {
        try {
            $data = [
                'id_prop' => $this->request->getPost('idprov'),
                'nama_prop' => $this->request->getPost('prov')
            ];

            $this->model->updateProvinsi($id, $data);
            return 'success';
        } catch (\Exception $e) {
            return 'error';
        }
    }

    public function delete($id)
    {
        try {
            $this->model->deleteProv($id);
            return 'success';
        } catch (\Exception $e) {
            return 'error';
        }
    }
}
