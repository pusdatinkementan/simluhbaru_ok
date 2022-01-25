<?php

namespace App\Controllers\Penyuluh;

use App\Controllers\BaseController;
use App\Models\penyuluh\PenyuluhSwastaModel;

class PenyuluhSwasta extends BaseController
{
    public function __construct()
    {
        $this->session = service('session');
        $this->config = config('Auth');
        $this->auth = service('authentication');

        $this->model = new PenyuluhSwastaModel();
    }

    public function penyuluhswasta()
    {


        if (session()->get('username') == "") {
            return redirect()->to('login');
        }
        $penyuluh_model = new PenyuluhSwastaModel();
        $swasta_data = $penyuluh_model->getPenyuluhSwastaTotal(session()->get('kodebapel'));
        $namaprop = $penyuluh_model->getPropvinsi();
        $tugas = $penyuluh_model->getTugas(session()->get('kodebapel'));
        $status = $penyuluh_model->getStatus();
        $data = [
            'jml_data' => $swasta_data['jum'],
            'nama_kabupaten' => $swasta_data['nama_kab'],
            'tabel_data' => $swasta_data['table_data'],
            'namaprop' => $namaprop,
            'tugas' => $tugas,
            'status' => $status,
            'title' => 'Penyuluh Swasta',
            'name' => 'Swasta'
        ];

        return view('kab/penyuluh/penyuluhswasta', $data);
    }


    public function save()
    {
        try {
            $res = $this->model->save([
                'jenis_penyuluh' => $this->request->getPost('jenis_penyuluh'),
                'noktp' => $this->request->getPost('noktp'),
                'nama' => $this->request->getPost('nama'),
                'thn_lahir' => $this->request->getPost('thn_lahir'),
                'bln_lahir' => $this->request->getPost('bln_lahir'),
                'tgl_lahir' => $this->request->getPost('tgl_lahir'),
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'satminkal' => $this->request->getPost('satminkal'),
                'lokasi_kerja' => $this->request->getPost('lokasi_kerja'),
                'alamat' => $this->request->getPost('alamat'),
                'dati2' => $this->request->getPost('dati2'),
                'kodepos' => $this->request->getPost('kodepos'),
                'kode_prop' => $this->request->getPost('kode_prop'),
                'telp' => $this->request->getPost('telp'),
                'email' => $this->request->getPost('email'),
                'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
                'alamat_perush' => $this->request->getPost('alamat_perush'),
                'telp_perush' => $this->request->getPost('telp_perush'),
                'jabatan_di_perush' => $this->request->getPost('jabatan_di_perush'),
                'tempat_tugas' => $this->request->getPost('tempat_tugas'),
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
        return redirect()->to('/penyuluhswasta');
    }

    public function edit($id_swa)
    {
        $swasta = $this->model->getDetailEdit($id_swa);
        echo $swasta;
    }

    public function editstatus($id)
    {
        $thl = $this->model->getDetailEditStatus($id);
        echo $thl;
    }

    public function updatestatus($id)
    {
        //$id = $this->request->getVar('idjab');
        $nama = $this->request->getPost('nama');
        //$gelar_blk = $this->request->getPost('gelar_blk');
        //$gelar_dpn = $this->request->getPost('gelar_dpn');
        $status = $this->request->getPost('status');
        $tgl_status = $this->request->getPost('tgl_status');
        $ket_status = $this->request->getPost('ket_status');

        $this->model->save([
            'id' => $id,
            'nama' => $nama,
            //'gelar_dpn' => $gelar_dpn,
            //'gelar_blk' => $gelar_blk,
            'status' => $status,
            'tgl_status' => $tgl_status,
            'ket_status' => $ket_status
        ]);

        //session()->setFlashdata('pesan', 'Data berhasil diubah');

    }

    public function update($id_swa)
    {
        //$id = $this->request->getVar('idjab');
        $jenis_penyuluh = $this->request->getPost('jenis_penyuluh');
        $noktp = $this->request->getPost('noktp');
        $nama = $this->request->getPost('nama');
        $tgl_lahir = $this->request->getPost('tgl_lahir');
        $bln_lahir = $this->request->getPost('bln_lahir');
        $thn_lahir = $this->request->getPost('thn_lahir');
        $tempat_lahir = $this->request->getPost('tempat_lahir');
        $jenis_kelamin = $this->request->getPost('jenis_kelamin');
        $satminkal = $this->request->getPost('satminkal');
        $lokasi_kerja = $this->request->getPost('lokasi_kerja');
        $alamat = $this->request->getPost('alamat');
        $dati2 = $this->request->getPost('dati2');
        $kodepos = $this->request->getPost('kodepos');
        $kode_prop = $this->request->getPost('kode_prop');
        $telp = $this->request->getPost('telp');
        $email = $this->request->getPost('email');
        $nama_perusahaan = $this->request->getPost('nama_perusahaan');
        $alamat_perush = $this->request->getPost('alamat_perush');
        $telp_perush = $this->request->getPost('telp_perush');
        $jabatan_di_perush = $this->request->getPost('jabatan_di_perush');
        $tempat_tugas = $this->request->getPost('tempat_tugas');
        $tgl_update = $this->request->getPost('tgl_update');

        $this->model->save([
            'id_swa' => $id_swa,
            'jenis_penyuluh' => $jenis_penyuluh,
            'noktp' => $noktp,
            'nama' => $nama,
            'tgl_lahir' => $tgl_lahir,
            'bln_lahir' => $bln_lahir,
            'thn_lahir' => $thn_lahir,
            'tempat_lahir' => $tempat_lahir,
            'jenis_kelamin' => $jenis_kelamin,
            'satminkal' => $satminkal,
            'lokasi_kerja' => $lokasi_kerja,
            'alamat' => $alamat,
            'dati2' => $dati2,
            'kodepos' => $kodepos,
            'kode_prop' => $kode_prop,
            'telp' => $telp,
            'email' => $email,
            'nama_perusahaan' => $nama_perusahaan,
            'alamat_perush' => $alamat_perush,
            'telp_perush' => $telp_perush,
            'jabatan_di_perush' => $jabatan_di_perush,
            'tempat_tugas' => $tempat_tugas,
            'tgl_update' => $tgl_update
        ]);

        //session()->setFlashdata('pesan', 'Data berhasil diubah');

    }
}
