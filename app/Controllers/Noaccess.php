<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Noaccess extends BaseController
{
    public function index()
    {
        $modules = (new Modules)->index();
        $data = [
            'name' => 'noaccess',
            'title' => 'Tidak Ada Akses',
            'modules' => $modules
        ];
        return view('_base/no_access', $data);
    }
}
