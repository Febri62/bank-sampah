<?php

namespace App\Controllers;

use App\Models\WebLogin;

class WebLoginController extends BaseController
{
    public function indexadministrator()
    {
        if (session()->get('administratorId')) {
            return redirect()->to(base_url('/admin'));
        }
        echo view('login/view_login_administrator');
    }

    public function cekloginadministrator()
    {
        $model = new WebLogin();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->cekEmailAdministrator($email);

        if ($user) {
            if (password_verify($password, $user['administrator_password'])) {
                if ($user['administrator_status'] == 1) {
                    session()->set('administratorId', $user['administrator_id']);
                    session()->set('administratorNama', $user['administrator_nama']);
                    session()->set('administratorEmail', $user['administrator_email']);
                    session()->set('administratorRole', $user['administrator_role']);
                    return redirect()->to('/admin');
                } else {
                    session()->setFlashdata('message', 'Akun diblokir!');
                    return redirect()->to('/admin/login');
                }
            } else {
                session()->setFlashdata('message', 'Password salah!');
                return redirect()->to('/admin/login');
            }
        } else {
            session()->setFlashdata('message', 'Email belum terdaftar!');
            return redirect()->to('/admin/login');
        }
    }

    public function logoutadministrator()
    {
        session()->remove('administratorId');
        session()->remove('administratorNama');
        session()->remove('administratorEmail');
        session()->remove('administratorRole');
        session()->setFlashdata('success', 'Berhasil keluar');
        return redirect()->to('/admin/login');
    }

    public function indexmitra()
    {
        if (session()->get('mitraId')) {
            return redirect()->to(base_url('/mitra/mitra'));
        }
        echo view('login/view_login_mitra');
    }

    public function cekloginmitra()
    {
        $model = new WebLogin();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->cekEmailMitra($email);

        if ($user) {
            if (password_verify($password, $user['mitra_password'])) {
                if ($user['mitra_status'] == 1) {
                    session()->set('mitraId', $user['mitra_id']);
                    session()->set('mitraNama', $user['mitra_nama']);
                    session()->set('mitraEmail', $user['mitra_email']);
                    return redirect()->to('/mitra/mitra');
                } else {
                    session()->setFlashdata('message', 'Akun diblokir!');
                    return redirect()->to('/mitra/login');
                }
            } else {
                session()->setFlashdata('message', 'Password salah!');
                return redirect()->to('/mitra/login');
            }
        } else {
            session()->setFlashdata('message', 'Email belum terdaftar!');
            return redirect()->to('/mitra/login');
        }
    }

    public function logoutmitra()
    {
        session()->remove('mitraId');
        session()->remove('mitraNama');
        session()->remove('mitraEmail');
        session()->setFlashdata('success', 'Berhasil keluar');
        return redirect()->to('/mitra/login');
    }
}
