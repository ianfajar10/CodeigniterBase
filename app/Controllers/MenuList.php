<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class MenuList extends BaseController
{
    public function index()
    {
        $modules = (new Modules)->index();
        $data = [
            'name' => 'menu-list',
            'title' => 'Daftar Menu',
            'modules' => $modules
        ];
        return view('_content/_views/view_menu_list', $data);
    }
}
