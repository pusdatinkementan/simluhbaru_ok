<?php

namespace App\Controllers\KelembagaanPelakuUtama\GapoktanBersama;

use App\Controllers\BaseController;
use App\Models\KelembagaanPelakuUtama\GapoktanBersama\AnggotaGapberModel;
use App\Models\KelembagaanPelakuUtama\Gapoktan\ListGapoktanModel;
use App\Models\KodeWilayah\KodeWilModel2;

class AnggotaGapber extends BaseController
{
    protected $model;
    protected $kode_model;
    protected $gapmodel;

    public function __construct()
    {
        $this->model = new AnggotaGapberModel();
        $this->kode_model = new KodeWilModel2;
        $this->gapmodel = new ListGapoktanModel();
    }

    public function index()
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

        $get_param = $this->request->getGet();
        $dtgapber = $this->model->getListAnggotaGapber($get_param['id']);
        $dtgap = $this->gapmodel->getListGapoktan($kode);

        $data = [
            'title' => 'Anggota Gapoktan Bersama',
            'tabel_data' => $dtgapber['listgapber'],
            'data_gapber' => $dtgapber['datagapber'],
            'dtgapoktan' => $dtgap
        ];

        //dd($data);

        return view('KelembagaanPelakuUtama/GapoktanBersama/anggotagapber', $data);
    }

    public function save()
    {
        $data =  [
            'id_gap' => $this->request->getPost('idgap'),
            'id_gapber' => $this->request->getPost('id_gap_ber'),
            'created_at' => $this->request->getPost('created_at'),
            'updated_at' => $this->request->getPost('created_at'),
            'status_anggota' => $this->request->getPost('status_ang')
        ];

        try {
            $this->model->saveGapber($data);
            return 'success';
        } catch (\Exception $e) {
            return 'error';
        }
        // return redirect()->to('/listpoktan?kode_kec=' . $this->request->getPost('kode_kec'));
    }
    public function edit($id)
    {
        $kel = $this->model->getDataByIdListKel($id);
        echo $kel;
    }

    public function update($id)
    {

        $data =  [
            'id_poktan' => $this->request->getPost('id_poktan'),
            'id_jns_kel' => $this->request->getPost('idkel'),
            'created_at' => $this->request->getPost('created_at'),
            'updated_at' => $this->request->getPost('created_at')
        ];

        try {
            $this->model->updateJnskel($id, $data);
            return 'success';
        } catch (\Exception $e) {
            return 'error';
        }
    }
    public function delete($id)
    {
        $this->model->deleteJnsKel($id);
        // return redirect()->to('/listpoktan');
    }
}
