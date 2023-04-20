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
            'name' => 'menu-list',
            'title' => 'Daftar Menu',
            'file' => $file->get_files(),
            'modules' => $modules
        ];
        return view('_content/_views/view_menu_list', $data);
    }
}
