<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\CriticModel;
use App\Models\OrderModel;
use App\Models\UserModel;

class Cart extends BaseController
{
    protected
        $cartModel,
        $userModel,
        $session;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->userModel = new UserModel();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $modules = (new Modules)->index();
        $model = new CriticModel();
        $model2 = new OrderModel();
        $id_user = ['username' => $this->session->get('username')];
        $user = $this->userModel->check_login($id_user)[0];
        $cart = new CartModel();
        $data = [
            'count_order' => count($model2->order_in_progress()),
            'critic' => $model->get_critic(),
            'critic_user' => $model->get_critic($id_user),
            'name' => 'cart',
            'title' => 'Keranjang',
            'file' => $cart->list_cart_user($user['username']),
            'count_cart' => count($cart->list_cart_user($user['username'])),
            'modules' => $modules
        ];
        return view('_content/_views/view_cart', $data);
    }

    public function process()
    {
        $params = $this->request->getPost();

        $data = [
            'user_id' => $params['user_id'],
            'file_id' => $params['file_id'],
            'quantity' => $params['quantity'],
        ];

        $save = $this->cartModel->save_data($data);

        if ($save) {
            
            $data = [
                'cart' => count($this->cartModel->list_cart_user($params['user_id']))
            ];

            $this->session->set($data);

            $response = [
                'success' => true,
                'msg' => $params['quantity'] == 0 ? 'Item berhasil dihapus dari keranjang.' : 'Item berhasil masuk ke keranjang.'
            ];
        } else {
            $response = [
                'success' => false,
                'msg' => $params['quantity'] == 0 ? 'Item gagal dihapus dari keranjang.' : 'Item gagal masuk ke keranjang.'
            ];
        }

        return $this->response->setJSON($response);
    }
}
