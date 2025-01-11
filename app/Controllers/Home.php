<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class Home extends BaseController
{
    protected $session, $product;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->product = new ProductModel();
    }

    public function index()
    {
        $sessionData = $this->session->get();

        $products = $this->product->get();

        $data = [
            'session' => $sessionData,
            'products' => $products
        ];
        return view('_base/home', $data);
    }
}
