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
                'upload' => ['Unggah', 'bi bi-pencil-square'],
                'profile' => ['Profil', 'bi bi-person']
            ]
        ];
        return ($data);
    }

}
