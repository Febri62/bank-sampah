<?php

namespace App\Controllers;

use App\Models\Pegawai;

class LaporanController extends BaseController
{
    public function index()
    {
        echo view('view_laporan');
    }
    public function indextransaksi()
    {
        echo view('view_laporan_transaksi');
    }
    

    // public function nasabahperbulan()
    // {
    //     $bulan = $this->request->getPost('filterbulan');
    //     $tahun = $this->request->getPost('filterbulan');
    //     $db = \Config\Database::connect();
    //     $query = $db->query("SELECT * FROM tb_nasabah
    //     WHERE MONTH(nasabah_join_at) = '$bulan' and YEAR(nasabah_join_at) = '$tahun'");

    //     $data = [
    //         'nasabah' => $query->getResultArray(),
    //         'bulan' => $bulan,
    //         'tahun' => $tahun
    //     ];

    //     echo view('report/laporan_nasabah_perbulan', $data);
    // }

    // public function mitraperbulan()
    // {
    //     $bulan = $this->request->getPost('filterbulan');
    //     $tahun = $this->request->getPost('filterbulan');
    //     $db = \Config\Database::connect();
    //     $query = $db->query("SELECT * FROM tb_mitra
    //     WHERE MONTH(mitra_join_at) = '$bulan' and YEAR(mitra_join_at) = '$tahun'");

    //     $data = [
    //         'mitra' => $query->getResultArray(),
    //         'bulan' => $bulan,
    //         'tahun' => $tahun
    //     ];

    //     echo view('report/laporan_mitra_perbulan', $data);
    // }

    // public function sampahperbulan()
    // {
    //     $bulan = $this->request->getPost('filterbulan');
    //     $tahun = $this->request->getPost('filterbulan');
        
    //     $db = \Config\Database::connect();
    //     $query = $db->query("SELECT sampah_id, sampah_nama, kategori_nama, sampah_kategori_id,sampah_satuan,sampah_harga, sampah_status,sampah_deskripsi,sampah_created_at
    //     FROM tb_sampah JOIN tb_kategori ON sampah_kategori_id=kategori_id WHERE MONTH(sampah_created_at) = '$bulan' and YEAR(sampah_created_at) = '$tahun'");

    //     $data = [
    //         'sampah' => $query->getResultArray(),
    //         'bulan' => $bulan,
    //         'tahun' => $tahun
    //     ];

    //     echo view('report/laporan_sampah_perbulan', $data);
    // }

    public function penjualan()
    {
        $bulan = $this->request->getPost('filterbulan');
        $tahun = $this->request->getPost('filtertahun');
        
        $db = \Config\Database::connect();
        $query = $db->query("SELECT penjualan_nomor,nasabah_nama,penjualan_tanggal,penjualan_nasabah,penjualan_total_item, penjualan_total_harga,penjualan_status,penjualan_metode,penjualan_created
        FROM tb_penjualan JOIN tb_nasabah ON penjualan_nasabah=nasabah_id WHERE MONTH(penjualan_created) = '$bulan' and YEAR(penjualan_created) = '$tahun'");

        $data = [
            'penjualan' => $query->getResultArray(),
            'bulan' => $bulan,
            'tahun' => $tahun,
        ];

        echo view('report/laporan_penjualan_perbulan', $data);
    }

    public function penarikan()
    {
        $bulan = $this->request->getPost('filterbulan');
        $tahun = $this->request->getPost('filtertahun');
        
        $db = \Config\Database::connect();
        $query = $db->query("SELECT penarikan_nomor,penarikan_nasabah,penarikan_tanggal, nasabah_nama,nasabah_id,penarikan_nama_bank,
        penarikan_nomor_rekening,penarikan_nama_rekening,penarikan_jumlah_penarikan,penarikan_status, penarikan_bukti_transfer
        FROM tb_penarikan JOIN tb_nasabah ON penarikan_nasabah=nasabah_id WHERE MONTH(penarikan_tanggal) = '$bulan' and YEAR(penarikan_tanggal) = '$tahun'");

        $data = [
            'penarikan' => $query->getResultArray(),
            'bulan' => $bulan,
            'tahun' => $tahun,
        ];

        echo view('report/laporan_penarikan_perbulan', $data);
    }

    public function sampahmasuk(){

        $filterkategori = $this->request->getPost('kategori');
        $bulan = $this->request->getPost('filterbulan');
        $tahun = $this->request->getPost('filtertahun');
        
        
        $db = \Config\Database::connect();
        $query = $db->query("SELECT detail_penjualan_id,sampah_id,sampah_nama,kategori_nama,
        detail_penjualan_qty,sampah_satuan,penjualan_tanggal FROM tb_sampah JOIN tb_kategori ON sampah_kategori_id=kategori_id
        JOIN tb_detail_penjualan ON detail_penjualan_sampah=sampah_id 
        JOIN tb_mitra ON sampah_mitra_id=mitra_id
        JOIN tb_nasabah	ON nasabah_mitra_id=mitra_id 
        JOIN tb_penjualan ON  detail_penjualan_nomor=penjualan_nomor WHERE kategori_id ='$filterkategori' and MONTH(penjualan_tanggal) = '$bulan'  and YEAR(penjualan_tanggal) = '$tahun' GROUP BY detail_penjualan_id");
        $data1 = $query->getResultArray();
        
        $data = [
            'sampah' => $data1,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'filterkategori' => $filterkategori
        ];
        
        echo view('report/laporan_sampah_masuk_perbulankategori', $data);
    }

    public function sampahmasukperbulan(){

        $bulan = $this->request->getPost('filterbulan');
        $tahun = $this->request->getPost('filtertahun');
        
        $db = \Config\Database::connect();
        $query = $db->query("SELECT detail_penjualan_id,sampah_id,sampah_nama,kategori_nama,
        detail_penjualan_qty,sampah_satuan,penjualan_tanggal FROM tb_sampah JOIN tb_kategori ON sampah_kategori_id=kategori_id
        JOIN tb_detail_penjualan ON detail_penjualan_sampah=sampah_id 
        JOIN tb_mitra ON sampah_mitra_id=mitra_id
        JOIN tb_nasabah	ON nasabah_mitra_id=mitra_id 
        JOIN tb_penjualan ON  detail_penjualan_nomor=penjualan_nomor WHERE MONTH(penjualan_tanggal) = '$bulan' and YEAR(penjualan_tanggal) = '$tahun' GROUP BY detail_penjualan_id");
        $data1 = $query->getResultArray();
        
        $data = [
            'sampah' => $data1,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ];
        
       echo view('report/laporan_sampah_masuk_perbulan', $data);
    }

    

    
}