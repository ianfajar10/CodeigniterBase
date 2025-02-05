<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\MidtransLibrary;
use App\Models\FavoriteModel;
use App\Models\ProductcategoryModel;
use App\Models\ProductModel;
use App\Models\TransactionModel;
use App\Models\RajaOngkirModel;

class Home extends BaseController
{
    protected $session, $product, $products_category, $favorite, $raja_ongkir, $order;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->product = new ProductModel();
        $this->products_category = new ProductcategoryModel();
        $this->favorite = new FavoriteModel();
        $this->raja_ongkir = new RajaOngkirModel();
        $this->order = new TransactionModel();
    }

    public function index()
    {
        $sessionData = $this->session->get();

        $products = $this->product->get();

        $favorite = [];

        $products_category = $this->products_category->get();

        if (isset($sessionData['username'])) {
            $favorite = $this->favorite->get($sessionData['username']);
        }
        
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

        $favorite = [];

        if (isset($sessionData['username'])) {
            $favorite = $this->favorite->get($sessionData['username']);
        }

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
        $data = $this->request->getPost();
      
        if (!$session->get('isLogin')) {
            return redirect()->to('/login');
        } else {
            $products = $this->product->get($data['product_id']);

            $provinces = $this->raja_ongkir->getProvinces();

            return view('_base/checkout_product', ['provinces' => $provinces, 'user' => $session->get(), 'products' => $products, 'qty' => $data['quantity']]);
        }
    }

    public function processPayment()
    {
        $midtrans = new MidtransLibrary();
        $session = session();
        $username = $session->get('username');

        $orderData = [
            'transaction_details' => [
                'order_id' => $this->request->getPost('orderNo2'),
                'gross_amount' => $this->request->getPost('total_payment'),
            ],
            'customer_details' => [
                'first_name' => $this->request->getPost('firstName'),
                'last_name' => $this->request->getPost('lastName'),
                'email' => $this->request->getPost('email'),
                'phone' => $this->request->getPost('telepon'),
            ],
        ];

        $dataOrder = [
            'transaction_details_local' => [
                'id' => $this->request->getPost('orderNo2'),
                'username' => $username,
                'product_id' => $this->request->getPost('product_id'),
                'qty' => $this->request->getPost('qty'),
                'price' => $this->request->getPost('price'),
                'receipt_number' => $this->request->getPost('courier') . '-',
            ],
        ];

        $transaction_details = json_encode($dataOrder);

        $snapToken = $midtrans->createSnapToken($orderData);

        return view('_base/payment', ['snaptoken' => $snapToken, 'transaction_details' => $transaction_details]);
    }

    public function store_transaction()
    {
        $session = session();
        if ($session->has('username')) {
            $order_id = $this->request->getPost('order_id');
            $price = $this->request->getPost('price');
            $product_id = $this->request->getPost('product_id');
            $quantity = $this->request->getPost('quantity');
            $username = $session->get('username');
            $receipt_number = $this->request->getPost('receipt_number');

            $data = array(
                'id'  => $order_id,
                'username'  => $username,
                'product_id'  => $product_id,
                'qty'  => $quantity,
                'price'  => $price,
                'paid_status'  => 'Sudah Bayar',
                'receipt_number'  => $receipt_number,
            );

            $store = $this->order->store($data);

            if ($store) {
                return $this->response->setJSON([
                    'status' => 'success',
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'failed',
                ]);
            }
        }

        return view('_base/home');
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
                    'additional_status' => 'Produk berhasil ditambah ke favorit'
                ]);
            }

            return $this->response->setJSON(['status' => 'success', 'additional_status' => 'loved']);
        }

        return $this->response->setJSON(['status' => 'error']);
    }

    public function getCities($provinceId)
    {
        $rajaOngkirModel = new RajaOngkirModel();
        $cities = $rajaOngkirModel->getCities($provinceId);

        return json_encode($cities);
    }

    public function calculateShipping()
    {
        $rajaOngkirModel = new RajaOngkirModel();
        $origin = $this->request->getPost('origin');
        $destination = $this->request->getPost('destination');
        $weight = $this->request->getPost('weight');
        $courier = $this->request->getPost('courier');

        $shippingCost = $rajaOngkirModel->getShippingCost($origin, $destination, $weight, $courier);

        return json_encode($shippingCost);
    }
}
