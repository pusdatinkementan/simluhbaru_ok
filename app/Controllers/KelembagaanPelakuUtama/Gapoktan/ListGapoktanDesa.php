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
        $listgapoktandesa_model = new ListGapoktanDesaModel();
        $desa = $listgapoktandesa_model->getDesa(session()->get('kodebapel'));
        $listgapoktandesa_data = $listgapoktandesa_model->getListGapoktanDesaTotal($kode_desa);
        $kode_data = $kode_model->getKodeWil2(session()->get('kodebapel'));

        $data = [
            
            'nama_desa' => $listgapoktandesa_data['nama_desa'],
            'tabel_data' => $listgapoktandesa_data['table_data'],
            'title' => 'List Gabungan Kelompok Tani',
            'name' => 'List Gabungan Kelompok Tani',
            'kode_prop' => $kode_data['kode_prop'],
            'desa' => $desa,
            
        ];

        return view('KelembagaanPelakuUtama/Gapoktan/listgapoktandesa', $data);
    }
    public function edit($id_poktan)
    {
        $poktan = $this->model->getDataById($id_poktan);
        echo $poktan;
    }
    public function update($id_poktan)
    {
        
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
        $simluh_jenis_kelompok = $this->request->getPost('simluh_jenis_kelompok');  
     

       
        $this->model->save([
            'id_poktan' => $id_poktan,
            'id_gap' => $id_gap,
            'kode_kec' => $kode_kec,
            'kode_prop' => $kode_prop,
            'kode_kab' => $kode_kab,
            'kode_desa' => $kode_desa,
            'nama_poktan' => $nama_poktan,
            'ketua_poktan' => $ketua_poktan,
            'alamat' => $alamat,
            'simluh_kelas_kemampuan' => $simluh_kelas_kemampuan,
            'simluh_tahun_bentuk' => $simluh_tahun_bentuk,
            'simluh_tahun_tap_kelas' => $simluh_tahun_tap_kelas,
            'simluh_jenis_kelompok' => $simluh_jenis_kelompok,
           
        ]);

        //session()->setFlashdata('pesan', 'Data berhasil diubah');

    }
    public function delete($id_poktan)
    {
        $this->model->delete($id_poktan);
       // return redirect()->to('/gapoktan');
    }
}