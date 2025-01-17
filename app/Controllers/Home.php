<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductcategoryModel;
use App\Models\ProductModel;

class Home extends BaseController
{
    protected $session, $product, $products_category;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->product = new ProductModel();
        $this->products_category = new ProductcategoryModel();
    }

    public function index()
    {
        $sessionData = $this->session->get();

        $products = $this->product->get();

        $products_category = $this->products_category->get();

        $data = [
            'session' => $sessionData,
            'products' => $products,
            'categories' => $products_category,
            'keywords' => false
        ];
        return view('_base/home', $data);
    }

    public function search()
    {
        $keyword = $this->request->getGet('keyword');

        $sessionData = $this->session->get();

        $products = $this->product->get($keyword);

        $products_category = $this->products_category->get();

        $data = [
            'session' => $sessionData,
            'products' => $products,
            'categories' => $products_category,
            'keywords' => true
        ];
        return view('_base/home', $data);
    }

    public function details($id = null)
    {
        $sessionData = $this->session->get();

        $products = $this->product->get($id);

        $products_category = $this->products_category->get();

        $data = [
            'session' => $sessionData,
            'products' => $products,
        ];
        return view('_base/details_product', $data);
    }

    public function checkout(){
        $session = session();
      
        if (!$session->get('isLogin')) {
            return redirect()->to('/login');
        }
    }
}
