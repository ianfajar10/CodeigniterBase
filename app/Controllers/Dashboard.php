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
        $id_user = ['username' => \Config\Services::session()->get('username')];
        $data = [
            'name' => 'dashboard',
            'title' => 'Beranda',
            'critic' => $model->get_critic(),
            'critic_user' => $model->get_critic($id_user),
            'count_order' => count($model2->order_in_progress()),
            'modules' => $modules
        ];

        return view('_content/_views/view_dashboard', $data);
    }
}
