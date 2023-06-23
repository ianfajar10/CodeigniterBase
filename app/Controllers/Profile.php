<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CriticModel;

class Profile extends BaseController
{
    public function index()
    {
        $modules = (new Modules)->index();
        $model2 = new CriticModel();
        $data = [
            'critic' => $model2->get_critic(),
            'name' => 'profile',
            'title' => 'Profil',
            'modules' => $modules
        ];
        return view('_content/_views/view_profile', $data);
    }
}
