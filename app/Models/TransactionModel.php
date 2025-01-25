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
        "paid_status",
        "receipt_number",
    ];

    protected $useTimestamps = false;

    public function get($params = null, $params2 = null, $params3 = null)
    {
        $builder = $this->builder();

        $builder->select('tbl_transaction.*, tbl_users.provinsi, tbl_users.kabupaten, tbl_users.kecamatan, tbl_users.alamat, tbl_products.name as product_name, tbl_users.name as user_name, tbl_users2.name as mitra_name')
                ->join('tbl_products', 'tbl_products.id = tbl_transaction.product_id', 'left')
                ->join('tbl_users as tbl_users2', 'tbl_users2.username = tbl_products.created_by', 'left')
                ->join('tbl_users', 'tbl_users.username = tbl_transaction.username', 'left');

        if ($params !== null) {
            $builder->where('tbl_transaction.id', $params); 
        }

        if ($params2 !== null) {
            $builder->where('tbl_products.created_by', $params2); 
        }

        if ($params3 !== null) {
            $builder->where('tbl_transaction.username', $params3); 
        }

        $query = $builder->get();

        return $query->getResult();
    }

    public function get_report($params = null)
    {
        $builder = $this->builder();

        $builder = $this->db->table('tbl_users u');
        $builder->select('u.name as name, u.provinsi, u.email, u.telepon, SUM(t.qty) as total_products_sold');
        $builder->join('tbl_products p', 'u.username = p.created_by');
        $builder->join('tbl_transaction t', 'p.id = t.product_id');
        $builder->groupBy('u.name, u.provinsi, u.email, u.telepon');
        $builder->orderBy('total_products_sold', 'DESC');
        $query = $builder->get();

        return $query->getResult();
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
