<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\OrderDetailModel;
use App\Models\OrderModel;
use App\Models\UserModel;

class Order extends BaseController
{
    protected
        $cartModel,
        $orderDetailModel,
        $orderModel,
        $userModel,
        $session;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->orderDetailModel = new OrderDetailModel();
        $this->orderModel = new OrderModel();
        $this->userModel = new UserModel();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $modules = (new Modules)->index();
        $id_user = ['username' => $this->session->get('username')];
        $user = $this->userModel->check_login($id_user)[0];

        $data = [
            'name' => 'order',
            'title' => 'Pemesanan',
            'file' => $this->orderModel->list_history_order_user($user['username']),
            'count_order' => count($this->orderModel->list_history_order_user($user['username'])),
            'modules' => $modules
        ];
        return view('_content/_views/view_order', $data);
    }

    public function detail($params)
    {
        $modules = (new Modules)->index();
        $data = [
            'name' => 'orderdetail',
            'title' => 'Detail Order',
            'file' => $this->orderDetailModel->get_item_order($params),
            'modules' => $modules,
            'params' => [
                'order_id' => $params
            ]
        ];
        return view('_content/_views/view_order_detail', $data);
    }

    public function process()
    {
        $params = $this->request->getPost();

        $data = [
            'id' => $params['no_order'],
            'user_id' => $params['user_id'],
            'total' => $params['total'],
            'status' => $params['status'],
            'disc_id' => $params['is_new'] === 'true' ? '1' : '0'
        ];

        $save = $this->orderModel->save_data($data);

        $quantity = $params['quantity'];
        $price = $params['price'];

        foreach ($params['item'] as $key => $value) {
            $data2 = [
                'order_id' => $params['no_order'],
                'file_id' => $value,
                'quantity' => $quantity[$key],
                'price' => $price[$key] * $quantity[$key],
            ];
    
            $save = $this->orderDetailModel->save_data_detail($data2);
        }
        
        if ($save) {
            foreach ($params['item'] as $key => $value) {
                $data = [
                    'user_id' => $params['user_id'],
                    'file_id' => $value
                ];
                $this->cartModel->delete_cart($data);
            }
            
            $data = [
                'cart' => count($this->cartModel->list_cart_user($params['user_id']))
            ];
            $this->session->set($data);

            $response = [
                'success' => true,
                'msg' => 'Pesanan berhasil dibuat!.'
            ];
        } else {
            $response = [
                'success' => false,
                'msg' => 'Pesanan gagal dibuat!.'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function check_new_user()
    {
        $params = $this->request->getPost();
        $query = $this->orderModel->list_history_order_user($params['user_id']);
        
        if ($query) {
            $response = [
                'success' => false,
            ];
        } else {
            $response = [
                'success' => true,
            ];
        }

        return $this->response->setJSON($response);
    }
}