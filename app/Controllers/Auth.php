<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAuth;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->ModelAuth = new ModelAuth;
    }
    public function Login()
    {
        $data = [
            'judul' => 'Login'
        ];
        return view('v_login', $data);
    }

     public function CekLogin()
    {
        if ($this->validate([
            'email' => [
                'label'  => 'E-Mail',
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!',
                    'valid_email' => 'Format {field} tidak valid !!'
                ]
            ],
            'password' => [
                'label'  => 'Password',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!',
                ]
                
            ],
        ])) {
            //Jika Login
            $email = $this->request->getPost('email');
            $password = sha1($this->request->getPost('password'));
            $CekLogin = $this->ModelAuth->Login($email, $password);
            if ($CekLogin) {
                #jika berhasil login
                session()->set('nama_user', $CekLogin['nama_user']);
                session()->set('foto', $CekLogin['foto']);
                session()->set('login', 1);

                return redirect()->to('Admin');
            } else {
                #jika gagal login...
                session()->setFlashdata('pesan', 'Email atau Password Salah');
                return redirect()->to('Auth/Login');
            }
            } else {
            // PERBAIKAN: Ditambahkan '/' sebelum $id_user agar rutenya valid dan tidak 404
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Auth/Login'))->withInput();
        }
    }

    public function Logout()
    {
        session()->remove('nama_user');
        session()->remove('foto');
        session()->remove('login');

        session()->setFlashdata('logout', 'Anda Berhasil LogOut !!');
        return redirect()->to(base_url('Auth/Login'));
    }

} 