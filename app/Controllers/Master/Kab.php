<?php

namespace App\Controllers\master;

use App\Controllers\BaseController;
use App\Models\WilayahModel;

class Kab extends BaseController
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
        $prov = $this->model->getKabByIdProv($id);

        //dd($jabatan);

        $data = [
            'title' => 'Kabupaten',
            'dtkab' => $prov['kab'],
            'nmprov' => $prov['nmprov']
        ];

        // dd($data);

        return view('master/kab', $data);
    }

    public function save()
    {
        try {
            $this->model->saveKab([
                'id_prop' => $this->request->getPost('idprov'),
                'id_dati2' => $this->request->getPost('idkab'),
                'nama_dati2' => $this->request->getPost('nmkab'),
            ]);
            return 'success';
        } catch (\Exception $e) {
            return 'error';
        }
    }

    public function edit($id)
    {
        $res = $this->model->getKab($id);
        $json = json_encode($res);
        echo $json;
    }

    public function update($id)
    {
        try {
            $data = [
                'id_dati2' => $this->request->getPost('idkab'),
                'nama_dati2' => $this->request->getPost('nmkab')
            ];

            $this->model->updateKab($id, $data);
            return 'success';
        } catch (\Exception $e) {
            return 'error';
        }
    }

    public function delete($id)
    {
        try {
            $this->model->deleteKab($id);
            return 'success';
        } catch (\Exception $e) {
            return 'error';
        }
    }
}
