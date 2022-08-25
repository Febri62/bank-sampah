<?php

namespace App\Controllers;

use App\Models\AdminNasabah;

class AdminNasabahController extends BaseController
{
    public function index()
    {
        $model = new AdminNasabah();
        $data['nasabah'] = $model->getData()->getResultArray();
        echo view('nasabah/view_nasabah_administrator', $data);
    }

    public function tambah()
    {
        $model = new AdminNasabah();
        $data = [
            'nasabah' => $model->getData()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];

        echo view('nasabah/view_tambah_nasabah', $data);
    }

    public function save()
    {
        $rules = [
            'email' => [
                'rules' => 'required|max_length[100]|is_unique[tb_nasabah.nasabah_email]',
                'errors' => [
                    'is_unique' => 'Email sudah ada',
                    'required' => 'Email harus diisi',
                    'max_length' => 'Kolom email tidak boleh lebih dari 20 karakter'
                ]
            ]
        ];

        if ($this->validate($rules)) {
            $model = new AdminNasabah();
            $data = array(
                'nasabah_email' => $this->request->getPost('email'),
                'nasabah_nama' => $this->request->getPost('nama'),
                'nasabah_password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'nasabah_nohp' => $this->request->getPost('notelp'),
                'nasabah_status' => $this->request->getPost('status'),
                'nasabah_mitra_id' => $this->request->getPost('mitra'),
                'nasabah_saldo' => $this->request->getPost('saldo'),
                'nasabah_join_at' => $this->request->getPost('join')
            );
            $model->saveData($data);
            session()->setFlashdata('success', 'Berhasil menyimpan data');
            return redirect()->to('/nasabah');
        } else {
            $validation = \Config\Services::validation();
            return redirect()->to('/tambah-data-nasabah')->withInput()->with('validation', $validation);
        }
    }

    public function edit()
    {
        
        $id = $this->request->getPost('id');


            $model = new AdminNasabah();
            $data = array(
                'nasabah_email' => $this->request->getPost('email'),
                'nasabah_nama' => $this->request->getPost('nama'),
                'nasabah_nohp' => $this->request->getPost('notelp'),
                'nasabah_saldo' => $this->request->getPost('saldo'),
                'nasabah_status' => $this->request->getPost('status')
            );
            $model->updateData($data, $id);
            session()->setFlashdata('success', 'Berhasil mengupdate data');
            return redirect()->to('/nasabah');
        
    }

    public function update($id)
    {
        $model = new AdminNasabah();
        $data = [
            'user' => $model->getUserDetail($id)->getResultArray(),
            'validation' => \Config\Services::validation()
        ];
        echo view('view_edit_user', $data);
    }

    public function delete()
    {
        $model = new AdminNasabah();
        $id = $this->request->getPost('id');
        $model->deleteData($id);
        session()->setFlashdata('success', 'Berhasil menghapus data');
        return redirect()->to('/nasabah');
    }

    public function reset()
    {
        $id = $this->request->getPost('id');

        $model = new AdminNasabah();
        $data = array(
            'nasabah_password' => password_hash('1234', PASSWORD_DEFAULT),
        );
        $model->updateData($data, $id);
        session()->setFlashdata('success', 'Berhasil reset password');
        return redirect()->to('/nasabah');
    }

    public function report()
    {
        $model = new AdminNasabah();
        $data['nasabah'] = $model->getData()->getResultArray();
        echo view('report/report_nasabah', $data);
    }
}