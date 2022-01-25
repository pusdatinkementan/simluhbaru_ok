<?php

namespace App\Controllers\master;

use App\Controllers\BaseController;
use App\Models\WilayahModel;

class Kec extends BaseController
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
        $kec = $this->model->getKecByIdKab($id);

        $data = [
            'title' => 'Kecamatan',
            'dtkec' => $kec
        ];

        return view('master/kec', $data);
    }

    public function saveKecamatan()
    {
        try {
            $data = [
                'id_prop' => $this->request->getPost('idprov'),
                'id_dati2' => $this->request->getPost('idkab'),
                'id_daerah' => $this->request->getPost('idkec'),
                'deskripsi' => $this->request->getPost('nmkec')
            ];
            // print_r($data);
            // die();
            $this->model->saveKec($data);
            return 'success';
        } catch (\Exception $e) {
            // print_r($e);
            return 'error';
        }
    }

    public function edit($id)
    {
        $res = $this->model->getKecById($id);
        echo $res;
    }

    public function update($id)
    {
        try {
            $data = [
                'id_daerah' => $this->request->getPost('idkec'),
                'deskripsi' => $this->request->getPost('nmkec')
            ];

            $this->model->updateKec($id, $data);
            return 'success';
        } catch (\Exception $e) {
            return 'error';
        }
    }

    public function delete($id)
    {
        try {
            $this->model->deleteKec($id);
            return 'success';
        } catch (\Exception $e) {
            return 'error';
        }
    }
}
