<?php

namespace App\Controllers\KelembagaanPelakuUtama\KelembagaanEkonomiPetani;
use App\Controllers\BaseController;
use App\Models\KelembagaanPelakuUtama\KelembagaanEkonomiPetani\KepKecModel;

class KepKec extends BaseController
{
    public function kepkec()
    {
       
        $kepkec_model = new KepKecModel();
        $kepkec_data = $kepkec_model->getKepKecTotal(session()->get('kodebpp'));

        $data = [
            'jum' => $kepkec_data['jum'],
            'nama_bp3k' => $kepkec_data['nama_bpp'],
           'tabel_data' => $kepkec_data['table_data'],
            'title' => 'Gapoktan Kecamatan',
            'name' => 'Gapoktan Kecamatan' 
        ];

        return view('KelembagaanPelakuUtama/KelembagaanEkonomiPetani/kepkec', $data);
    }
  
    
}