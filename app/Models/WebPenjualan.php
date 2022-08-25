<?php

namespace App\Models;

use CodeIgniter\Model;

class WebPenjualan extends Model
{
    public function getData()
    {
        $bulder = $this->db->table('tb_penjualan')
            ->join('tb_nasabah', 'nasabah_id = penjualan_nasabah')
            ->join('tb_mitra', 'mitra_id = nasabah_mitra_id');
        return $bulder->get();
    }
    public function getDataByMitra($id)
    {
        $builder = $this->db->table('tb_penjualan');
            $builder->join('tb_nasabah', 'nasabah_id = penjualan_nasabah');
            $builder->join('tb_mitra', 'mitra_id = nasabah_mitra_id');
            $builder->where(['nasabah_mitra_id' => $id]);
            $builder->orderBy('penjualan_status', 'ASC');
            $query = $builder->get();
            //  var_dump($query);
            //  exit();
        return $query;
    }
    public function updateData($data, $id)
    {
        $query = $this->db->table('tb_penjualan')->update($data, array('penjualan_nomor' => $id));
        return $query;
    }
    public function getDataDetailPenjualan($id)
    {
        $bulder = $this->db->table('tb_detail_penjualan')
            ->join('tb_penjualan', 'detail_penjualan_nomor = penjualan_nomor')
            ->join('tb_sampah', 'sampah_id = detail_penjualan_sampah')
            ->join('tb_kategori', 'kategori_id = sampah_kategori_id')
            ->where(['detail_penjualan_nomor' => $id]);
        return $bulder->get();
    }

    
}
