<?php

namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{
    protected $table = 'tbl_files';
    protected $primaryKey = "id";

    public function get_files()
    {
        return $this->findAll();
    }

    public function save_file($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
}
