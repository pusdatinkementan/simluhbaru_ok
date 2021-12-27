<?php

namespace App\Controllers\profil;

use App\Controllers\BaseController;
use App\Models\penyuluh\PenyuluhTHLAPBDModel;

class PenyuluhTHLAPBD extends BaseController
{
    protected $session;
    function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
    }

    public function detail($nik)
    {
        $penyuluhmodel = new PenyuluhTHLAPBDModel();
        $dtpenyuluh = $penyuluhmodel->getDetailPenyuluhTHLAPBDByNIK($nik);
        $data = [
            'title' => 'Profil penyuluh',
            'dt' => $dtpenyuluh
        ];

        //dd($data);

        return view('profil/profilpenyuluhthlapbd', $data);
    }
}
