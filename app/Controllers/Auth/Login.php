<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
    public function __construct()
    {
        $this->session = service('session');
        $this->config = config('Auth');
        $this->auth = service('authentication');
    }

    public function index()
    {
        $data = [
            'title' => 'Login',
            'config' => $this->config
        ];

        return view('login', $data);
    }

    public function proses()
    {
        $session = session();
        $model = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $model->where('username', $username)->first();
        // dd($data);
        if ($data) {
            $pass = $data['password'];
            //$verify_pass = password_verify(md5($password), $pass);
            if (md5($password) == $pass) {
                $ses_data = [
                    'userid'       => $data['id'],
                    'username'      => $data['username'],
                    'nama'          => $data['name'],
                    'status_user'    => $data['status'],
                    'idprop' => $data['idProp'],
                    'kodebapel' => $data['kodeBapel'],
                    'kodebakor' => $data['kodeBakor'],
                    'kodebpp' => $data['kodeBpp'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                if (session()->get('status_user') == '2') {
                    return redirect()->to('profil/admin');
                }
                return redirect()->to('lembaga');
            } else {
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('login');
            }
        } else {
            $session->setFlashdata('msg', 'User not Found');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
