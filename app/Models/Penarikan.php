<?php

namespace App\Models;

use CodeIgniter\Model;

class Penarikan extends Model
{
    public function saveData($data)
    {
        $query = $this->db->table('tb_penarikan')->insert($data);
        return $query;
    }

    public function getHistory($id)
    {
        return $this->db->table('tb_penarikan')
            ->join('tb_nasabah', 'penarikan_nasabah = nasabah_id')  
            ->where(['penarikan_nasabah' => $id])
            ->get()->getResult();
    }

    public function getHistoryDetail($id)
    {
        return $this->db->table('tb_penarikan')
            ->join('tb_nasabah', 'penarikan_nasabah = nasabah_id')  
            ->where(['penarikan_nomor' => $id])
            ->get()->getResult();
    }
}
