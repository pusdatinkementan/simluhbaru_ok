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

        $postdata = http_build_query(
            // array(
            //     'NIK' => $this->input->post('NIK'),
            //     'NAMA_LGKP' => $this->input->post('NAMA_LGKP'),
            //     'JENIS_KLMIN' => $this->input->post('JENIS_KLMIN'),
            //     'TMPT_LHR' => $this->input->post('TMPT_LHR'),
            //     'TGL_LHR' => $this->input->post('TGL_LHR'),
            //     'TRESHOLD' => 90,
            //     'user_id' => '11953174202203011dummybppsdmpkementan',
            //     'password' => '123',
            //     'ip_user' => '10.214.41.21'
            // )

            array(
                'NIK' => '3173044607870002',
                'NAMA_LGKP' => 'YULIANTI',
                'JENIS_KLMIN' => 'Perempuan',
                'TMPT_LHR' => 'JAKARTA',
                'TGL_LHR' => '1987-07-06',
                'TRESHOLD' => 90,
                'user_id' => '11953174202203011dummybppsdmpkementan',
                'password' => '123',
                'ip_user' => '10.214.41.21'
            )
        );

        $opts = array(
            'http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );

        $context  = stream_context_create($opts);

        $result = file_get_contents('http://172.16.160.84:8000/dukcapil/get_json/bppsdmp_kementan/nik_verifby_elemen', false, $context);

        $resultJson = json_decode($result, true);
        print_r($resultJson);
    }
}
