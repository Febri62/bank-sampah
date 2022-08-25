<?php

namespace App\Controllers;

use App\Models\AdminAdministrator;

class AdminAdministratorController extends BaseController
{
    public function index()
    {
        $model = new AdminAdministrator();
        $data = [
            'administrator' => $model->getData()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];
        
        echo view('administrator/view_administrator', $data);
    }

    public function save()
    {
        $rules = [
            'email' => [
                'rules' => 'required|max_length[100]|is_unique[tb_administrator.administrator_email]',
                'errors' => [
                    'is_unique' => 'Email sudah ada',
                    'required' => 'Email harus diisi',
                    'max_length' => 'Kolom email tidak boleh lebih dari 20 karakter'
                ]
            ],
            'nama' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Nama harus diisi',
                    'max_length' => 'Kolom nama tidak boleh lebih dari 100 karakter'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[4]|max_length[100]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'max_length' => 'Kolom password tidak boleh lebih dari 100 karakter',
                    'min_length' => 'Kolom password setidaknya terdiri dari 4 karakter'
                ]
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Level harus diisi'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Level harus diisi'
                ]
            ]
        ];

        if ($this->validate($rules)) {
            $model = new AdminAdministrator();
            $data = array(
                'administrator_email' => $this->request->getPost('email'),
                'administrator_nama' => $this->request->getPost('nama'),
                'administrator_password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'administrator_role' => $this->request->getPost('role'),
                'administrator_status' => $this->request->getPost('status')
            );
            $model->saveData($data);
            session()->setFlashdata('success', 'Berhasil menyimpan data');
            return redirect()->to('/administrator');
        } else {
            $validation = \Config\Services::validation();
            return redirect()->to('/administrator')->withInput()->with('validation', $validation);
        }
    }

    public function edit()
    {
        $rules = [
            'nama' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Nama harus diisi',
                    'max_length' => 'Kolom nama tidak boleh lebih dari 100 karakter'
                ]
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Level harus diisi'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Level harus diisi'
                ]
            ]
        ];

        $id = $this->request->getPost('id');

        if ($this->validate($rules)) {
            $model = new AdminAdministrator();
            $data = array(
                'administrator_nama' => $this->request->getPost('nama'),
                'administrator_role' => $this->request->getPost('role'),
                'administrator_status' => $this->request->getPost('status')
            );
            $model->updateData($data, $id);
            session()->setFlashdata('success', 'Berhasil mengupdate data');
            return redirect()->to('/administrator');
        } else {
            $validation = \Config\Services::validation();
            return redirect()->to('/administrator' . $id)->withInput()->with('validation', $validation);
        }
    }

    public function reset()
    {
        $id = $this->request->getPost('id');

        $model = new AdminAdministrator();
        $data = array(
            'administrator_password' => password_hash('1234', PASSWORD_DEFAULT),
        );
        $model->updateData($data, $id);
        session()->setFlashdata('success', 'Berhasil reset password');
        return redirect()->to('/administrator');
    }

    public function delete()
    {
        $model = new AdminAdministrator();
        $id = $this->request->getPost('id');
        $model->deleteData($id);
        session()->setFlashdata('success', 'Berhasil menghapus data');
        return redirect()->to('/administrator');
    }

    public function report()
    {
        $model = new AdminAdministrator();
        $data['administrator'] = $model->getData()->getResultArray();
        echo view('report/report_administrator', $data);
    }
}
