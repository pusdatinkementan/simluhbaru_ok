<?php

namespace App\Controllers\KelembagaanPenyuluhan\Desa;

use App\Controllers\BaseController;
use App\Models\KelembagaanPenyuluhan\Desa\DesaModel;
use App\Models\KelembagaanPenyuluhan\Desa\PosluhdesModel;
use App\Models\KodeWilayah\KodeWilModel;


class Desa extends BaseController
{
    protected $session;

    function __construct()
    {
        //$this->model = new PosluhdesModel;
        $this->session = \Config\Services::session();
        $this->session->start();
        $this->model = new PosluhdesModel();
    }
    public function desa()
    {

        $desa_model = new DesaModel;
        $desa_data = $desa_model->getDesaTotal($this->session->get('kodebapel'));
        $data = [
            'jum_des' => $desa_data['jum_des'],
            'nama_kabupaten' => $desa_data['nama_kab'],
            'tabel_data' => $desa_data['table_data'],
            'title' => 'Desa',
            'name' => 'Desa'
        ];

        return view('KelembagaanPenyuluhan/Desa/desa', $data);
    }

    public function listdesa()
    {

        $get_param = $this->request->getGet();
        $kode_kec = $get_param['kode_kec'];
        $kode = $this->session->get('kodebapel');
        $posluhdes_model = new PosluhdesModel;
        $kodewil_model = new KodeWilModel;
        $pen_swa = $posluhdes_model->getPenyuluhSwadaya($kode_kec);
        $desa = $posluhdes_model->getDesa($kode_kec);
        $kode_data = $kodewil_model->getKodeWil($kode);
        //dd($pen_swa);
        // $data['desa'] = $posluhdes_model->orderBy('nm_desa', 'ASC')->findAll();
        $posluhdes_data = $posluhdes_model->getPosluhdesTotal($kode_kec);

        $data = [
            'jum_kec' => $posluhdes_data['jum_kec'],
            'nama_kecamatan' => $posluhdes_data['nama_kec'],
            'tabel_data' => $posluhdes_data['table_data'],
            'desa' => $desa,
            'pen_swa' => $pen_swa,
            'kode_kec' => $kode_kec,
            'kode_prop' => $kode_data['kode_prop'],
            'title' => 'Daftar Posluhdes',
            'name' => 'Posluhdes'
        ];

        //$output = view('KelembagaanPenyuluhan/Desa/source-pos', $data);
        //echo json_encode($datas);
        //$data = json_encode($data);
        return view('KelembagaanPenyuluhan/Desa/daftar_posluhdes', $data);
    }

    public function formaddpos()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => view('/KelembagaanPenyuluhan/Desa/modaltambah/')
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
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
        $posluhdes_model = new PosluhdesModel;

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

        return redirect()->to('/daftar_posluhdes?kode_kec=' . $this->request->getPost('kode_kec'));
    }

    public function delete($idpos)
    {
        $this->posModel->delete($idpos);
        return redirect()->to('/desa');
    }
}
