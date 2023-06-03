<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
        $modules = (new Modules)->index();
        $model = new UserModel();

        $dataUser = $model->list_user();

        $data = [
            'name' => 'user',
            'title' => 'Data Pengguna',
            'user' => $dataUser,
            'modules' => $modules
        ];
        return view('_content/_views/view_user', $data);
    }
}
