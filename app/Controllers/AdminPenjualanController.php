<?php

namespace App\Controllers;

use App\Models\WebPenjualan;

class AdminPenjualanController extends BaseController
{
    public function index(){
        $db      = \Config\Database::connect();
        $query = $db->query("SELECT penjualan_nomor,penjualan_tanggal,penjualan_nasabah,penjualan_total_harga,penjualan_total_item,
        penjualan_status,penjualan_metode,penjualan_alamat_detail,penjualan_created,nasabah_nama 
        FROM tb_penjualan JOIN tb_nasabah ON penjualan_nasabah=nasabah_id ORDER BY penjualan_status ASC");
        $data['penjualan'] = $query;

        echo view('penjualan/view_penjualan_admin', $data);
    }
    public function edit(){
         $db      = \Config\Database::connect();
            $data = [
                   'penjualan_status' => $this->request->getPost('status')
            ];
            $id = $this->request->getPost('id');
            $db->table('tb_penjualan')->update($data, array('penjualan_nomor' => $id));
            // $model->updateData($data, $id);
            session()->setFlashdata('success', 'Berhasil mengupdate data');
            return redirect()->to('/penjualan');
    }
    public function report(){
        $db      = \Config\Database::connect();
        $builder = $db->table('tb_penjualan');
        $builder->select('*');
        // $builder->join('tb_mitra', 'tb_penjualan.penjualan_mitra_id = tb_mitra.mitra_id');
        $builder->join('tb_nasabah', 'tb_penjualan.penjualan_nasabah = tb_nasabah.nasabah_id');
        $query = $builder->get();
        $data['penjualan'] = $query;
        echo view('report/report_transaksi_penjualan', $data);
    }

    public function detail($id)
    {
        
        $model = new WebPenjualan();
        $data = [
            'detailpenjualan' => $model->getDataDetailPenjualan($id)->getResultArray()
        ];
        
        echo view('penjualan/view_detail_penjualan', $data);
    }

    public function detailpenjualan($id)
    {
        
        $model = new WebPenjualan();
        $data = [
            'detailpenjualan' => $model->getDataDetailPenjualan($id)->getResultArray()
        ];
        
        echo view('penjualan/view_detail_penjualan_admin', $data);
    }
}