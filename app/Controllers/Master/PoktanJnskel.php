<?php

namespace App\Controllers\master;

use App\Controllers\BaseController;
use App\Models\KelembagaanPelakuUtama\KelompokTani\ListJnsKelModel;

class PoktanJnskel extends BaseController
{
    public function __construct()
    {
        $this->session = service('session');
        $this->config = config('Auth');
        $this->auth = service('authentication');
        $this->model = new ListJnsKelModel();
    }

    public function index()
    {

        if (session()->get('username') == "") {
            return redirect()->to('login');
        }

        $kegiatan = $this->model->getListJnsKel();

        $data = [
            'title' => 'Jenis Kelompok',
            'dtkegiatan' => $kegiatan
        ];

        return view('master/listjnskel', $data);
    }

    public function save()
    {
        try {
            $this->model->save([
                'jns_kel' => $this->request->getPost('jnskelompok'),
                'created_at' => $this->request->getPost('created_at'),
                'updated_at' => $this->request->getPost('created_at')
            ]);
            return 'success';
        } catch (\Exception $e) {
            return 'error';
        }
    }
    public function edit($id)
    {
        $data = $this->model->getDataById($id);
        echo $data;
    }

    public function update($id)
    {
        try {
            $data = $this->model->save([
                'id_kel' => $id,
                'jns_kel' => $this->request->getPost('jnskelompok'),
                'updated_at' => $this->request->getPost('updated_at')
            ]);
            return 'success';
        } catch (\Exception $e) {
            return 'error';
        }
    }
    public function delete($id)
    {
        try {
            $this->model->delete($id);
            return 'success';
        } catch (\Exception $e) {
            return 'error';
        }
    }
}
