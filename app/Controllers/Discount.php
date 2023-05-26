<?php

namespace App\Controllers;

use App\Models\DiscountModel;
use App\Models\FileModel;

class Discount extends BaseController
{
    public function index()
    {
        $modules = (new Modules)->index();
        $model = new FileModel();
        $model2 = new DiscountModel();

        $data = [
            'name' => 'discount',
            'title' => 'Potongan Harga',
            'file' => $model->get_files_cond(),
            'discount' => $model2->get_discount(),
            'modules' => $modules
        ];
        return view('_content/_views/view_discount', $data);
    }

    public function process()
    {
        $model = new FileModel();
        $params = $this->request->getPost();

        $save = $model->save_discount($params['file_id'], $params['discount']);
        if ($save) {

            $response = [
                'success' => true,
                'msg' => 'Diskon berhasil disimpan.'
            ];
        } else {
            $response = [
                'success' => false,
                'msg' => 'Diskon gagal disimpan.'
            ];
        }

        return $this->response->setJSON($response);
    }
}