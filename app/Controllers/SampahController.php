<?php

namespace App\Controllers;

use App\Models\Sampah;
use CodeIgniter\API\ResponseTrait;

class SampahController extends BaseController
{
    use ResponseTrait;

    public function list($id)
    {
        $model = new Sampah();
        $list = $model->getAllData($id);

        if ($list) {
            return $this->respond([
                'success' => true,
                'result' => $list
            ]);
        } else {
            return $this->respond([
                'success' => false,
                'message' => 'Sampah tidak ditemukan'
            ]);
        }
    }

    public function detail($id)
    {
        $model = new Sampah();
        $result = $model->getDetailData($id);

        if ($result) {
            return $this->respond([
                'success' => true,
                'result' => $result
            ]);
        } else {
            return $this->respond([
                'success' => false,
                'message' => 'Sampah tidak ditemukan'
            ]);
        }
    }

    public function filterCategory($id)
    {
        $model = new Sampah();
        $result = $model->getFilterKategori($id);

        if ($result) {
            return $this->respond([
                'success' => true,
                'result' => $result
            ]);
        } else {
            return $this->respond([
                'success' => false,
                'message' => 'Sampah tidak ditemukan'
            ]);
        }
    }

     public function pencarian($id, $search)
    {
        $model = new Sampah();
        $list = $model->getSearhingData($id, $search);

        if ($list) {
            return $this->respond([
                'success' => true,
                'result' => $list
            ]);
        } else {
            return $this->respond([
                'success' => false,
                'message' => 'Sampah tidak ditemukan'
            ]);
        }
    }
}
