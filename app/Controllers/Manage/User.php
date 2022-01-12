<?php

namespace App\Controllers\manage;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\WilayahModel;
use Config\Services;

class User extends BaseController
{
    protected $model1;
    protected $model2;

    public function __construct()
    {
        $this->model1 = new UserModel();
        $this->model2 = new WilayahModel();
    }
    public function index()
    {
        $query = $this->model1->getStatusUser();
        $prov = $this->model2->getProv();
        $data = [
            'title' => 'Manajemen User',
            'stsuser' => $query,
            'prov' => $prov
        ];

        return view('manage/user', $data);
    }

    public function ajax_user_list()
    {
        $request = Services::request();
        $datatable = new UserModel();
        if ($request->getMethod(true) === 'POST') {
            $lists = $datatable->getDatatables($request);
            $data = [];
            $no = $request->getPost('start');

            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->username;
                $row[] = $list->p_oke;
                $row[] = $list->name;
                $row[] = $list->namastatus;
                $row[] = $list->nama_bpp;
                $row[] = $list->satminkal;
                $row[] = '<button type="button" id="btnHapusUser" data-id=' . $list->id . ' class="btn btn-danger btn-xs">Hapus</button>
                      <button type="button" id="btnEditUser" data-id=' . $list->id . ' class="btn btn-primary btn-xs">Edit</button>';
                $data[] = $row;
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $datatable->countAll($request),
                'recordsFiltered' => $datatable->countFiltered($request),
                'data' => $data
            ];

            echo json_encode($output);
        }
    }

    public function saveUser()
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => md5($this->request->getPost('password')),
            'name' => $this->request->getPost('name'),
            'joiningdate' => $this->request->getPost('joiningdate'),
            'status' => $this->request->getPost('status'),
            'phone' => $this->request->getPost('phone'),
            'mobile' => $this->request->getPost('mobile'),
            'idprop' => $this->request->getPost('idprop'),
            'kodebakor' => $this->request->getPost('kodebakor'),
            'kodebapel' => $this->request->getPost('kodebapel'),
            'kodebpp' => $this->request->getPost('kodebpp'),
            'p_oke' => $this->request->getPost('password')
        ];

        $this->model1->saveUser($data);
    }

    public function edit($id)
    {
        if (session()->get('username') == "") {
            return redirect()->to('login');
        }

        $data = $this->model1->getUserById($id);
        echo $data;
    }

    public function update($id)
    {
        if (session()->get('username') == "") {
            return redirect()->to('login');
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'password' => md5($this->request->getPost('password')),
            'name' => $this->request->getPost('namauser'),
            'status' => $this->request->getPost('status'),
            'phone' => $this->request->getPost('phone'),
            'mobile' => $this->request->getPost('mobile'),
            'idprop' => $this->request->getPost('prov'),
            'kodebakor' => $this->request->getPost('prov'),
            'kodebapel' => $this->request->getPost('kab'),
            'kodebpp' => $this->request->getPost('kec'),
            'p_oke' => $this->request->getPost('password')
        ];

        $this->model1->updateUser($id, $data);
    }
}
