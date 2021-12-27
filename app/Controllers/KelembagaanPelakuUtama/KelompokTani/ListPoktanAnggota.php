<?php

namespace App\Controllers\KelembagaanPelakuUtama\KelompokTani;
use App\Controllers\BaseController;
use App\Models\KelembagaanPelakuUtama\KelompokTani\ListPoktanAnggotaModel;
use App\Models\KodeWilayah\KodeWilModel;
use App\Models\KodeWilayah\KodeWilModel2;

class ListPoktanAnggota extends BaseController
{  public function __construct()
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
        
    $this->lpa_model = new ListPoktanAnggotaModel();
    }
    public function listpoktananggota()
    {   if (session()->get('username') == "") {
        return redirect()->to('login');
    }
        
    
        $kode_kab = $this->session->get('kodebapel');
        $get_param = $this->request->getGet();
        $ip = $get_param['ip'];
        $listpoktananggota_model = new ListPoktanAnggotaModel();
        $kodewil_model = new KodeWilModel();
        $kodewil_model = new KodeWilModel2();
        $komoditas = $listpoktananggota_model->getKomoditas();
        $komoditas2 = $listpoktananggota_model->getKomoditas2();
        $komoditas3 = $listpoktananggota_model->getKomoditas3();
        $listpoktananggota_data = $listpoktananggota_model->getListPoktanAnggotaTotal($ip);
        $kode_data = $kodewil_model->getKodeWil2($kode_kab);
        $kode_data2 = $kodewil_model->getKodeWil2($kode_kab);

        $data = [
            
            'nama_poktan' => $listpoktananggota_data['nama_poktan'],
            'tabel_data' => $listpoktananggota_data['table_data'],
            'title' => 'List Kelompok Tani',
            'name' => 'List Kelompok Tani',
            'komoditas' => $komoditas,
             'komoditas2' => $komoditas2,
             'komoditas3' => $komoditas3,
             'id_poktan' => $ip,
             'kode_kec' => $kode_data['kode_kec'],
             'kode_prop' => $kode_data['kode_prop'],
             'kode_desa' => $kode_data2['kode_desa']
        ];

        return view('KelembagaanPelakuUtama/KelompokTani/listpoktananggota', $data);
    }
    public function save()
    {
        try {
            $res = $this->lpa_model->save([
                'kode_kec' => $this->request->getPost('kode_kec'),
                'kode_desa' => $this->request->getPost('kode_desa'),
                'kode_kab' => $this->request->getPost('kode_kab'),
                'kode_prop' => $this->request->getPost('kode_prop'),
                'id_poktan' => $this->request->getPost('id_poktan'),
                'nama_anggota' => $this->request->getPost('nama_anggota'),
                'nama_ktp' => $this->request->getPost('nama_ktp'),
                'no_ktp' => $this->request->getPost('no_ktp'),
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'tgl_lahir' => $this->request->getPost('tgl_lahir'),
                'bln_lahir' => $this->request->getPost('bln_lahir'),
                'thn_lahir' => $this->request->getPost('thn_lahir'),
                'no_hp' => $this->request->getPost('no_hp'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'alamat_ktp' => $this->request->getPost('alamat_ktp'),
                'status_anggota' => $this->request->getPost('status_anggota'),
                'kode_komoditas' => $this->request->getPost('kode_komoditas'),
                'kode_komoditas2' => $this->request->getPost('kode_komoditas2'),
                'kode_komoditas3' => $this->request->getPost('kode_komoditas3'),
                'volume' => $this->request->getPost('volume'),
                'volume2' => $this->request->getPost('volume2'),
                'volume3' => $this->request->getPost('volume3'),
                'lainnya' => $this->request->getPost('lainnya'),
                'luas_lahan_ternak_diusahakan' => $this->request->getPost('luas_lahan_ternak_diusahakan'),
                'luas_lahan_ternak_dimiliki' => $this->request->getPost('luas_lahan_ternak_dimiliki'),
                'titik_koordinat_lahan' => $this->request->getPost('titik_koordinat_lahan'),
                'kategori_petani_penggarap' => $this->request->getPost('kategori_petani_penggarap'),
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
    public function edit($id_anggota)
    {
        $anggota = $this->lpa_model->getDataById($id_anggota);
        echo $anggota;
    }

    public function update($id_anggota)
    {
        
        $id_poktan = $this->request->getPost('id_poktan');
        $kode_kec = $this->request->getPost('kode_kec');
        $kode_desa = $this->request->getPost('kode_desa');
        $kode_kab = $this->request->getPost('kode_kab');
        $kode_prop = $this->request->getPost('kode_prop');
        $nama_anggota = $this->request->getPost('nama_anggota');
        $nama_ktp = $this->request->getPost('nama_ktp');
        $no_ktp = $this->request->getPost('no_ktp');
        $tempat_lahir = $this->request->getPost('tempat_lahir');
        $tgl_lahir = $this->request->getPost('tgl_lahir');
        $bln_lahir = $this->request->getPost('bln_lahir');
        $thn_lahir = $this->request->getPost('thn_lahir');
        $no_hp = $this->request->getPost('no_hp');
        $jenis_kelamin = $this->request->getPost('jenis_kelamin');
        $alamat_ktp = $this->request->getPost('alamat_ktp');
        $status_anggota = $this->request->getPost('status_anggota');
        $kode_komoditas = $this->request->getPost('kode_komoditas');
        $kode_komoditas2 = $this->request->getPost('kode_komoditas2');
        $kode_komoditas3 = $this->request->getPost('kode_komoditas3');
        $volume = $this->request->getPost('volume');
        $volume2 = $this->request->getPost('volume2');
        $volume3 = $this->request->getPost('volume3');
        $lainnya = $this->request->getPost('lainnya');
        $luas_lahan_ternak_diusahakan = $this->request->getPost('luas_lahan_ternak_diusahakan');
        $luas_lahan_ternak_dimiliki = $this->request->getPost('luas_lahan_ternak_dimiliki');
        $titik_koordinat_lahan = $this->request->getPost('titik_koordinat_lahan');
        $kategori_petani_penggarap = $this->request->getPost('kategori_petani_penggarap');
        
        $this->lpa_model->save([
            
            'id_anggota' => $id_anggota,
            'id_poktan' => $id_poktan,
            'kode_kec' => $kode_kec,
            'kode_desa' => $kode_desa,
            'kode_kab' => $kode_kab,
            'kode_prop' => $kode_prop,
            'nama_anggota' => $nama_anggota,
            'nama_ktp' => $nama_ktp,
            'no_ktp' => $no_ktp,
            'jenis_kelamin' => $jenis_kelamin,
            'tempat_lahir' => $tempat_lahir,
            'tgl_lahir' => $tgl_lahir,
            'bln_lahir' => $bln_lahir,
            'thn_lahir' => $thn_lahir,
            'no_hp' => $no_hp,
            'alamat_ktp' => $alamat_ktp,
            'status_anggota' => $status_anggota,
            'kode_komoditas' => $kode_komoditas,
            'kode_komoditas2' => $kode_komoditas2,
            'kode_komoditas3' => $kode_komoditas3,
            'volume' => $volume,
            'volume2' => $volume2,
            'volume3' => $volume3,
            'lainnya' => $lainnya,
            'luas_lahan_ternak_diusahakan' => $luas_lahan_ternak_diusahakan,
            'luas_lahan_ternak_dimiliki' => $luas_lahan_ternak_dimiliki,
            'titik_koordinat_lahan' => $titik_koordinat_lahan,
            'kategori_petani_penggarap' => $kategori_petani_penggarap,
            
        ]);

        //session()->setFlashdata('pesan', 'Data berhasil diubah');

    }
    public function delete($id_anggota)
    {
        $this->lpa_model->delete($id_anggota);
       // return redirect()->to('/listpoktan');
    }

}