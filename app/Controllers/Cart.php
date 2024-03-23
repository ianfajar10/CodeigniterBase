<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrderModel;

class Cart extends BaseController
{
    protected
        $order;

    public function __construct()
    {
        $this->order = new OrderModel();
    }

    public function index()
    {
        $modules = (new Modules)->index();
        $data = [
            'title' => 'Keranjang',
            'modules' => $modules
        ];
        return view('_content/_views/view_cart_page', $data);
    }

    public function store()
    {
        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            $insert = $this->order->store($data);

            if ($insert) {
                return $this->response->setJSON(['success' => true, 'msg' => 'Checkout berhasil!']);
            } else {
                return $this->response->setJSON(['success' => false, 'msg' => 'Checkout gagal!']);
            }
        }
    }
}
