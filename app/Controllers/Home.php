<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FavoriteModel;
use App\Models\ProductcategoryModel;
use App\Models\ProductModel;

class Home extends BaseController
{
    protected $session, $product, $products_category, $favorite;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->product = new ProductModel();
        $this->products_category = new ProductcategoryModel();
        $this->favorite = new FavoriteModel();
    }

    public function index()
    {
        $sessionData = $this->session->get();

        $products = $this->product->get();

        $products_category = $this->products_category->get();

        $favorite = $this->favorite->get($sessionData['username']);

        $data = [
            'session' => $sessionData,
            'products' => $products,
            'categories' => $products_category,
            'keywords' => false,
            'favorite_count' => count($favorite)
        ];
        return view('_base/home', $data);
    }

    public function search()
    {
        $keyword = $this->request->getGet('keyword');

        $sessionData = $this->session->get();

        $products = $this->product->get($keyword);

        $products_category = $this->products_category->get();

        $favorite = $this->favorite->get($sessionData['username']);

        $data = [
            'session' => $sessionData,
            'products' => $products,
            'categories' => $products_category,
            'keywords' => true,
            'favorite_count' => count($favorite)
        ];
        return view('_base/home', $data);
    }

    public function details($id = null)
    {
        $sessionData = $this->session->get();

        $products = $this->product->get($id);

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
        } else {
            return view('_base/checkout_product');
        }
    }

    public function love()
    {
        $session = session();
        if ($session->has('username')) {
            $product_id = $this->request->getPost('product_id');
            $username = $session->get('username');

            $data = array(
                'product_id'  => $product_id,
                'username'  => $username,
            );

            $isLoved = $this->favorite->check($data);

            if ($isLoved) {
                $this->favorite->destroy($data);
                return $this->response->setJSON([
                    'status' => 'success',
                    'additional_status' => 'Produk berhasil dihapus dari favorit'
                ]);
            } else {
                $this->favorite->store($data);
                return $this->response->setJSON([
                    'status' => 'success',
                    'additional_status' => 'Produk berhasil ditambah dari favorit'
                ]);
            }

            return $this->response->setJSON(['status' => 'success', 'additional_status' => 'loved']);
        }

        return $this->response->setJSON(['status' => 'error']);
    }
}
