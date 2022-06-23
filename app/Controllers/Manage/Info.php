<?php

namespace App\Controllers\manage;

use App\Controllers\BaseController;
use App\Models\InfoModel;

class Info extends BaseController
{

    protected $model;

    public function __construct()
    {
        $this->session = service('session');
        $this->config = config('Auth');
        $this->auth = service('authentication');

        $this->model = new InfoModel();
    }
    public function index()
    {
        if (session()->get('username') == "") {
            return redirect()->to('login');
        }
        // $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        //  $menu = $this->model->getMenuAll();
        $data = [
            'title' => 'Manajemen Info',
            'dt_info' => $this->model->getInfoAll()
        ];

        return view('manage/info', $data);
    }

    public function saveInfo()
    {
        // if (!$this->validate([
        //     // 'nameTxt' => 'required|min_length[10]'
        //     'dokumen' => [
        //         'rules' => 'max_size[dok,1024]',
        //         'errors' => [
        //             //'uploaded' => 'pilih gambar dulu',
        //             'max_size' => 'ukuran dokumen terlalu besar'
        //         ]
        //     ]
        // ])) {

        //     return redirect()->to('manage/info')->withInput();
        // }

        //ambil file
        $dok =  $this->request->getFile('dok');
        $dokname = $dok->getName();
        $dok->move('assets/dok/info', $dokname);

        $data = [
            'judul_info' => $this->request->getPost('judul'),
            'deskripsi_info' => $this->request->getPost('desc'),
            'tgl_info' => $this->request->getPost('tgl'),
            'file_info' => $dokname,
            'status_info' => $this->request->getPost('status'),
            'created_at' => date('Y-m-d h:i:s')
        ];

        try {
            $this->model->saveInfo($data);
            return 'success';
        } catch (\Exception $e) {
            print_r($e);
            return 'error';
        }
    }

    public function submenu()
    {
        if (session()->get('username') == "") {
            return redirect()->to('login');
        }
        // $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $menu = $this->model->getMenuAll();
        $submenu = $this->model->getSubMenuAll();
        $data = [
            'title' => 'Manajemen Sub Menu',
            'menu' => $menu,
            'dt' => $submenu
        ];

        return view('manage/submenu', $data);
    }

    public function submenu_save()
    {
        $data = [
            'menu_id' => $this->request->getPost('menu_id'),
            'title' => $this->request->getPost('judul'),
            'url' => $this->request->getPost('url'),
            'icon' => $this->request->getPost('icon'),
            'is_active' => $this->request->getPost('is_active'),
        ];

        $this->model->saveSubMenu($data);

        // dd($data);

        //return redirect()->to('manage/menu');
    }

    public function editsubmenu($id)
    {
        if (session()->get('username') == "") {
            return redirect()->to('login');
        }

        $data = $this->model->getSubMenuById($id);
        echo $data;
    }

    public function submenu_update($id)
    {
        if (session()->get('username') == "") {
            return redirect()->to('login');
        }

        $data = [
            'menu_id' => $this->request->getPost('menu_id'),
            'title' => $this->request->getPost('judul'),
            'url' => $this->request->getPost('url'),
            'icon' => $this->request->getPost('icon'),
            'is_active' => $this->request->getPost('is_active'),
        ];

        $this->model->updateSubmenu($id, $data);
    }

    public function deleteInfo($id)
    {
        try {
            $this->model->deleteInfo($id);
            return 'success';
        } catch (\Exception $e) {
            // print_r($e);
            return 'error';
        }
    }

    public function save()
    {
        $this->model->save([
            'menu' => $this->request->getPost('menu'),
        ]);

        //return redirect()->to('manage/menu');
    }

    public function edit($id)
    {
        $menu = $this->model->getMenuById($id);
        echo $menu;
    }

    public function update($id)
    {
        $menu = $this->request->getPost('menu');
        $this->model->save([
            'id' => $id,
            'menu' => $menu
        ]);
    }

    public function delete($id)
    {
        $this->model->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        // return redirect()->to('master/jabatan');
    }
}
