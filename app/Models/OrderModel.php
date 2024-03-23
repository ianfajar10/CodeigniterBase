<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = "tbl_orders";
    protected $primaryKey = "id";

    protected $allowedFields = [
        "user_id",
        "table",
        "total_amount",
        "created_at",
        "updated_at",
    ];

    protected $useTimestamps = false;

    public function store($data)
    {
        $data_insert1 = [
            'user_id' => $data['userId'],
            'table' => $data['tableNumber'],
            'total_amount' => $data['totalPrice'],
            'status' => "menunggu_pembayaran",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $query = $this->db->table($this->table)->insert($data_insert1);
        
        
        if($query){
            
            $orderId = $this->db->insertID();
            
            $dataDetail = $data['products'];

            $insertData = [];
            foreach ($dataDetail as $item) {
                $item['price'] = str_replace('.', '', $item['price']);
                $item['price'] = str_replace(',00', '', $item['price']);
                
                // Menghitung harga per item
                $price = intval($item['price']) * intval($item['quantity']);
                
                
                // Menambahkan data untuk insert batch
                $insertData[] = [
                    'order_id' => $orderId,
                    'product_id' => $item['id'],
                    'price' => $price,
                    'quantity' => $item['quantity'],
                    'created_at' => date('Y-m-d H:i:s'),
                ];
            }
            
            $query2 = $this->db->table('tbl_order_details')->insertBatch($insertData);
            return $query2;
        }

        return $query;
    }

    public function list($userId = null)
    {
        if ($userId) {
            $query = $this->select('id, CONCAT("MC-", id) as no_pesanan, user_id, table, CONCAT(UPPER(SUBSTRING(REPLACE(status, "_", " "), 1, 1)), LOWER(SUBSTRING(REPLACE(status, "_", " "), 2))) AS status, total_amount, updated_at')->where('user_id', $userId)->find();
        } else {
            $query = $this->select('id, CONCAT("MC-", id) as no_pesanan, user_id, table, CONCAT(UPPER(SUBSTRING(REPLACE(status, "_", " "), 1, 1)), LOWER(SUBSTRING(REPLACE(status, "_", " "), 2))) AS status, total_amount, updated_at')->findAll();
        }
        return $query;
    }

    public function listById($id = null)
    {
        if ($id) {
            $query = $this->select('id, user_id, table, CONCAT(UPPER(SUBSTRING(REPLACE(status, "_", " "), 1, 1)), LOWER(SUBSTRING(REPLACE(status, "_", " "), 2))) AS status, total_amount, updated_at')->where('id', $id)->find();
        } else {
            $query = $this->select('id, user_id, table, CONCAT(UPPER(SUBSTRING(REPLACE(status, "_", " "), 1, 1)), LOWER(SUBSTRING(REPLACE(status, "_", " "), 2))) AS status, total_amount, updated_at')->findAll();
        }
        return $query;
    }

    public function updates($data = null)
    {
        $id = $data['id'];
        $status = $data['status'];

        $data_insert = [
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $query = $this->db->table($this->table)->where('id', $id)->update($data_insert);
        return $query;
    }
}
