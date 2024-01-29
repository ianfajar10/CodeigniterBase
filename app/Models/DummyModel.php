<?php

namespace App\Models;

use CodeIgniter\Model;

class DummyModel extends Model
{
    protected $table = "tbl_dummy";
    protected $primaryKey = "id";

    protected $allowedFields = [
        "column1",
        "column2",
        "column3",
        "column4",
        "column5",
    ];

    protected $useTimestamps = false;

    public function get_dummy()
    {
        $query = $this->findAll();
        return $query;
    }
}
