<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Modules extends BaseController
{
    public function index()
    {
        $check_role = session()->get('role');

        $data['sidebars'] = ($check_role == 1) ?
            [
                'dashboard' => ['Beranda', 'ti ti-layout-dashboard'],
                'sample-page' => ['Halaman Contoh', 'ti ti-file-broken'],
                'sample-data-tables' => ['Data Tables Contoh', 'ti ti-layout-columns'],
                // 'profile' => ['Profil', 'ti ti-user-circle'],
                // 'modul' => ['Modul', 'ti ti-list-details'],
                // 'upload' => ['Unggah', 'bi bi-pencil-square'],
            ]
            :
            [
                'dashboard' => ['Beranda', 'ti ti-layout-dashboard'],
                // 'profile' => ['Profil', 'ti ti-user-circle'],
                // 'filelist' => ['Daftar File', 'bi bi-book"'],
            ];

        return $data;
    }
}
