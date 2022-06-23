<?php

namespace App\Controllers\manage;

use App\Controllers\BaseController;
use App\Models\RolemenuModel;
use App\Models\MenuModel;

class RoleMenu extends BaseController
{

    protected $model;
    protected $menumodel;

    public function __construct()
    {
        $this->session = service('session');
        $this->config = config('Auth');
        $this->auth = service('authentication');

        $this->model = new RolemenuModel();
        $this->menumodel = new MenuModel();
    }
    public function index()
    {
        if (session()->get('username') == "") {
            return redirect()->to('login');
        }

        $query = $this->model->getUserRoleAll();
        $role = $this->model->getRole();
        $menu = $this->menumodel->getMenuAll();
        // dd($role);
        $data = [
            'title' => 'User Access Role',
            'dt' => $query,
            'role' => $role,
            'menu' => $menu
        ];

        return view('manage/roleuser', $data);
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

    public function akses_menu_save()
    {
        $role = $this->request->getPost('role_id');
        $menu = $this->request->getPost('menu_id');
        $this->model->save([
            'role_id' => $role,
            'menu_id' => $menu
        ]);
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

    public function deleteAkses($id)
    {
        $this->model->delete($id);
        // session()->setFlashdata('pesan', 'Data berhasil dihapus');
        // return redirect()->to('master/jabatan');
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
        $menu = $this->model->getRoleById($id);
        //dd($menu);
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

    public function updateRoleAccess($id)
    {
        $menu = $this->request->getPost('menu_id');
        $this->model->save([
            'role_id' => $id,
            'menu_id' => $menu
        ]);
    }
}
