<?php

namespace App\Models;

use CodeIgniter\Model;

class DiscountModel extends Model
{
    protected $table = "tbl_discs";

    protected $allowedFields = [
        "id",
        "discount",
    ];

    public function get_discount()
    {
        return $this->select('(discount * 100) as label, id as value')
        ->where('discount < 1')->findAll();
    }
}
