<?php

namespace App\Models;

use CodeIgniter\Model;

class WebNasabah extends Model
{
    public function getData()
    {
        $bulder = $this->db->table('tb_nasabah')
            ->join('tb_mitra', 'nasabah_mitra_id = mitra_id');
        return $bulder->get();
    }
    public function getDataByMitra($id)
    {
        $bulder = $this->db->table('tb_nasabah')
            ->join('tb_mitra', 'nasabah_mitra_id = mitra_id')
            ->where(['nasabah_mitra_id' => $id]);
        return $bulder->get();
    }
    public function saveData($data)
    {
        $query = $this->db->table('tb_nasabah')->insert($data);
        return $query;
    }
    public function updateData($data, $id)
    {
        $query = $this->db->table('tb_nasabah')->update($data, array('nasabah_id' => $id));
        return $query;
    }
    public function deleteData($id)
    {
        $query = $this->db->table('tb_nasabah')->delete(array('nasabah_id' => $id));
        return $query;
    }
}
