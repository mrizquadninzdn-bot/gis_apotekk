<?php

namespace App\Controllers;

use App\Models\modeSetting;

class Admin extends BaseController
{

public function __construct()
{
    $this->ModelSetting = new ModelSetting();
}
    public function index()
    {
        $data =[
            'judul' => 'Dashboard',
            'page' => 'v_dashboard',
        ];
        return view('v_template_back_end', $data);
    }

    public function Setting()
    {
        $data =[
            'judul' => 'Setting',
            'page' => 'v_setting',
            'web' => $this->ModelSetting->DataWeb(),
        ];
        return view('v_template_back_end', $data);
    }

    public function UpdateSetting()
    {
        $data = [
            'id' => 1,
            'nama_web' => $this->request->getPost('nama_web'),
            'coordinat_wilayah' => $this->request->getPost('coordinat_wilayah'),
            'zoom_view' => $this->request->getPost('zoom_view'),
        ];
        $this->ModelSetting->UpdateData($data);
        session()->setFlasedata('pesan', 'Settingan Web Telah DiUpdate !!!');
        return redirect()->to('Admin/Setting');
    }
}