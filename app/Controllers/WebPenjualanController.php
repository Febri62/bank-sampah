<?php

namespace App\Controllers;

use App\Models\WebPenjualan;
use CodeIgniter\Database\Query;

class WebPenjualanController extends BaseController
{
    public function index()
    {
        $userlogin = session()->get('mitraId');

        $model = new WebPenjualan();
        $data = [
            'penjualan' => $model->getDataByMitra($userlogin)->getResultArray(),
        ];
        
        echo view('penjualan/view_penjualan_mitra', $data);
    }

    public function detailmitra($id)
    {
        $userlogin = session()->get('mitraId');

        $model = new WebPenjualan();
        $data = [
            'detailpenjualan' => $model->getDataDetailPenjualan($id)->getResultArray(),
        ];
        echo view('penjualan/view_penjualan_mitra_detail', $data);
    }

    public function editmitra()
    {
        $id = $this->request->getPost('id');

        $model = new WebPenjualan();
        $data = array(
            'penjualan_status' => $this->request->getPost('status'),
        );
        $model->updateData($data, $id);
        session()->setFlashdata('success', 'Berhasil mengupdate data');
        return redirect()->to('/mitra/penjualan');
        
    }

    public function reportmitra()
    {
        $userlogin = session()->get('mitraId');

        $model = new WebPenjualan();
        $data = [
            'penjualan' => $model->getDataByMitra($userlogin)->getResultArray(),
        ];
        echo view('report/report_penjualan_mitra', $data);
    }

    public function nasabahperbulan()
    {
        $userlogin = session()->get('mitraId');
        $bulan = $this->request->getPost('filterbulan');
        $tahun = date("Y");
        
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM tb_nasabah WHERE MONTH(nasabah_join_at) = '$bulan' and YEAR(nasabah_join_at) = '$tahun'");

        $data = [
            'nasabah' => $query->getResultArray($userlogin),
            'bulan' => $bulan,
            'tahun' => $tahun
        ];

        echo view('report/laporan_nasabah_perbulan_mitra', $data);
    }

    public function sampahperbulan()
    {
        $userlogin = session()->get('mitraId');
        $bulan = $this->request->getPost('filterbulan');
        $tahun = date("Y");
        
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM tb_sampah WHERE MONTH(sampah_created_at) = '$bulan' and YEAR(sampah_created_at) = '$tahun'");

        $data = [
            'nasabah' => $query->getResultArray($userlogin),
            'bulan' => $bulan,
            'tahun' => $tahun
        ];

        echo view('report/laporan_penjualan_perbulan', $data);
    }
}
