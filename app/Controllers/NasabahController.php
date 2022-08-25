<?php

namespace App\Controllers;

use App\Models\Nasabah;
use CodeIgniter\API\ResponseTrait;

class NasabahController extends BaseController
{
    use ResponseTrait;

    public function login()
    {
        $model = new Nasabah();
        $useremail = $this->request->getVar('email');
        $userpassword = $this->request->getVar('password');

        $user = $model->checkuser($useremail);

        if ($user) {
            if (password_verify($userpassword, $user['nasabah_password'])) {
                return $this->respond([
                    'success' => true,
                    'message' => 'Berhasil login',
                    'user' => $user
                ]);
            } else {
                return $this->respond([
                    'success' => false,
                    'message' => 'Password anda salah'
                ]);
            }
        } else {
            return $this->respond([
                'success' => false,
                'message' => 'Email tidak ditemukan'
            ]);
        }
    }

    public function register()
    {
        $rules = [
            'email' => [
                'rules' => 'is_unique[tb_nasabah.nasabah_email]',
                'errors' => [
                    'is_unique' => 'Email sudah terdaftar'
                ]
            ]
        ];

        if ($this->validate($rules)) {

            $model = new Nasabah();
            $datamitra = $model->searchMitra($this->request->getVar('kodepos'));

            if ($datamitra) {
                $mitraid = $datamitra['mitra_id'];

                $data = array(
                    'nasabah_email' => $this->request->getVar('email'),
                    'nasabah_nama' => $this->request->getVar('name'),
                    'nasabah_password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'nasabah_status' => 1,
                    'nasabah_mitra_id' => $mitraid,
                    'nasabah_saldo' => 0,
                    'nasabah_join_at' => date('Ymd'),
                );
    
                $data = $model->register($data);
    
                return $this->respond([
                    'success' => true,
                    'message' => 'Berhasil mendaftar'
                ]);
            } else {
                return $this->respond([
                    'success' => false,
                    'codefailed' => 1,
                    'message' => 'Maaf, tidak ada Bank Sampah terdekat dari lokasi anda'
                ]);
            }
        } else {
            $validation = \Config\Services::validation();

            return $this->respond([
                'success' => false,
                'codefailed' => 2,
                'message' => 'Ada kesalahan',
                'data' => $validation->getErrors()
            ]);
        }
    }

    public function editpassword()
    {
        $nasabahid = $this->request->getVar('nasabahid');

        $data = array(
            'nasabah_password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        );

        $model = new Nasabah();
        $data = $model->updateData($data, $nasabahid);

        return $this->respond([
            'success' => true,
            'message' => 'Berhasil update data'
        ]);
    }

    public function editnama()
    {
        $nasabahid = $this->request->getVar('nasabahid');

        $data = array(
            'nasabah_nama' => $this->request->getVar('namanasabah'),
        );

        $model = new Nasabah();
        $data = $model->updateData($data, $nasabahid);

        return $this->respond([
            'success' => true,
            'message' => 'Berhasil update data'
        ]);
    }

      public function saldo($id)
    {
        $model = new Nasabah();
        $list = $model->checkuser($id);

        if ($list) {
            return $this->respond([
                'success' => true,
                'result' => $list
            ]);
        } else {
            return $this->respond([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }
}
