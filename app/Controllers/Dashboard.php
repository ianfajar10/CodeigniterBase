<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CriticModel;
use App\Models\OrderModel;

class Dashboard extends BaseController
{
    protected
    $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $modules = (new Modules)->index();
        $model = new CriticModel();
        $model2 = new OrderModel();
        $data = [
            'name' => 'dashboard',
            'title' => 'Beranda',
            'critic' => $model->get_critic(),
            'count_order' => count($model2->order_in_progress()),
            'modules' => $modules
        ];

        return view('_content/_views/view_dashboard', $data);
    }
}
