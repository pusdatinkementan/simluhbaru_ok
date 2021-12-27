<?php

namespace App\Controllers\validasi;

use App\Controllers\BaseController;
use App\Models\ValidasiPoktanModel;

class Poktan extends BaseController
{
    protected $model;


    public function __construct()
    {
        $this->session = service('session');
        $this->config = config('Auth');
        $this->auth = service('authentication');
        $this->model = new ValidasiPoktanModel();
    }

    public function index()
    {
        if (session()->get('username') == "") {
            return redirect()->to('login');
        }

        $data = [
            'title' => 'Validasi Data Poktan',
        ];

        return view('validasi/indexpoktan', $data);
    }

    public function bantuan()
    {
        if (session()->get('username') == "") {
            return redirect()->to('login');
        }


        $data = [
            'title' => 'Validasi Poktan',

        ];

        return view('validasi/gapoktansk', $data);
    }
}
