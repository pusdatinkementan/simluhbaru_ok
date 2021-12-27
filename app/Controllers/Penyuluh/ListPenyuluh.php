<?php

namespace App\Controllers\Penyuluh;

use App\Controllers\BaseController;
use App\Models\PenyuluhModel;

class ListPenyuluh extends BaseController
{
    public function index()
    {
        $model = new PenyuluhModel();
    
        $data = [
            'title' => 'Daftar Penyuluh',
            'name' => 'Penyuluh'
        ];

        return view('profil/listpenyuluh', $data);
    }
}
