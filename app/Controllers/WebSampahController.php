<?php

namespace App\Controllers;

use App\Models\WebKategori;
use App\Models\WebSampah;


class WebSampahController extends BaseController
{
    public function index()
    {
        $userlogin = session()->get('mitraId');

        $model = new WebSampah();
        $modelsatu = new WebKategori();
        $data = [
            'sampah' => $model->getDataByMitra($userlogin)->getResultArray(),
            'kategori' => $modelsatu->getData()->getResultArray()
        ];
        echo view('sampah/view_sampah_mitra', $data);
    }

    public function save()
    {
        $model = new WebSampah();

        $userlogin = session()->get('mitraId');

        $filegambar = $this->request->getFile('gambar');

        if ($filegambar ->getError() == 4) {
            $filenama = 'default.png';
        } else {
            $filenama = $filegambar->getRandomName();

            $filegambar->move('fotosampah/', $filenama);
        }

        $data = array(
            'sampah_nama' => $this->request->getPost('nama'),
            'sampah_kategori_id' => $this->request->getPost('kategori'),
            'sampah_satuan' => $this->request->getPost('satuan'),
            'sampah_harga' => $this->request->getPost('harga'),
            'sampah_mitra_id' => $userlogin,
            'sampah_status' => $this->request->getPost('status'),
            'sampah_deskripsi' => $this->request->getPost('deskripsi'),
            'sampah_gambar' => $filenama,
            'sampah_created_at' => date('Ymd')
        );
        $model->saveData($data);
        session()->setFlashdata('success', 'Berhasil menyimpan data');
        return redirect()->to('/mitra/sampah');
    }

    public function edit()
    {
        $id = $this->request->getPost('id');

        $model = new WebSampah();

        $filegambar = $this->request->getFile('gambar');

        if ($filegambar ->getError() == 4) {
            $filenama = $this->request->getPost('filelama');
        } else {
            $filenama = $filegambar->getRandomName();

            $filegambar->move('fotosampah/', $filenama);
        }

        $data = array(
            'sampah_nama' => $this->request->getPost('nama'),
            'sampah_kategori_id' => $this->request->getPost('kategori'),
            'sampah_satuan' => $this->request->getPost('satuan'),
            'sampah_harga' => $this->request->getPost('harga'),
            'sampah_status' => $this->request->getPost('status'),
            'sampah_deskripsi' => $this->request->getPost('deskripsi'),
            'sampah_gambar' => $filenama,
        );
        $model->updateData($data, $id);
        session()->setFlashdata('success', 'Berhasil menyimpan data');
        return redirect()->to('/mitra/sampah');
    }

    public function delete()
    {
        $model = new WebSampah();
        $id = $this->request->getPost('id');
        $model->deleteData($id);
        session()->setFlashdata('success', 'Berhasil menghapus data');
        return redirect()->to('/mitra/sampah');
    }

    public function report()
    {
        $userlogin = session()->get('mitraId');

        $model = new WebSampah();
        $data = [
            'sampah' => $model->getDataByMitra($userlogin)->getResultArray(),
        ];
        echo view('report/report_sampah', $data);
    }
}
