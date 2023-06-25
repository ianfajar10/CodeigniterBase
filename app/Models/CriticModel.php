<?php

namespace App\Models;

use CodeIgniter\Model;

class CriticModel extends Model
{
    protected $table = "tbl_critics";
    
    protected $primaryKey = "id";

    protected $useTimestamps = true;

    protected $allowedFields = [
        "username",
        "critic",
        "created_at"
    ];

    public function save_data($data)
    {
        $this->insert($data);
        return true;
    }

    public function get_critic($params = null)
    {
        if (isset($params)) {
            $query = $this->where('username', $params)->orderBy('created_at', 'desc')->findAll();
            return $query;
        } else {
            $query = $this->orderBy('created_at', 'desc')->findAll();
            return $query;
        }
    }
}
