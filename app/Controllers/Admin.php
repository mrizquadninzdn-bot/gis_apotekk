<?php

namespace App\Controllers;

// Perhatikan huruf besar kecilnya (Case Sensitive)
use App\Models\ModelSetting;

class Admin extends BaseController
{
    // Deklarasikan variabel agar bisa dipakai di semua function
    protected $ModelSetting;

    public function __construct()
    {
        // Pastikan nama class Model sesuai dengan file di App/Models/ModelSetting.php
        $this->ModelSetting = new ModelSetting();
    }

    public function index()
    {
        $data = [
            'judul' => 'Dashboard',
            'page'  => 'v_dashboard',
        ];
        return view('v_template_back_end', $data);
    }

    public function Setting()
    {
        $data = [
            'judul' => 'Setting',
            'page'  => 'v_setting',
            'web'   => $this->ModelSetting->DataWeb(),
        ];
        return view('v_template_back_end', $data);
    }

    public function UpdateSetting()
{
    $data = [
        'id'             => 1,
        'nama_web'       => $this->request->getPost('nama_web'),
        'coordinat_kota' => $this->request->getPost('coordinat_kota'), // Sesuaikan nama kolom
        'zoom_view'      => $this->request->getPost('zoom_view'),
    ];
    $this->ModelSetting->UpdateData($data);
    session()->setFlashdata('pesan', 'Settingan Web Telah DiUpdate !!!');
    return redirect()->to('Admin/Setting');
}
}
