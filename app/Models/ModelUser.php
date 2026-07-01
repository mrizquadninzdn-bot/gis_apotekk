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
    
    public function UpdateData($id_user)
    {
        $this->db->table('tbl_User')
        ->where('id_User', $data['id_User'])
        ->update($data);
    }

    public function DeleteData($id_user)
    {
        $this->db->table('tbl_User')
        ->where('id_User', $data['id_User'])
        ->delete($data);
    }
}
