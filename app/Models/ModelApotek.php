<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelApotek extends Model
{
    public function AllData()
    {
        return $this->db->table('tbl_apotek')
            ->get()->getResultArray();
    }
    
    public function InsertData($data)
    {
        $this->db->table('tbl_apotek')->insert($data);
    }

    public function DetailData($id_apotek)
    {
        return $this->db->table('tbl_apotek')
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
}
