<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RekapModel;
use App\Models\KelembagaanPenyuluhan\Kecamatan\KecamatanModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Rekap extends BaseController
{
    protected $session;

    function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
        helper('autentikasi');
        $this->model = new RekapModel();
		session();
    }


    public function kelembagaan()
    {
		$rmodel = new RekapModel();
		switch (session()->get('status_user') ){
			case '1' :  
				$data = [
					'title' => 'Rekap Kelembagaan Penyuluhan Provinsi',
					'rkeluh' => $rmodel->getRekapKelembagaanprov(session()->get('kodebakor'))
				];
				$view = 'rekap/kelembagaanprov';
				break;
			case '200' :  
				$data = [
					'title' => 'Rekap Kelembagaan Penyuluhan Kabupaten',
					'rkeluh' => $rmodel->getRekapKelembagaankab(session()->get('kodebapel'))
				];
				$view = 'rekap/kelembagaankab';
			break;
			default :  $rekapluh = $rmodel->getRekapkab(session()->get('kodebapel')); break;
		}       
        
        return view($view, $data);
    }
	
	public function ketenagaan()
    {
		$rmodel = new RekapModel();
		switch (session()->get('status_user') ){
			case '1' :  
				$data = [
					'title' => 'Rekap Ketenagaan Penyuluhan Provinsi',
					'rkeluh' => $rmodel->getRekapKetenagaanprov(array("prov"=>session()->get('kodebakor')))
				];
				$view = 'rekap/ketenagaanprov';
				break;
			case '200' :  
				$data = [
					'title' => 'Rekap Ketenagaan Penyuluhan Kabupaten',
					'rkeluh' => $rmodel->getRekapKetenagaankab(session()->get('kodebapel')),
					'sumkab' => $rmodel->getRekapKetenagaanprov(array("kab"=>session()->get('kodebapel'))),
				];
				$view = 'rekap/ketenagaankab';
			break;
			default :  $rekapluh = $rmodel->getRekapkab(session()->get('kodebapel')); break;
		}       
        
        return view($view, $data);
    }

    
}
