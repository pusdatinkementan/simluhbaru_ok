<?php

namespace App\Controllers\KelembagaanPenyuluhan\Provinsi;

use App\Controllers\BaseController;
use App\Models\KelembagaanPenyuluhan\Provinsi\ProvModel;

class Provinsi extends BaseController
{
    protected $session;

    function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
    }

    public function prov()
    {
        // $get_param = $this->request->getGet();
        // $kode_prop = $get_param['kode_prop'];
        $prov_model = new ProvModel;
        $prov_data = $prov_model->getProv(session()->get('kodebakor'));

        $data = [
            // 'jumpns' => $kab_data['jumpns'],
            'nama_prop' => $prov_data['nama_prop'],
            'tabel_data' => $prov_data['table_data'],
            'title' => 'Provinsi',
            'name' => 'Provinsi'
        ];

        return view('KelembagaanPenyuluhan/Provinsi/provinsi', $data);
    }
}
