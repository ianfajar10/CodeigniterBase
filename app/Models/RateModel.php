<?php

namespace App\Models;

use CodeIgniter\Model;

class RateModel extends Model
{
    protected $table = "tbl_rates";

    protected $allowedFields = [
        "product_id",
        "username",
        "rate",
    ];

    protected $useTimestamps = false;

    public function get($params = null, $params2 = null)
    {
        if ($params == null) {
            return $this->findAll();
        } else {
            $query = $this->where('product_id', $params);
            if ($params2 != null) {
                $query = $query->where('username', $params2);
            }
            return $query->findAll();
        }
    }


    public function save_file($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
}
