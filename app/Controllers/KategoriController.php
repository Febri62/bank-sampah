<?php

namespace App\Controllers;

use App\Models\Kategori;
use CodeIgniter\API\ResponseTrait;

class KategoriController extends BaseController
{
    use ResponseTrait;

    public function list()
    {
        $model = new Kategori();
        $result = $model->getAllData();

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
}
