<?php

namespace App\Controllers\profil;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Admin extends BaseController
{
    protected $session;
    protected $adminmodel;

    function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
        helper('autentikasi');
        $this->adminmodel = new AdminModel();
    }

    public function index()
    {
        if (session()->get('username') == "") {
            return redirect()->to('login');
        }

        $dtAdmin = $this->adminmodel->getProfil(session()->get('status_user'));

        $data = [
            'title' => 'Profil Admin',
            'dt' => $dtAdmin,
            'validation' => \Config\Services::validation()
        ];

        // dd($data);

        return view('admin/profiladmin', $data);
        //}
    }

    function saveFotoProfil()
    {
        if (!$this->validate([
            // 'nameTxt' => 'required|min_length[10]'
            'foto' => [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    //'uploaded' => 'pilih gambar dulu',
                    'max_size' => 'ukuran gambar terlalu besar',
                    'is_image' => 'bukan gambar',
                    'mime_in' => 'bukan gambar',
                ]
            ]
        ])) {

            return redirect()->to('/profil/admin/')->withInput();
        }

        //ambil file
        $foto =  $this->request->getFile('foto');

        if ($foto->getError() == 4) {
            $namafoto = 'logo.png';
        } else {
            //penamaan file 
            $namafoto = $foto->getRandomName();
            //pindahkan file
            $foto->move('assets/img', $namafoto);
        }

        //simpan ke database
        $data = [
            'fotoprofil' => $namafoto
        ];

        $this->adminmodel->saveProfil($data);

        return redirect()->to('/profil/admin/');
    }
}
