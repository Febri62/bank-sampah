<?php

namespace App\Controllers;

use App\Models\AdminMitra;


class AdminMitraController extends BaseController
{
    public function index()
    {
        
        
        $model = new AdminMitra();
        $data = [
            'mitra' => $model->getData()->getResultArray(),
            'validation' => \Config\Services::validation()

        ];
        echo view('mitra/view_mitra', $data);
    }

    public function tambah()
    {
        $model = new AdminMitra();
        $data = [
            'mitra' => $model->getData()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];

        echo view('mitra/view_tambah_mitra', $data);
    }
    // public function ubah(){
    //     $model = new AdminMitra();
    //     $data = [
    //         'mitra' => $model->updateData()->getResultArray(),
    //         'validation' => \Config\Services::validation()
    //     ];
    //     return view('mitra/view_update_mitra');
    // }
    public function save()
    {
        $db = db_connect();
        // $rules = [
        //     'email' => [
        //         'rules' => 'required|max_length[100]|is_unique[tb_mitra.mitra_email]',
        //         'errors' => [
        //             'is_unique' => 'Email sudah ada',
        //             'required' => 'Email harus diisi',
        //             'max_length' => 'Kolom email tidak boleh lebih dari 20 karakter'
        //         ]
        //     ]
        // ];

        // if ($this->validate($rules)) {
        //     $model = new AdminMitra();
            $data = [
                'mitra_email' => $this->request->getPost('email'),
                'mitra_nama' => $this->request->getPost('nama'),
                'mitra_password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'mitra_nohp' => $this->request->getPost('notelp'),
                'mitra_direktur' => $this->request->getPost('direktur'),
                'mitra_kecamatan' => $this->request->getPost('kecamatan'),
                'mitra_kota' => $this->request->getPost('kota'),
                'mitra_alamat' => $this->request->getPost('alamat'),
                'mitra_status' => $this->request->getPost('status'),
                'mitra_join_at' => $this->request->getPost('join')
            ];
            // $model->saveData($data);
            // session()->setFlashdata('success', 'Berhasil menyimpan data');
            // return redirect()->to('/mitra');
            $db->table('tb_mitra')->insert($data);
        session()->setflashdata('success', 'Data Berhasil Disimpan.');
        return redirect()->to(base_url('/mitra'));
        // } else {
        //     $validation = \Config\Services::validation();
        //     return redirect()->to('/tambah_data_mitra')->withInput()->with('validation', $validation);
        // }
    }

    public function edit()
    {
        $db = db_connect();
      

            // $model = new AdminMitra();
            $data = [
                'mitra_email' => $this->request->getPost('email'),
                'mitra_nama' => $this->request->getPost('nama'),
                'mitra_nohp' => $this->request->getPost('notelp'),
                'mitra_direktur' => $this->request->getPost('direktur'),
                'mitra_status' => $this->request->getPost('status')
            ];
            $id = $this->request->getPost('id');
            $db->table('tb_mitra')->update($data, array('mitra_id' => $id));
            // $model->updateData($data, $id);
            session()->setFlashdata('success', 'Berhasil mengupdate data');
            return redirect()->to('/mitra');
    }

    // public function update($id)
    // {
    //     $model = new AdminMitra();
    //     $data = [
    //         'user' => $model->getUserDetail($id)->getResultArray(),
    //         'validation' => \Config\Services::validation()
    //     ];
    //     echo view('view_edit_user', $data);
    // }

    public function delete()
    {
        $model = new AdminMitra();
        $id = $this->request->getPost('id');
        $model->deleteData($id);
        session()->setFlashdata('success', 'Berhasil menghapus data');
        return redirect()->to('/mitra');
    }

    // public function report()
    // {
    //     $model = new AdminMitra();
    //     $data['user'] = $model->getUser()->getResultArray();
    //     echo view('laporan/laporan_user', $data);
    // }

    public function reset()
    {
        $id = $this->request->getPost('id');

        $model = new AdminMitra();
        $data = array(
            'mitra_password' => password_hash('1234', PASSWORD_DEFAULT),
        );
        $model->updateData($data, $id);
        session()->setFlashdata('success', 'Berhasil reset password');
        return redirect()->to('/mitra');
    }
    public function report()
    {
        $model = new AdminMitra();
        $data['mitra'] = $model->getData()->getResultArray();
        echo view('report/report_mitra', $data);
    }
}
