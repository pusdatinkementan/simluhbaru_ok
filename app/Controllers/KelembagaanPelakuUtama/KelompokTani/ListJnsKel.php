<?php

namespace App\Controllers\KelembagaanPelakuUtama\KelompokTani;

use App\Controllers\BaseController;
use App\Models\KelembagaanPelakuUtama\KelompokTani\ListJnsKelModel;

class ListJnsKel extends BaseController
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
        $get_param = $this->request->getGet();

        $ip = $get_param['ip'];
        $list = $this->model->getJnsKelByPoktan($ip);
        $kelompok = $this->model->getListJnsKel();

        $data = [
            'tabel_data' => $list,
            'title' => 'List Jenis Kelompok Lainnnya',
            'id_poktan' => $ip,
            'dtkelompok' => $kelompok
        ];

        // dd($data);

        return view('KelembagaanPelakuUtama/KelompokTani/list_jenis_kelompok', $data);
    }
    public function save()
    {
        $data =  [
            'id_poktan' => $this->request->getPost('id_poktan'),
            'id_jns_kel' => $this->request->getPost('idkel'),
            'created_at' => $this->request->getPost('created_at'),
            'updated_at' => $this->request->getPost('created_at')
        ];

        try {
            $this->model->saveJnskel($data);
            return 'success';
        } catch (\Exception $e) {
            return 'error';
        }
        // return redirect()->to('/listpoktan?kode_kec=' . $this->request->getPost('kode_kec'));
    }
    public function edit($id)
    {
        $kel = $this->model->getDataByIdListKel($id);
        echo $kel;
    }

    public function update($id)
    {

        $data =  [
            'id_poktan' => $this->request->getPost('id_poktan'),
            'id_jns_kel' => $this->request->getPost('idkel'),
            'created_at' => $this->request->getPost('created_at'),
            'updated_at' => $this->request->getPost('created_at')
        ];

        try {
            $this->model->updateJnskel($id, $data);
            return 'success';
        } catch (\Exception $e) {
            return 'error';
        }
    }
    public function delete($id)
    {
        $this->model->deleteJnsKel($id);
        // return redirect()->to('/listpoktan');
    }
}
