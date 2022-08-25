<?php

namespace App\Controllers;

use App\Models\WebNasabah;

class WebNasabahController extends BaseController
{
    public function indexmitra()
    {
        $userlogin = session()->get('mitraId');

        $model = new WebNasabah();
        $data['nasabah'] = $model->getDataByMitra($userlogin)->getResultArray();
        echo view('nasabah/view_nasabah_mitra', $data);
    }

    public function savemitra()
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

        $userlogin = session()->get('mitraId');

        if ($this->validate($rules)) {
            $model = new WebNasabah();
            $data = array(
                'nasabah_email' => $this->request->getPost('email'),
                'nasabah_nama' => $this->request->getPost('nama'),
                'nasabah_password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'nasabah_nohp' => $this->request->getPost('notelp'),
                'nasabah_status' => $this->request->getPost('status'),
                'nasabah_mitra_id' => $userlogin,
                'nasabah_saldo' => $this->request->getPost('saldo'),
                'nasabah_join_at' => $this->request->getPost('join')
            );
            $model->saveData($data);
            session()->setFlashdata('success', 'Berhasil menyimpan data');
            return redirect()->to('/mitra/nasabah');
        } else {
            session()->setFlashdata('failed', 'Gagal menyimpan data');
            $validation = \Config\Services::validation();
            return redirect()->to('/mitra/nasabah')->withInput()->with('validation', $validation);
        }
    }

    public function editmitra()
    {
        $id = $this->request->getPost('id');

        $model = new WebNasabah();
        $data = array(
            'nasabah_nama' => $this->request->getPost('nama'),
            'nasabah_nohp' => $this->request->getPost('notelp'),
            'nasabah_status' => $this->request->getPost('status'),
            'nasabah_saldo' => $this->request->getPost('saldo'),
        );
        $model->updateData($data, $id);
        session()->setFlashdata('success', 'Berhasil mengupdate data');
        return redirect()->to('/mitra/nasabah');
        
    }

    public function deletemitra()
    {
        $model = new WebNasabah();
        $id = $this->request->getPost('id');
        $model->deleteData($id);
        session()->setFlashdata('success', 'Berhasil menghapus data');
        return redirect()->to('/mitra/nasabah');
    }

    public function resetmitra()
    {
        $id = $this->request->getPost('id');

        $model = new WebNasabah();
        $data = array(
            'nasabah_password' => password_hash('1234', PASSWORD_DEFAULT),
        );
        $model->updateData($data, $id);
        session()->setFlashdata('success', 'Berhasil reset password');
        return redirect()->to('/mitra/nasabah');
    }

    public function reportmitra()
    {
        $userlogin = session()->get('mitraId');

        $model = new WebNasabah();
        $data['nasabah'] = $model->getDataByMitra($userlogin)->getResultArray();
        echo view('report/report_nasabah', $data);
    }
}