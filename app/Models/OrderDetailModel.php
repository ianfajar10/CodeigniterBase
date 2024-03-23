<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderDetailModel extends Model
{
    protected $table = "tbl_order_details";

    protected $allowedFields = [
        "order_id",
        "product_id",
        "quantity",
        "price",
        "created_at",
        "updated_at",
    ];

    protected $useTimestamps = false;

    public function list()
    {
        $query = $this->select('tbl_order_details.*, tbl_files.name')->join('tbl_files', 'tbl_files.id = tbl_order_details.product_id', 'left')->findAll();
        return $query;
    }

    public function listById($id = null)
    {
        if ($id) {
            $query = $this->select('tbl_order_details.*, tbl_files.name')->join('tbl_files', 'tbl_files.id = tbl_order_details.product_id', 'left')->where('tbl_order_details.order_id', $id)->find();
        }
        return $query;
    }
}
