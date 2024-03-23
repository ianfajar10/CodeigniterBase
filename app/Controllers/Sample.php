<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Sample extends BaseController
{
    public function index()
{
        $modules = (new Modules)->index();
        $data = [
            'title' => 'Sample',
            'modules' => $modules
        ];
        return view('_content/_views/view_sample_page', $data);
    }
}
