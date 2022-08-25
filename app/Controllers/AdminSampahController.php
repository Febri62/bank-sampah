<?php

namespace App\Controllers;

use App\Models\AdminSampah;


class AdminSampahController extends BaseController
{
    public function index()
    {
        
        $db      = \Config\Database::connect();
        $builder = $db->table('tb_sampah');
        $builder->select('*');
        $builder->join('tb_kategori', 'tb_sampah.sampah_kategori_id = tb_kategori.kategori_id');
        $builder->join('tb_mitra', 'tb_sampah.sampah_mitra_id = tb_mitra.mitra_id');
        $query = $builder->get();
        $data['sampah'] = $query;

        // $model = new AdminSampah();
        // $data = [
        //     'sampah' => $model->getData()->getResultArray(),
        //     'validation' => \Config\Services::validation()
            
        // ];
      
        echo view('sampah/view_sampah', $data);
    }

    public function tambah()
    {
        $model = new AdminSampah();
        $data = [
            'sampah' => $model->getData()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];

        echo view('sampah/view_tambah_sampah', $data);
    }

    public function update()
    {
        $model = new AdminSampah();
        $data = [
            'sampah' => $model->getData()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];

        echo view('sampah/view_update_sampah', $data);
    }
    // public function ubah(){
    //     return view('sampah/view_update_sampah');
    // }
    public function save()
    {
        $db   = \Config\Database::connect();
        $dataBerkas = $this->request->getFile('gambar');
        $filenama = $dataBerkas->getRandomName();
        $data = [
            'sampah_gambar' => $filenama];
        
        $dataBerkas->move('assets/images/', $filenama);
        

            $data = [
                'sampah_nama' => $this->request->getPost('nama'),
                'sampah_kategori_id' => $this->request->getPost('kategori'),
                'sampah_satuan' => $this->request->getPost('satuan'),
                'sampah_harga' => $this->request->getPost('harga'),
                'sampah_mitra_id' => $this->request->getPost('mitra'),
                'sampah_status' => $this->request->getPost('status'),
                'sampah_deskripsi' => $this->request->getPost('deskripsi'),
                'sampah_gambar' => $filenama,
                'sampah_created_at' => $this->request->getPost('join')
            ];

            $db->table('tb_sampah')->insert($data);
            if($db==true){
            session()->setFlashdata('success', 'Berhasil menyimpan data');
            return redirect()->to('/sampah');
        } else {
            echo "<script>
            alert('failed', 'Data Gagal disimpan');
            window.location = 'tambah_data_sampah'
            </script>"; 
        }
    }
    public function delete()
    {
        $db   = \Config\Database::connect();
        $id = $this->request->getPost('id');

        $db->table('tb_sampah')->delete(array('sampah_id' => $id));
        session()->setFlashdata('success', 'Berhasil menghapus data');
        return redirect()->to('/sampah');
    }

    public function report(){
    
        $db      = \Config\Database::connect();
        $builder = $db->table('tb_sampah');
        $builder->select('*');
        // $builder->join('tb_mitra', 'tb_penjualan.penjualan_mitra_id = tb_mitra.mitra_id');
        $builder->join('tb_kategori', 'tb_sampah.sampah_kategori_id = tb_kategori.kategori_id');
        $query = $builder->get();
        $data['sampah'] = $query;
        echo view('report/report_sampah_admin', $data);
    }

    public function edit()
    {
       $db   = \Config\Database::connect();
        $dataBerkas = $this->request->getFile('gambar');
        $filenama = $dataBerkas->getRandomName();
        $data = [
            'sampah_gambar' => $filenama,
        ];
        
        

        $data = [
            'sampah_nama' => $this->request->getPost('nama'),
            'sampah_kategori_id' => $this->request->getPost('kategori'),
            'sampah_satuan' => $this->request->getPost('satuan'),
            'sampah_harga' => $this->request->getPost('harga'),
            'sampah_status' => $this->request->getPost('status'),
            'sampah_deskripsi' => $this->request->getPost('deskripsi'),
            'sampah_gambar' => $filenama,
        ];
        $dataBerkas->move('assets/images/', $filenama);
        $id = $this->request->getPost('id');
        $db->table('tb_sampah')->update($data, array('sampah_id' => $id));

        if($db == TRUE){
            session()->setflashdata('success', 'Update data Berhasil.');
        return redirect()->to(base_url('/sampah'));
        } else {
            echo "<script>
            alert('failed', 'Data Gagal disimpan');
            window.location = 'sampah'
            </script>"; 
        }
    }

