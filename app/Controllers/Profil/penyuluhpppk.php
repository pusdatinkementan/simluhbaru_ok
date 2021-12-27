<?php

namespace App\Controllers\profil;

use App\Controllers\BaseController;
use App\Models\penyuluh\PenyuluhPPPKModel;

class PenyuluhPPPK extends BaseController
{
    protected $session;
    function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
    }

    public function detail($nik)
    {
        $penyuluhmodel = new PenyuluhPPPKModel();
        $dtpenyuluh = $penyuluhmodel->getDetailPenyuluhPPPKByNIK($nik);
        $data = [
            'title' => 'Profil penyuluh',
            'dt' => $dtpenyuluh
        ];

        //dd($data);

        return view('profil/profilpenyuluhpppk', $data);
    }
}
