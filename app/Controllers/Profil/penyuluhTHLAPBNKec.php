<?php

namespace App\Controllers\profil;

use App\Controllers\BaseController;
use App\Models\penyuluh\PenyuluhTHLAPBNKecModel;

class PenyuluhTHLAPBNKec extends BaseController
{
    protected $session;
    function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
    }

    public function detail($no_peserta)
    {
        $penyuluhmodel = new PenyuluhTHLAPBNKecModel();
        $dtpenyuluh = $penyuluhmodel->getDetailPenyuluhTHLAPBNKecByNIK($no_peserta);
        $data = [
            'title' => 'Profil penyuluh',
            'dt' => $dtpenyuluh
        ];

        //dd($data);

        return view('profil/profilpenyuluhthlapbn', $data);
    }
}
