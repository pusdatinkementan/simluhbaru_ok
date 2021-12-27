<?php

namespace App\Controllers\KelembagaanPelakuUtama\KelembagaanEkonomiPetani;

use App\Controllers\BaseController;
use App\Models\KelembagaanPelakuUtama\KelembagaanEkonomiPetani\ListKEP2LModel;
use App\Models\KelembagaanPelakuUtama\KelembagaanEkonomiPetani\KegiatanBunModel;
use App\Models\KelembagaanPelakuUtama\KelembagaanEkonomiPetani\KegiatanHorModel;
use App\Models\KelembagaanPelakuUtama\KelembagaanEkonomiPetani\KegiatanNakModel;
use App\Models\KelembagaanPelakuUtama\KelembagaanEkonomiPetani\KegiatanOlahModel;
use App\Models\KelembagaanPelakuUtama\KelembagaanEkonomiPetani\KegiatanTpModel;
use App\Models\KodeWilayah\KodeWilModel2;

ini_set("memory_limit", "1090M");
class KegiatanUsaha extends BaseController
{
    protected $model;
    public function __construct()
    {
        $this->model = new KegiatanBunModel();
        $this->Hormodel = new KegiatanHorModel();
        $this->Nakmodel = new KegiatanNakModel();
        $this->Olahmodel = new KegiatanOlahModel();
        $this->Tpmodel = new KegiatanTpModel();

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

    public function kegiatanbun()
    {
        $get_param = $this->request->getGet();
        $id_kep = $get_param['id_kep'];
        $kegiatanbun_model = new KegiatanBunModel();
        $kegiatanhor_model = new KegiatanHorModel();
        $kegiatannak_model = new KegiatanNakModel();
        $kegiatanolah_model = new KegiatanOlahModel();
        $kegiatantp_model = new KegiatanTPModel();
        $kodewil_model = new KodeWilModel2();
        $komoditas = $kegiatanbun_model->getKomoditas();
        $kegiatanbun_data = $kegiatanbun_model->getKegiatanBun($id_kep);
        $kegiatanhor_data = $kegiatanhor_model->getKegiatanHor($id_kep);
        $kegiatannak_data = $kegiatannak_model->getKegiatanNak($id_kep);
        $kegiatanolah_data = $kegiatanolah_model->getKegiatanOlah($id_kep);
        $kegiatantp_data = $kegiatantp_model->getKegiatanTp($id_kep);
        $bun = $kegiatanbun_model->getBun();
        $hor = $kegiatanhor_model->getHor();
        $nak = $kegiatannak_model->getNak();
        $olah = $kegiatanolah_model->getOlah();
        $tp = $kegiatantp_model->getTp();
        $data = [

            'title' => 'Jenis Kegiatan Usaha',
            'name' => 'Jenis Kegiatan Usaha',
            'komoditas' => $komoditas,
            'id_kep' => $id_kep,
            'bun' => $bun,
            'hor' => $hor,
            'nak' => $nak,
            'olh' => $olah,
            'tp' => $tp,
            'kebun' => $kegiatanbun_data['kebun'],
            'ternak' => $kegiatannak_data['ternak'],
            'olah' => $kegiatanolah_data['olah'],
            'tapang' => $kegiatantp_data['tapang'],
            'horti' => $kegiatanhor_data['horti']

        ];
        return view('KelembagaanPelakuUtama/KelembagaanEkonomiPetani/kegiatanusaha', $data);
    }
    public function saveBun()
    {
        try {
            $res = $this->model->save([

                'id_kep' => $this->request->getPost('id_kep'),
                'kode_komoditas_bun' => $this->request->getPost('kode_komoditas_bun'),
                'volume_bun' => $this->request->getPost('volume_bun'),

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

        $id_kep = $this->request->getPost('id_kep');
        $kode_komoditas_bun = $this->request->getPost('kode_komoditas_bun');
        $volume_bun = $this->request->getPost('volume_bun');

        $this->model->save([
            'id_usaha' => $id_usaha,
            'id_kep' => $id_kep,
            'kode_komoditas_bun' => $kode_komoditas_bun,
            'volume_bun' => $volume_bun,
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

                'id_kep' => $this->request->getPost('id_kep'),
                'kode_komoditas_hor' => $this->request->getPost('kode_komoditas_hor'),
                'volume_hor' => $this->request->getPost('volume_hor'),

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
        $id_kep = $this->request->getPost('id_kep');
        $kode_komoditas_hor = $this->request->getPost('kode_komoditas_hor');
        $volume_hor = $this->request->getPost('volume_hor');

        $this->Hormodel->save([
            'id_usaha' => $id_usaha,
            'id_kep' => $id_kep,
            'kode_komoditas_hor' => $kode_komoditas_hor,
            'volume_hor' => $volume_hor,
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

                'id_kep' => $this->request->getPost('id_kep'),
                'kode_komoditas_nak' => $this->request->getPost('kode_komoditas_nak'),
                'volume_nak' => $this->request->getPost('volume_nak'),

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
        $id_kep = $this->request->getPost('id_kep');
        $kode_komoditas_nak = $this->request->getPost('kode_komoditas_nak');
        $volume_nak = $this->request->getPost('volume_nak');

        $this->Nakmodel->save([
            'id_usaha' => $id_usaha,
            'id_kep' => $id_kep,
            'kode_komoditas_nak' => $kode_komoditas_nak,
            'volume_nak' => $volume_nak,
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

                'id_kep' => $this->request->getPost('id_kep'),
                'kode_komoditas_olah' => $this->request->getPost('kode_komoditas_olah'),
                'volume_olah' => $this->request->getPost('volume_olah'),

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

        $id_kep = $this->request->getPost('id_kep');
        $kode_komoditas_olah = $this->request->getPost('kode_komoditas_olah');
        $volume_olah = $this->request->getPost('volume_olah');

        $this->Olahmodel->save([
            'id_usaha' => $id_usaha,
            'id_kep' => $id_kep,
            'kode_komoditas_olah' => $kode_komoditas_olah,
            'volume_olah' => $volume_olah,
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

                'id_kep' => $this->request->getPost('id_kep'),
                'kode_komoditas_tp' => $this->request->getPost('kode_komoditas_tp'),
                'volume_tp' => $this->request->getPost('volume_tp'),

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

        $id_kep = $this->request->getPost('id_kep');
        $kode_komoditas_tp = $this->request->getPost('kode_komoditas_tp');
        $volume_tp = $this->request->getPost('volume_tp');

        $this->Tpmodel->save([
            'id_usaha' => $id_usaha,
            'id_kep' => $id_kep,
            'kode_komoditas_tp' => $kode_komoditas_tp,
            'volume_tp' => $volume_tp,
        ]);
    }
    public function deleteTp($id_usaha)
    {
        $this->Tpmodel->delete($id_usaha);
        //return redirect()->to('/listpoktan');
    }
}