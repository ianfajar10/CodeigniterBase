<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CriticModel;

class Noaccess extends BaseController
{
    public function index()
    {
        $modules = (new Modules)->index();
        $model = new CriticModel();
        $id_user = ['username' => \Config\Services::session()->get('username')];
        $data = [
            'name' => 'noaccess',
            'critic_user' => $model->get_critic($id_user),
            'title' => 'Tidak Ada Akses',
            'modules' => $modules
        ];
        return view('_base/no_access', $data);
    }
}
