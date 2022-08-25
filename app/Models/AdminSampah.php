<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminSampah extends Model
{
    public function getData()
    {
        $bulder = $this->db->table('tb_sampah');
        return $bulder->get();
        
    }
    public function saveData($data)
    {
        $query = $this->db->table('tb_sampah')->insert($data);
        return $query;
    }
    public function updateData($data, $id)
    {
        $query = $this->db->table('tb_sampah')->update($data, array('sampah_id' => $id));
        return $query;
    }
    public function deleteData($id)
    {
        $query = $this->db->table('tb_sampah')->delete(array('sampah_id' => $id));
        return $query;
    }
    
}