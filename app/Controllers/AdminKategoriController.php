<?php

namespace App\Controllers;

use App\Models\AdminKategori;

class AdminKategoriController extends BaseController
{
    public function index()
    {
        $model = new AdminKategori();
        $data = [
            'kategori' => $model->getData()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];
        echo view('kategori/view_kategori', $data);
    }

    public function save()
    {
        $rules = [
            'nama' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Nama harus diisi',
                    'max_length' => 'Kolom nama tidak boleh lebih dari 100 karakter'
                ]
            ]
        ];

        if ($this->validate($rules)) {
            $model = new AdminKategori();
            $data = array(
                'kategori_nama' => $this->request->getPost('nama')
            );
            $model->saveData($data);
            session()->setFlashdata('success', 'Berhasil menyimpan data');
            return redirect()->to('/kategori');
        } else {
            $validation = \Config\Services::validation();
            return redirect()->to('/kategori')->withInput()->with('validation', $validation);
        }
    }

    public function edit()
    {
        
        $id = $this->request->getPost('id');

            $model = new AdminKategori();
            $data = array(
                'kategori_nama' => $this->request->getPost('kategori'),
            );
            $model->updateData($data, $id);
            session()->setFlashdata('success', 'Berhasil mengupdate data');
            return redirect()->to('/kategori');
    
    }

    public function delete()
    {
        $model = new AdminKategori();
        $id = $this->request->getPost('id');
        $model->deleteData($id);
        session()->setFlashdata('success', 'Berhasil menghapus data');
        return redirect()->to('/kategori');
    }

    public function report()
    {
        $model = new AdminKategori();
        $data['kategori'] = $model->getData()->getResultArray();
        echo view('report/report_kategori', $data);
    }
}
