<?php

namespace App\Controllers\KelembagaanPelakuUtama\KelompokTani;
use App\Controllers\BaseController;
use App\Models\KelembagaanPelakuUtama\KelompokTani\ListBantuModel;

class ListBantu extends BaseController
{
    public function __construct()
    {
        $this->session = service('session');
        $this->config = config('Auth');
        $this->auth = service('authentication');
        $this->model = new ListBantuModel();
    }
    public function listbantu()
    {
         
        if (session()->get('username') == "") {
            return redirect()->to('login');
        }
        $get_param = $this->request->getGet();

        $ip = $get_param['ip'];
        $listbantu_model = new ListBantuModel();
        $kegiatan = $listbantu_model->getKegiatan();
        $listbantu_data = $listbantu_model->getListBantu($ip);

        $data = [
            
            'nama_poktan' => $listbantu_data['nama_poktan'],
            'tabel_data' => $listbantu_data['table_data'],
            'title' => 'List Bantu Tani',
            'name' => 'List Bantu Tani',
            'kegiatan' => $kegiatan,
            'id_poktan' => $ip,
           
        ];

        return view('KelembagaanPelakuUtama/KelompokTani/listbantu', $data);
    }
    public function save()
    {
        try {
            $res = $this->model->save([
                'id_poktan' => $this->request->getPost('id_poktan'),
                'kegiatan' => $this->request->getPost('kegiatan'),
                'volume' => $this->request->getPost('volume'),
                'tahun' => $this->request->getPost('tahun'),
            ]);
            if($res == false){
                $data = [
                    "value" => false,
                    "message" => 'data tidak lengkap'
                ];
            }else{
                $data = [
                    "value" => true
                ];
            }
            return json_encode($data);
        } catch (\Exception $e){
            $data = [
                "value" => false,
                "message" => $e->getMessage() 
            ];
            return json_encode($data);
        }
        // return redirect()->to('/listpoktan?kode_kec=' . $this->request->getPost('kode_kec'));
    }
    public function edit($idban)
    {
        $bantuan = $this->model->getDataById($idban);
        echo $bantuan;
    }

    public function update($idban)
    {
        
        $id_poktan = $this->request->getPost('id_poktan');
        $kegiatan = $this->request->getPost('kegiatan');
        $volume = $this->request->getPost('volume');
        $tahun = $this->request->getPost('tahun');
      
        $this->model->save([
            'idban' => $idban,
            'id_poktan' => $id_poktan,
            'kegiatan' => $kegiatan,
            'volume' => $volume,
            'tahun' => $tahun,
            
        ]);

        //session()->setFlashdata('pesan', 'Data berhasil diubah');

    }
    public function delete($idban)
    {
        $this->model->delete($idban);
       // return redirect()->to('/listpoktan');
    }
}