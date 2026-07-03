<?php

namespace App\Controllers;

use App\Models\ModelSetting;
use App\Models\ModelWilayah;
use App\Models\ModelFeedback;

class Home extends BaseController
{
    protected $ModelSetting;
    protected $ModelWilayah;

    public function __construct()
    {
        $this->ModelSetting = new ModelSetting();
        $this->ModelWilayah = new ModelWilayah();
    }

    public function index()
    {
        // 1. Ambil koneksi database untuk mengambil data apotek
        $db = \Config\Database::connect();
        $data_apotek = $db->query("SELECT * FROM tbl_apotek")->getResultArray();

        // 2. Ambil data wilayah dari query langsung (opsi paling aman dari error table)
        $data_wilayah = $db->query("SELECT * FROM tbl_wilayah")->getResultArray();

        // 3. Ambil settingan koordinat kota
        $data_web = $this->ModelSetting->DataWeb();

        // 4. Kirim semua variabel ke view v_home
        $data = [
            'judul'   => 'Home',
            'page'    => 'v_home',
            'web'     => $data_web,
            'wilayah' => $data_wilayah,
            'apotek'  => $data_apotek, // <--- Kunci utamanya ada di sini!
        ];

        // Sesuaikan dengan nama template front-end kamu, misal v_template_front_end
        return view('v_template_front_end', $data); 
    }
    public function kirim_feedback()
    {
        // Validasi input
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => ['required' => 'Nama wajib diisi.']
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email wajib diisi.',
                    'valid_email' => 'Format email tidak valid.'
                ]
            ],
            'kontak' => [
                'rules' => 'required',
                'errors' => ['required' => 'Kontak/No HP wajib diisi.']
            ],
            'pesan' => [
                'rules' => 'required',
                'errors' => ['required' => 'Pesan feedback wajib diisi.']
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        // Simpan ke database
        $model = new ModelFeedback();
        $model->save([
            'nama'   => $this->request->getPost('nama'),
            'email'  => $this->request->getPost('email'),
            'kontak' => $this->request->getPost('kontak'),
            'pesan'  => $this->request->getPost('pesan'),
        ]);

        session()->setFlashdata('sukses', 'Terima kasih! Feedback Anda berhasil dikirim.');
        return redirect()->back();
    }
}
