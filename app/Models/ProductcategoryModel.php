<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductcategoryModel extends Model
{
    protected $table = "tbl_categories";
    protected $primaryKey = "id";

    protected $allowedFields = [
        "name"
    ];

    protected $useTimestamps = false;

    public function get($params = null)
    {
        if ($params == null) {
            return $this->findAll();
        } else {
            $query = $this->where('id', $params)->find();
            return $query;
        }
    }
    
    public function save_file($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
}
