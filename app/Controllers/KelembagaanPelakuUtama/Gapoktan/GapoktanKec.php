<?php

namespace App\Controllers\KelembagaanPelakuUtama\Gapoktan;
use App\Controllers\BaseController;
use App\Models\KelembagaanPelakuUtama\Gapoktan\GapoktanKecModel;

class GapoktanKec extends BaseController
{
    public function gapoktankec()
    {
       
        $gapoktankec_model = new GapoktanKecModel();
        $gapoktankec_data = $gapoktankec_model->getGapoktanKecTotal(session()->get('kodebpp'));

        $data = [
            'jum' => $gapoktankec_data['jum'],
            'nama_bp3k' => $gapoktankec_data['nama_bpp'],
           'tabel_data' => $gapoktankec_data['table_data'],
            'title' => 'Gapoktan Kecamatan',
            'name' => 'Gapoktan Kecamatan' 
        ];

        return view('KelembagaanPelakuUtama/Gapoktan/gapoktankec', $data);
    }
  
    
}