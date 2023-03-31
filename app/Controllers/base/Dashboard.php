<?php

namespace App\Controllers\Base;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        return view('base/dashboard');
    }
}
