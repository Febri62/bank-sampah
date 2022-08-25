<?php

namespace App\Models;

use CodeIgniter\Model;

class WebLogin extends Model
{
    public function cekEmailAdministrator($email)
    {
        return $this->db->table('tb_administrator')
            ->where(array('administrator_email' => $email))
            ->get()->getRowArray();
    }

    public function cekEmailMitra($email)
    {
        return $this->db->table('tb_mitra')
            ->where(array('mitra_email' => $email))
            ->get()->getRowArray();
    }
}
