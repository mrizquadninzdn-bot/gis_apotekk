<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelApotek extends Model
{
    public function AllData()
    {
        return $this->db->table('tbl_apotek')
            ->join('tbl_jenjang', 'tbl_jenjang.id_jenjang = tbl_apotek.id_jenjang', 'left')
            ->get()->getResultArray();
    }
    
    public function InsertData($data)
    {
        $this->db->table('tbl_apotek')->insert($data);
    }

    public function DetailData($id_apotek)
    {
        return $this->db->table('tbl_apotek')
        ->join('tbl_jenjang', 'tbl_jenjang.id_jenjang = tbl_apotek.id_jenjang', 'left')
        ->join('tbl_provinsi', 'tbl_provinsi.id_provinsi = tbl_apotek.id_provinsi', 'left')
        ->join('tbl_kabupaten', 'tbl_kabupaten.id_kabupaten = tbl_apotek.id_kabupaten', 'left')
        ->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan = tbl_apotek.id_kecamatan', 'left')
        ->join('tbl_wilayah', 'tbl_wilayah.id_wilayah = tbl_apotek.id_wilayah', 'left')
        ->where('id_apotek', $id_apotek)
        ->get()->getRowArray();
    }
    
    public function UpdateData($data)
    {
        $this->db->table('tbl_apotek')
        ->where('id_apotek', $data['id_apotek'])
        ->update($data);
    }

    public function DeleteData($data)
    {
        $this->db->table('tbl_apotek')
        ->where('id_apotek', $data['id_apotek'])
        ->delete($data);
    }

    //Provinsi
    Public function allProvinsi()
    {
        return $this->db->table('tbl_provinsi')
            ->orderBy('id_provinsi', 'ASC')
            ->get()->getResultArray();
    }

    Public function allKabupaten($id_provinsi)
    {
        return $this->db->table('tbl_kabupaten')
            ->where('id_provinsi', $id_provinsi)
            ->orderBy('id_provinsi', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function allKecamatan($id_kabupaten)
    {
        return $this->db->table('tbl_kecamatan') 
                        ->where('id_kabupaten', $id_kabupaten) // <-- Sesuaikan nama kolom ini dengan phpMyAdmin
                        ->orderBy('nama_kecamatan', 'ASC')
                        ->get()
                        ->getResultArray();
    }
}
