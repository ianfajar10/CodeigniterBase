<?php

namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{
    protected $table = 'tbl_files';
    protected $primaryKey = "id";

    protected $allowedFields = [
        "id",
        "name",
        "description",
        "file",
        "type",
        "price",
        "disc_id",
    ];

    public function get_files($params = null)
    {
        if ($params == null) {
            return $this->findAll();
        } else {
            $query = $this->where('id', $params)->find();
            return $query;
        }
    }
    
    public function get_files_by_search($query = null)
    {
        if ($query == null) {
            return $this->findAll();
        } else {
            $query = $this->like('name', $query)->find();
            return $query;
        }
    }

    public function save_file($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
    
    public function delete_files($id)
    {
        $this->where('id', $id)
        ->delete();
        return true;
    }

    public function get_files_cond($params = null)
    {
        return $this->select('tbl_files.id, name, file, (discount * 100) as discount, price, (price - price * discount) AS after_discount')->join('tbl_discs', 'tbl_discs.id = tbl_files.disc_id', 'left')->orderBy('discount', 'desc')->findAll();
    }

    public function save_discount($file_id, $discount)
    {
        $this->set(['disc_id' => $discount])->where('id', $file_id)->update();
        return true;
    }
}
