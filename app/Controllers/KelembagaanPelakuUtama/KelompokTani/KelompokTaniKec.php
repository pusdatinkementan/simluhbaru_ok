<?php

namespace App\Controllers\KelembagaanPelakuUtama\KelompokTani;
use App\Controllers\BaseController;
use App\Models\KelembagaanPelakuUtama\KelompokTani\KelompokTaniKecModel;

class KelompokTaniKec extends BaseController
{
    public function kelompoktanikec()
    {
         $get_param = $this->request->getGet();
        if (empty(session()->get('status_user')) || session()->get('status_user') == '2') {
            $kode = '00';
        } elseif (session()->get('status_user') == '1') {
            $kode = session()->get('kodebakor');
        } elseif (session()->get('status_user') == '200') {
            $kode = session()->get('kodebapel');
        } elseif (session()->get('status_user') == '300') {
            $kode = session()->get('kodebpp');
        }
        $kelompoktanikec_model = new KelompokTaniKecModel();
        $kelompoktanikec_data = $kelompoktanikec_model->getKelompokTaniKecTotal(session()->get('kodebpp'));

        $data = [
            'jum' => $kelompoktanikec_data['jum'],
            'nama_bp3k' => $kelompoktanikec_data['nama_bpp'],
           'tabel_data' => $kelompoktanikec_data['table_data'],
            'title' => 'Kelompok Tani Kecamatan',
            'name' => 'Kelompok Tani Kecamatan' 
        ];

        return view('KelembagaanPelakuUtama/KelompokTani/kelompoktanikec', $data);
    }
  
    
}