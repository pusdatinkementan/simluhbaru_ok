<?php

namespace App\Controllers\KelembagaanPelakuUtama\KelompokTani;

use App\Controllers\BaseController;
use App\Models\KelembagaanPelakuUtama\KelompokTani\ListPoktanModel;
use App\Models\KelembagaanPelakuUtama\KelompokTani\KomoditasBunModel;
use App\Models\KelembagaanPelakuUtama\KelompokTani\KomoditasHorModel;
use App\Models\KelembagaanPelakuUtama\KelompokTani\KomoditasNakModel;
use App\Models\KelembagaanPelakuUtama\KelompokTani\KomoditasOlahModel;
use App\Models\KelembagaanPelakuUtama\KelompokTani\KomoditasTpModel;
use App\Models\KodeWilayah\KodeWilModel2;

ini_set("memory_limit", "1090M");
class JenisKomoditasDiusahakan extends BaseController
{
    protected $model;
    public function __construct()
    {
        $this->model = new KomoditasBunModel();
        $this->Hormodel = new KomoditasHorModel();
        $this->Nakmodel = new KomoditasNakModel();
        $this->Olahmodel = new KomoditasOlahModel();
        $this->Tpmodel = new KomoditasTpModel();

        if (empty(session()->get('status_user')) || session()->get('status_user') == '2') {
            $kode = '00';
        } elseif (session()->get('status_user') == '1') {
            $kode = session()->get('kodebakor');
        } elseif (session()->get('status_user') == '200') {
            $kode = session()->get('kodebapel');
        } elseif (session()->get('status_user') == '300') {
            $kode = session()->get('kodebpp');
        }
    }

