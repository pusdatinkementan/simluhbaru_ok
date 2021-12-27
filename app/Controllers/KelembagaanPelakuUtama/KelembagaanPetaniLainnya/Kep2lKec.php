<?php

namespace App\Controllers\KelembagaanPelakuUtama\KelembagaanPetaniLainnya;
use App\Controllers\BaseController;
use App\Models\KelembagaanPelakuUtama\KelembagaanPetaniLainnya\Kep2lKecModel;

class Kep2lKec extends BaseController
{
    public function kep2lkec()
    {
       
        $kep2lkec_model = new Kep2lKecModel();
        $kep2lkec_data = $kep2lkec_model->getKep2lKecTotal(session()->get('kodebpp'));

        $data = [
            'jum' => $kep2lkec_data['jum'],
            'nama_bp3k' => $kep2lkec_data['nama_bpp'],
           'tabel_data' => $kep2lkec_data['table_data'],
            'title' => 'Gapoktan Kecamatan',
            'name' => 'Gapoktan Kecamatan' 
        ];

        return view('KelembagaanPelakuUtama/KelembagaanPetaniLainnya/kep2lkec', $data);
    }
  
    
}