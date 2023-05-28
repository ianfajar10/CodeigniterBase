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
        $var = "(SELECT GROUP_CONCAT(concat(tbl_files.name, ' ('), concat(tod.quantity, ')') SEPARATOR ',') FROM tbl_order_detail tod left JOIN tbl_files ON tbl_files.id = tod.file_id WHERE tod.order_id = tbl_orders.id) AS item";
        if ($params == null) {
            $query = $this->select('tbl_orders.id, user_id, total, status, discount, date, ' . $var)->join('tbl_discs', 'tbl_discs.id = tbl_orders.disc_id', 'left')
            ->where('status IS NOT NULL')
            ->orderBy('date', 'desc')
            ->findAll();
            // dd($this->getLastQuery());
            return $query;
        } else {
            $query = $this->select('tbl_orders.id, user_id, total, status, discount, date')->join('tbl_discs', 'tbl_discs.id = tbl_orders.disc_id', 'left')
            ->where('user_id', $params)
            ->where('status IS NOT NULL')
            ->orderBy('date', 'desc')
            ->find();
            return $query;
        }
    }

    public function update_status($status, $order_id)
    {
        $this->set(['status' => $status])->where('id', $order_id)->update();
        return true;
    }
}
