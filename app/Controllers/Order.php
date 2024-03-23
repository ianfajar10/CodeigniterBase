<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrderModel;

class Order extends BaseController
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
            'title' => 'Pesanan',
            'modules' => $modules
        ];
        return view('_content/_views/view_order', $data);
    }

    public function get_list_table()
    {
        $db = \Config\Database::connect();

        $db->transStart(); // Memulai transaksi

        try {
            $data = $this->order->list();

            $db->transCommit(); // Commit transaksi
            return $this->response->setJSON($data);
        } catch (\Exception $e) {
            $db->transRollback(); // Rollback transaksi jika terjadi kesalahan
            return $this->response->setJSON(['error' => 'Transaction failed: ' . $e->getMessage()]);
        }
    }

    public function get_list_by_id()
    {
        $db = \Config\Database::connect();

        $db->transStart(); // Memulai transaksi

        try {
            $id = $this->request->getVar('id');

            $data = $this->order->listById($id);

            $db->transCommit(); // Commit transaksi
            return $this->response->setJSON($data);
        } catch (\Exception $e) {
            $db->transRollback(); // Rollback transaksi jika terjadi kesalahan
            return $this->response->setJSON(['error' => 'Transaction failed: ' . $e->getMessage()]);
        }
    }

    public function updates()
    {
        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            $insert = $this->order->updates($data);

            if ($insert) {
                return $this->response->setJSON(['success' => true, 'msg' => 'Update status pesanan berhasil!']);
            } else {
                return $this->response->setJSON(['success' => false, 'msg' => 'Update status pesanan gagal!']);
            }
        }
    }
}
