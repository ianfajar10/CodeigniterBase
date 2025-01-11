<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'tbl_products';
    protected $primaryKey = "id";

    protected $allowedFields = [
        "name",
        "price",
        "description",
        "file",
        "category",
        "type"
    ];

    protected $useTimestamps = true;

    public function get($params = null)
    {
        $builder = $this->builder();

        if ($params === null) {
            $builder->select('tbl_products.*, tbl_users.name as mitra_name')
                ->join('tbl_users', 'tbl_users.username = tbl_products.created_by', 'left');


            return $builder->get()->getResult();
        } else {

            $builder->select('tbl_products.*, tbl_users.name as mitra_name')
            ->join('tbl_users', 'tbl_users.username = tbl_products.created_by', 'left')
            ->where('tbl_products.id', $params)
            ->orWhere("LOWER(tbl_products.name) LIKE", "%" . strtolower($params) . "%");

            return $builder->get()->getResult();
        }
    }

    public function save_product($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
}
