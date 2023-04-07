<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $modules = (new Modules)->index();
        $data = [
            'name' => 'dashboard',
            'title' => 'Beranda',
            'modules' => $modules
        ];
        return view('_content/_views/view_dashboard', $data);
    }
}
