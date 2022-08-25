<?php

namespace App\Models;

use CodeIgniter\Model;

class Keranjang extends Model
{
    public function saveData($data)
    {
        $query = $this->db->table('tb_keranjang')->insert($data);
        return $query;
    }

    public function saveDataDetail($data)
    {
        $query = $this->db->table('tb_detail_penjualan')->insert($data);
        return $query;
    }

    public function getHistory($id)
    {
        return $this->db->table('tb_keranjang')
            ->join('tb_nasabah', 'penjualan_nasabah = nasabah_id')  
            ->where(['penjualan_nasabah' => $id])
            ->get()->getResult();
    }

    public function getHistoryDetail($id)
    {
        return $this->db->table('tb_keranjang')
            ->join('tb_nasabah', 'penjualan_nasabah = nasabah_id')  
            ->where(['penjualan_nomor' => $id])
            ->get()->getResult();
    }
    public function getHistoryDetailPenjualan($id)
    {
        return $this->db->table('tb_detail_penjualan')
            ->join('tb_sampah', 'sampah_id = detail_penjualan_sampah')
            ->join('tb_kategori', 'kategori_id = sampah_kategori_id') 
            ->where(['detail_penjualan_nomor' => $id])
            ->get()->getResult();
    }
}
