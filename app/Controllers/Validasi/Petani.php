<?php

namespace App\Controllers\validasi;

use App\Controllers\BaseController;
use App\Models\PetaniModel;

class Petani extends BaseController
{
    protected $model;


    public function __construct()
    {
        $this->session = service('session');
        $this->config = config('Auth');
        $this->auth = service('authentication');
        $this->model = new PetaniModel();
    }

    public function index()
    {
        if (session()->get('username') == "") {
            return redirect()->to('login');
        }

        $data = [
            'title' => 'Validasi Data Petani',
        ];

        return view('validasi/indexpetani', $data);
    }

    public function nik()
    {
        if (session()->get('username') == "") {
            return redirect()->to('login');
        }
        //$penyuluhModel = new MasterModel();
        $dataPenyuluh = $this->model1->getAllNikUnmatch();

        //dd($jabatan);

        $data = [
            'title' => 'Validasi Penyuluh',
            'dt' => $dataPenyuluh['table_data'],
            'jmlnoktp' => $dataPenyuluh['jmlnoktp']
        ];

        return view('validasi/penyuluh', $data);
    }

    /*
    Edited By: Asyhadi
    Function: doeditktp
    Desc: untuk mengubah / validasi KTP
    Date: 9 Desember 2021
    */
    public function doeditktp($idpns)
    {
        $this->model2->save([
            'id' => $idpns,
            'noktp' => $this->request->getPost('noktp')
        ]);
    }
}
