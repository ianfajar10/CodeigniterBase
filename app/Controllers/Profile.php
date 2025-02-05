<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class Profile extends BaseController
{
    protected $session, $product;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->product = new ProductModel();
    }

    public function index()
    {
        helper('form');
        $modules = (new Modules)->index();
        $data = [
            'title' => 'Profil',
            'modules' => $modules
        ];
        return view('_content/_views/view_profile', $data);
    }

    public function favorite()
    {
        $products_fav = $this->product->get_fav();

        $data = [
            'products_fav' => $products_fav
        ];
        return view('_base/favorite', $data);
    }
}
