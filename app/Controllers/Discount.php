<?php

namespace App\Controllers;

use App\Models\CriticModel;
use App\Models\DiscountModel;
use App\Models\FileModel;
use App\Models\OrderModel;

class Discount extends BaseController
{
    public function index()
    {
        $modules = (new Modules)->index();
        $model = new FileModel();
        $model2 = new DiscountModel();
        $model3 = new CriticModel();
        $model4 = new OrderModel();
        
        $data = [
            'count_order' => count($model4->order_in_progress()),
            'critic' => $model3->get_critic(),
            'name' => 'discount',
            'title' => 'Diskon',
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