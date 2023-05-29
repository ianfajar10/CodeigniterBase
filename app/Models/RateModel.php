<?php

namespace App\Models;

use CodeIgniter\Model;

class RateModel extends Model
{
    protected $table = "tbl_rates";

    protected $allowedFields = [
        "file_id",
        "user_id",
        "rate",
        "comment",
    ];

    public function check_user($params, $var)
    {
        return $this->where('user_id', $params['user_id'])->where('file_id', $params['file_id'])->where('rate', $var)->find();
    }

    public function count_rating($params)
    {
        return $this->where('file_id', $params['file_id'])->find();
    }

    public function save_data($data)
    {
        $user = $this->where('user_id', $data['user_id'])->where('file_id', $data['file_id'])->find();

        if ($user) {
            $this->where('user_id', $data['user_id'])
                ->where('file_id', $data['file_id'])
                ->set([
                    'rate' => $data['rate']
                ])
                ->update();
            return true;
        } else {
            $this->insert($data);
            return true;
        }
    }
}
