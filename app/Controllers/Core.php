<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Core extends BaseController
{
    public function index()
    {
        $modules = (new Modules)->index();
        $data = [
            'name' => 'core',
            'title' => null,
            'modules' => $modules
        ];
        return view('_base/core', $data);
    }

}
