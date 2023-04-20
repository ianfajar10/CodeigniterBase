<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Modules extends BaseController
{
    public function index()
    {
        $check_role = session()->get('role');
        if ($check_role == 1) {
            $data = [
                'sidebars' => [
                    'dashboard' => ['Beranda', 'bi bi-grid'],
                    // 'menu-list' => ['Daftar Menu', 'bi bi-book"'],
                    'upload' => ['Unggah', 'bi bi-pencil-square'],
                    'profile' => ['Profil', 'bi bi-person']
                ]
            ];
        } else {
            $data = [
                'sidebars' => [
                    'dashboard' => ['Beranda', 'bi bi-grid'],
                    'menu-list' => ['Daftar Menu', 'bi bi-book"'],
                    'profile' => ['Profil', 'bi bi-person']
                ]
            ];
        }
        return ($data);
    }

}
