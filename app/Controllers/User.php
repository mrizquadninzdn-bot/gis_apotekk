<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelUser; 

class User extends BaseController
{
    protected $ModelUser;

    public function __construct()
    {
        $this->ModelUser = new ModelUser();
    }

    public function index()
    {
        $data = [
            'judul' => 'Kelola Data User',
            'user'  => $this->ModelUser->AllData(), 
            'page'  => 'User/v_index',
        ];
        return view('v_template_back_end', $data);
    }

    public function Input()
    {
        $data = [
            'judul' => 'Input User',
            'menu'  => 'user',
            'page'  => 'User/v_input', // Dipastikan huruf U besar sesuai folder
        ];
        return view('v_template_back_end', $data);
    }

    public function Edit($id_user)
    {
        $data = [
            'judul' => 'Edit User',
            'menu'  => 'user',
            'page'  => 'User/v_edit', // Dipastikan huruf U besar sesuai folder
            'user'  => $this->ModelUser->DetailData($id_user),
        ];
        return view('v_template_back_end', $data);
    }

    public function InsertData()
    {
        if ($this->validate([
            'nama_user' => [
                'label'  => 'Nama user',
                'rules'  => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'email' => [
                'label'  => 'E-Mail',
                'rules'  => 'required|valid_email', // Ditambah pengaman valid_email
                'errors' => [
                    'required' => '{field} Wajib Diisi !!',
                    'valid_email' => 'Format {field} tidak valid !!'
                ]
            ],
            'password' => [
                'label'  => 'Password',
                'rules'  => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'foto' => [
                'label'  => 'Foto User',
                'rules'  => 'max_size[foto,1024]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran {field} maksimal 1024 KB !!',
                    'mime_in'  => 'Format {field} harus JPG, JPEG, atau PNG !!'
                ]
            ],
        ])) {
            
            // 1. Ambil file foto dari form
            $foto = $this->request->getFile('foto');
            
            // PERBAIKAN UTAMA: Cek apakah user mengupload foto baru atau tidak
            if ($foto->isValid() && !$foto->hasMoved()) {
                $nama_file = $foto->getRandomName();
                $foto->move('foto', $nama_file); // Memasukkan ke folder public/foto
            } else {
                $nama_file = 'default.png'; // Jika tidak upload, beri nama default.png
            }

            // 2. Susun Array Data (Kode koordinat apotek yang mubazir sudah dihapus)
            $data = [
                'nama_user' => $this->request->getPost('nama_user'),
                'email'     => $this->request->getPost('email'),
                'password'  => sha1($this->request->getPost('password')),
                'foto'      => $nama_file,
            ];

            // 3. Simpan ke database melalui model
            $this->ModelUser->InsertData($data);

            session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan !!');
            return redirect()->to(base_url('User'));

        } else {
            // Jika validasi gagal
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('User/Input'))->withInput();
        }
    }

    public function UpdateData($id_user)
    {
        if ($this->validate([
            'nama_user' => [
                'label'  => 'Nama user',
                'rules'  => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'email' => [
                'label'  => 'E-Mail',
                'rules'  => 'required|valid_email', // Ditambah pengaman valid_email
                'errors' => [
                    'required' => '{field} Wajib Diisi !!',
                    'valid_email' => 'Format {field} tidak valid !!'
                ]
            ],
            'password' => [
                'label'  => 'Password',
                'rules'  => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'foto' => [
                'label'  => 'Foto User',
                'rules'  => 'max_size[foto,1024]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran {field} maksimal 1024 KB !!',
                    'mime_in'  => 'Format {field} harus JPG, JPEG, atau PNG !!'
                ]
            ],
        ])) {
            
            // 1. Ambil file foto dari form
            $foto = $this->request->getFile('foto');
            
            // PERBAIKAN UTAMA: Cek apakah user mengupload foto baru atau tidak
            if ($foto->isValid() && !$foto->hasMoved()) {
                $nama_file = $foto->getRandomName();
                $user = $this->ModelApotek->DetailData($id_user);
            

            if ($foto->getError() == 4) {
                $nama_file = $user['foto'];
            }else {
                $nama_file = $foto->getRandomName();
                $foto->move('Foto', $nama_file);
            }
                $foto->move('foto', $nama_file); // Memasukkan ke folder public/foto
            } else {
                $nama_file = 'default.png'; // Jika tidak upload, beri nama default.png
            }

            // 2. Susun Array Data (Kode koordinat apotek yang mubazir sudah dihapus)
            $data = [
                'nama_user' => $this->request->getPost('nama_user'),
                'email'     => $this->request->getPost('email'),
                'password'  => sha1($this->request->getPost('password')),
                'foto'      => $nama_file,
            ];

            // 3. Simpan ke database melalui model
            $this->ModelUser->UpdateData($data);

            session()->setFlashdata('Update', 'Data Berhasil Ditambahkan !!');
            return redirect()->to(base_url('User'));

        } else {
            // Jika validasi gagal
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('User/Edit'))->withInput();
        }
    }
}