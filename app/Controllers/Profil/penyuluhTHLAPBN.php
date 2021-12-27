<?php

namespace App\Controllers\profil;

use App\Controllers\BaseController;
use App\Models\penyuluh\PenyuluhTHLAPBNModel;

class PenyuluhTHLAPBN extends BaseController
{
    protected $session;
    function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
    }

    public function detail($nik)
    {
        $penyuluhmodel = new PenyuluhTHLAPBNModel();
        $dtpenyuluh = $penyuluhmodel->getDetailPenyuluhTHLAPBNByNIK($nik);
        $data = [
            'title' => 'Profil penyuluh',
            'dt' => $dtpenyuluh
        ];

        //dd($data);

        return view('profil/profilpenyuluhthlapbn', $data);
    }
}
