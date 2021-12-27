<?php

namespace App\Controllers\validasi;

use App\Controllers\BaseController;
use App\Models\ValidasiLembagaPenyuluhModel;

class Lembagapenyuluh extends BaseController
{
    protected $model;


    public function __construct()
    {
        $this->session = service('session');
        $this->config = config('Auth');
        $this->auth = service('authentication');
        // $this->model = new ValidasiLembagaPenyuluhModel();
    }

    public function index()
    {
        if (session()->get('username') == "") {
            return redirect()->to('login');
        }

        $data = [
            'title' => 'Validasi Data Kelembagaan Penyuluhan',
        ];

        return view('validasi/indexlembagapenyuluh', $data);
    }

    public function bpp()
    {
        if (session()->get('username') == "") {
            return redirect()->to('login');
        }


        $data = [
            'title' => 'Validasi BPP',

        ];

        return view('validasi/bpp', $data);
    }
}
