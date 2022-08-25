<?php

namespace App\Models;

use CodeIgniter\Model;

class Nasabah extends Model
{
    public function checkuser($useremail)
    {
        return $this->db->table('tb_nasabah')
            ->join('tb_mitra', 'nasabah_mitra_id = mitra_id')
            ->where(array('nasabah_email' => $useremail))
            ->get()->getRowArray();
    }

    public function register($data)
    {
        $query = $this->db->table('tb_nasabah')->insert($data);

        return $query;
    }

    public function searchMitra($kodepos)
    {
        return $this->db->table('tb_mitra')
            ->where(array('mitra_kode_pos' => $kodepos, 'mitra_status' => 1))
            ->limit(1)
            ->get()->getRowArray();
    }

    public function updateData($data, $id)
    {
        $query = $this->db->table('tb_nasabah')->update($data, array('nasabah_id' => $id));
        return $query;
    }
}
