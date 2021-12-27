<?php

namespace App\Controllers\Penyuluh;

use App\Controllers\BaseController;
use App\Models\penyuluh\PendInFormalPnsModel;
use App\Models\penyuluh\PenyuluhPNSModel;

class PendInFormalPns extends BaseController
{
    protected $session;
    function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
        $this->model = new PendInFormalPnsModel();
    }

    public function detail()
    {
        $get_param = $this->request->getGet();
        $get_paramm = $this->request->getGet();

        $nip = $get_param['nip'];
        $nama = $get_paramm['nama'];
        $penyuluhmodel = new PendInFormalPnsModel();
        $dtpenyuluh = $penyuluhmodel->getPendInFormalPnsTotal($nip);
        $diklat = $penyuluhmodel->getDiklat();
        $data = [
            'tabel_data' => $dtpenyuluh['table_data'],
            'title' => 'Pendidikan Formal PNS',
            'nipp' => $nip,
            'namaa' => $nama,
            'diklat' => $diklat
        ];

        //dd($data);

        return view('kab/penyuluh/pendidikaninformalpns', $data);
    }

    public function save()
    {
        try {
            $res = $this->model->save([
                'nip' => $this->request->getPost('nip'),
                'nama' => $this->request->getPost('nama'),
                'kelompok' => $this->request->getPost('kelompok'),
                'lokasi' => $this->request->getPost('lokasi'),
                'tgl_mulai' => $this->request->getPost('tgl_mulai'),
                'penyelenggara' => $this->request->getPost('penyelenggara'),
                'jml_jam' => $this->request->getPost('jml_jam'),
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
        $pns = $this->model->getDetailEdit($id);
        echo $pns;
    }

    public function update($id)
    {
        //$id = $this->request->getVar('idjab');
        $nip = $this->request->getPost('nip');
        $nama = $this->request->getPost('nama');
        $kelompok = $this->request->getPost('kelompok');
        $lokasi = $this->request->getPost('lokasi');
        $tgl_mulai = $this->request->getPost('tgl_mulai');
        $penyelenggara = $this->request->getPost('penyelenggara');
        $jml_jam = $this->request->getPost('jml_jam');
        $satminkal = $this->request->getPost('satminkal');
        $tgl_update = $this->request->getPost('tgl_update');

        $this->model->save([
            'id' => $id,
            'nip' => $nip,
            'nama' => $nama,
            'kelompok' => $kelompok,
            'lokasi' => $lokasi,
            'tgl_mulai' => $tgl_mulai,
            'penyelenggara' => $penyelenggara,
            'jml_jam' => $jml_jam,
            'satminkal' => $satminkal,
            'tgl_update' => $tgl_update
        ]);

        //session()->setFlashdata('pesan', 'Data berhasil diubah');

    }
}
