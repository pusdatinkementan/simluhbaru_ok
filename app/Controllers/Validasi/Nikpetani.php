<?php

namespace App\Controllers\validasi;

use App\Controllers\BaseController;
use App\Models\ValidasiNikModel;

class Nikpetani extends BaseController
{
    protected $model;


    public function __construct()
    {
        $this->session = service('session');
        $this->config = config('Auth');
        $this->auth = service('authentication');
        $this->model = new ValidasiNikModel();
    }

    public function index()
    {
        if (session()->get('username') == "") {
            return redirect()->to('login');
        }

        $data = [
            'title' => 'Validasi NIK',
        ];

        return view('validasi/indexnik', $data);
    }

    public function ceknik($nik)
    {
        if (session()->get('username') == "") {
            return redirect()->to('login');
        }

        try {
            return $this->model->getNikPetani($nik);
        } catch (\Exception $e) {
            return 'error';
        }
    }

    public function cekdukcapil()
    {
        $treshold = 100;
        $opts = '{
            "NIK": "' . $this->request->getPost("NIK") . '",
            "NAMA_LGKP": "' . $this->request->getPost("NAMA_LGKP") . '",
            "JENIS_KLMIN": "' . $this->request->getPost("JENIS_KLMIN") . '",
            "TMPT_LHR": "' . $this->request->getPost("TMPT_LHR") . '",
            "TGL_LHR": "' . $this->request->getPost("TGL_LHR") . '",
            "TRESHOLD": ' . $treshold . ',
            "user_id": "1289172202206071bppsdmkementan",
            "password": "gTa7q8j",
            "ip_user": "10.160.84.10"
        }';
        // print_r($opts);
        // die();

        // $opts = '{
        //     "NIK": "3173044607870002",
        //     "NAMA_LGKP": "YULIANTI",
        //     "JENIS_KLMIN": "Perempuan",
        //     "TMPT_LHR": "JAKARTA",
        //     "TGL_LHR": "06-07-1987",
        //     "TRESHOLD": 90,
        //     "user_id": "11953174202203011dummybppsdmpkementan",
        //     "password": "123",
        //     "ip_user": "10.214.41.21"
        // }';

        // dd($opts);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            // CURLOPT_URL => 'http://172.16.160.128:8000/dukcapil/get_json/bppsdmp_kementan/nik_verifby_elemen',
            CURLOPT_URL => 'http://172.16.160.128:8000/dukcapil/get_json/badan_penyuluhan_sdm/nik_verifby_elemen',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $opts,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Cookie: JSESSIONID=9C88C7068F7789ED7F03CE08B596BA04; SRVNAME=app08-nutanix'
            ),
        ));

        $response = curl_exec($curl);
        // print_r($response);
        // die();

        curl_close($curl);

        $response = json_decode($response);

        $msg = '';
        $valid = true;
        if (isset($response->content[0]->RESPONSE_CODE) && $response->content[0]->RESPONSE_CODE == '5') {
            $msg .= $response->content[0]->RESPON;
            $valid = false;
        } else {

            if (isset($response->content[0]->RESPONSE_CODE) && $response->content[0]->RESPONSE_CODE == '2') {
                $valid = false;
                $response->content[0]->RESPON . '\n';
            } else {

                if (explode(' ', $response->content[0]->NAMA_LGKP)[0] == 'Sesuai') {
                    $msg .= 'Nama Lengkap ' . $response->content[0]->NAMA_LGKP . '\n';
                } else {
                    $valid = false;
                    $msg .= 'Nama Lengkap ' . $response->content[0]->NAMA_LGKP . '\n';
                }

                if ($response->content[0]->JENIS_KLMIN == 'Sesuai') {
                    $msg .= 'Jenis Kelamin ' . $response->content[0]->JENIS_KLMIN . '\n';
                } else {
                    $valid = false;
                    $msg .= 'Jenis Kelamin ' . $response->content[0]->JENIS_KLMIN . '\n';
                }

                if (explode(' ', $response->content[0]->TMPT_LHR)[0] == 'Sesuai') {
                    $msg .= 'Tempat Lahir' . $response->content[0]->TMPT_LHR . '\n';
                } else {
                    $valid = false;
                    $msg .= 'Tempat Lahir ' . $response->content[0]->TMPT_LHR . '\n';
                }

                if ($response->content[0]->TGL_LHR == 'Sesuai') {
                    $msg .= 'Tanggal Lahir ' . $response->content[0]->TGL_LHR . '\n';
                } else {
                    $valid = false;
                    $msg .= 'Tanggal Lahir ' . $response->content[0]->TGL_LHR . '\n';
                }
            }
        }

        if ($valid == true) {
            $valid = 'valid';
        } else {
            $valid = 'not valid';
        }
        //save ke tabel di db

        $data = [
            'NO_KTP' => $this->request->getPost("NIK"),
            'RESPONSE_JSON' => json_encode($response),
            'RESPONSE_STATUS' => $valid,
            'RESPONSE_MESSAGE' => $msg,
            'RESPONSE_NAMA_LGKP' => $response->content[0]->NAMA_LGKP,
            'RESPONSE_JENIS_KLMIN' => $response->content[0]->JENIS_KLMIN,
            'RESPONSE_TMPT_LHR' => $response->content[0]->TMPT_LHR,
            'RESPONSE_TGL_LHR' => $response->content[0]->TGL_LHR,
            'RESPONSE_TRESHOLD' => $treshold,
            'RESPONSE_DATETIME' => date('Y-m-d H:i:s')
        ];
        try {
            $this->model->saveNIK($data, $this->request->getPost("NIK"));
            //  return 'success';
            $dt = [
                'status' => 'sukses',
                'hasil' => $data
            ];
            return json_encode($dt);
        } catch (\Exception $e) {
            print_r($e);
            return 'error';
        }
    }
}
