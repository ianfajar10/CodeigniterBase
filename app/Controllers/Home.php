<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FileModel;

class Home extends BaseController
{
    protected
        $fileModel;

    public function __construct()
    {
        $this->fileModel = new FileModel();
    }

    public function index()
    {
        $getFiles = $this->fileModel->get_files();

        $data = [
            'product' => $getFiles
        ];
        return view('_base/home',$data);
    }
}
