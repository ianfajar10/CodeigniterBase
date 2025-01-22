<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = "tbl_transaction";

    protected $allowedFields = [
        "id",
        "username",
        "product_id",
        "qty",
        "price",
    ];

    protected $useTimestamps = true;

    public function get($params = null)
    {
        $query = $this->find();
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
