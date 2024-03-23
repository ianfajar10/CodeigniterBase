<?php

namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{
    protected $table = 'tbl_files';
    protected $primaryKey = "id";

    protected $allowedFields = [
        "name",
        "price",
        "description",
        "file",
        "type"
    ];

    protected $useTimestamps = true;

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

    public function get_files_by_search($query = null)
    {
        if ($query == null) {
            $query = $this->findAll();
            return $query;
        } else {
            $query = $this->like('name', $query)->find();
            return $query;
        }
    }

    public function get_files_by_filter($filter = null)
    {
        if ($filter == null) {
            $query = $this->findAll();
            return $query;
        } else {
            $query = $this->like('additional', $filter)->find();
            return $query;
        }
    }

    public function drop($id = null)
    {
        $query = $this->where('id', $id)->delete();
        return $query;
    }

}
