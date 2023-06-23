<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CriticModel;
use App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
        $modules = (new Modules)->index();
        $model2 = new CriticModel();
        $model = new UserModel();
        
        $dataUser = $model->list_user();
        
        $data = [
            'critic' => $model2->get_critic(),
            'name' => 'user',
            'title' => 'Data Pengguna',
            'user' => $dataUser,
            'modules' => $modules
        ];
        return view('_content/_views/view_user', $data);
    }
}
