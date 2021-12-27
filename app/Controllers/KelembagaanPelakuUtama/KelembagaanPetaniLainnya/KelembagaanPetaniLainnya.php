<?php

namespace App\Controllers\KelembagaanPelakuUtama\KelembagaanPetaniLainnya;

use App\Controllers\BaseController;
use App\Models\KelembagaanPelakuUtama\KelembagaanPetaniLainnya\KelembagaanPetaniLainnyaModel;
use App\Models\KelembagaanPelakuUtama\KelembagaanPetaniLainnya\ListKEP2LModel;
use App\Models\KodeWilayah\KodeWilModel2;

class KelembagaanPetaniLainnya extends BaseController
{   
    protected $model;
    public function __construct()
    {
        $this->model = new ListKEP2LModel();
    }
    public function kelembagaanpetanilainnya()
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
  
        $kode_model = new KodeWilModel2; 
        $kelembagaanpetanilainnya_model = new KelembagaanPetaniLainnyaModel();
        $kelembagaanpetanilainnya_data = $kelembagaanpetanilainnya_model->getKelembagaanPetaniLainnyaTotal($this->session->get('kodebapel'));
        $kode_data = $kode_model->getKodeWil2(session()->get('kodebapel'));
        $data = [

            'nama_kabupaten' => $kelembagaanpetanilainnya_data['nama_kab'],
            'jum_poktan' => $kelembagaanpetanilainnya_data['jum_poktan'],
            'tabel_data' => $kelembagaanpetanilainnya_data['table_data'],
            'title' => 'Kelompok Petani Lainnya',
            'name' => 'Kelompok Petani Lainnya',
            'kode_prop' => $kode_data['kode_prop'],
           
        ];

        return view('KelembagaanPelakuUtama/KelembagaanPetaniLainnya/kelembagaanpetanilainnya', $data);
    }

    public function listkep2l()
    {
        $get_param = $this->request->getGet();
        $kode_kec = $get_param['kode_kec'];
        $kodewil_model = new KodeWilModel2();
        $listkep2l_model = new ListKEP2LModel();
        $desa = $listkep2l_model->getDesa($kode_kec);
        $komoditas = $listkep2l_model->getKomoditas();
        $kode_data = $kodewil_model->getKodeWil($kode_kec);
        $listkep2l_data = $listkep2l_model->getListKEP2LTotal($kode_kec);
        $kode = $kodewil_model->getKodeWil2(session()->get('kodebapel'));


        $data = [
            
            'nama_kecamatan' => $listkep2l_data['nama_kec'],
            'jum' => $listkep2l_data['jum'],
            'tabel_data' => $listkep2l_data['table_data'],
            'title' => 'List Kelompok Petani Lainnya',
            'name' => 'List Kelompok Petani Lainnya',
            'desa' => $desa,
            'komoditas' => $komoditas,
            'kode_kec' => $kode_kec,
            'kode_prop' => $kode_data['kode_prop'],
            'kode_kab' => $kode['kode_kab'],

        ];

        return view('KelembagaanPelakuUtama/KelembagaanPetaniLainnya/listkep2l', $data);
    }

    public function save()
    {
        try{
        $res = $this->model->save([
            'kode_kec' => $this->request->getPost('kode_kec'),
            'kode_prop' => $this->request->getPost('kode_prop'),
            'kode_kab' => $this->request->getPost('kode_kab'),
            'kode_desa' => $this->request->getPost('kode_desa'),
            'no_sk_cpcl' => $this->request->getPost('no_sk_cpcl'),
            'no_urut_sk' => $this->request->getPost('no_urut_sk'),
            'nama_poktan' => $this->request->getPost('nama_poktan'),
            'nama_ketua' => $this->request->getPost('nama_ketua'),
            'nama_sekretaris' => $this->request->getPost('nama_sekretaris'),
            'nama_bendahara' => $this->request->getPost('nama_bendahara'),
            'alamat_sekretariat' => $this->request->getPost('alamat_sekretariat'), 
            'tanggal_bentuk' => $this->request->getPost('tanggal_bentuk'),
            'kode_komoditas_hor' => $this->request->getPost('kode_komoditas_hor'),
            'status' => $this->request->getPost('status'),
        ]);
        if($res == false){
                $data = [
                    "value" => false,
                    "message" => 'data tidak lengkap'
                ];
            }else{
                $data = [
                    "value" => true
                ];
            }
            return json_encode($data);
        } catch (\Exception $e){
            $data = [
                "value" => false,
                "message" => $e->getMessage() 
            ];
            return json_encode($data);
        }
        // return redirect()->to('/listpoktan?kode_kec=' . $this->request->getPost('kode_kec'));
    }
    public function edit($id_p2l)
    {
        $kep2l = $this->model->getDataById($id_p2l);
        echo $kep2l;
    }
    public function update($id_p2l)
    {
        
        $kode_prop = $this->request->getPost('kode_prop');
        $kode_kec = $this->request->getPost('kode_kec');
        $kode_kab = $this->request->getPost('kode_kab');
        $kode_desa = $this->request->getPost('kode_desa');
        $no_sk_cpcl = $this->request->getPost('no_sk_cpcl');
        $no_urut_sk = $this->request->getPost('no_urut_sk');
        $nama_poktan = $this->request->getPost('nama_poktan');
        $nama_ketua = $this->request->getPost('nama_ketua');
        $nama_bendahara = $this->request->getPost('nama_bendahara');
        $nama_sekretaris = $this->request->getPost('nama_sekretaris');
        $alamat_sekretariat = $this->request->getPost('alamat_sekretariat');  
        $tanggal_bentuk = $this->request->getPost('tanggal_bentuk');
        $kode_komoditas_hor = $this->request->getPost('kode_komoditas_hor');
        $status = $this->request->getPost('status');

       
        $this->model->save([
            'id_p2l' => $id_p2l,
            'kode_kec' => $kode_kec,
            'kode_prop' => $kode_prop,
            'kode_kab' => $kode_kab,
            'kode_desa' => $kode_desa,
            'no_sk_cpcl' => $no_sk_cpcl,
            'no_urut_sk' => $no_urut_sk,
            'nama_poktan' => $nama_poktan,
            'nama_ketua' => $nama_ketua,
            'nama_bendahara' => $nama_bendahara,
            'nama_sekretaris' => $nama_sekretaris,
            'alamat_sekretariat' => $alamat_sekretariat,
            'tanggal_bentuk' => $tanggal_bentuk,
            'kode_komoditas_hor' => $kode_komoditas_hor,
            'status' => $status,
         
        ]);

        //session()->setFlashdata('pesan', 'Data berhasil diubah');

    }
    public function delete($id_p2l)
    {
        $this->model->delete($id_p2l);
       // return redirect()->to('/gapoktan');
    }
}
