<?php

namespace App\Controllers\KelembagaanPelakuUtama\kelompoktani;

use App\Controllers\BaseController;
use App\Models\KelembagaanPelakuUtama\KelompokTani\KelompokTaniModel;
use App\Models\KelembagaanPelakuUtama\KelompokTani\ListPoktanModel;
use App\Models\KodeWilayah\KodeWilModel2;
use App\Models\KelembagaanPelakuUtama\KelompokTani\KomoditasBunModel;
use App\Models\KelembagaanPelakuUtama\KelompokTani\KomoditasHorModel;
use App\Models\KelembagaanPelakuUtama\KelompokTani\KomoditasNakModel;
use App\Models\KelembagaanPelakuUtama\KelompokTani\KomoditasOlahModel;
use App\Models\KelembagaanPelakuUtama\KelompokTani\KomoditasTpModel;

class KelompokTani extends BaseController
{
    protected $model;
    public function __construct()
    {
        $this->model = new ListPoktanModel();
    }
    public function kelompoktani()
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
        $kelompoktani_model = new KelompokTaniModel();
        $kelompoktani_data = $kelompoktani_model->getKelompokTaniTotal($this->session->get('kodebapel'));

        $data = [

            'nama_kabupaten' => $kelompoktani_data['nama_kab'],
            'jum_poktan' => $kelompoktani_data['jum_poktan'],
            'tabel_data' => $kelompoktani_data['table_data'],
            'title' => 'Kelompok Tani',
            'name' => 'Kelompok Tani'
        ];

