<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Modules extends BaseController
{
    public function index()
    {
        $data = [
            'sidebars' => [
                'dashboard' => ['Beranda', 'bi bi-grid'],
                'profile' => ['Profil', 'bi bi-person']
            ]
        ];
        return ($data);
    }

}
