<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Modules extends BaseController
{
    public function index()
    {
        $check_role = session()->get('role');
        $data['all'] = [
            'dashboard' => ['Beranda', 'bi bi-grid'],
            'filelist' => ['Daftar File', 'bi bi-book"'],
            'filelist/detail' => ['Detail File', '-'],
            'upload' => ['Unggah', 'bi bi-pencil-square'],
            'profile' => ['Profil', 'bi bi-person']
        ];
        if ($check_role == 1) {
            $data['sidebars'] = [
                'dashboard' => ['Beranda', 'bi bi-grid'],
                'upload' => ['Unggah', 'bi bi-pencil-square'],
                'profile' => ['Profil', 'bi bi-person']
            ];
        } else {
            $data['sidebars'] = [
                'dashboard' => ['Beranda', 'bi bi-grid'],
                'filelist' => ['Daftar File', 'bi bi-book"'],
                'profile' => ['Profil', 'bi bi-person']
            ];
        }
        return ($data);
    }
}
