<?php

namespace App\Controllers\Penyuluh;

use App\Controllers\BaseController;
use App\Models\penyuluh\PakPNSModel;

class PakPNS extends BaseController
{
    protected $session;
    function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
        $this->model = new PakPNSModel();
    }

    public function detail()
    {
        $get_param = $this->request->getGet();
        $get_paramm = $this->request->getGet();

        $nip = $get_param['nip'];
        $nama = $get_paramm['nama'];
        $penyuluhmodel = new PakPNSModel();
        $dtpenyuluh = $penyuluhmodel->getPakPNSTotal($nip);
        $pp = $penyuluhmodel->getPP();
        $data = [
            'tabel_data' => $dtpenyuluh['table_data'],
            'title' => 'Riwayat Jenjang Jabatan / Gol / Nilai PAK Penyuluh PNS',
            'nipp' => $nip,
            'namaa' => $nama,
            'pp' => $pp
        ];

        //dd($data);

        return view('kab/penyuluh/pakpns', $data);
    }

    public function save()
    {
        try {
            $res = $this->model->save([
                'nip' => $this->request->getPost('nip'),
                'kredit_utama' => $this->request->getPost('kredit_utama'),
                'kredit_penunjang' => $this->request->getPost('kredit_penunjang'),
                'gol' => $this->request->getPost('gol'),
                'tgl_nilai' => $this->request->getPost('tgl_nilai'),
                'tgl_nilai2' => $this->request->getPost('tgl_nilai2'),
                'tgl_spk' => $this->request->getPost('tgl_spk'),
                'no_sk' => $this->request->getPost('no_sk'),
                'pejabat' => $this->request->getPost('pejabat'),
                'satminkal' => $this->request->getPost('satminkal'),
                'tgl_update' => $this->request->getPost('tgl_update')
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
    }

    public function delete($id)
    {
        $this->model->delete($id);
        // return redirect()->to('/pendinformalpns');
    }

    public function edit($id)
    {
        $pakpns = $this->model->getDetailEdit($id);
        echo $pakpns;
    }

    public function update($id)
    {
        //$id = $this->request->getVar('idjab');
        $nip = $this->request->getPost('nip');
        $kredit_utama = $this->request->getPost('kredit_utama');
        $kredit_penunjang = $this->request->getPost('kredit_penunjang');
        $gol = $this->request->getPost('gol');
        $tgl_nilai = $this->request->getPost('tgl_nilai');
        $tgl_nilai2 = $this->request->getPost('tgl_nilai2');
        $tgl_spk = $this->request->getPost('tgl_spk');
        $no_sk = $this->request->getPost('no_sk');
        $pejabat = $this->request->getPost('pejabat');
        $satminkal = $this->request->getPost('satminkal');
        $tgl_update = $this->request->getPost('tgl_update');

        $this->model->save([
            'id' => $id,
            'nip' => $nip,
            'kredit_utama' => $kredit_utama,
            'kredit_penunjang' => $kredit_penunjang,
            'gol' => $gol,
            'tgl_nilai' => $tgl_nilai,
            'tgl_nilai2' => $tgl_nilai2,
            'tgl_spk' => $tgl_spk,
            'no_sk' => $no_sk,
            'pejabat' => $pejabat,
            'satminkal' => $satminkal,
            'tgl_update' => $tgl_update
        ]);

        //session()->setFlashdata('pesan', 'Data berhasil diubah');

    }
}
