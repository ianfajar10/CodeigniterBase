<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrderModel;

class History extends BaseController
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
            'title' => 'Riwayat',
            'modules' => $modules
        ];
        return view('_content/_views/view_history', $data);
    }

    public function get_list_table()
    {
        $db = \Config\Database::connect();
        
        $db->transStart(); // Memulai transaksi
        
        try {
            $userId = session()->get('username');
            $data = $this->order->list($userId);

            $db->transCommit(); // Commit transaksi
            return $this->response->setJSON($data);
        } catch (\Exception $e) {
            $db->transRollback(); // Rollback transaksi jika terjadi kesalahan
            return $this->response->setJSON(['error' => 'Transaction failed: ' . $e->getMessage()]);
        }
    }
}
