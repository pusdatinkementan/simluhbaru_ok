<?php

namespace App\Controllers\validasi;

use App\Controllers\BaseController;
use App\Models\ValidasiGapoktanModel;

class Gapoktan extends BaseController
{
    protected $model;


    public function __construct()
    {
        $this->session = service('session');
        $this->config = config('Auth');
        $this->auth = service('authentication');
        $this->model = new ValidasiGapoktanModel();
    }

    public function index()
    {
        if (session()->get('username') == "") {
            return redirect()->to('login');
        }

        $data = [
            'title' => 'Validasi Data Gapoktan',
        ];

        return view('validasi/indexgapoktan', $data);
    }

    public function nosk()
    {
        if (session()->get('username') == "") {
            return redirect()->to('login');
        }


        $data = [
            'title' => 'Validasi Penyuluh',

        ];

        return view('validasi/gapoktansk', $data);
    }
}
