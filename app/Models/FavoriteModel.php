<?php

namespace App\Models;

use CodeIgniter\Model;

class FavoriteModel extends Model
{
    protected $table = "tbl_favorites";

    protected $allowedFields = [
        "username",
        "product_id",
    ];

    protected $useTimestamps = false;

    public function get($params = null)
    {
        $query = $this->where('username', $params)->find();
        return $query;
    }
    
    public function store($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function check($data)
    {
        $query = $this->db->table($this->table)
            ->where('username', $data['username'])
            ->where('product_id', $data['product_id'])
            ->get();

        return $query->getRowArray();
    }

    public function destroy($data)
    {
        $query = $this->db->table($this->table)
            ->where('username', $data['username'])
            ->where('product_id', $data['product_id'])
            ->delete();

        return $query;
    }
}
