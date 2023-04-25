<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = "tbl_carts";

    protected $allowedFields = [
        "user_id",
        "file_id",
        "quantity"
    ];

    public function save_data($data)
    {
        $user_file_id = $this->where('user_id', $data['user_id'])->where('file_id', $data['file_id'])->find();

        if ($user_file_id) {
            $this->where('user_id', $data['user_id'])
                ->where('file_id', $data['file_id'])
                ->set([
                    'quantity' => $data['quantity']
                ])
                ->update();
            return true;
        } else {
            $this->insert($data);
            return true;
        }
    }

    public function get_user_files($params = null)
    {
        $query = $this->where('user_id', $params['user_id'])
            ->where('file_id', $params['file_id'])->find();
        return $query;
    }

    public function list_cart_user($params = null)
    {
        $query = $this->where('user_id', $params)->find();
        return $query;
    }
}
