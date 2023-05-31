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
        if (!($var == 'comment')) {
            return $this->where('user_id', $params['user_id'])->where('file_id', $params['file_id'])->where('rate', $var)->find();
        } else {
            return $this->where('user_id', $params['user_id'])->where('file_id', $params['file_id'])->where('comment IS NOT NULL')->find();
        }
    }

    public function count_rating($params)
    {
        return $this->where('file_id', $params['file_id'])->find();
    }

    public function save_data($data)
    {
        $user = $this->where('user_id', $data['user_id'])->where('file_id', $data['file_id'])->find();

        $var = array_key_exists('rate', $data) ? 'rate' : 'comment';

        $value = array_key_exists('rate', $data) ? $data['rate'] : $data['comment'];

        if ($user) {
            $this->where('user_id', $data['user_id'])
                ->where('file_id', $data['file_id'])
                ->set([
                    $var => $value
                ])
                ->update();
            return true;
        } else {
            $this->insert($data);
            return true;
        }
    }

    public function get_comment($params)
    {
        return $this->where('file_id', $params['file_id'])->where('comment IS NOT NULL')->findAll();
        // return $this->where('file_id', $params['file_id'])->where('user_id', $params['user_id'])->where('comment IS NOT NULL')->findAll();
    }

    public function get_like($params)
    {
        return $this->where('file_id', $params['file_id'])->where('rate', 'like')->findAll();
        // return $this->where('file_id', $params['file_id'])->where('user_id', $params['user_id'])->where('comment IS NOT NULL')->findAll();
    }
}
