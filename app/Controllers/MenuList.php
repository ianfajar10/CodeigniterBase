<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FileModel;

class MenuList extends BaseController
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
            'rating' => 5,
            'modules' => $modules
        ];
        return view('_content/_views/view_menu_list_detail', $data);
    }
}
