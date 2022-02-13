<?php

namespace App\Controllers\manage;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\WilayahModel;
use Config\Services;
use Exception;

use function PHPUnit\Framework\isNull;

class Filter extends BaseController
{
    protected $model1;
    protected $model2;
    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
        $this->model1 = new UserModel();
        $this->model2 = new WilayahModel();
    }
    public function index()
    {
        $query = $this->model1->getStatusUser();
        $prov = $this->model2->getProv();

        $kdprov = $this->request->getPost('filter_prov');
        $kdkab = $this->request->getPost('filter_kab');
        $kdkec = $this->request->getPost('filter_kec');

        if (isset($kdprov) && $kdkab == '') {
            $sub = substr($kdprov, 0, 2);
            $search = "SELECT * FROM useradmin WHERE kodeBakor LIKE '" . $sub . "%'";
            $q = $this->db->query($search);
            $row   = $q->getResultArray();
            //dd($row);
        }

        if (isset($kdkab)) {
            // $sub = substr($kdkab, 0, 2);
            $search = "SELECT * FROM useradmin WHERE kodeBapel LIKE '" . $kdkab . "%'";
            //echo $search;
            $q = $this->db->query($search);
            $row   = $q->getResultArray();
        }

        if (isset($kdkec)) {
            // $sub = substr($kdkab, 0, 2);
            $search = "SELECT * FROM useradmin WHERE kodeBpp LIKE '" . $kdkec . "%'";
            //echo $search;
            $q = $this->db->query($search);
            $row   = $q->getResultArray();
        }

        $data = [
            'title' => 'Manajemen User',
            'dtsearch' => $row,
            'prov' => $prov,
            'stsuser' => $query
        ];

        // dd($data);

        return view('manage/userfilter', $data);
    }

    function tabel_filter($x)
    {
        $tbl = "<table id='tblresFilteruser' class='table'>
        <thead>
            <tr>
                <th scope='col'>No</th>
                <th scope='col'>Username</th>
                <th scope='col'>Password</th>
                <th scope='col'>Nama User</th>
                <th scope='col'>Status</th>
                <th scope='col'>BPP</th>
                <th scope='col'>Satker</th>
                <th scope='col'>Aksi</th>
            </tr>
        </thead><tbody>";
        $no = 1;
        foreach ($x as $dt) {
            $tbl .= "<tr>
                        <td>" . $no++ . "</td>
                        <td>" . $dt['username'] . "</td>
                        <td>" . $dt['p_oke'] . "</td>
                        <td>" . $dt['name'] . "</td>
                        <td>" . $dt['namastatus'] . "</td>
                        <td>" . $dt['nama_bpp'] . "</td>                       
                        <td>" . $dt['satminkal'] . "</td>                       
                        <td><button type='button' id='btnHapusUser' data-id='" . $dt['id'] . "' class='btn btn-danger btn-xs'>Hapus</button>
                        <button type='button' id='btnEditUser' data-id='" . $dt['id'] . "' class='btn btn-primary btn-xs'>Edit</button>
                      <button type='button' id='btnResetUser' data-id='" . $dt['id'] . "' class='btn btn-warning btn-xs'>Reset</button></td>                       
                </tr>";
        }

        $tbl .= "</tbody>
        </table>";
        return $tbl;
    }


    function filter_prov()
    {
        $kdprov = $this->request->getPost('kdprov');
        $sub = substr($kdprov, 0, 2);
        $search = "SELECT * FROM useradmin WHERE kodeBakor LIKE '" . $sub . "%'";
        $q = $this->db->query($search);
        $row   = $q->getResultArray();
        echo $this->tabel_filter($row);
    }

    function filter_kab()
    {
        $kdkab = $this->request->getPost('kdkab');
        $search = "SELECT * FROM useradmin WHERE kodeBapel LIKE '" . $kdkab . "%'";
        $q = $this->db->query($search);
        $row   = $q->getResultArray();
        // dd($row);
        echo $this->tabel_filter($row);
    }

    function filter_kec()
    {
        $kdkec = $this->request->getPost('kdkec');
        $search = "SELECT * FROM useradmin WHERE kodeBpp = '" . $kdkec . "'";
        $q = $this->db->query($search);
        $row   = $q->getResultArray();
        echo $this->tabel_filter($row);
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
                      <button type="button" id="btnEditUser" data-id=' . $list->id . ' class="btn btn-primary btn-xs">Edit</button>
                      <button type="button" id="btnResetUser" data-id=' . $list->id . ' class="btn btn-warning btn-xs">Reset</button>';
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

    public function updatepass($id)
    {
        if (session()->get('username') == "") {
            return redirect()->to('login');
        }

        $data = [
            'password' => md5($this->request->getPost('newpass')),
            'p_oke' => $this->request->getPost('newpass'),
            'updated_at' => $this->request->getPost('updatedat')
        ];

        $this->model1->updateUser($id, $data);
    }

    public function delete($id)
    {
        try {
            $this->model1->deleteUser($id);
            return 'success';
        } catch (\Exception $e) {
            return 'error';
        }
        //return $id;
    }
}
