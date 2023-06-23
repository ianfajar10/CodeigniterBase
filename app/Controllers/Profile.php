<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CriticModel;
use App\Models\OrderModel;

class Profile extends BaseController
{
    public function index()
    {
        $model = new CriticModel();
        $model2 = new OrderModel();
        $modules = (new Modules)->index();
        $data = [
            'count_order' => count($model2->order_in_progress()),
            'critic' => $model->get_critic(),
            'name' => 'profile',
            'title' => 'Profil',
            'modules' => $modules
        ];
        return view('_content/_views/view_profile', $data);
    }
}
