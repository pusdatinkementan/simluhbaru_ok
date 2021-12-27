<?php

namespace App\Controllers\manage;

use App\Controllers\BaseController;
use App\Models\UserModel;
use Config\Services;

class User extends BaseController
{
    protected $model;

    public function __construct()
    {
        // $this->model = new UserModel();
    }
    public function index()
    {
        // $query = $this->model->findAll();
        $data = [
            'title' => 'Manajemen User'
            //'dt' => $query
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
                $row[] = $list->name;
                $row[] = $list->status;
                $row[] = $list->idProp;
                $row[] = $list->kodeBakor;
                $row[] = $list->kodeBapel;
                $row[] = $list->kodeBpp;
                $row[] = $list->p_oke;
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
        echo "test";
    }
}
