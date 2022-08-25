<?php

namespace App\Controllers;

use App\Models\WebPenjualan;

class LaporanMitraController extends BaseController
{
public function mitraindex()
    {
        $userlogin = session()->get('mitraId');

        $model = new WebPenjualan();
        $data = [
            'laporan-master' => $model->getDataByMitra($userlogin)->getResultArray(),
        ];
        
        echo view('view_laporan_master_mitra', $data);
    }
    public function mitraindextransaksi()
    {
        $userlogin = session()->get('mitraId');

        $model = new WebPenjualan();
        $data = [
            'laporan-transaksi' => $model->getDataByMitra($userlogin)->getResultArray(),
        ];
        echo view('view_laporan_transaksi_mitra', $data);
    }

    public function mitranasabahperbulan()
    {
        $userlogin = session()->get('mitraId');
        
        $bulan = $this->request->getPost('filterbulan');
        $tahun = date('Y');

        
        $db = \Config\Database::connect();

        $query = $db->query("SELECT * FROM tb_nasabah WHERE MONTH (nasabah_join_at) = '$bulan' AND nasabah_mitra_id = '$userlogin'");
        $data = $query->getResultArray();
        // $query = $db->query("SELECT * FROM tb_nasabah WHERE MONTH(nasabah_join_at) = '$bulan' and YEAR(nasabah_join_at) = '$tahun' BY $userlogin");
        $data = [
            'nasabah' => $query->getResultArray($userlogin),
            'bulan' => $bulan,
            'tahun' => $tahun
        ];

        echo view('report/laporan_nasabah_perbulan_mitra', $data);
    }

    
    public function mitrasampahperbulan()
    {
        $userlogin = session()->get('mitraId');
        
        $bulan = $this->request->getPost('filterbulan');
        $tahun = date('Y');

        
        $db = \Config\Database::connect();

        $query = $db->query("SELECT sampah_id, sampah_nama, kategori_nama, sampah_kategori_id,sampah_satuan,sampah_harga, sampah_status,sampah_deskripsi,sampah_created_at
        FROM tb_sampah JOIN tb_kategori ON sampah_kategori_id=kategori_id WHERE MONTH (sampah_created_at) = '$bulan' AND sampah_mitra_id = '$userlogin'");
        $data = $query->getResultArray();
        // $query = $db->query("SELECT * FROM tb_nasabah WHERE MONTH(nasabah_join_at) = '$bulan' and YEAR(nasabah_join_at) = '$tahun' BY $userlogin");
        $data = [
            'sampah' => $query->getResultArray($userlogin),
            'bulan' => $bulan,
            'tahun' => $tahun
        ];

        echo view('report/laporan_sampah_perbulan_mitra', $data);
    }

    public function mitrapenjualan()
    {
        $userlogin = session()->get('mitraId');
        $nama = session()->get('mitraNama');
        $bulan = $this->request->getPost('filterbulan');
        $tahun = $this->request->getPost('filtertahun');
        
        $db = \Config\Database::connect();
        $query = $db->query("SELECT penjualan_nomor,nasabah_nama,penjualan_tanggal,penjualan_nasabah,penjualan_total_item, penjualan_total_harga,penjualan_status,penjualan_metode,penjualan_created
        FROM tb_penjualan JOIN tb_nasabah ON penjualan_nasabah=nasabah_id JOIN tb_mitra ON nasabah_mitra_id=mitra_id WHERE MONTH(penjualan_tanggal) = '$bulan' AND YEAR(penjualan_tanggal) = '$tahun' AND mitra_id = '$userlogin'");

        $data = [
            'penjualan' => $query->getResultArray(),
            'bulan' => $bulan,
            'tahun' => $tahun,
            'nama' => $nama,
        ];

        echo view('report/laporan_penjualan_perbulan_mitra', $data);
    }

    public function mitrapenarikan()
    {
        $userlogin = session()->get('mitraId');
        $nama = session()->get('mitraNama');
        $bulan = $this->request->getPost('filterbulan');
        $tahun = $this->request->getPost('filtertahun');
        
        $db = \Config\Database::connect();
        $query = $db->query("SELECT penarikan_nomor,penarikan_nasabah,penarikan_tanggal, nasabah_nama,nasabah_id,penarikan_nama_bank,
        penarikan_nomor_rekening,penarikan_nama_rekening,penarikan_jumlah_penarikan,penarikan_status
        FROM tb_penarikan JOIN tb_nasabah ON penarikan_nasabah=nasabah_id JOIN tb_mitra ON nasabah_mitra_id=mitra_id WHERE MONTH(penarikan_tanggal) = '$bulan' AND YEAR(penarikan_tanggal) = '$tahun' AND mitra_id = '$userlogin'");

        $data = [
            'penarikan' => $query->getResultArray(),
            'bulan' => $bulan,
            'tahun' => $tahun,
            'nama' => $nama,
        ];

        echo view('report/laporan_penarikan_perbulan_mitra', $data);
    }

    public function sampahmasuk()
    {
        $userlogin = session()->get('mitraId');
        $nama = session()->get('mitraNama');
        $filterkategori = $this->request->getPost('kategori');
        $bulan = $this->request->getPost('filterbulan');
        $tahun = $this->request->getPost('filtertahun');
        
        
        
        $db = \Config\Database::connect();
        $query = $db->query("SELECT detail_penjualan_id,sampah_id,sampah_nama,kategori_nama,
        detail_penjualan_qty,sampah_satuan,penjualan_tanggal,mitra_nama FROM tb_sampah JOIN tb_kategori ON sampah_kategori_id=kategori_id
        JOIN tb_detail_penjualan ON detail_penjualan_sampah=sampah_id 
        JOIN tb_mitra ON sampah_mitra_id=mitra_id
        JOIN tb_nasabah	ON nasabah_mitra_id=mitra_id 
        JOIN tb_penjualan ON  detail_penjualan_nomor=penjualan_nomor WHERE kategori_id ='$filterkategori' and MONTH(penjualan_tanggal) = '$bulan' AND YEAR(penjualan_tanggal) = '$tahun' and mitra_id = '$userlogin' GROUP BY detail_penjualan_id");
        $data1 = $query->getResultArray();
        
        $data = [
            'sampah' => $data1,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'filterkategori' => $filterkategori,
            'nama' => $nama           
        ];
        
        echo view('report/laporan_sampah_masuk_mitrakategori', $data);
    }

    public function sampahmasukperbulan()
    {
        $userlogin = session()->get('mitraId');
        $nama = session()->get('mitraNama');
        $bulan = $this->request->getPost('filterbulan');
        $tahun = $this->request->getPost('filtertahun');
        
        
        $db = \Config\Database::connect();
        $query = $db->query("SELECT detail_penjualan_id,sampah_id,sampah_nama,kategori_nama,
        detail_penjualan_qty,sampah_satuan,penjualan_tanggal FROM tb_sampah JOIN tb_kategori ON sampah_kategori_id=kategori_id
        JOIN tb_detail_penjualan ON detail_penjualan_sampah=sampah_id 
        JOIN tb_mitra ON sampah_mitra_id=mitra_id
        JOIN tb_nasabah	ON nasabah_mitra_id=mitra_id 
        JOIN tb_penjualan ON  detail_penjualan_nomor=penjualan_nomor WHERE MONTH(penjualan_tanggal) = '$bulan' AND YEAR(penjualan_tanggal) = '$tahun' AND mitra_id = '$userlogin' GROUP BY detail_penjualan_id");
        $data1 = $query->getResultArray();
        
        $data = [
            'sampah' => $data1,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'nama' => $nama,
        ];
        
        echo view('report/laporan_sampah_masuk_mitra', $data);
    }
}
    