<?php

namespace App\Controllers\Penyuluh;

use App\Controllers\BaseController;
use App\Models\penyuluh\PenyuluhSwastaKecModel;

class PenyuluhSwastaKec extends BaseController
{

    public function __construct()
    {
        $this->session = service('session');
        $this->config = config('Auth');
        $this->auth = service('authentication');

        $this->model = new PenyuluhSwastaKecModel();
    }

    public function penyuluhswastakec()
    {
        // $get_param = $this->request->getGet();

        // $kode_kec = $get_param['kode_kec'];
        // $kode_kab = $get_param['kode_kab'];
        $penyuluh_model = new PenyuluhSwastaKecModel();
        $swastakec_data = $penyuluh_model->getPenyuluhSwastaKecTotal(session()->get('kodebpp'));
        $namaprop = $penyuluh_model->getPropvinsi();
        $tugas = $penyuluh_model->getTugas(session()->get('kodebpp'));

        $data = [
            'jml_data' => $swastakec_data['jum'],
            // 'nama_kabupaten' => $swastakec_data['nama_kab'],
            'nama_kecamatan' => $swastakec_data['nama_kec'],
            'tabel_data' => $swastakec_data['table_data'],
            'namaprop' => $namaprop,
            'tugas' => $tugas,
            'title' => 'Penyuluh Swasta',
            'name' => 'Swasta'
        ];

        // var_dump($data);
        // die();

        return view('kab/penyuluh/penyuluhswastakec', $data);
    }

    public function edit($id_swa)
    {
        $swasta = $this->model->getDetailEdit($id_swa);
        echo $swasta;
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
