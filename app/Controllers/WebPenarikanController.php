<?php

namespace App\Controllers;

use App\Models\WebPenarikan;

class WebPenarikanController extends BaseController
{
    public function index()
    {
        $userlogin = session()->get('mitraId');

        $model = new WebPenarikan();
        $data = [
            'penarikan' => $model->getDataByMitra($userlogin)->getResultArray(),
        ];
        echo view('penarikan/view_penarikan_mitra', $data);
    }

    public function editmitra()
    {
        $id = $this->request->getPost('id');

        $model = new WebPenarikan();

        $filegambar = $this->request->getFile('gambar');

        $filenama = $filegambar->getRandomName();

        $filegambar->move('buktitransfer/', $filenama);

        $data = array(
            'penarikan_status' => 1,
            'penarikan_bukti_transfer' => $filenama,
        );
        $model->updateData($data, $id);
        session()->setFlashdata('success', 'Berhasil mengupdate data');
        return redirect()->to('/mitra/penarikan');
        
    }

    public function reportmitra()
    {
        $userlogin = session()->get('mitraId');

        $model = new WebPenarikan();
        $data = [
            'penarikan' => $model->getDataByMitra($userlogin)->getResultArray(),
        ];
        echo view('report/report_penarikan_mitra', $data);
    }

    public function penarikanperbulan()
    {
        $bulan = $this->request->getPost('filterbulan');
        $tahun = date("Y");
        
        $db = \Config\Database::connect();
        $query = $db->query("SELECT penarikan_nomor,penarikan_nasabah,penarikan_tanggal, nasabah_nama,nasabah_id,penarikan_nama_bank,
        penarikan_nomor_rekening,penarikan_nama_rekening,penarikan_jumlah_penarikan,penarikan_status
        FROM tb_penarikan JOIN tb_nasabah ON penarikan_nasabah=nasabah_id WHERE MONTH(penarikan_created) = '$bulan' and YEAR(penarikan_created) = '$tahun'");

        $data = [
            'penarikan' => $query->getResultArray(),
            'bulan' => $bulan,
            'tahun' => $tahun
        ];

        echo view('report/laporan_penarikan_perbulan', $data);
    }
}
