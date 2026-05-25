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
        ];
        return view('v_template_back_end', $data);
    }
}