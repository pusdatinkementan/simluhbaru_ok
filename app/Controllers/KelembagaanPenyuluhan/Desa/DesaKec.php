<?php

namespace App\Controllers\KelembagaanPenyuluhan\Desa;

use App\Controllers\BaseController;
use App\Models\KelembagaanPenyuluhan\Desa\DesaKecModel;
use App\Models\KelembagaanPenyuluhan\Desa\PosluhdesKecModel;
use App\Models\KodeWilayah\KodeWilModel;

class DesaKec extends BaseController
{
    protected $session;

    function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
        $this->model = new PosluhdesKecModel();
    }
    public function desa()
    {
        $desa_model = new DesaKecModel;
        $desa_data = $desa_model->getDesaTotal(session()->get('kodebpp'));

        $data = [
            'jum_des' => $desa_data['jum_des'],
            'nama_bp3k' => $desa_data['nama_kec'],
            'tabel_data' => $desa_data['table_data'],
            'title' => 'Desa',
            'name' => 'Desa'
        ];

        return view('KelembagaanPenyuluhan/Desa/desakec', $data);
    }

    public function listdesa()
    {

        $get_param = $this->request->getGet();

        $kode_kec = $get_param['kode_kec'];

        $posluhdes_model = new PosluhdesKecModel;
        $posluhdes_data = $posluhdes_model->getPosluhdesKecTotal($kode_kec);
        $kodewil_model = new KodeWilModel();
        $pen_swa = $posluhdes_model->getPenyuluhSwadaya($kode_kec);
        $desa = $posluhdes_model->getDesa($kode_kec);
        $kode_data = $kodewil_model->getKodeWil($kode_kec);

        $data = [
            'jum_kec' => $posluhdes_data['jum_kec'],
            'nama_kecamatan' => $posluhdes_data['nama_kec'],
            'tabel_data' => $posluhdes_data['table_data'],
            'title' => 'Daftar Posluhdes',
            'desa' => $desa,
            'pen_swa' => $pen_swa,
            'kode_kec' => $kode_kec,
            'kode_prop' => $kode_data['kode_prop'],
            'name' => 'Posluhdes'
        ];

        return view('KelembagaanPenyuluhan/Desa/daftar_posluhdes_kec', $data);
    }

    public function save()
    {
        try {
            $res = $this->model->save([
                'kode_prop' => $this->request->getPost('kode_prop'),
                'kode_kab' => $this->request->getPost('kode_kab'),
                'kode_kec' => $this->request->getPost('kode_kec'),
                'kode_desa' => $this->request->getPost('kode_desa'),
                'nama' => $this->request->getPost('nama'),
                'ketua' => $this->request->getPost('ketua'),
                'bendahara' => $this->request->getPost('bendahara'),
                'sekretaris' => $this->request->getPost('sekretaris'),
                'jum_anggota' => $this->request->getPost('jum_anggota'),
                'alamat' => $this->request->getPost('alamat'),
                'tahun_berdiri' => $this->request->getPost('tahun_berdiri'),
                'penyuluh_swadaya' => $this->request->getPost('penyuluh_swadaya')
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

        //return redirect()->to('/daftar_posluhdes?kode_kec=' . $this->request->getPost('kode_kec'));
    }

    public function detailPosluhdes($id)
    {
        $posluhdes_model = new PosluhdesKecModel;

        $posluh = $posluhdes_model->getPosluhdes($id);
        echo json_encode($posluh);
    }

    public function update($idpos)
    {
        $kode_prop = $this->request->getPost('kode_prop');
        $kode_kab = $this->request->getPost('kode_kab');
        $kode_kec = $this->request->getPost('kode_kec');
        $kode_desa = $this->request->getPost('kode_desa');
        $nama = $this->request->getPost('nama');
        $ketua = $this->request->getPost('ketua');
        $sekretaris = $this->request->getPost('sekretaris');
        $bendahara = $this->request->getPost('bendahara');
        $jum_anggota = $this->request->getPost('jum_anggota');
        $alamat = $this->request->getPost('alamat');
        $tahun_berdiri = $this->request->getPost('tahun_berdiri');
        $penyuluh_swadaya = $this->request->getPost('penyuluh_swadaya');
        $this->model->save([
            'idpos' => $idpos,
            'kode_prop' => $kode_prop,
            'kode_kab' => $kode_kab,
            'kode_kec' => $kode_kec,
            'kode_desa' => $kode_desa,
            'nama' => $nama,
            'ketua' => $ketua,
            'bendahara' => $bendahara,
            'sekretaris' => $sekretaris,
            'jum_anggota' => $jum_anggota,
            'alamat' => $alamat,
            'tahun_berdiri' => $tahun_berdiri,
            'penyuluh_swadaya' => $penyuluh_swadaya
        ]);

        return redirect()->to('/daftar_posluhdes_kec?kode_kec=' . $this->request->getPost('kode_kec'));
    }

    public function delete($idpos)
    {
        $this->posModel->delete($idpos);
        return redirect()->to('/desa');
    }
}
