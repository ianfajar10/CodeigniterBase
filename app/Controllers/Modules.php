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
                'menu-list' => ['Daftar Menu', 'bi bi-book"'],
                'profile' => ['Profil', 'bi bi-person']
            ]
        ];
        return ($data);
    }

}