        return view('KelembagaanPelakuUtama/KelompokTani/kelompoktani', $data);
    }

    public function listpoktan()
    {
        $get_param = $this->request->getGet();
        $kode_kec = $get_param['kode_kec'];
        $listpoktan_model = new ListPoktanModel();
        $kodewil_model = new KodeWilModel2();
        $desa = $listpoktan_model->getDesa($kode_kec);
        $listpoktan_data = $listpoktan_model->getKelompokTaniTotal($kode_kec);
        $kode_data = $kodewil_model->getKodeWil($kode_kec);
        /*
        Tanggal : 31 Januari 2022
        Desc: menambahkan list model komoditas
        Edited By: Bambang, Wahyu, Asyhadi
        */
        $getmodelbun = new KomoditasBunModel();
        $getmodeltp = new KomoditasTpModel();
        $getmodelnak = new KomoditasNakModel();

        $data = [

            'nama_kecamatan' => $listpoktan_data['nama_kec'],
            'jum' => $listpoktan_data['jum'],
            'tabel_data' => $listpoktan_data['table_data'],
            'title' => 'List Kelompok Tani',
            'name' => 'List Kelompok Tani',
            'desa' => $desa,
            'kode_kec' => $kode_kec,
            'kode_prop' => $kode_data['kode_prop'],
            'databun' => $getmodelbun->getBun(),
            'datatp' => $getmodeltp->getTp()
        ];


        return view('KelembagaanPelakuUtama/KelompokTani/listpoktan', $data);
    }
    public function save()
    {
        $listpoktan_model = new ListPoktanModel();
        try {
            $res = $listpoktan_model->save([
                'kode_kec' => $this->request->getPost('kode_kec'),
                'kode_kab' => $this->request->getPost('kode_kab'),
                'kode_desa' => $this->request->getPost('kode_desa'),
                'kode_prop' => $this->request->getPost('kode_prop'),
                'id_gap' => $this->request->getPost('id_gap'),
                'nama_poktan' => $this->request->getPost('nama_poktan'),
                'ketua_poktan' => $this->request->getPost('ketua_poktan'),
                'alamat' => $this->request->getPost('alamat'),
                'simluh_tahun_bentuk' => $this->request->getPost('simluh_tahun_bentuk'),
                'status' => $this->request->getPost('status'),
                'simluh_tahun_tap_kelas' => $this->request->getPost('simluh_tahun_tap_kelas'),
                'simluh_kelas_kemampuan' => $this->request->getPost('simluh_kelas_kemampuan'),

                'simluh_jenis_kelompok_perempuan' => $this->request->getPost('simluh_jenis_kelompok_perempuan'),
                'simluh_jenis_kelompok_domisili' => $this->request->getPost('simluh_jenis_kelompok_domisili'),
                'simluh_jenis_kelompok_upja' => $this->request->getPost('simluh_jenis_kelompok_upja'),
                'simluh_jenis_kelompok_p3a' => $this->request->getPost('simluh_jenis_kelompok_p3a'),
                'simluh_jenis_kelompok_lmdh' => $this->request->getPost('simluh_jenis_kelompok_lmdh'),
                'simluh_jenis_kelompok_penangkar' => $this->request->getPost('simluh_jenis_kelompok_penangkar'),
                'simluh_jenis_kelompok_kmp' => $this->request->getPost('simluh_jenis_kelompok_kmp'),
                'simluh_jenis_kelompok_umkm' => $this->request->getPost('simluh_jenis_kelompok_umkm'),


                'simluh_jenis_kelompok_tp' => $this->request->getPost('simluh_jenis_kelompok_tp'),
                'simluh_jenis_kelompok_bun' => $this->request->getPost('simluh_jenis_kelompok_bun'),
                'simluh_jenis_kelompok_hor' => $this->request->getPost('simluh_jenis_kelompok_hor'),
                'simluh_jenis_kelompok_nak' => $this->request->getPost('simluh_jenis_kelompok_nak'),
                'simluh_jenis_kelompok_olah' => $this->request->getPost('simluh_jenis_kelompok_olah'),


                'simluh_komo_lain_tp' => $this->request->getPost('simluh_komo_lain_tp'),
                'simluh_komo_lain_bun' => $this->request->getPost('simluh_komo_lain_bun'),
                'simluh_komo_lain_hor' => $this->request->getPost('simluh_komo_lain_hor'),
                'simluh_komo_lain_nak' => $this->request->getPost('simluh_komo_lain_nak'),
                'simluh_komo_lain_olah' => $this->request->getPost('simluh_komo_lain_olah'),

                'simluh_komo_lain_olah' => $this->request->getPost('komTp')
            ]);
            if ($res == false) {
                $data = [
                    "value" => false,
                    "message" => 'data tidak lengkap'
                ];
            } else {
                $data = [
                    "value" => true
                ];
            }
            return json_encode($data);
        } catch (\Exception $e) {
            $data = [
                "value" => false,
                "message" => $e->getMessage()
            ];
            return json_encode($data);
        }
        // return redirect()->to('/listpoktan?kode_kec=' . $this->request->getPost('kode_kec'));
    }
    public function edit($id_poktan)
    {

        $poktan = $this->model->getDataById($id_poktan);
        echo $poktan;
    }

    public function update($id_poktan)
    {

        $listpoktan_model = new ListPoktanModel();
        $kode_kec = $this->request->getPost('kode_kec');
        $kode_kab = $this->request->getPost('kode_kab');
        $kode_desa = $this->request->getPost('kode_desa');
        $kode_prop = $this->request->getPost('kode_prop');
        $id_gap = $this->request->getPost('id_gap');
        $nama_poktan = $this->request->getPost('nama_poktan');
        $ketua_poktan = $this->request->getPost('ketua_poktan');
        $alamat = $this->request->getPost('alamat');
        $simluh_tahun_bentuk = $this->request->getPost('simluh_tahun_bentuk');
        $status = $this->request->getPost('status');
        $simluh_kelas_kemampuan = $this->request->getPost('simluh_kelas_kemampuan');
        $simluh_tahun_tap_kelas = $this->request->getPost('simluh_tahun_tap_kelas');

        $simluh_jenis_kelompok_perempuan = $this->request->getPost('simluh_jenis_kelompok_perempuan');
        $simluh_jenis_kelompok_domisili = $this->request->getPost('simluh_jenis_kelompok_domisili');
        $simluh_jenis_kelompok_upja = $this->request->getPost('simluh_jenis_kelompok_upja');
        $simluh_jenis_kelompok_p3a = $this->request->getPost('simluh_jenis_kelompok_p3a');
        $simluh_jenis_kelompok_lmdh = $this->request->getPost('simluh_jenis_kelompok_lmdh');
        $simluh_jenis_kelompok_penangkar = $this->request->getPost('simluh_jenis_kelompok_penangkar');
        $simluh_jenis_kelompok_kmp = $this->request->getPost('simluh_jenis_kelompok_kmp');
        $simluh_jenis_kelompok_umkm = $this->request->getPost('simluh_jenis_kelompok_umkm');

        $simluh_jenis_kelompok_tp = $this->request->getPost('simluh_jenis_kelompok_tp');
        $simluh_jenis_kelompok_bun = $this->request->getPost('simluh_jenis_kelompok_bun');
        $simluh_jenis_kelompok_hor = $this->request->getPost('simluh_jenis_kelompok_hor');
        $simluh_jenis_kelompok_nak = $this->request->getPost('simluh_jenis_kelompok_nak');
        $simluh_jenis_kelompok_olah = $this->request->getPost('simluh_jenis_kelompok_olah');

        $simluh_komo_lain_tp = $this->request->getPost('simluh_komo_lain_tp');
        $simluh_komo_lain_bun = $this->request->getPost('simluh_komo_lain_bun');
        $simluh_komo_lain_hor = $this->request->getPost('simluh_komo_lain_hor');
        $simluh_komo_lain_nak = $this->request->getPost('simluh_komo_lain_nak');
        $simluh_komo_lain_olah = $this->request->getPost('simluh_komo_lain_olah');

        $listpoktan_model->save([
            'id_poktan' => $id_poktan,
            'kode_kec' => $kode_kec,
            'kode_kab' => $kode_kab,
            'kode_desa' => $kode_desa,
            'kode_prop' => $kode_prop,
            'id_gap' => $id_gap,
            'nama_poktan' => $nama_poktan,
            'ketua_poktan' => $ketua_poktan,
            'alamat' => $alamat,
            'simluh_tahun_bentuk' => $simluh_tahun_bentuk,
            'status' => $status,
            'simluh_tahun_tap_kelas' => $simluh_tahun_tap_kelas,
            'simluh_kelas_kemampuan' => $simluh_kelas_kemampuan,

            'simluh_jenis_kelompok_perempuan' => $simluh_jenis_kelompok_perempuan,
            'simluh_jenis_kelompok_domisili' => $simluh_jenis_kelompok_domisili,
            'simluh_jenis_kelompok_upja' => $simluh_jenis_kelompok_upja,
            'simluh_jenis_kelompok_p3a' => $simluh_jenis_kelompok_p3a,
            'simluh_jenis_kelompok_lmdh' => $simluh_jenis_kelompok_lmdh,
            'simluh_jenis_kelompok_penangkar' => $simluh_jenis_kelompok_penangkar,
            'simluh_jenis_kelompok_kmp' => $simluh_jenis_kelompok_kmp,
            'simluh_jenis_kelompok_umkm' => $simluh_jenis_kelompok_umkm,

            'simluh_jenis_kelompok_tp' => $simluh_jenis_kelompok_tp,
            'simluh_jenis_kelompok_bun' => $simluh_jenis_kelompok_bun,
            'simluh_jenis_kelompok_hor' => $simluh_jenis_kelompok_hor,
            'simluh_jenis_kelompok_nak' => $simluh_jenis_kelompok_nak,
            'simluh_jenis_kelompok_olah' => $simluh_jenis_kelompok_olah,

            'simluh_komo_lain_tp' => $simluh_komo_lain_tp,
            'simluh_komo_lain_bun' => $simluh_komo_lain_bun,
            'simluh_komo_lain_hor' => $simluh_komo_lain_hor,
            'simluh_komo_lain_nak' => $simluh_komo_lain_nak,
            'simluh_komo_lain_olah' => $simluh_komo_lain_olah,
        ]);
    }
    public function delete($id_poktan)
    {
        $this->model->delete($id_poktan);
        //return redirect()->to('/listpoktan');
    }
}
