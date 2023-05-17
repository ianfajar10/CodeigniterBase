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
}
