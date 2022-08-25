<?php

namespace App\Models;

use CodeIgniter\Model;

class WebPenarikan extends Model
{
    public function getData()
    {
        $bulder = $this->db->table('tb_penarikan')
            ->join('tb_nasabah', 'nasabah_id = penarikan_nasabah')
            ->join('tb_mitra', 'mitra_id = nasabah_mitra_id');
        return $bulder->get();
    }
    public function getDataByMitra($id)
    {
        $builder = $this->db->table('tb_penarikan');
            $builder->join('tb_nasabah', 'nasabah_id = penarikan_nasabah');
            $builder->join('tb_mitra', 'mitra_id = nasabah_mitra_id');
            $builder->where(['nasabah_mitra_id' => $id]);
             $builder->orderBy('penarikan_status', 'ASC');
        return $builder->get();
    }
    public function updateData($data, $id)
    {
        $query = $this->db->table('tb_penarikan')->update($data, array('penarikan_nomor' => $id));
        return $query;
    }
}