    // public function edit()
    // {
    //     $rules = [
    //         'email' => [
    //             'rules' => 'required|max_length[100]|is_unique[tb_Sampah.Sampah_email]',
    //             'errors' => [
    //                 'is_unique' => 'Email sudah ada',
    //                 'required' => 'Email harus diisi',
    //                 'max_length' => 'Kolom email tidak boleh lebih dari 20 karakter'
    //             ]
    //         ],
    //         'nama' => [
    //             'rules' => 'required|max_length[100]',
    //             'errors' => [
    //                 'required' => 'Nama harus diisi',
    //                 'max_length' => 'Kolom nama tidak boleh lebih dari 100 karakter'
    //             ]
    //         ],
    //         'password' => [
    //             'rules' => 'required|min_length[4]|max_length[100]',
    //             'errors' => [
    //                 'required' => 'Password harus diisi',
    //                 'max_length' => 'Kolom password tidak boleh lebih dari 100 karakter',
    //                 'min_length' => 'Kolom password setidaknya terdiri dari 4 karakter'
    //             ]
    //         ],
    //         'notelp' => [ 
    //             'rules' => 'required|max_length[100]',
    //             'errors' => [
    //                 'required' => 'No Hp harus diisi',
    //                 'max_length' => 'Kolom tidak boleh lebih dari 100 karakter'
    //             ]
    //         ],
    //         'direktur' => [
    //             'rules' => 'required|max_length[100]',
    //             'errors' => [
    //                 'required' => 'Nama Direktur harus diisi',
    //                 'max_length' => 'Kolom tidak boleh lebih dari 100 karakter'
    //             ]
    //         ],
    //         'kecamatan' => [
    //             'rules' => 'required|max_length[100]',
    //             'errors' => [
    //                 'required' => 'Nama kecamatan harus diisi',
    //                 'max_length' => 'Kolom nama kecamatan tidak boleh lebih dari 100 karakter'
    //             ]
    //         ],
    //         'kota' => [
    //             'rules' => 'required|max_length[100]',
    //             'errors' => [
    //                 'required' => 'Nama kota harus diisi',
    //                 'max_length' => 'Kolom nama kota tidak boleh lebih dari 100 karakter'
    //             ]
    //         ],
    //         'alamat' => [
    //             'rules' => 'required|max_length[100]',
    //             'errors' => [
    //                 'required' => 'Alamat harus diisi',
    //                 'max_length' => 'Kolom alamat tidak boleh lebih dari 100 karakter'
    //             ]
    //         ],
    //         'status' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'status harus diisi'
    //             ]
    //         ]
    //     ];

    //     $id = $this->request->getPost('id');

    //     if ($this->validate($rules)) {
    //         $model = new AdminSampah();
    //         $data = array(
    //             'userEmail' => $this->request->getPost('email'),
    //             'userNama' => $this->request->getPost('nama'),
    //             'userPassword' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
    //             'userLevel' => $this->request->getPost('level')
    //         );
    //         $model->updateUser($data, $id);
    //         session()->setFlashdata('success', 'Berhasil menyimpan data');
    //         return redirect()->to('/user');
    //     } else {
    //         $validation = \Config\Services::validation();
    //         return redirect()->to('/user/update/' . $id)->withInput()->with('validation', $validation);
    //     }
    // }

    // public function update($id)
    // {
    //     $model = new AdminSampah();
    //     $data = [
    //         'user' => $model->getUserDetail($id)->getResultArray(),
    //         'validation' => \Config\Services::validation()
    //     ];
    //     echo view('view_edit_user', $data);
    // }

    // public function delete()
    // {
    //     $model = new AdminSampah();
    //     $id = $this->request->getPost('id');
    //     $model->deleteUser($id);
    //     session()->setFlashdata('success', 'Berhasil menghapus data');
    //     return redirect()->to('/user');
    // }

    // public function report()
    // {
    //     $model = new AdminSampah();
    //     $data['user'] = $model->getUser()->getResultArray();
    //     echo view('laporan/laporan_user', $data);
    // }
}
