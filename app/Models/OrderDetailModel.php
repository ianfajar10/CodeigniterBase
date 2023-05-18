<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderDetailModel extends Model
{
    protected $table = "tbl_order_detail";

    protected $allowedFields = [
        "order_id",
        "file_id",
        "quantity",
        "price"
    ];

    public function save_data_detail($data2)
    {
        $this->insert($data2);
        return true;
    }

    public function get_item_order($params)
    {
        $query = $this->join('tbl_files', 'tbl_files.id = tbl_order_detail.file_id', 'left')
        ->where('order_id', $params)
        ->find();
        return $query;
    }
}
