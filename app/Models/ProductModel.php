<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $session;
    
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    protected $table = 'tbl_products';
    protected $primaryKey = "id";

    protected $allowedFields = [
        "name",
        "price",
        "description",
        "file",
        "category",
        "type",
        "stock"
    ];

    protected $useTimestamps = true;

    public function get($params = null)
    {
        $builder = $this->builder();

        if ($params === null) {
            $builder->select('tbl_products.*, tbl_users.name as mitra_name');

            if (isset($this->session) && $this->session->get('username') != null) {
                $builder->select('(CASE WHEN tbl_favorites.product_id IS NOT NULL THEN TRUE ELSE FALSE END) as love')
                ->join('tbl_favorites', 'tbl_favorites.product_id = tbl_products.id AND tbl_favorites.username = ' . $this->db->escape($this->session->get('username')), 'left');
            }

            $builder->join('tbl_users', 'tbl_users.username = tbl_products.created_by', 'left');

            return $builder->get()->getResult();
        } else {
            $builder->select('tbl_products.*, tbl_users.name as mitra_name, tbl_categories.name as category_name');

            if (isset($this->session) && $this->session->get('username') != null) {
                $builder->select('(CASE WHEN tbl_favorites.product_id IS NOT NULL THEN TRUE ELSE FALSE END) as love')
                ->join('tbl_favorites', 'tbl_favorites.product_id = tbl_products.id AND tbl_favorites.username = ' . $this->db->escape($this->session->get('username')), 'left');
            }

            $builder->join('tbl_users', 'tbl_users.username = tbl_products.created_by', 'left')
            ->join('tbl_categories', 'tbl_products.category = tbl_categories.id', 'left')
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
