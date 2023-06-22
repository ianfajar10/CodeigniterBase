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
        "best",
    ];

    public function get_files($params = null)
    {
        if ($params == null) {
            $query = $this->select('tbl_files.id, name, description, file, type, price, tbl_discs.discount')->join('tbl_discs', 'tbl_discs.id = tbl_files.disc_id', 'left')->findAll();
            return $query;
        } else if($params == 'food') {
            $query = $this->select('tbl_files.id, name, description, file, type, price, tbl_discs.discount, best')->join('tbl_discs', 'tbl_discs.id = tbl_files.disc_id', 'left')->like('tbl_files.name', 'makanan')->find();
            return $query;
        } else if ($params == 'drink') {
            $query = $this->select('tbl_files.id, name, description, file, type, price, tbl_discs.discount, best')->join('tbl_discs', 'tbl_discs.id = tbl_files.disc_id', 'left')->like('tbl_files.name', 'minuman')->find();
            return $query;
        } else {
            $query = $this->select('tbl_files.id, name, description, file, type, price, tbl_discs.discount')->join('tbl_discs', 'tbl_discs.id = tbl_files.disc_id', 'left')->where('tbl_files.id', $params)->find();
            return $query;
        }
    }
    
    public function get_files_by_search($query = null)
    {
        if ($query == null) {
            $query = $this->select('tbl_files.id, name, description, file, type, price, tbl_discs.discount')->join('tbl_discs', 'tbl_discs.id = tbl_files.disc_id', 'left')->findAll();
            return $query;
        } else {
            $query =
            $this->select('tbl_files.id, name, description, file, type, price, tbl_discs.discount')->join('tbl_discs', 'tbl_discs.id = tbl_files.disc_id', 'left')->like('name', $query)->find();
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

    public function get_unlike_menu()
    {
        $query = $this->select('name, SUM(quantity) as quantity')->join('tbl_order_detail', 'tbl_order_detail.file_id = tbl_files.id', 'left')->groupBy('name, quantity')->orderBy('quantity', 'asc')->limit(5)->find();
        return $query;
    }
}
