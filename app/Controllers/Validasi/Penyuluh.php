<?php

namespace App\Controllers\validasi;

use App\Controllers\BaseController;
use App\Models\ValidasiModel;
use App\Models\penyuluh\PenyuluhPNSModel;


class Penyuluh extends BaseController
{
    protected $model1;
    protected $model2;

    public function __construct()
    {
        $this->session = service('session');
        $this->config = config('Auth');
        $this->auth = service('authentication');
        $this->model1 = new ValidasiModel();
        $this->model2 = new PenyuluhPNSModel();
    }

    public function index()
    {
        if (session()->get('username') == "") {
            return redirect()->to('login');
        }

        $data = [
            'title' => 'Validasi Data Penyuluh',
        ];

        return view('validasi/indexpenyuluh', $data);
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

    public function nohp()
    {
        if (session()->get('username') == "") {
            return redirect()->to('login');
        }
        //$penyuluhModel = new MasterModel();
        $dataPenyuluh = $this->model1->getAllNoHpEmpty();

        //dd($jabatan);

        $data = [
            'title' => 'Validasi Penyuluh',
            'dt' => $dataPenyuluh['table_data']
        ];

        return view('validasi/penyuluhnohp', $data);
    }

    public function doeditnohp($idpns)
    {
        $this->model2->save([
            'id' => $idpns,
            'hp' => $this->request->getPost('nohp')
        ]);
    }

    public function nip()
    {
        if (session()->get('username') == "") {
            return redirect()->to('login');
        }
        //$penyuluhModel = new MasterModel();
        $dataPenyuluh = $this->model1->getAllNipUnmatch();

        //dd($jabatan);

        $data = [
            'title' => 'Validasi Penyuluh',
            'dt' => $dataPenyuluh['table_data']
        ];

        return view('validasi/penyuluhnip', $data);
    }

    public function doeditnip($idpns)
    {
        $this->model2->save([
            'id' => $idpns,
            'nip' => $this->request->getPost('nip')
        ]);
    }
}
