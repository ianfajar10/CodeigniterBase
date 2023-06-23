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

    public function update_data($data)
    {
        $this->where('id', $data['no_order'])
        ->where('user_id', $data['username'])
        ->set([
            'total' => $data['total']
        ])
        ->update();
        return true;
    }
    
    public function list_history_order_user($params = null, $status = null)
    {
        $var = "(SELECT GROUP_CONCAT(concat(tbl_files.name, ' ('), concat(tod.quantity, ')') SEPARATOR ',') FROM tbl_order_detail tod left JOIN tbl_files ON tbl_files.id = tod.file_id WHERE tod.order_id = tbl_orders.id) AS item";
        if ($params == null) {
            $query = $this->select('tbl_orders.id, user_id, (SELECT SUM(quantity) FROM tbl_order_detail WHERE tbl_order_detail.order_id = tbl_orders.id) AS total_item, total AS total_price, status, discount, (total - discount) AS price_after_diskon, ' . $var)->join('tbl_discs', 'tbl_discs.id = tbl_orders.disc_id', 'left')
            ->where('status IS NOT NULL')
            ->orderBy('date', 'desc')
            ->findAll();
            // dd($this->getLastQuery());
            return $query;
        } else {
            if (isset($params['date_profit'])) {
                $query = $this->select('tbl_orders.id, (SELECT SUM(quantity) FROM tbl_order_detail WHERE tbl_order_detail.order_id = tbl_orders.id) AS total_item, total AS total_price, discount, (total - discount) AS price_after_diskon')->join('tbl_discs', 'tbl_discs.id = tbl_orders.disc_id', 'left')
                ->where('status IS NOT NULL')
                ->like('date', $params['date_profit'])
                ->orderBy('date', 'desc')
                ->findAll();
                return $query;
            } else if (isset($params['date_order'])) {
                $query = $this->select('tbl_orders.id, status, user_id, (SELECT SUM(quantity) FROM tbl_order_detail WHERE tbl_order_detail.order_id = tbl_orders.id) AS total_item, ' . $var)->join('tbl_discs', 'tbl_discs.id = tbl_orders.disc_id', 'left')
                ->where('status IS NOT NULL')
                ->like('date', $params['date_order'])
                ->orderBy('date', 'desc')
                ->findAll();
                return $query;
            } else {
                if ($status == null) {
                    $query = $this->select('tbl_orders.id, user_id, total, status, discount, date')->join('tbl_discs', 'tbl_discs.id = tbl_orders.disc_id', 'left')
                    ->where('user_id', $params)
                    ->where('status !=', 'sudah_bayar')
                    ->where('status IS NOT NULL')
                    ->orderBy('date', 'desc')
                    ->find();
                    return $query;
                } else {
                    $query = $this->select('tbl_orders.id, user_id, total, status, discount, date')->join('tbl_discs', 'tbl_discs.id = tbl_orders.disc_id', 'left')
                    ->where('user_id', $params)
                    ->where('status', 'sudah_bayar')
                    ->where('status IS NOT NULL')
                    ->orderBy('date', 'desc')
                    ->find();
                    return $query;
                }
            }
        }
    }
    
    public function order_in_progress()
    {
        $var = "(SELECT GROUP_CONCAT(concat(tbl_files.name, ' ('), concat(tod.quantity, ')') SEPARATOR ',') FROM tbl_order_detail tod left JOIN tbl_files ON tbl_files.id = tod.file_id WHERE tod.order_id = tbl_orders.id) AS item";
        $query = $this->select('tbl_orders.id, user_id, (SELECT SUM(quantity) FROM tbl_order_detail WHERE tbl_order_detail.order_id = tbl_orders.id) AS total_item, total AS total_price, status, discount, (total - discount) AS price_after_diskon, ' . $var)->join('tbl_discs', 'tbl_discs.id = tbl_orders.disc_id', 'left')
            ->where('status', 'pesanan_belum_diproses')
            ->orderBy('date', 'desc')
            ->findAll();
        return $query;
    }

    public function update_status($status, $order_id)
    {
        $this->set(['status' => $status])->where('id', $order_id)->update();
        return true;
    }
    
    public function check_order($user)
    {
        $query = $this->where('user_id', $user)->where('status !=', 'sudah_bayar')->find();
        return $query;
    }
    
    public function get_user_loyal()
    {
        $query = $this->select('name, username, count(user_id) as total')->join('tbl_users', 'tbl_users.username = tbl_orders.user_id', 'left')->groupBy('name, user_id')->orderBy('total', 'asc')->limit(5)->find();
        return $query;
    }
}
