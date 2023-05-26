<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = "tbl_orders";

    protected $allowedFields = [
        "id",
        "user_id",
        "total",
        "status",
        "disc_id",
        "date"
    ];

    public function save_data($data)
    {
        $this->insert($data);
        return true;
    }
    
    public function list_history_order_user($params = null)
    {
        $query = $this->select('tbl_orders.id, user_id, total, status, discount, date')->join('tbl_discs', 'tbl_discs.id = tbl_orders.disc_id', 'left')
        ->where('user_id', $params)
        ->where('status IS NOT NULL')
        ->orderBy('date', 'desc')
        ->find();
        return $query;
    }
}
