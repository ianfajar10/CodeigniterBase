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
            'upload' => ['Input Menu', 'bi bi-pencil-square'],
            'discount' => ['Potongan Harga', 'bi bi-tag'],
            'profile' => ['Profil', 'bi bi-person'],
            'cart' => ['Keranjang', 'bi bi-cart'],
            'order' => ['Histori Pemesanan', 'bi bi-clock-history'],
            'order/detail' => ['Detail Order', '-'],
            'orderadmin' => ['Data Pemesanan', 'bi bi-book'],
            'report' => ['Laporan', 'bi bi-file-earmark-bar-graph-fill'],
            'user' => ['Data Pelanggan', 'bi bi-person-circle'],
            'critic' => ['Kritik & Saran', 'bi bi-chat-left-quote'],
            'criticadmin' => ['Kritik & Saran', 'bi bi-chat-left-quote'],
            'review' => ['Review Pelanggan', 'bi bi-chat-left-quote'],
            'banner' => ['Banner', 'bi bi-images'],
        ];
        if ($check_role == 1) {
            //ADMIN
            $data['sidebars'] = [
                'dashboard' => ['Beranda', 'bi bi-grid'],
                'upload' => ['Input Menu', 'bi bi-pencil-square'],
                // 'menulist' => ['Daftar Menu', 'bi bi-book"'],
                'discount' => ['Potongan Harga', 'bi bi-tag'],
                'profile' => ['Profil', 'bi bi-person'],
                'orderadmin' => ['Data Pemesanan', 'bi bi-book'],
                'user' => ['Data Pelanggan', 'bi bi-person-circle'],
                'report' => ['Laporan', 'bi bi-file-earmark-bar-graph-fill'],
                'criticadmin' => ['Kritik & Saran', 'bi bi-chat-left-quote'],
                'review' => ['Review Pelanggan', 'bi bi-chat-left-quote'],
                'banner' => ['Banner', 'bi bi-images'],
            ];
        } else {
            if ($check_role != null) {
                $data['sidebars'] = [
                    'dashboard' => ['Beranda', 'bi bi-grid'],
                    'menulist' => ['Daftar Menu', 'bi bi-book"'],
                    'cart' => ['Keranjang', 'bi bi-cart'],
                    'profile' => ['Profil', 'bi bi-person'],
                    'order' => ['Histori Pemesanan', 'bi bi-clock-history'],
                    'critic' => ['Kritik & Saran', 'bi bi-chat-left-quote'],
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
