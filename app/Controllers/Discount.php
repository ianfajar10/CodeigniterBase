<?php

namespace App\Controllers;

use App\Models\FileModel;

class Discount extends BaseController
{
    public function index()
    {
        $modules = (new Modules)->index();
        $data = [
            'name' => 'discount',
            'title' => 'Potongan Harga',
            'modules' => $modules
        ];
        return view('_content/_views/view_discount', $data);
    }
}