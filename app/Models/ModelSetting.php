<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSetting extends Model
{
    public function DataWeb()
    {
        // Perbaikan: ganti 'tabel' menjadi 'table'
        return $this->db->table('tbl_setting')
                ->where('id', 1)
                ->get()->getRowArray();
    }

    public function UpdateData($data)
    {
        // Di sini sudah benar menggunakan 'table'
        $this->db->table('tbl_setting')
                ->where('id', 1)
                ->update($data);
    }
}
