<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrderDetailModel;

class Orderdetail extends BaseController
{
    protected
        $order;

    public function __construct()
    {
        $this->order = new OrderDetailModel();
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
}