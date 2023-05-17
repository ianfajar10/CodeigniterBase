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
        "date"
    ];

    public function save_data($data)
    {
        $this->insert($data);
        return true;
    }
    
    public function list_history_order_user($params = null)
    {
        $query = $this->where('user_id', $params)->where('status', '<>', NULL)->find();
        return $query;
    }
}
