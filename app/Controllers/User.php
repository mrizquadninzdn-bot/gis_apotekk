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
            'page'  => 'User/v_input',
        ];
        return view('v_template_back_end', $data);
    }

    public function Edit($id_user)
    {
        $data = [
            'judul' => 'Edit User',
            'menu'  => 'user',
            'page'  => 'User/v_edit',
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
                'rules'  => 'required|valid_email',
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
            
            $foto = $this->request->getFile('foto');
            
            if ($foto->isValid() && !$foto->hasMoved()) {
                $nama_file = $foto->getRandomName();
                $foto->move('foto', $nama_file);
            } else {
                $nama_file = 'default.png';
            }

            $data = [
                'nama_user' => $this->request->getPost('nama_user'),
                'email'     => $this->request->getPost('email'),
                'password'  => sha1($this->request->getPost('password')),
                'foto'      => $nama_file,
            ];

            $this->ModelUser->InsertData($data);

            session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan !!');
            return redirect()->to(base_url('User'));

        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('User/Input'))->withInput();
        }
    }

    public function UpdateData($id_user)
    {
        // Ambil data user lama untuk mempertahankan foto jika tidak diganti
        $user_lama = $this->ModelUser->DetailData($id_user);

        if ($this->validate([
            'nama_user' => [
                'label'  => 'Nama user',
                'rules'  => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'email' => [
                'label'  => 'E-Mail',
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!',
                    'valid_email' => 'Format {field} tidak valid !!'
                ]
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
            
            $foto = $this->request->getFile('foto');
            
            // PERBAIKAN: Proteksi pengecekan agar tidak unlink folder kosong/NULL
            if ($foto->isValid() && !$foto->hasMoved()) {
                $nama_file = $foto->getRandomName();
                $foto->move('foto', $nama_file);
                
                // Menghapus foto lama di folder jika ada (kecuali jika kosong atau foto default)
                if (!empty($user_lama['foto']) && $user_lama['foto'] != 'default.png' && file_exists('foto/' . $user_lama['foto'])) {
                    unlink('foto/' . $user_lama['foto']);
                }
            } else {
                $nama_file = $user_lama['foto']; // Gunakan foto lama jika tidak unggah baru
            }

            $data = [
                'nama_user' => $this->request->getPost('nama_user'),
                'email'     => $this->request->getPost('email'),
                'foto'      => $nama_file,
            ];

            // Password hanya di-update jika kolom password diisi oleh admin
            $password = $this->request->getPost('password');
            if (!empty($password)) {
                $data['password'] = sha1($password);
            }

            // Kirim parameter lengkap ($id_user dan $data) ke ModelUser
            $this->ModelUser->UpdateData($id_user, $data);

            session()->setFlashdata('pesan', 'Data Berhasil Diupdate !!');
            return redirect()->to(base_url('User'));

        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('User/Edit/' . $id_user))->withInput();
        }
    }

    public function Delete($id_user)
    {
        // Ambil detail data dulu untuk hapus file foto lama di folder
        $user = $this->ModelUser->DetailData($id_user);
        
        // PERBAIKAN: Logika hapus foto saat delete dibersihkan dari kode ganda dan proteksi file kosong
        if (!empty($user['foto']) && $user['foto'] != 'default.png' && file_exists('foto/' . $user['foto'])) {
            unlink('foto/' . $user['foto']);
        }

        $data = [
            'id_user' => $id_user,
        ];
        
        $this->ModelUser->DeleteData($data);
        
        session()->setFlashdata('pesan', 'Data Berhasil Didelete !!');
        return redirect()->to(base_url('User'));
    }
}