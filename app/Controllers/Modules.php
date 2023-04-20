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
                'all' => [
                    'dashboard' => ['Beranda', 'bi bi-grid'],
                    'menulist' => ['Daftar Menu', 'bi bi-book"'],
                    'menulist/detail' => ['Detail Menu', '-'],
                    'upload' => ['Unggah', 'bi bi-pencil-square'],
                    'profile' => ['Profil', 'bi bi-person']
                ],
                'sidebars' => [
                    'dashboard' => ['Beranda', 'bi bi-grid'],
                    'upload' => ['Unggah', 'bi bi-pencil-square'],
                    'profile' => ['Profil', 'bi bi-person']
                ],
            ];
        } else {
            $data = [
                'all' => [
                    'dashboard' => ['Beranda', 'bi bi-grid'],
                    'menulist' => ['Daftar Menu', 'bi bi-book"'],
                    'menulist/detail' => ['Detail Menu', '-'],
                    'upload' => ['Unggah', 'bi bi-pencil-square'],
                    'profile' => ['Profil', 'bi bi-person']
                ],
                'sidebars' => [
                    'dashboard' => ['Beranda', 'bi bi-grid'],
                    'menulist' => ['Daftar Menu', 'bi bi-book"'],
                    'profile' => ['Profil', 'bi bi-person']
                ]
            ];
        }
        return ($data);
    }

}
