<?php

namespace App\Controllers\profil;

use App\Controllers\BaseController;
use App\Models\penyuluh\PenyuluhSwadayaKecModel;

class PenyuluhSwadayaKec extends BaseController
{
    protected $session;
    function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
    }

    public function detail($nik)
    {
        $penyuluhmodel = new PenyuluhSwadayaKecModel();
        $dtpenyuluh = $penyuluhmodel->getDetailPenyuluhSwadayaKecByNIK($nik);
        $data = [
            'title' => 'Profil penyuluh',
            'dt' => $dtpenyuluh
        ];

        //dd($data);

        return view('profil/profilpenyuluhswadayakec', $data);
    }
}
