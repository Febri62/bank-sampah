<?php

namespace App\Models;

use CodeIgniter\Model;

class Kategori extends Model
{
    public function getAllData()
    {
        return $this->db->table('tb_kategori')
            ->get()->getResult();
    }
}
