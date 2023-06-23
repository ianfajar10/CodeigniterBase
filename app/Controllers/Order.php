<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\CriticModel;
use App\Models\DiscountModel;
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
        $discountModel,
        $session;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->orderDetailModel = new OrderDetailModel();
        $this->orderModel = new OrderModel();
        $this->userModel = new UserModel();
        $this->discountModel = new DiscountModel();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $modules = (new Modules)->index();
        $model2 = new CriticModel();
        $id_user = ['username' => $this->session->get('username')];
        $user = $this->userModel->check_login($id_user)[0];
        
        $data = [
            'critic' => $model2->get_critic(),
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
        $model2 = new CriticModel();
        $data = [
            'critic' => $model2->get_critic(),
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
            'table' => $params['table'],
            'total' => $params['total'],
            'status' => $params['status'],
            'disc_id' => $params['is_new'] === 'true' ? 'THANICOFFEENEW' : '0'
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
                'msg' => 'Maaf, anda tidak memenuhi syarat sebagai pengguna baru.'
            ];
        } else {
            if (isset($params['code'])) {
                $check_code = $this->discountModel->get_code($params['code']);
                if (count($check_code) > 0) {
                    $response = [
                        'success' => true,
                        'msg' => 'Selamat, kode bisa digunakan.'
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'msg' => 'Maaf, kode tidak bisa digunakan.'
                    ];
                }
            }
        }

        return $this->response->setJSON($response);
    }
    
    public function index_admin()
    {
        $modules = (new Modules)->index();

        $data = [
            'name' => 'orderadmin',
            'title' => 'Data Pemesanan',
            'file' => $this->orderModel->list_history_order_user(),
            'modules' => $modules
        ];
        return view('_content/_views/view_order_admin', $data);
    }

    public function update_status()
    {
        $model = new OrderModel();
        $params = $this->request->getPost();

        $save = $model->update_status($params['status'], $params['order_id']);
        if ($save) {

            $response = [
                'success' => true,
                'msg' => 'Status pembayaran berhasil disimpan.'
            ];
        } else {
            $response = [
                'success' => false,
                'msg' => 'Status pembayaran gagal disimpan.'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function check_birth_user()
    {
        $params = $this->request->getPost();
        $query = $this->userModel->check_birth_user($params['user_id']);
        
        if ($query) {
            $response = [
                'success' => true,
                'msg' => 'Valid.'
            ];
        } else {
            $response = [
                'success' => false,
                'msg' => 'Tidak Valid.'
            ];
        }

        return $this->response->setJSON($response);
    }
}