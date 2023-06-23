<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CriticModel;

class Noaccess extends BaseController
{
    public function index()
    {
        $modules = (new Modules)->index();
        $model2 = new CriticModel();
        $data = [
            'critic' => $model2->get_critic(),
            'name' => 'noaccess',
            'title' => 'Tidak Ada Akses',
            'modules' => $modules
        ];
        return view('_base/no_access', $data);
    }
}
