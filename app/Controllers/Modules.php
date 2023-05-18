<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Modules extends BaseController
{
    public function index($query = null)
    {
        $check_role = session()->get('role');
        $data['all'] = [
            'dashboard' => ['Beranda', 'bi bi-grid'],
            'menulist' => ['Daftar Menu', 'bi bi-book"'],
            'menulist/detail' => ['Detail Menu', '-'],
            'menulist/search' => ['Pencarian Menu ' . '(' . $query . ')', '-'],
            'upload' => ['Unggah', 'bi bi-pencil-square'],
            'discount' => ['Potongan Harga', 'bi bi-tag'],
            'profile' => ['Profil', 'bi bi-person'],
            'cart' => ['Keranjang', 'bi bi-cart'],
            'order' => ['Histori Pemesanan', 'bi bi-clock-history'],
            'order/detail' => ['Detail Order', '-'],
        ];
        if ($check_role == 1) {
            //ADMIN
            $data['sidebars'] = [
                'dashboard' => ['Beranda', 'bi bi-grid'],
                'upload' => ['Unggah', 'bi bi-pencil-square'],
                'discount' => ['Potongan Harga', 'bi bi-tag'],
                'profile' => ['Profil', 'bi bi-person']
            ];
        } else {
            if ($check_role != null) {
                $data['sidebars'] = [
                    'dashboard' => ['Beranda', 'bi bi-grid'],
                    'menulist' => ['Daftar Menu', 'bi bi-book"'],
                    'cart' => ['Keranjang', 'bi bi-cart'],
                    'profile' => ['Profil', 'bi bi-person'],
                    'order' => ['Histori Pemesanan', 'bi bi-clock-history'],
                ];
            } else {
                $data['sidebars'] = [
                    'dashboard' => ['Beranda', 'bi bi-grid'],
                    'menulist' => ['Daftar Menu', 'bi bi-book"'],
                    'cart' => ['Keranjang', 'bi bi-cart'],
                    'profile' => ['Profil', 'bi bi-person'],
                ];
            }
        }
        return ($data);
    }
}
