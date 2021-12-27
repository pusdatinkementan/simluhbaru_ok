<?php

namespace App\Controllers\KelembagaanPelakuUtama\Gapoktan;

use App\Controllers\BaseController;
use App\Models\KelembagaanPelakuUtama\Gapoktan\GapoktanModel;
use App\Models\KelembagaanPelakuUtama\Gapoktan\ListGapoktanModel;
use App\Models\KodeWilayah\KodeWilModel2;

class Gapoktan extends BaseController
{
    
    protected $model;
    public function __construct()
    {
        $this->model = new ListGapoktanModel();
    }
    public function gapoktan()
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
        $gapoktan_model = new GapoktanModel;
        $gapoktan_data = $gapoktan_model->getGapoktanTotal($this->session->get('kodebapel'));
        $kode_data = $kode_model->getKodeWil2(session()->get('kodebapel'));
        
       

        $data = [

            'nama_kabupaten' => $gapoktan_data['nama_kab'],
            'jum_gapoktan' => $gapoktan_data['jum_gapoktan'],
            'tabel_data' => $gapoktan_data['table_data'],
            'title' => 'Gapoktan',
            'name' => 'Gapoktan',
            'kode_prop' => $kode_data['kode_prop'],
           
        ];

        return view('KelembagaanPelakuUtama/Gapoktan/gapoktan', $data);
    }
    public function listgapoktan()
    {
        
        $get_param = $this->request->getGet();
        $kode_kec = $get_param['kode_kec'];
        $listgapoktan_model = new ListGapoktanModel();
        $kodewil_model = new KodeWilModel2();
        $desa = $listgapoktan_model->getDesa($kode_kec);
        $listgapoktan_data = $listgapoktan_model->getListGapoktanTotal($kode_kec);
        $kode_data = $kodewil_model->getKodeWil($kode_kec);
        $usaha_tani = $listgapoktan_model->getUsahaTani();
        $usaha_olah = $listgapoktan_model->getUsahaOlah();

        $data = [

            'nama_kecamatan' => $listgapoktan_data['nama_kec'],
            'jum' => $listgapoktan_data['jum'],
            'tabel_data' => $listgapoktan_data['table_data'],
            'title' => 'List Gabungan Kelompok Tani',
            'name' => 'List Gabungan Kelompok Tani',
            'desa' => $desa,
            'kode_kec' => $kode_kec,
            'kode_prop' => $kode_data['kode_prop'],
            'usahatani' => $usaha_tani,
            'usahaolah' => $usaha_olah

          


        ];

        return view('KelembagaanPelakuUtama/Gapoktan/listgapoktan', $data);
    }
    public function save()
    {
        try{

        $res = $this->model->save([
            'kode_kec' => $this->request->getPost('kode_kec'),
            'kode_prop' => $this->request->getPost('kode_prop'),
            'kode_kab' => $this->request->getPost('kode_kab'),
            'kode_desa' => $this->request->getPost('kode_desa'),
            'ketua_gapoktan' => $this->request->getPost('ketua_gapoktan'),
            'nama_gapoktan' => $this->request->getPost('nama_gapoktan'),
            'alamat' => $this->request->getPost('alamat'),
            'simluh_sekretaris' => $this->request->getPost('simluh_sekretaris'),
            'simluh_bendahara' => $this->request->getPost('simluh_bendahara'),
            'simluh_tahun_bentuk' => $this->request->getPost('simluh_tahun_bentuk'),
            'simluh_sk_pengukuhan' => $this->request->getPost('simluh_sk_pengukuhan'), 
            'simluh_usaha_tani' => $this->request->getPost('simluh_usaha_tani'),
            'simluh_usaha_olah' => $this->request->getPost('simluh_usaha_olah'),
            
            'simluh_usaha_saprodi' => $this->request->getPost('simluh_usaha_saprodi'),
            'simluh_usaha_pemasaran' => $this->request->getPost('simluh_usaha_pemasaran'),
            'simluh_usaha_simpan_pinjam' => $this->request->getPost('simluh_usaha_simpan_pinjam'),
            'simluh_usaha_jasa_lain' => $this->request->getPost('simluh_usaha_jasa_lain'),
            'simluh_usaha_jasa_lain_desc' => $this->request->getPost('simluh_usaha_jasa_lain_desc'),

            'simluh_alsin_traktor' => $this->request->getPost('simluh_alsin_traktor'),
            'simluh_alsin_hand_tractor' => $this->request->getPost('simluh_alsin_hand_tractor'),
            'simluh_alsin_pompa_air' => $this->request->getPost('simluh_alsin_pompa_air'),
            'simluh_alsin_penggiling_padi' => $this->request->getPost('simluh_alsin_penggiling_padi'),
            'simluh_alsin_pengering' => $this->request->getPost('simluh_alsin_pengering'),
            'simluh_alsin_chooper' => $this->request->getPost('simluh_alsin_chooper'),
            'simluh_alsin_lain_desc' => $this->request->getPost('simluh_alsin_lain_desc'),
            'simluh_alsin_lain' => $this->request->getPost('simluh_alsin_lain'),

            
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
    public function edit($id_gap)
    {
        $gap = $this->model->getDataById($id_gap);
        echo $gap;
    }
    public function update($id_gap)
    {
        
        $kode_prop = $this->request->getPost('kode_prop');
        $kode_kec = $this->request->getPost('kode_kec');
        $kode_kab = $this->request->getPost('kode_kab');
        $kode_desa = $this->request->getPost('kode_desa');
        $nama_gapoktan = $this->request->getPost('nama_gapoktan');
        $ketua_gapoktan = $this->request->getPost('ketua_gapoktan');
        $alamat = $this->request->getPost('alamat');
        $simluh_tahun_bentuk = $this->request->getPost('simluh_tahun_bentuk');
        $simluh_bendahara = $this->request->getPost('simluh_bendahara');
        $simluh_sekretaris = $this->request->getPost('simluh_sekretaris');
        $simluh_sk_pengukuhan = $this->request->getPost('simluh_sk_pengukuhan');  
        $simluh_usaha_tani = $this->request->getPost('simluh_usaha_tani');
        $simluh_usaha_olah = $this->request->getPost('simluh_usaha_olah');

        $simluh_usaha_saprodi = $this->request->getPost('simluh_usaha_saprodi');
        $simluh_usaha_pemasaran = $this->request->getPost('simluh_usaha_pemasaran');
        $simluh_usaha_simpan_pinjam = $this->request->getPost('simluh_usaha_simpan_pinjam');
        $simluh_usaha_jasa_lain = $this->request->getPost('simluh_usaha_jasa_lain');
        $simluh_usaha_jasa_lain_desc = $this->request->getPost('simluh_usaha_jasa_lain_desc');
        
        $simluh_alsin_traktor = $this->request->getPost('simluh_alsin_traktor');
        $simluh_alsin_hand_tractor = $this->request->getPost('simluh_alsin_hand_tractor');
        $simluh_alsin_pompa_air = $this->request->getPost('simluh_alsin_pompa_air');
        $simluh_alsin_penggiling_padi = $this->request->getPost('simluh_alsin_penggiling_padi');
        $simluh_alsin_pengering = $this->request->getPost('simluh_alsin_pengering');
        $simluh_alsin_chooper = $this->request->getPost('simluh_alsin_chooper');
        $simluh_alsin_lain_desc = $this->request->getPost('simluh_alsin_lain_desc');
        $simluh_alsin_lain = $this->request->getPost('simluh_alsin_lain');
        $this->model->save([
            'id_gap' => $id_gap,
            'kode_kec' => $kode_kec,
            'kode_prop' => $kode_prop,
            'kode_kab' => $kode_kab,
            'kode_desa' => $kode_desa,
            'nama_gapoktan' => $nama_gapoktan,
            'ketua_gapoktan' => $ketua_gapoktan,
            'alamat' => $alamat,
            'simluh_tahun_bentuk' => $simluh_tahun_bentuk,
            'simluh_bendahara' => $simluh_bendahara,
            'simluh_sekretaris' => $simluh_sekretaris,
            'simluh_sk_pengukuhan' => $simluh_sk_pengukuhan,
            'simluh_usaha_tani' => $simluh_usaha_tani,
            'simluh_usaha_olah' => $simluh_usaha_olah,
            'simluh_usaha_saprodi' => $simluh_usaha_saprodi,
            'simluh_usaha_pemasaran' => $simluh_usaha_pemasaran,
            'simluh_usaha_simpan_pinjam' => $simluh_usaha_simpan_pinjam,
            'simluh_usaha_jasa_lain' => $simluh_usaha_jasa_lain,
            'simluh_usaha_jasa_lain_desc' => $simluh_usaha_jasa_lain_desc,
            'simluh_alsin_traktor' => $simluh_alsin_traktor,
            'simluh_alsin_hand_tractor' => $simluh_alsin_hand_tractor,
            'simluh_alsin_pompa_air' => $simluh_alsin_pompa_air,
            'simluh_alsin_penggiling_padi' => $simluh_alsin_penggiling_padi,
            'simluh_alsin_pengering' => $simluh_alsin_pengering,
            'simluh_alsin_chooper' => $simluh_alsin_chooper,
            'simluh_alsin_lain_desc' => $simluh_alsin_lain_desc,
            'simluh_alsin_lain' => $simluh_alsin_lain,
        ]);

        //session()->setFlashdata('pesan', 'Data berhasil diubah');

    }
    public function delete($id_gap)
    {
        $this->model->delete($id_gap);
       // return redirect()->to('/listgapoktan');
    }
}
