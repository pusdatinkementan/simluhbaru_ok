<?php

namespace App\Controllers\KelembagaanPenyuluhan\Kabupaten;

use App\Controllers\BaseController;
use App\Models\KelembagaanPenyuluhan\Kabupaten\KabupatenModel;

class Kabupaten extends BaseController
{
    protected $session;

    function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
    }

    public function kab()
    {

        $kab_model = new KabupatenModel;
        $kab_data = $kab_model->getKabTotal($this->session->get('kodebapel'));

        $data = [
            // 'jumpns' => $kab_data['jumpns'],
            'nama_kabupaten' => $kab_data['nama_kab'],
            'tabel_data' => $kab_data['table_data'],
            'title' => 'Kabupaten',
            'name' => 'Kabupaten'
        ];

        return view('KelembagaanPenyuluhan/Kabupaten/kabupaten', $data);
    }

    // public function listdesa()
    // {

    //     $data = [


    //         'name' => 'Desa'
    //     ];
    //     return view('KelembagaanPenyuluhan/Desa/listdesa', $data);
    // }
}
