<?php

namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{
    protected $table = 'tbl_files';
    protected $primaryKey = "id";

    public function get_files($params = null)
    {
        if ($params == null) {
            return $this->findAll();
        } else {
            $query = $this->where('id', $params)->find();
            return $query;
        }
    }

    public function save_file($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
}
