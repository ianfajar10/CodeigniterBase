<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Profile extends BaseController
{
    public function index()
    {
        $modules = (new Modules)->index();
        $data = [
            'title' => 'Profile',
            'modules' => $modules
        ];
        return view('_content/_views/view_profile', $data);
    }
}
