<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
    }
    public function index()
    {
        $sessionData = $this->session->get();
        $data = [
            'session' => $sessionData,
        ];
        return view('_base/home', $data);
    }
}
