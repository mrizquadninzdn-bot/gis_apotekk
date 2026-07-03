<?php

namespace App\Controllers;

// Perhatikan huruf besar kecilnya (Case Sensitive)
use App\Models\ModelSetting;
use App\Models\ModelWilayah; // <--- 1. KITA TAMBAHKAN MODEL WILAYAH DI SINI

class Admin extends BaseController
{
    // Deklarasikan variabel agar bisa dipakai di semua function
    protected $ModelSetting;
    protected $ModelWilayah = 'tbl_wilayah'; // <--- 2. DEKLARASIKAN VARIABEL UNTUK MODEL WILAYAH

    public function __construct()
    {
        // Pastikan nama class Model sesuai dengan file di App/Models/ModelSetting.php
        $this->ModelSetting = new ModelSetting();
        $this->ModelWilayah = new ModelWilayah(); // <--- 3. INISIALISASI MODEL WILAYAH DI SINI
    }

    public function index()
    {
        // 1. Hubungkan ke database MySQL
        $db = \Config\Database::connect();
        
        // 2. Query hitung jumlah apotek berdasarkan kolom status (untuk Grafik)
        $query_grafik = $db->query("SELECT status, COUNT(*) as jumlah FROM tbl_apotek GROUP BY status")->getResultArray();
        
        $labels = [];
        $datasets = [];
        foreach ($query_grafik as $row) {
            $labels[] = $row['status'] ? $row['status'] : 'Lainnya';
            $datasets[] = (int)$row['jumlah'];
        }

        // 3. Query ambil SEMUA data apotek untuk menampilkan Marker/Titik di Peta
        $apotek = $db->query("SELECT * FROM tbl_apotek")->getResultArray();

        // 4. AMBIL DATA SETTINGAN WEB (Ini yang kurang agar variabel $web tidak error!)
        $data_web = $this->ModelSetting->DataWeb();

        // 5. AMBIL DATA WILAYAH DARI DATABASE (Agar $wilayah tidak error lagi!)
// GANTI DENGAN INI:
$data_wilayah = $db->query("SELECT * FROM tbl_wilayah")->getResultArray();
        // 6. Susun array data untuk dikirim ke view
        $data = [
            'judul'         => 'Dashboard',
            'page'          => 'v_dashboard',
            'json_labels'   => json_encode($labels),   // Kirim ke Grafik
            'json_datasets' => json_encode($datasets), // Kirim ke Grafik
            'apotek'        => $apotek,                // Kirim ke Peta (Marker)
            'web'           => $data_web,              // MENGIRIM VARIABEL $web KE VIEW
            'wilayah'       => $data_wilayah,          // <--- 4. SEKARANG VARIABEL $wilayah SUDAH IKUT DIKIRIM!
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