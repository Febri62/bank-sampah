<?php

namespace App\Models;

use CodeIgniter\Model;

class Sampah extends Model
{
    public function getAllData($id)
    {
        return $this->db->table('tb_sampah')
            ->join('tb_kategori', 'kategori_id = sampah_kategori_id') 
            ->join('tb_mitra', 'mitra_id = sampah_mitra_id') 
            ->where(['sampah_mitra_id' => $id])
            ->get()->getResult();
    }

    public function getSearhingData($id, $search)
    {
        return $this->db->table('tb_sampah')
            ->join('tb_kategori', 'kategori_id = sampah_kategori_id') 
            ->join('tb_mitra', 'mitra_id = sampah_mitra_id') 
            ->where(['sampah_mitra_id' => $id])
            ->like('sampah_nama', $search)
            ->get()->getResult();
    }
    
    public function getDetailData($id)
    {
        return $this->db->table('tb_sampah')
            ->join('tb_kategori', 'kategori_id = sampah_kategori_id') 
            ->join('tb_mitra', 'mitra_id = sampah_mitra_id') 
            ->where(['sampah_id' => $id])
            ->get()->getResult();
    }

    public function getFilterKategori($id)
    {
        return $this->db->table('tb_sampah')
            ->join('tb_kategori', 'kategori_id = sampah_kategori_id') 
            ->join('tb_mitra', 'mitra_id = sampah_mitra_id') 
            ->where(['sampah_kategori_id' => $id])
            ->get()->getResult();
    }
}
