<?php

namespace App\Controllers;

// use App\Models\penarikan;

class AdminPenarikanController extends BaseController
{
    public function index(){
        $db      = \Config\Database::connect();
        $query = $db->query("SELECT penarikan_nomor,penarikan_tanggal,penarikan_nasabah,penarikan_nama_bank,penarikan_nomor_rekening,
        penarikan_nama_rekening,penarikan_jumlah_penarikan,penarikan_status,nasabah_nama,penarikan_bukti_transfer
        FROM tb_penarikan JOIN tb_nasabah ON penarikan_nasabah=nasabah_id ORDER BY penarikan_status ASC");
    
        $data['penarikan'] = $query;
        echo view('penarikan/view_penarikan_admin', $data);
    }
    public function edit(){
            
           
            $db      = \Config\Database::connect();
            $data = [
                   'penarikan_status' => $this->request->getPost('status')
            ];
            $id = $this->request->getPost('id');
            $db->table('tb_penarikan')->update($data, array('penarikan_nomor' => $id));
            // $model->updateData($data, $id);
            session()->setFlashdata('success', 'Berhasil mengupdate data');
            return redirect()->to('/penarikan');
    }

    public function save(){

        $db   = \Config\Database::connect();
        $dataBerkas = $this->request->getFile('bukti');
        $fileName = $dataBerkas->getRandomName();
        $data = [
            'penarikan_bukti_transfer' => $fileName,
        ];
        
        $dataBerkas->move('assets/images/', $fileName);
        $id = $this->request->getPost('id');
        $db->table('tb_penarikan')->update($data, array('penarikan_nomor' => $id));

        if($db == TRUE){
            session()->setflashdata('success', 'Upload Bukti Berhasil.');
        return redirect()->to(base_url('/penarikan'));
        } else {
            echo "<script>
            alert('failed', 'Data Gagal disimpan');
            window.location = 'penarikan'
            </script>"; 
        }
        
    }

    public function report(){
        $db      = \Config\Database::connect();
        $builder = $db->table('tb_penarikan');
        $builder->select('*');
        // $builder->join('tb_mitra', 'tb_penarikan.penarikan_mitra_id = tb_mitra.mitra_id');
        $builder->join('tb_nasabah', 'tb_penarikan.penarikan_nasabah = tb_nasabah.nasabah_id');
        $query = $builder->get();
        $data['penarikan'] = $query;
        echo view('report/report_transaksi_penarikan', $data);
    }
}