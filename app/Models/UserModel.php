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
        "birth",
        "email",
        "telp",
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
        return $query;
    }
    
    public function check_email($param)
    {
        $query = $this->where('email', $param)->findAll();
        return $query;
    }
    
    public function check_birth_user($param)
    {
        // dd(date("Y-m-d"));
        $query = $this->where('username', $param)->like('birth', date("m-d"))->findAll();
        // print_r($this->getLastQuery());die;
        return $query;
    }
}
