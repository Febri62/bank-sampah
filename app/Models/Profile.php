<?php

namespace App\Models;

use CodeIgniter\Model;

class Profile extends Model
{
    public function updateProfile($data, $email)
    {
        $query = $this->db->table('tb_mitra')->update($data, array('mitra_email' => $email));
        return $query;
    }
}
