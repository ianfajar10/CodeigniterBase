<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Core extends BaseController
{
    public function index()
    {
        return view('_base/core');
    }
}
