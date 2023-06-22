<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = "tbl_users";
    protected $primaryKey = "id";

    protected $allowedFields = [
        "name",
        "username",
        "password",
        "email",
        "role"
    ];

    protected $useTimestamps = true;

    public function check_login($data)
    {
        $query = $this->where('username', $data['username'])->find();
        return $query;
    }

    public function save_data($data)
    {
        $query = $this->insert($data);
        return $query;
    }

    public function list_user()
    {
        $query = $this->where('username !=', 'admin')->findAll();
        // dd($this->getLastQuery());
        return $query;
    }

    public function check_email($param)
    {
        $query = $this->where('email', $param)->findAll();
        return $query;
    }
}
