<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminMitra extends Model
{
    public function getData()
    {
        $bulder = $this->db->table('tb_mitra');
        return $bulder->get();
        
    }
    public function saveData($data)
    {
        $query = $this->db->table('tb_mitra')->insert($data);
        return $query;
    }
    public function updateData($data, $id)
    {
        $query = $this->db->table('tb_mitra')->update($data, array('mitra_id' => $id));
        return $query;
    }
    public function deleteData($id)
    {
        $query = $this->db->table('tb_mitra')->delete(array('mitra_id' => $id));
        return $query;
    }
    
}