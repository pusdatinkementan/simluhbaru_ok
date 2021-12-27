<?php

namespace App\Controllers\KelembagaanPelakuUtama\KelembagaanEkonomiPetani;
use App\Controllers\BaseController;
use App\Models\KelembagaanPelakuUtama\KelembagaanEkonomiPetani\KelembagaanEkonomiPetaniModel;
use App\Models\KelembagaanPelakuUtama\KelembagaanEkonomiPetani\ListKEPModel;
use App\Models\KodeWilayah\KodeWilModel2;

class KelembagaanEkonomiPetani extends BaseController
{
    protected $model;
    public function __construct()
    {
        $this->session = service('session');
        $this->config = config('Auth');
        $this->auth = service('authentication');

        $this->model = new ListKEPModel();
    }
    public function kelembagaanekonomipetani()
    {
        if (empty(session()->get('status_user')) || session()->get('status_user') == '2') {
            $kode = '00';
        } elseif (session()->get('status_user') == '1') {
            $kode = session()->get('kodebakor');
        } elseif (session()->get('status_user') == '200') {
            $kode = session()->get('kodebapel');
        } elseif (session()->get('status_user') == '300') {
            $kode = session()->get('kodebpp');
        }
        $kelembagaanekonomipetani_model = new KelembagaanEkonomiPetaniModel();
        $kelembagaanekonomipetani_data = $kelembagaanekonomipetani_model->getKelembagaanEkonomiPetaniTotal($this->session->get('kodebapel'));

        $data = [
            
            'nama_kabupaten' => $kelembagaanekonomipetani_data['nama_kab'],
            'tabel_data' => $kelembagaanekonomipetani_data['table_data'],
            'title' => 'Kelembagaan Ekonomi Petani',
            'name' => 'Kelembagaan Ekonomi Petani'
        ];

        return view('KelembagaanPelakuUtama/KelembagaanEkonomiPetani/kelembagaanekonomipetani', $data);
    }
    public function listkep()
    {
        
        if (session()->get('username') == "") {
            return redirect()->to('login');
        }
        $get_param = $this->request->getGet();
        $kode_kec = $get_param['kode_kec'];
        $kodewil_model = new KodeWilModel2();
        $listkep_model = new ListKEPModel();
        $desa = new ListKEPModel();
        $listkep_data = $listkep_model->getListKEPTotal($kode_kec);
        $kode_data = $kodewil_model->getKodeWil($kode_kec);

        $data = [

            'nama_kecamatan' => $listkep_data['nama_kec'],
            'tabel_data' => $listkep_data['table_data'],
            'title' => 'List Kelembagaan Ekonomi Petani',
            'name' => 'List Kelembagaan Ekonomi Petani',
            'desa' => $desa,
            'kode_kec' => $kode_kec,
            'kode_prop' => $kode_data['kode_prop'],
        ];

        return view('KelembagaanPelakuUtama/KelembagaanEkonomiPetani/listkep', $data);
    }
    public function save()
    {
        try {
            $res = $this->model->save([
                'kode_kec' => $this->request->getPost('kode_kec'),
                'kode_kab' => $this->request->getPost('kode_kab'),
                'kode_desa' => $this->request->getPost('kode_desa'),
                'jenis_kep' => $this->request->getPost('jenis_kep'),
                'nama_kep' => $this->request->getPost('nama_kep'),
                'alamat' => $this->request->getPost('alamat'),
                'no_telp' => $this->request->getPost('no_telp'), 
                 'nama_direktur' => $this->request->getPost('nama_direktur'),
                'email' => $this->request->getPost('email'),
                'tahun_bentuk' => $this->request->getPost('tahun_bentuk'),
                'badan_hukum' => $this->request->getPost('badan_hukum'),
                'jum_anggota' => $this->request->getPost('jum_anggota'),
                'jum_poktan' => $this->request->getPost('jum_poktan'),
                'jum_gapoktan' => $this->request->getPost('jum_gapoktan'),
                'total_aset' => $this->request->getPost('total_aset'),
                'sertifikasi' => $this->request->getPost('sertifikasi'),

                'jenis_mitra_internasional' => $this->request->getPost('jenis_mitra_internasional'),
                'jenis_mitra_nasional' => $this->request->getPost('jenis_mitra_nasional'),
                'jenis_mitra_lokal' => $this->request->getPost('jenis_mitra_lokal'),
                'jenis_mitra_koperasi' => $this->request->getPost('jenis_mitra_koperasi'),
                'jenis_mitra_perorangan' => $this->request->getPost('jenis_mitra_perorangan'),

                'bentuk_mitra_pemasaran' => $this->request->getPost('bentuk_mitra_pemasaran'),
                'bentuk_mitra_saprodi' => $this->request->getPost('bentuk_mitra_saprodi'),
                'bnetuk_mitra_pendampingan' => $this->request->getPost('bnetuk_mitra_pendampingan'),

                'luas_lahan_usaha_tp' => $this->request->getPost('luas_lahan_usaha_tp'),
                'luas_lahan_usaha_bun' => $this->request->getPost('luas_lahan_usaha_bun'),
                'luas_lahan_usaha_hor' => $this->request->getPost('luas_lahan_usaha_hor'),
                'luas_lahan_usaha_nak' => $this->request->getPost('luas_lahan_usaha_nak'),
                'luas_lahan_usaha_olah' => $this->request->getPost('luas_lahan_usaha_olah'),

                
                'pemasaran_regional_tp' => $this->request->getPost('pemasaran_regional_tp'),
                'pemasaran_regional_bun' => $this->request->getPost('pemasaran_regional_bun'),
                'pemasaran_regional_hor' => $this->request->getPost('pemasaran_regional_hor'),
                'pemasaran_regional_nak' => $this->request->getPost('pemasaran_regional_nak'),
                'pemasaran_regional_olah' => $this->request->getPost('pemasaran_regional_olah'),

                'pemasaran_ekspor_tp' => $this->request->getPost('pemasaran_ekspor_tp'),
                'pemasaran_ekspor_bun' => $this->request->getPost('pemasaran_ekspor_bun'),
                'pemasaran_ekspor_hor' => $this->request->getPost('pemasaran_ekspor_hor'),
                'pemasaran_ekspor_nak' => $this->request->getPost('pemasaran_ekspor_nak'),
                'pemasaran_ekspor_olah' => $this->request->getPost('pemasaran_ekspor_olah'),
                
                'pemasaran_tti' => $this->request->getPost('pemasaran_tti'),

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
    public function edit($id_kep)
    {
        $kep = $this->model->getDataById($id_kep);
        echo $kep;
    }

    public function update($id_kep)
    {
        
        $kode_kec = $this->request->getPost('kode_kec');
        $kode_kab = $this->request->getPost('kode_kab');
        $kode_desa = $this->request->getPost('kode_desa');
        $nama_kep = $this->request->getPost('nama_kep');
        $jenis_kep = $this->request->getPost('jenis_kep');
        $nama_direktur = $this->request->getPost('nama_direktur');
        $jum_anggota = $this->request->getPost('jum_anggota');
        $jum_poktan = $this->request->getPost('jum_poktan');
        $jum_gapoktan = $this->request->getPost('jum_gapoktan');
        $tahun_bentuk = $this->request->getPost('tahun_bentuk');
        $badan_hukum = $this->request->getPost('badan_hukum');
        $alamat = $this->request->getPost('alamat');
        $no_telp = $this->request->getPost('no_telp');  
        $email = $this->request->getPost('email');
        $total_aset = $this->request->getPost('total_aset');
        $sertifikasi = $this->request->getPost('sertifikasi');
        
        $jenis_mitra_internasional = $this->request->getPost('jenis_mitra_internasional');
        $jenis_mitra_nasional = $this->request->getPost('jenis_mitra_nasional');
        $jenis_mitra_lokal = $this->request->getPost('jenis_mitra_lokal');
        $jenis_mitra_koperasi = $this->request->getPost('jenis_mitra_koperasi');
        $jenis_mitra_perorangan = $this->request->getPost('jenis_mitra_perorangan');
        
        $bentuk_mitra_pemasaran = $this->request->getPost('bentuk_mitra_pemasaran');
        $bentuk_mitra_saprodi = $this->request->getPost('bentuk_mitra_saprodi');
        $bnetuk_mitra_pendampingan = $this->request->getPost('bnetuk_mitra_pendampingan');
        
        $luas_lahan_usaha_tp = $this->request->getPost('luas_lahan_usaha_tp');
        $luas_lahan_usaha_bun = $this->request->getPost('luas_lahan_usaha_bun');
        $luas_lahan_usaha_nak = $this->request->getPost('luas_lahan_usaha_hor');
        $luas_lahan_usaha_hor = $this->request->getPost('luas_lahan_usaha_nak');
        $luas_lahan_usaha_olah = $this->request->getPost('luas_lahan_usaha_olah');
        
        $pemasaran_regional_tp = $this->request->getPost('pemasaran_regional_tp');
        $pemasaran_regional_bun = $this->request->getPost('pemasaran_regional_bun');
        $pemasaran_regional_nak = $this->request->getPost('pemasaran_regional_hor');
        $pemasaran_regional_hor = $this->request->getPost('pemasaran_regional_nak');
        $pemasaran_regional_olah = $this->request->getPost('pemasaran_regional_olah');

        $pemasaran_ekspor_tp = $this->request->getPost('pemasaran_ekspor_tp');
        $pemasaran_ekspor_bun = $this->request->getPost('pemasaran_ekspor_bun');
        $pemasaran_ekspor_nak = $this->request->getPost('pemasaran_ekspor_hor');
        $pemasaran_ekspor_hor = $this->request->getPost('pemasaran_ekspor_nak');
        $pemasaran_ekspor_olah = $this->request->getPost('pemasaran_ekspor_olah');
        
        $pemasaran_tti = $this->request->getPost('pemasaran_tti');
       
        $this->model->save([
            'id_kep' => $id_kep,
            'kode_kec' => $kode_kec,
            'kode_kab' => $kode_kab,
            'kode_desa' => $kode_desa,
            'nama_kep' => $nama_kep,
            'jenis_kep' => $jenis_kep,
            'alamat' => $alamat,
            'tahun_bentuk' => $tahun_bentuk,
            'badan_hukum' => $badan_hukum,
            'jum_anggota' => $jum_anggota,
            'jum_poktan' => $jum_poktan,
            'jum_gapoktan' => $jum_gapoktan,
            'no_telp' => $no_telp,
            'nama_direktur' => $nama_direktur,
            'email' => $email,
            'total_aset' => $total_aset,
            'sertifikasi' => $sertifikasi,
            
            'jenis_mitra_internasional' => $jenis_mitra_internasional,
            'jenis_mitra_nasional' => $jenis_mitra_nasional,
            'jenis_mitra_lokal' => $jenis_mitra_lokal,
            'jenis_mitra_koperasi' => $jenis_mitra_koperasi,
            'jenis_mitra_perorangan' => $jenis_mitra_perorangan,
            
            'bentuk_mitra_pemasaran' => $bentuk_mitra_pemasaran,
            'bentuk_mitra_saprodi' => $bentuk_mitra_saprodi,
            'bnetuk_mitra_pendampingan' => $bnetuk_mitra_pendampingan,
            
            'luas_lahan_usaha_tp' => $luas_lahan_usaha_tp,
            'luas_lahan_usaha_bun' => $luas_lahan_usaha_bun,
            'luas_lahan_usaha_hor' => $luas_lahan_usaha_hor,
            'luas_lahan_usaha_nak' => $luas_lahan_usaha_nak,
            'luas_lahan_usaha_olah' => $luas_lahan_usaha_olah,
            
            'pemasaran_regional_tp' => $pemasaran_regional_tp,
            'pemasaran_regional_bun' => $pemasaran_regional_bun,
            'pemasaran_regional_hor' => $pemasaran_regional_hor,
            'pemasaran_regional_nak' => $pemasaran_regional_nak,
            'pemasaran_regional_olah' => $pemasaran_regional_olah,

            'pemasaran_ekspor_tp' => $pemasaran_ekspor_tp,
            'pemasaran_ekspor_bun' => $pemasaran_ekspor_bun,
            'pemasaran_ekspor_hor' => $pemasaran_ekspor_hor,
            'pemasaran_ekspor_nak' => $pemasaran_ekspor_nak,
            'pemasaran_ekspor_olah' => $pemasaran_ekspor_olah,

            'pemasaran_tti' => $pemasaran_tti,
        ]);

        //session()->setFlashdata('pesan', 'Data berhasil diubah');

    }
    public function delete($id)
    {
        $this->model->delete($id);
       // return redirect()->to('/listkep');
    }
   
}