    public function komoditasbun()
    {
        $get_param = $this->request->getGet();
        $ip = $get_param['ip'];
        $komoditasbun_model = new komoditasBunModel();
        $komoditashor_model = new KomoditasHorModel();
        $komoditasnak_model = new KomoditasNakModel();
        $komoditasolah_model = new KomoditasOlahModel();
        $komoditastp_model = new KomoditasTPModel();
        $kodewil_model = new KodeWilModel2();
        $komoditas = $komoditasbun_model->getKomoditas();
        $komoditasbun_data = $komoditasbun_model->getKomoditasBun($ip);
        $komoditashor_data = $komoditashor_model->getKomoditasHor($ip);
        $komoditasnak_data = $komoditasnak_model->getKomoditasNak($ip);
        $komoditasolah_data = $komoditasolah_model->getKomoditasOlah($ip);
        $komoditastp_data = $komoditastp_model->getKomoditasTp($ip);
        $bun = $komoditasbun_model->getBun();
        $hor = $komoditashor_model->getHor();
        $nak = $komoditasnak_model->getNak();
        $olah = $komoditasolah_model->getOlah();
        $tp = $komoditastp_model->getTp();
        $data = [

            'title' => 'Jenis Komoditas Usaha',
            'name' => 'Jenis Komoditas Usaha',
            'komoditas' => $komoditas,
            'id_poktan' => $ip,
            'bun' => $bun,
            'hor' => $hor,
            'nak' => $nak,
            'olh' => $olah,
            'tp' => $tp,
            'kebun' => $komoditasbun_data['kebun'],
            'ternak' => $komoditasnak_data['ternak'],
            'olah' => $komoditasolah_data['olah'],
            'tapang' => $komoditastp_data['tapang'],
            'horti' => $komoditashor_data['horti']

        ];
        return view('KelembagaanPelakuUtama/KelompokTani/jeniskomoditas', $data);
    }
    public function saveBun()
    {
        try {
            $res = $this->model->save([

                'id_poktan' => $this->request->getPost('id_poktan'),
                'kode_komoditas_bun' => $this->request->getPost('kode_komoditas_bun'),
                'sektor' => $this->request->getPost('sektor'),

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
        // return redirect()->to('/listpoktan?kode_kec=' . $this->request->getPost('kode_kec'));
    }
    public function detailBun($id_usaha)
    {
        $bun = $this->model->getDataById($id_usaha);
        echo $bun;
    }

    public function updateBun($id_usaha)
    {

        $id_poktan = $this->request->getPost('id_poktan');
        $kode_komoditas_bun = $this->request->getPost('kode_komoditas_bun');
        $sektor = $this->request->getPost('sektor');

        $this->model->save([
            'id_usaha' => $id_usaha,
            'id_poktan' => $id_poktan,
            'kode_komoditas_bun' => $kode_komoditas_bun,
            'sektor' => $sektor,
        ]);
    }
    public function deleteBun($id_usaha)
    {
        $this->model->delete($id_usaha);
        //return redirect()->to('/listpoktan');
    }
    public function saveHor()
    {
        try {
            $res = $this->Hormodel->save([

                'id_poktan' => $this->request->getPost('id_poktan'),
                'kode_komoditas_hor' => $this->request->getPost('kode_komoditas_hor'),
                'sektor' => $this->request->getPost('sektor'),

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
    public function detailHor($id_usaha)
    {
        $hor = $this->Hormodel->getDataById($id_usaha);
        echo $hor;
    }

    public function updateHor($id_usaha)
    {

        $id_poktan = $this->request->getPost('id_poktan');
        $kode_komoditas_hor = $this->request->getPost('kode_komoditas_hor');
        $sektor = $this->request->getPost('sektor');

        $this->Hormodel->save([
            'id_usaha' => $id_usaha,
            'id_poktan' => $id_poktan,
            'kode_komoditas_hor' => $kode_komoditas_hor,
            'sektor' => $sektor,
        ]);
    }
    public function deleteHor($id_usaha)
    {
        $this->Hormodel->delete($id_usaha);
        //return redirect()->to('/listpoktan');
    }

    public function saveNak()
    {
        try {
            $res = $this->Nakmodel->save([

                'id_poktan' => $this->request->getPost('id_poktan'),
                'kode_komoditas_nak' => $this->request->getPost('kode_komoditas_nak'),
                'sektor' => $this->request->getPost('sektor'),

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
    public function detailNak($id_usaha)
    {
        $nak = $this->Nakmodel->getDataById($id_usaha);
        echo $nak;
    }

    public function updateNak($id_usaha)
    {

        $id_poktan = $this->request->getPost('id_poktan');
        $kode_komoditas_nak = $this->request->getPost('kode_komoditas_nak');
        $sektor = $this->request->getPost('sektor');

        $this->Nakmodel->save([
            'id_usaha' => $id_usaha,
            'id_poktan' => $id_poktan,
            'kode_komoditas_nak' => $kode_komoditas_nak,
            'sektor' => $sektor,
        ]);
    }
    public function deleteNak($id_usaha)
    {
        $this->Nakmodel->delete($id_usaha);
        //return redirect()->to('/listpoktan');
    }

    public function saveOlah()
    {
        try {
            $res = $this->Olahmodel->save([

                'id_poktan' => $this->request->getPost('id_poktan'),
                'kode_komoditas_olah' => $this->request->getPost('kode_komoditas_olah'),
                'sektor' => $this->request->getPost('sektor'),

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
    public function detailOlah($id_usaha)
    {
        $olah = $this->Olahmodel->getDataById($id_usaha);
        echo $olah;
    }

    public function updateOlah($id_usaha)
    {

        $id_poktan = $this->request->getPost('id_poktan');
        $kode_komoditas_olah = $this->request->getPost('kode_komoditas_olah');
        $sektor = $this->request->getPost('sektor');

        $this->Olahmodel->save([
            'id_usaha' => $id_usaha,
            'id_poktan' => $id_poktan,
            'kode_komoditas_olah' => $kode_komoditas_olah,
            'sektor' => $sektor,
        ]);
    }
    public function deleteOlah($id_usaha)
    {
        $this->Olahmodel->delete($id_usaha);
        //return redirect()->to('/listpoktan');
    }
    public function saveTp()
    {
        try {
            $res = $this->Tpmodel->save([

                'id_poktan' => $this->request->getPost('id_poktan'),
                'kode_komoditas_tp' => $this->request->getPost('kode_komoditas_tp'),
                'sektor' => $this->request->getPost('sektor'),

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
    public function detailTp($id_usaha)
    {
        $tp = $this->Tpmodel->getDataById($id_usaha);
        echo $tp;
    }

    public function updateTp($id_usaha)
    {

        $id_poktan = $this->request->getPost('id_poktan');
        $kode_komoditas_tp = $this->request->getPost('kode_komoditas_tp');
        $sektor = $this->request->getPost('sektor');

        $this->Tpmodel->save([
            'id_usaha' => $id_usaha,
            'id_poktan' => $id_poktan,
            'kode_komoditas_tp' => $kode_komoditas_tp,
            'sektor' => $sektor,
        ]);
    }
    public function deleteTp($id_usaha)
    {
        $this->Tpmodel->delete($id_usaha);
        //return redirect()->to('/listpoktan');
    }
}