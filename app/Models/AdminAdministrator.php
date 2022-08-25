<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminAdministrator extends Model
{
    public function getData()
    {
        $bulder = $this->db->table('tb_administrator');
        return $bulder->get();
    }
    public function saveData($data)
    {
        $query = $this->db->table('tb_administrator')->insert($data);
        return $query;
    }
    public function updateData($data, $id)
    {
        $query = $this->db->table('tb_administrator')->update($data, array('administrator_id' => $id));
        return $query;
    }
    public function deleteData($id)
    {
        $query = $this->db->table('tb_administrator')->delete(array('administrator_id' => $id));
        return $query;
    }
}
