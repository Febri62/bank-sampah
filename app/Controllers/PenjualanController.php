<?php

namespace App\Controllers;

use App\Models\Penarikan;
use App\Models\Penjualan;
use CodeIgniter\API\ResponseTrait;

class PenjualanController extends BaseController
{
    use ResponseTrait;

    public function savelangsung()
    {
        $hurufdepan = "INV-";
        $tanggal = date("Ymd");
        $randomName = rand(1000, 9999);

        $generateFaktur = $hurufdepan . $tanggal . '-' . $randomName;

        date_default_timezone_set('Asia/Jakarta');
        $data = array(
            'penjualan_nomor' => $generateFaktur,
            'penjualan_tanggal' => date('Y-m-d'),
            'penjualan_nasabah' => $this->request->getVar('idnasabah'),
            'penjualan_total_item' => $this->request->getVar('totalitem'),
            'penjualan_total_harga' => $this->request->getVar('totalharga'),
            'penjualan_status' => 0,
            'penjualan_metode' => $this->request->getVar('metode'),
            'penjualan_alamat_detail' => $this->request->getVar('alamatdetail'),
            'penjualan_created' => date('Y-m-d'),
        );

        $model = new Penjualan();
        $result = $model->saveData($data);

        $datadua= array(
            'detail_penjualan_nomor' => $generateFaktur,
            'detail_penjualan_sampah' => $this->request->getVar('idsampah'),
            'detail_penjualan_qty' => $this->request->getVar('qty'),
            'detail_penjualan_jumlah' => $this->request->getVar('jumlah'),
        );

        $resultdua = $model->saveDataDetail($datadua);

        return $this->respond([
            'success' => true,
            'message' => 'Berhasil menyimpan data',
            'faktur' => $generateFaktur,
            'tanggal' => date('Y-m-d'),
            'metode' => $this->request->getVar('metode'),
            'status' => 0,
            'jumlahpendapatan' => $this->request->getVar('totalharga'),
        ]);
    }

    public function savebanyak()
    {
        $hurufdepan = "INV-";
        $tanggal = date("Ymd");
        $randomName = rand(1000, 9999);

        $generateFaktur = $hurufdepan . $tanggal . '-' . $randomName;

        date_default_timezone_set('Asia/Jakarta');
        $data = array(
            'penjualan_nomor' => $generateFaktur,
            'penjualan_tanggal' => date('Y-m-d'),
            'penjualan_nasabah' => $this->request->getVar('idnasabah'),
            'penjualan_total_item' => $this->request->getVar('totalitem'),
            'penjualan_total_harga' => $this->request->getVar('totalharga'),
            'penjualan_status' => 0,
            'penjualan_metode' => $this->request->getVar('metode'),
            'penjualan_alamat_detail' => $this->request->getVar('alamatdetail'),
            'penjualan_created' => date('Y-m-d'),
        );

        $model = new Penjualan();
        $result = $model->saveData($data);

        $datasatu= array(
            'detail_penjualan_nomor' => $generateFaktur,
            'detail_penjualan_sampah' => $this->request->getVar('idsampah'),
            'detail_penjualan_qty' => $this->request->getVar('qty'),
            'detail_penjualan_jumlah' => $this->request->getVar('jumlah'),
        );
        $resultsatu = $model->saveDataDetail($datasatu);

        $detailDua = $this->request->getVar('idsampahdua');
        $detailTiga = $this->request->getVar('idsampahtiga');

        if ($detailDua !== '') {
            $datadua= array(
                'detail_penjualan_nomor' => $generateFaktur,
                'detail_penjualan_sampah' => $this->request->getVar('idsampahdua'),
                'detail_penjualan_qty' => $this->request->getVar('qtydua'),
                'detail_penjualan_jumlah' => $this->request->getVar('jumlahdua'),
            );
            $resultdua = $model->saveDataDetail($datadua);
        }

        if ($detailTiga !== '') {
            $datatiga= array(
                'detail_penjualan_nomor' => $generateFaktur,
                'detail_penjualan_sampah' => $this->request->getVar('idsampahtiga'),
                'detail_penjualan_qty' => $this->request->getVar('qtytiga'),
                'detail_penjualan_jumlah' => $this->request->getVar('jumlahtiga'),
            );
            $resulttiga = $model->saveDataDetail($datatiga);
        }

        return $this->respond([
            'success' => true,
            'message' => 'Berhasil menyimpan data',
            'faktur' => $generateFaktur,
            'tanggal' => date('Y-m-d'),
            'metode' => $this->request->getVar('metode'),
            'status' => 0,
            'jumlahpendapatan' => $this->request->getVar('totalharga'),
        ]);
    }

    public function riwayat($id)
    {
        $model = new Penjualan();
        $list = $model->getHistory($id);

        if ($list) {
            return $this->respond([
                'success' => true,
                'result' => $list
            ]);
        } else {
            return $this->respond([
                'success' => false,
                'message' => 'History tidak ditemukan'
            ]);
        }
    }

    public function riwayatdetail($id)
    {
        $model = new Penjualan();
        $list = $model->getHistoryDetail($id);

        if ($list) {
            return $this->respond([
                'success' => true,
                'result' => $list
            ]);
        } else {
            return $this->respond([
                'success' => false,
                'message' => 'Detail history tidak ditemukan'
            ]);
        }
    }

    public function riwayatdetailpenjualan($id)
    {
        $model = new Penjualan();
        $list = $model->getHistoryDetailPenjualan($id);

        if ($list) {
            return $this->respond([
                'success' => true,
                'result' => $list
            ]);
        } else {
            return $this->respond([
                'success' => false,
                'message' => 'Detail history tidak ditemukan'
            ]);
        }
    }

    public function changestatus()
    {
        $idtransaksi = $this->request->getVar('idtransaksi');

        $data = array(
            'penjualan_status' => 4,
        );

        $model = new Penjualan();
        $result = $model->updateData($data, $idtransaksi);
        
        return $this->respond([
            'success' => true,
            'message' => 'Berhasil membatalkan transaksi',
        ]);
    }
}
