<?php

namespace App\Controllers\KelembagaanPelakuUtama\Gapoktan;

use App\Controllers\BaseController;
use App\Models\KelembagaanPelakuUtama\Gapoktan\ListGapoktanDesaModel;
use App\Models\KodeWilayah\KodeWilModel2;

class ListGapoktanDesa extends BaseController
{
    protected $model;
    public function __construct()
    {
        $this->model = new ListGapoktanDesaModel();
    }
    public function listgapoktandesa()
    {

        if (session()->get('username') == "") {
            return redirect()->to('login');
        }

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
        $get_param = $this->request->getGet();
        $kode_desa = $get_param['kode_desa'];
        $kode_gap = $get_param['kodegap'];
        $listgapoktandesa_model = new ListGapoktanDesaModel();
        $desa = $listgapoktandesa_model->getDesa(session()->get('kodebapel'));
        $listgapoktandesa_data = $listgapoktandesa_model->getListGapoktanDesaTotal($kode_desa, $kode_gap);
        $getpoktandesa = $listgapoktandesa_model->getPoktanByDesa($kode_desa);
        $kode_data = $kode_model->getKodeWil2(session()->get('kodebapel'));

        $data = [
            'id_gap' => $kode_gap,
            'nama_gap' => $listgapoktandesa_data['nama_gap'],
            'nama_desa' => $listgapoktandesa_data['nama_desa'],
            'kode_kec' => $listgapoktandesa_data['kode_kec'],
            'tabel_data' => $listgapoktandesa_data['table_data'],
            // 'jumpoktan' => $this->model->getCountJumPoktan(),
            'title' => 'List Gabungan Kelompok Tani',
            'name' => 'List Gabungan Kelompok Tani',
            'kode_prop' => $kode_data['kode_prop'],
            'desa' => $desa,
            'poktan' => $getpoktandesa,
            'kodedesa' => $kode_desa
        ];

        // dd($data);

        return view('KelembagaanPelakuUtama/Gapoktan/listgapoktandesa', $data);
    }
    public function edit($id_poktan)
    {
        $poktan = $this->model->getDataById($id_poktan);
        echo $poktan;
    }

    public function addPoktanDesa()
    {
        $id_poktan = $this->request->getPost('id_poktan');
        $id_gap = $this->request->getPost('id_gap');
        $kode_prop = $this->request->getPost('kode_prop');
        $kode_kec = $this->request->getPost('kode_kec');
        $kode_kab = $this->request->getPost('kode_kab');
        $kode_desa = $this->request->getPost('kode_desa');
        $nama_poktan = $this->request->getPost('nama_poktan');
        $ketua_poktan = $this->request->getPost('ketua_poktan');
        $alamat = $this->request->getPost('alamat');
        $simluh_kelas_kemampuan = $this->request->getPost('simluh_kelas_kemampuan');
        $simluh_tahun_tap_kelas = $this->request->getPost('simluh_tahun_tap_kelas');
        $simluh_tahun_bentuk = $this->request->getPost('simluh_tahun_bentuk');
        $simluh_jenis_kelompok = 1;

        try {

            $data = [
                'id_poktan' => $id_poktan,
                'id_gap' => $id_gap,
                'kode_kec' => $kode_kec,
                'kode_prop' => $kode_prop,
                'kode_kab' => $kode_kab,
                'kode_desa' => $kode_desa,
                'ketua_poktan' => $ketua_poktan,
                'alamat' => $alamat,
                'simluh_kelas_kemampuan' => $simluh_kelas_kemampuan,
                'simluh_tahun_bentuk' => $simluh_tahun_bentuk,
                'simluh_tahun_tap_kelas' => $simluh_tahun_tap_kelas,
                'simluh_jenis_kelompok' => $simluh_jenis_kelompok
            ];
            // dd($data);
            $this->model->update($data);
            return 'success';
        } catch (\Exception $e) {
            // d($e);
            return 'error';
        }

        //session()->setFlashdata('pesan', 'Data berhasil diubah');

    }

    public function update($id_poktan)
    {
        $data = [
            'id_poktan' => $id_poktan,
            'status' => $this->request->getPost('status'),
            'id_gap' => $this->request->getPost('id_gap'),
            'noreg' => $this->request->getPost('kode_desa') . '-' . $this->request->getPost('id_gap') . '-' . $id_poktan
        ];

        try {
            $this->model->save($data);
            return 'success';
        } catch (\Exception $e) {
            return 'error';
        }
    }
    public function delete($id_poktan)
    {
        $this->model->delete($id_poktan);
        // return redirect()->to('/gapoktan');
    }

    public function updateStatusGapoktanDesa($id_poktan)
    {
        try {
            $data = [
                'status' => $this->request->getPost('status')
            ];

            $this->model->updateStatusGapDesa($id_poktan, $data);
            return 'sukses';
        } catch (\Exception $e) {
            return 'error';
        }
    }
}
