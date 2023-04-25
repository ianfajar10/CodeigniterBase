<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\FileModel;

class Menulist extends BaseController
{
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

        $modules = (new Modules)->index();
        $data = [
            'name' => 'menulist',
            'title' => 'Detail Menu',
            'file' => $file->get_files($params),
            'rating' => 0,
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
}
