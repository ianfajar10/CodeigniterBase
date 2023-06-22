<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CriticModel;

class Profile extends BaseController
{
    public function index()
    {
        $model = new CriticModel();
        $modules = (new Modules)->index();
        $data = [
            'critic' => $model->get_critic(),
            'name' => 'profile',
            'title' => 'Profil',
            'modules' => $modules
        ];
        return view('_content/_views/view_profile', $data);
    }
}
