<?php

namespace App\Controllers;

use App\Models\ModelWilayah;
use App\Models\ModelSetting;
use App\Models\ModelApotek;

class Apotek extends BaseController
{
    // Deklarasikan semua properti model agar dibaca sistem dengan benar
    protected $ModelSetting;
    protected $ModelWilayah; // Tambahan: deklarasi properti wilayah
    protected $ModelApotek;

    public function __construct()
    {
        $this->ModelSetting = new ModelSetting();
        $this->ModelWilayah = new ModelWilayah(); // PERBAIKAN 1: Diubah dari ModelSetting menjadi ModelWilayah
        $this->ModelApotek  = new ModelApotek();
    }
    
    public function index()
    {
        $data = [
            'judul'   => 'Apotek',
            'menu'    => 'apotek',
            // PERBAIKAN: Kita arahkan pencarian ke folder 'apotek/v_apotek'
            'page'    => 'Apotek/v_index', 
            'apotek'  => $this->ModelApotek->AllData(),
            'wilayah' => $this->ModelWilayah->AllData(), 
        ];

        // Memanggil template back_end
        return view('v_template_back_end', $data);
    }
    public function Input()
    {
        $data = [
            'judul' => 'Input Apotek',
            'menu'  => 'apotek',
            'page' => 'Apotek/v_input',
            'web'   => $this->ModelSetting->DataWeb(),
            'provinsi'   => $this->ModelApotek->allProvinsi(),
            'wilayah' => $this->ModelWilayah->AllData(),
        ];
        return view('v_template_back_end', $data);
    }

    public function InsertData()
    {
        if ($this->validate([
            'nama_sekolah' => [
                'label' => 'Nama Sekolah',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
                ],
                'geojson' => [
                'label' => 'Data GeoJSON',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
                ],
                'warna' => [
                'label' => 'Warna',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
                ],
            ])) {
            //jika validasi berhasil
            $data =[
                'nama_wilayah' => $this->request->getPost('nama_wilayah'),
                'warna' => $this->request->getPost('warna'),
                'geojson' => $this->request->getPost('geojson'),
            ];
            $this->ModelWilayah->InsertData($data);
            session()->setFlashdata('insert', 'Data Berhasil Ditambahkan');
            return redirect()->to('Wilayah');
        }else {
            //jika validasi gagal
            session()->setFlashData('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('Wilayah/Input')->withInput();
        }
    }
    //Kabupaten, Kecamatan
    public function Kabupaten()
    {
        $id_provinsi = $this->request->getPost('id_provinsi');
        $kab = $this->ModelApotek->allKabupaten($id_provinsi);
        
        echo '<option value="">--Pilih Kabupaten--</option>';
        
        if (!empty($kab) && is_array($kab)) {
            foreach($kab as $key => $value) {
                echo "<option value='{$value['id_kabupaten']}'>{$value['nama_kabupaten']}</option>";
            }
        }
    }
    public function Kecamatan()
    {
        // Menangkap kiriman id_kabupaten dari script AJAX view
        $id_kabupaten = $this->request->getPost('id_kabupaten');
        
        $kec = $this->ModelApotek->allKecamatan($id_kabupaten);
        
        echo '<option value="">--Pilih Kecamatan--</option>';
        
        if (!empty($kec) && is_array($kec)) {
            foreach($kec as $key => $value) {
                echo "<option value='{$value['id_kecamatan']}'>{$value['nama_kecamatan']}</option>";
            }
        }
    }
}