<?php

namespace App\Controllers;

use App\Models\ModelWilayah;
use App\Models\ModelSetting;
use App\Models\ModelApotek;
use App\Models\ModelJenjang;


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
        $this->ModelJenjang  = new ModelJenjang();

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
            'jenjang' => $this->ModelJenjang->AllData(), 

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
            'jenjang' => $this->ModelJenjang->AllData(),
        ];
        return view('v_template_back_end', $data);
    }

public function InsertData()
    {
        if ($this->validate([
            'nama_apotek' => [
                'label'  => 'Nama Apotek',
                'rules'  => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'status' => [
                'label'  => 'Status',
                'rules'  => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'id_jenjang' => [
                'label'  => 'Jenjang',
                'rules'  => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'coordinat' => [
                'label'  => 'Coordinat Apotek',
                'rules'  => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'id_Provinsi' => [
                'label'  => 'Provinsi',
                'rules'  => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'id_kabupaten' => [
                'label'  => 'Kabupaten',
                'rules'  => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'id_kecamatan' => [
                'label'  => 'Kecamatan',
                'rules'  => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'alamat' => [
                'label'  => 'Alamat',
                'rules'  => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'id_wilayah' => [
                'label'  => 'Wilayah Administrasi',
                'rules'  => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'foto' => [
                'label'  => 'Foto Apotek',
                'rules'  => 'max_size[foto,1024]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran {field} maksimal 1024 KB !!',
                    'mime_in'  => 'Format {field} harus JPG, JPEG, atau PNG !!'
                ]
            ],
        ])) {
            // 1. Ambil file foto dan generate nama acak
            $foto = $this->request->getFile('foto');
            $nama_file = $foto->getRandomName();

            // 2. PROSES MEMECAH KOORDINAT MENJADI LATITUDE & LONGITUDE
            $koordinat_mentah = $this->request->getPost('coordinat'); // format: "lat,lng"
            $pecah = explode(',', $koordinat_mentah);
            $latitude  = isset($pecah[0]) ? trim($pecah[0]) : '';
            $longitude = isset($pecah[1]) ? trim($pecah[1]) : '';

            // 3. Susun Array Data Sesuai Struktur Kolom Database Anda (image_cc8582.png)
            $data = [
                'nama_apotek'  => $this->request->getPost('nama_apotek'),
                'status'       => $this->request->getPost('status'),
                'latitude'     => $latitude,  // Sesuai kolom database Anda
                'longitude'    => $longitude, // Sesuai kolom database Anda
                'id_jenjang'  => $this->request->getPost('id_jenjang'),
                'id_provinsi'  => $this->request->getPost('id_provinsi'),
                'id_kabupaten' => $this->request->getPost('id_kabupaten'),
                'id_kecamatan' => $this->request->getPost('id_kecamatan'),
                'alamat'       => $this->request->getPost('alamat'),
                'id_wilayah'   => $this->request->getPost('id_wilayah'),
                'foto'         => $nama_file, // Sesuai kolom database Anda
            ];

            // 4. Pindahkan file fisik gambar ke folder public/foto_apotek
            $foto->move('Foto', $nama_file);

            // 5. Simpan ke database
            $this->ModelApotek->InsertData($data);

            session()->setFlashdata('pesan', 'Data Apotek Berhasil Ditambahkan !!');
            return redirect()->to(base_url('Apotek'));

        } else {
            // Jika validasi gagal
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Apotek/Input'))->withInput();
        }
    }

    public function Edit($id_apotek)
    {
        $apotekData = $this->ModelApotek->DetailData($id_apotek);
        $data = [
            'judul' => 'Edit ' . $apotekData['nama_apotek'],
            'menu'  => 'apotek',
            'page' => 'Apotek/v_edit',
            'web'   => $this->ModelSetting->DataWeb(),
            'provinsi'   => $this->ModelApotek->allProvinsi(),
            'wilayah' => $this->ModelWilayah->AllData(),
            'jenjang' => $this->ModelJenjang->AllData(),
            'apotek'   => $this->ModelApotek->DetailData($id_apotek),
        ];
        return view('v_template_back_end', $data);
    }
public function UpdateData($id_apotek)
    {
        if ($this->validate([
            'nama_apotek' => [
                'label'  => 'Nama Apotek',
                'rules'  => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'status' => [
                'label'  => 'Status',
                'rules'  => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'id_jenjang' => [
                'label'  => 'Jenjang',
                'rules'  => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'coordinat' => [
                'label'  => 'Coordinat Apotek',
                'rules'  => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'id_Provinsi' => [
                'label'  => 'Provinsi',
                'rules'  => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'id_kabupaten' => [
                'label'  => 'Kabupaten',
                'rules'  => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'id_kecamatan' => [
                'label'  => 'Kecamatan',
                'rules'  => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'alamat' => [
                'label'  => 'Alamat',
                'rules'  => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'id_wilayah' => [
                'label'  => 'Wilayah Administrasi',
                'rules'  => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'foto' => [
                'label'  => 'Foto Apotek',
                'rules'  => 'max_size[foto,1024]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran {field} maksimal 1024 KB !!',
                    'mime_in'  => 'Format {field} harus JPG, JPEG, atau PNG !!'
                ]
            ],
        ])) {
            $apotek = $this->ModelApotek->DetailData($id_apotek);
            // 1. Ambil file foto dan generate nama acak
            $foto = $this->request->getFile('foto');
            

            if ($foto->getError() == 4) {
                $nama_file = $apotek['foto'];
            }else {
                $nama_file = $foto->getRandomName();
                $foto->move('Foto', $nama_file);
            }

            // 2. PROSES MEMECAH KOORDINAT MENJADI LATITUDE & LONGITUDE
            $koordinat_mentah = $this->request->getPost('coordinat'); // format: "lat,lng"
            $pecah = explode(',', $koordinat_mentah);
            $latitude  = isset($pecah[0]) ? trim($pecah[0]) : '';
            $longitude = isset($pecah[1]) ? trim($pecah[1]) : '';

            // 3. Susun Array Data Sesuai Struktur Kolom Database Anda (image_cc8582.png)
            $data = [
                'id_apotek'    => $id_apotek,
                'nama_apotek'  => $this->request->getPost('nama_apotek'),
                'status'       => $this->request->getPost('status'),
                'latitude'     => $latitude,  // Sesuai kolom database Anda
                'longitude'    => $longitude, // Sesuai kolom database Anda
                'id_jenjang'  => $this->request->getPost('id_jenjang'),
                'id_provinsi'  => $this->request->getPost('id_provinsi'),
                'id_kabupaten' => $this->request->getPost('id_kabupaten'),
                'id_kecamatan' => $this->request->getPost('id_kecamatan'),
                'alamat'       => $this->request->getPost('alamat'),
                'id_wilayah'   => $this->request->getPost('id_wilayah'),
                'foto'         => $nama_file, // Sesuai kolom database Anda
            ];

            // 4. Pindahkan file fisik gambar ke folder public/foto_apotek
            

            // 5. Simpan ke database
            $this->ModelApotek->UpdateData($data);

            session()->setFlashdata('pesan', 'Data Apotek Berhasil Diupdate !!');
            return redirect()->to(base_url('Apotek'));

        } else {
            // Jika validasi gagal
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Apotek/Edit/' . $id_apotek))->withInput();
        }
    }

    //DELETE
    // PERBAIKAN 1: Nama fungsi diubah dari Delete menjadi DeleteData agar sinkron dengan Routes
    public function DeleteData($id_apotek)
    {
        //delete foto
        $apotek = $this->ModelApotek->DetailData($id_apotek);
        if ($apotek['foto'] <> '') {
            unlink('foto/' . $apotek['foto']);
        }
        // Ambil detail data dulu untuk hapus file foto lama di folder
        $apotek = $this->ModelApotek->DetailData($id_apotek);
        if (!empty($apotek['foto']) && file_exists('Foto/' . $apotek['foto'])) {
            unlink('Foto/' . $apotek['foto']);
        }

        $data = [
            'id_apotek' => $id_apotek,
        ];
        
        $this->ModelApotek->DeleteData($data);
        
        // PERBAIKAN 2: Ubah setFlasdata menjadi setFlashdata (tambah huruf h), 
        // dan ubah 'delete' menjadi 'pesan' agar otomatis terbaca oleh v_index.php yang tadi kita pasang
        session()->setFlashdata('pesan', 'Data Apotek Berhasil Dihapus !!');
        
        return redirect()->to(base_url('Apotek'));
    }

    public function DetailData($id_apotek)
    {
        $apotekData = $this->ModelApotek->DetailData($id_apotek);
        $data = [
            'judul' => 'DETAIL ' . $apotekData['nama_apotek'],
            'menu'  => 'apotek',
            'page' => 'Apotek/v_detail',
            'web'   => $this->ModelSetting->DataWeb(),
            'apotek'   => $this->ModelApotek->DetailData($id_apotek),
        ];
        return view('v_template_back_end', $data);
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