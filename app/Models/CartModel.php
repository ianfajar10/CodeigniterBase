<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = "tbl_carts";

    protected $allowedFields = [
        "user_id",
        "file_id",
        "quantity",
        "variant"
    ];

    public function save_data($data)
    {
        $user_file_id = $this->where('user_id', $data['user_id'])->where('file_id', $data['file_id'])->find();

        if ($user_file_id) {
            if($data['quantity'] !== '0'){
                $this->where('user_id', $data['user_id'])
                    ->where('file_id', $data['file_id'])
                    ->set([
                        'quantity' => $data['quantity']
                    ])
                    ->update();
                    return true;
                } else {
                    $this->where('user_id', $data['user_id'])
                    ->where('file_id', $data['file_id'])
                    ->delete();
                    return true;
            }
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
        $query = $this->select('tbl_carts.*, tbl_files.name, tbl_files.description, tbl_files.file, tbl_files.type, tbl_files.disc_id, (tbl_files.price - (tbl_discs.discount * tbl_files.price)) AS price')->join('tbl_files', 'tbl_files.id = tbl_carts.file_id', 'left')
        ->join('tbl_discs', 'tbl_discs.id = tbl_files.disc_id', 'left')
        ->where('user_id', $params)
        ->find();
        return $query;
    }

    public function list_history_cart_user($params = null)
    {
        $query = $this->join('tbl_files', 'tbl_files.id = tbl_carts.file_id', 'left')
        ->where('user_id', $params)->find();
        return $query;
    }

    public function delete_cart($data)
    {
        $this->where('user_id', $data['user_id'])
        ->where('file_id', $data['file_id'])
        ->delete();
        return true;
    }
}
