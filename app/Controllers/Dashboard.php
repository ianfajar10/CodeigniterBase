<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CriticModel;

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
        $data = [
            'name' => 'dashboard',
            'title' => 'Beranda',
            'critic' => $model->get_critic(),
            'modules' => $modules
        ];


        return view('_content/_views/view_dashboard', $data);
    }
}
