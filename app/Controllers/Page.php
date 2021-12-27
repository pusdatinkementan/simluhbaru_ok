<?php

namespace App\Controllers;

use App\Models\LembagaModel;

class Page extends BaseController
{
    protected $session;
    protected $modelLembaga;

    function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
        $this->modelLembaga = new LembagaModel();
    }

    public function dashboard()
    {
        if (session()->get('username') == "") {
            return redirect()->to('login');
        }

        $lembagaModel = new LembagaModel();

        $profilAllBpp = $lembagaModel->getKoordinatBpp();
        // $lat = explode(',', $profilAllBpp[0]['koordinat_lokasi_bpp']);
        // echo $lat[0];
        // dd($profilAllBpp);

        $data = [
            'title' => 'Dashboard',
            'name' => 'dashboard',
            'profilbpp' => $profilAllBpp
        ];

        return view('dashboard', $data);
    }

    public function profil()
    {
        // echo "Welcome back, " . $this->session->get('email');

        $data = [
            'title' => 'Profil Lembaga',
            'name' => 'Adi'
        ];

        return view('profillembaga', $data);
    }

    public function penyuluh()
    {

        $data = [
            'title' => 'Profil penyuluh',
            'name' => 'Adi'
        ];

        return view('profilpenyuluh', $data);
    }
}
