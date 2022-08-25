<?php

namespace App\Controllers;

use App\Models\Penarikan;
use CodeIgniter\API\ResponseTrait;

class PenarikanController extends BaseController
{
    use ResponseTrait;

    public function save()
    {
        // $rules = [
        //     'email' => [
        //         'rules' => 'is_unique[tb_penarikan.nasabah_email]',
        //         'errors' => [
        //             'is_unique' => 'Email sudah terdaftar'
        //         ]
        //     ]
        // ];

        // if ($this->validate($rules)) {

        $hurufdepan = "PEN-";
        $tanggal = date("Ymd");
        $randomName = rand(1000, 9999);

        $generateFaktur = $hurufdepan . $tanggal . '-' . $randomName;

        date_default_timezone_set('Asia/Jakarta');
        $data = array(
            'penarikan_nomor' => $generateFaktur,
            'penarikan_tanggal' => date('Y-m-d H:i:s'),
            'penarikan_nasabah' => $this->request->getVar('idnasabah'),
            'penarikan_nama_bank' => $this->request->getVar('namabank'),
            'penarikan_nomor_rekening' => $this->request->getVar('nomorrekening'),
            'penarikan_nama_rekening' => $this->request->getVar('namarekening'),
            'penarikan_jumlah_penarikan' => $this->request->getVar('jumlahpenarikan'),
            'penarikan_status' => 0,
        );

        $model = new Penarikan();
        $data = $model->saveData($data);

        return $this->respond([
            'success' => true,
            'message' => 'Berhasil menyimpan data'
        ]);
        
        // } else {
        //     $validation = \Config\Services::validation();

        //     return $this->respond([
        //         'success' => false,
        //         'message' => 'Ada kesalahan',
        //         'data' => $validation->getErrors()
        //     ]);
        // }
    }

    public function riwayat($id)
    {
        $model = new Penarikan();
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
        $model = new Penarikan();
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
}
