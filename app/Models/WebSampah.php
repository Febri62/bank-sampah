<?php

namespace App\Models;

use CodeIgniter\Model;

class WebSampah extends Model
{
    public function getData()
    {
        $bulder = $this->db->table('tb_sampah');
        return $bulder->get();
    }
    public function getDataByMitra($id)
    {
        $bulder = $this->db->table('tb_sampah')
            ->join('tb_kategori', 'kategori_id = sampah_kategori_id')
            ->join('tb_mitra', 'mitra_id = sampah_mitra_id')
            ->where(['sampah_mitra_id' => $id]);
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