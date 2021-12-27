<?php

namespace App\Controllers\profil;

use App\Controllers\BaseController;
use App\Models\penyuluh\PenyuluhPNSKecModel;

class PenyuluhKec extends BaseController
{
    protected $session;
    function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
    }

    public function detail($nip)
    {
        $penyuluhmodel = new PenyuluhPNSKecModel();
        $dtpenyuluh = $penyuluhmodel->getDetailPenyuluhPNSKecByNIK($nip);
        $data = [
            'title' => 'Profil penyuluh',
            'dt' => $dtpenyuluh
        ];

        //dd($data);

        return view('profil/profilpenyuluhkec', $data);
    }
}
