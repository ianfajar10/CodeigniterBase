<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartModel;

class Cart extends BaseController
{
    protected
        $cartModel,
        $session;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->session = \Config\Services::session();
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
                'msg' => 'Item berhasil masuk ke keranjang.'
            ];
        } else {
            $response = [
                'success' => false,
                'msg' => 'Item gagal masuk ke keranjang.'
            ];
        }

        return $this->response->setJSON($response);
    }
}
