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
                'profile' => ['Profil', 'ti ti-user-circle'],
                'product-category' => ['Kategori', 'ti ti-archive'],
                'user' => ['Data Pembeli', 'ti ti-crown'],
                'user-mitra' => ['Data Penjual', 'ti ti-user'],
                'report' => ['Laporan', 'ti ti-file'],
                // 'sample-page' => ['Halaman Contoh', 'ti ti-file-broken'],
                // 'sample-data-tables' => ['Data Tables Contoh', 'ti ti-layout-columns'],
            ]
            :
            $data['sidebars'] = ($check_role == 2) ? [
                'dashboard' => ['Beranda', 'ti ti-layout-dashboard'],
                'profile' => ['Profil', 'ti ti-user-circle'],
                'product' => ['Produk', 'ti ti-gift'],
                'order' => ['Pesanan', 'ti ti-tag'],
                
                // 'sample-crud' => ['Produk', 'ti ti-plus'],
            ]
            :
            [
                'dashboard' => ['Beranda', 'ti ti-layout-dashboard'],
                'profile' => ['Profil', 'ti ti-user-circle'],
                'history' => ['Transaksi', 'ti ti-shopping-cart'],
                // 'filelist' => ['Daftar File', 'bi bi-book"'],
            ];

        return $data;
    }
}
