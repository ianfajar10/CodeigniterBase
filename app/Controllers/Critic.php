<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FileModel;
use App\Models\RateModel;

class Critic extends BaseController
{
    public function index()
    {
        $modules = (new Modules)->index();
        $model = new RateModel();

        $dataCritic = $model->get_comment();

        $data = [
            'name' => 'critic',
            'title' => 'Data Kritik & Saran',
            'user' => $dataCritic,
            'modules' => $modules
        ];
        return view('_content/_views/view_critic', $data);
    }
}
