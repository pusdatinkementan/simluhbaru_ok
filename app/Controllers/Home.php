<?php

namespace App\Controllers;

use App\Models\PenyuluhModel;

class Home extends BaseController
{
	protected $session;
    
    function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();       
		session();

        if (session()->get('username') <> "") {
            return redirect()->to('/lembaga');
        }
    }
	
	public function index()
	{
		
		$penyuluhModel = new PenyuluhModel();
		$penyuluh = $penyuluhModel->findAll();

		//dd($penyuluh);

		$data = [
			'title' => 'Home',
			'dt' => $penyuluh
		];

		return view('welcome_message', $data);
	}
}
