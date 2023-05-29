<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\FileModel;
use App\Models\RateModel;

class Menulist extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $file = new FileModel();

        $modules = (new Modules)->index();
        $data = [
            'name' => 'menulist',
            'title' => 'Daftar Menu',
            'file' => $file->get_files(),
            'modules' => $modules
        ];
        return view('_content/_views/view_menu_list', $data);
    }

    public function detail($params)
    {
        $file = new FileModel();
        $rate = new RateModel();
        $modules = (new Modules)->index();

        $new_params = [
            'file_id' => $params,
            'user_id' => $this->session->get('username')
        ];

        $data = [
            'name' => 'menulist',
            'title' => 'Detail Menu',
            'file' => $file->get_files($params),
            'rating' => count($rate->count_rating($new_params)),
            'like' => $rate->check_user($new_params, 'like'),
            'dislike' => $rate->check_user($new_params, 'dislike'),
            'modules' => $modules,
            'params' => [
                'id' => $params
            ]
        ];
        return view('_content/_views/view_menu_list_detail', $data);
    }

    public function search($query = null)
    {
        $query = $this->request->getPost()['query'];

        $file = new FileModel();

        $modules = (new Modules)->index($query);
        $data = [
            'name' => 'menulist',
            'title' => 'Detail Menu',
            'file' => $file->get_files_by_search($query),
            'query' => $query,
            'modules' => $modules
        ];
        return view('_content/_views/view_menu_list', $data);
    }

    public function detail_item_user()
    {
        $params = $this->request->getPost();
        $cart = new CartModel();

        $response = $cart->get_user_files($params) ? $cart->get_user_files($params)[0] : null;

        return $this->response->setJSON($response);
    }

    public function rate_process()
    {
        $rate = new RateModel();

        $params = $this->request->getPost();

        $data = [
            'user_id' => $params['user_id'],
            'file_id' => $params['file_id'],
            'rate' => $params['rate'],
        ];

        $save = $rate->save_data($data);

        if ($save) {
            $response = [
                'success' => true,
                'msg' => 'Berhasil memberi penilaian.'
            ];
        } else {
            $response = [
                'success' => false,
                'msg' => 'Gagal memberi penilaian.'
            ];
        }

        return $this->response->setJSON($response);
    }
}
