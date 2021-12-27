<?php

namespace App\Controllers\profil;

use App\Controllers\BaseController;
use App\Models\penyuluh\PenyuluhPPPKKecModel;

class PenyuluhPPPKKec extends BaseController
{
    protected $session;
    function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
    }

    public function detail($nip)
    {
        $penyuluhmodel = new PenyuluhPPPKKecModel();
        $dtpenyuluh = $penyuluhmodel->getDetailPenyuluhPPPKKecByNIK($nip);
        $data = [
            'title' => 'Profil penyuluh',
            'dt' => $dtpenyuluh
        ];

        //dd($data);

        return view('profil/profilpenyuluhpppkkec', $data);
    }
}
