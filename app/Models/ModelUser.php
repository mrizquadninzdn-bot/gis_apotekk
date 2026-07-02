<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    public function AllData()
    {
        return $this->db->table('tbl_User')
            ->get()
            ->getResultArray();
    }
    
    public function InsertData($data)
    {
        $this->db->table('tbl_User')->insert($data);
    }

    public function DetailData($id_User)
    {
        return $this->db->table('tbl_User')
        ->where('id_User', $id_User)
        ->get()->getRowArray();
    }
    
    // PERBAIKAN: Gunakan langsung variabel $id_user di dalam where()
    public function UpdateData($id_user, $data)
    {
        return $this->db->table('tbl_User')
            ->where('id_user', $id_user) // Menggunakan variabel $id_user langsung, bukan $data['id_User']
            ->update($data);
    }
    
    // PERBAIKAN UNTUK HAPUS: Gunakan langsung variabel $id_user
    public function DeleteData($id_user)
    {
        return $this->db->table('tbl_User')
            ->where('id_user', $id_user) // Menggunakan variabel $id_user langsung
            ->delete();
    }
}
