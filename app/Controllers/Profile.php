<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Profile extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Profil'
        ];
        return view('_content/_views/view_profile', $data);
    }
}
