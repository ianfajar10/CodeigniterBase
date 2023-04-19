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
}
