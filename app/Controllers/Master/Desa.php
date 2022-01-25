<?php

namespace App\Controllers\master;

use App\Controllers\BaseController;
use App\Models\WilayahModel;

class Desa extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new WilayahModel();
    }

    public function index($id)
    {
        if (session()->get('username') == "") {
            return redirect()->to('login');
        }
        //$penyuluhModel = new MasterModel();
        $kec = $this->model->getDesaByIdKec($id);

        //  dd($kec);

        $data = [
            'title' => 'Desa',
            'dtdesa' => $kec
        ];

        // dd($data);

        return view('master/desa', $data);
    }

    public function save()
    {
        try {
            $data = [
                'id_prop' => $this->request->getPost('idprov'),
                'id_dati2' => $this->request->getPost('idkab'),
                'id_daerah' => $this->request->getPost('idkec'),
                'id_desa' => $this->request->getPost('iddesa'),
                'nm_desa' => $this->request->getPost('nmdesa')
            ];

            $this->model->saveDesa($data);
            return 'success';
        } catch (\Exception $e) {
            // print_r($e);
            return 'error';
        }
    }

    public function edit($id)
    {
        $res = $this->model->getDesaById($id);
        echo $res;
    }

    public function update($id)
    {
        try {
            $data = [
                'id_desa' => $this->request->getPost('iddesa'),
                'nm_desa' => $this->request->getPost('nmdesa')
            ];

            $this->model->updateDesa($id, $data);
            return 'success';
        } catch (\Exception $e) {
            return 'error';
        }
    }

    public function delete($id)
    {
        try {
            $this->model->deleteDesa($id);
            return 'success';
        } catch (\Exception $e) {
            return 'error';
        }
    }
}
